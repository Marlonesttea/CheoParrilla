<?php
/* ============================================================
   AGENDA.PHP  -  EL CEREBRO DEL MODULO DE RESERVAS
   ------------------------------------------------------------
   Aqui vive UNA SOLA VEZ la regla de si hay cupo o no.
   La usan la pagina publica, el archivo que devuelve las horas
   en JSON, y el panel de administracion.

   La idea central del modulo:
   un restaurante no vende platos en esta pantalla, vende MESAS
   DURANTE UN RATO. Lo que se agota es la capacidad del local
   en una franja de tiempo.
   ============================================================ */

require_once __DIR__ . '/bd.php';

/* ------------------------------------------------------------
   AYUDAS DE TIEMPO
   Trabajamos en minutos desde medianoche porque comparar
   numeros es mas facil y mas seguro que comparar textos.
   "19:30"  ->  1170
   ------------------------------------------------------------ */

function a_minutos(string $hora): int
{
    [$h, $m] = explode(':', $hora);
    return ((int)$h) * 60 + ((int)$m);
}

function a_hora(int $minutos): string
{
    return sprintf('%02d:%02d', intdiv($minutos, 60), $minutos % 60);
}

/** Convierte 19:30 en "07:30 pm" para mostrarlo bonito. */
function hora_bonita(string $hora): string
{
    return strtolower(date('h:i a', strtotime($hora)));
}


/* ------------------------------------------------------------
   CONFIGURACION
   Lee la tabla reservas_config una sola vez y la deja en memoria.
   Asi el dueño cambia la capacidad del local desde el panel y
   todo el modulo se entera, sin tocar una linea de codigo.
   ------------------------------------------------------------ */

function config(mysqli $db): array
{
    static $cache = null;              // se calcula una sola vez por peticion
    if ($cache !== null) {
        return $cache;
    }

    $cache = [];
    $res = $db->query("SELECT clave, valor FROM reservas_config");
    while ($fila = $res->fetch_assoc()) {
        $cache[$fila['clave']] = $fila['valor'];
    }
    return $cache;
}

function cfg(mysqli $db, string $clave, $porDefecto = '')
{
    $c = config($db);
    return $c[$clave] ?? $porDefecto;
}


/* ------------------------------------------------------------
   HORARIO DEL DIA
   Devuelve la fila de reservas_horarios que corresponde al dia
   de la semana de esa fecha, o null si ese dia el local no abre.

   date('N') devuelve 1 para lunes y 7 para domingo, que es
   exactamente como numeramos la tabla. Por eso la llave primaria
   de reservas_horarios es el dia de la semana.
   ------------------------------------------------------------ */

function horario_del_dia(mysqli $db, string $fecha): ?array
{
    $dia = (int)date('N', strtotime($fecha));

    $stmt = $db->prepare("SELECT * FROM reservas_horarios WHERE dia_semana = ?");
    $stmt->bind_param('i', $dia);
    $stmt->execute();
    $horario = $stmt->get_result()->fetch_assoc();

    if (!$horario || (int)$horario['abre'] !== 1) {
        return null;                   // ese dia de la semana no se atiende
    }
    return $horario;
}


/** ¿Esa fecha suelta esta bloqueada? Devuelve el motivo, o null. */
function bloqueo_del_dia(mysqli $db, string $fecha): ?string
{
    $stmt = $db->prepare("SELECT motivo FROM reservas_bloqueos WHERE fecha = ?");
    $stmt->bind_param('s', $fecha);
    $stmt->execute();
    $fila = $stmt->get_result()->fetch_assoc();
    return $fila ? $fila['motivo'] : null;
}


/* ------------------------------------------------------------
   ¿SE PUEDE RESERVAR ESE DIA?
   Revisa, en orden: que la fecha tenga forma de fecha, que no
   sea de ayer, que no este demasiado lejos, que ese dia de la
   semana el local abra, y que no sea un dia bloqueado.
   Devuelve '' si todo esta bien, o el motivo del rechazo.
   ------------------------------------------------------------ */

function fecha_reservable(mysqli $db, string $fecha): string
{
    $d = DateTime::createFromFormat('Y-m-d', $fecha);
    if (!$d || $d->format('Y-m-d') !== $fecha) {
        return 'La fecha no es valida.';
    }

    $hoy = new DateTime('today');
    if ($d < $hoy) {
        return 'Esa fecha ya paso.';
    }

    $tope = (new DateTime('today'))->modify('+' . (int)cfg($db, 'dias_anticipacion', 30) . ' days');
    if ($d > $tope) {
        return 'Solo se puede reservar hasta el ' . $tope->format('d/m/Y') . '.';
    }

    if (!horario_del_dia($db, $fecha)) {
        return 'Ese dia el restaurante no abre.';
    }

    $motivo = bloqueo_del_dia($db, $fecha);
    if ($motivo !== null) {
        return 'Dia no disponible: ' . $motivo;
    }

    return '';
}


/* ------------------------------------------------------------
   RESERVAS QUE OCUPAN MESA EN UNA FECHA
   pendiente, confirmada y cumplida  ->  OCUPAN
   cancelada y no_asistio            ->  LIBERAN la mesa
   Por eso nunca borramos una reserva: basta cambiarle el estado.
   ------------------------------------------------------------ */

function reservas_del_dia(mysqli $db, string $fecha): array
{
    $sql = "SELECT personas, hora
              FROM reservas
             WHERE fecha = ?
               AND estado IN ('pendiente','confirmada','cumplida')";

    $stmt = $db->prepare($sql);
    $stmt->bind_param('s', $fecha);
    $stmt->execute();

    $lista = [];
    $res = $stmt->get_result();
    while ($fila = $res->fetch_assoc()) {
        $lista[] = [
            'personas' => (int)$fila['personas'],
            'inicio'   => a_minutos($fila['hora']),
        ];
    }
    return $lista;
}


/* ------------------------------------------------------------
   CUANTAS PERSONAS HAY DENTRO DEL LOCAL A UNA HORA DADA
   ------------------------------------------------------------
   Esta es LA funcion del modulo. Una reserva de las 6:30 que
   dura 90 minutos sigue ocupando la mesa a las 7:00 y a las 7:30.
   Entonces no basta con contar las reservas de esa hora exacta:
   hay que contar todas las que SE CRUZAN con esa franja.

   Regla del choque de dos intervalos A y B:

        inicioA < finB   Y   finA > inicioB

   Se usa  <  y no  <=  a proposito: si una reserva termina justo
   a las 8:00 y otra empieza a las 8:00, NO se estorban.
   ------------------------------------------------------------ */

function ocupacion_en(array $reservas, int $franja, int $duracion): int
{
    $finFranja = $franja + $duracion;
    $total = 0;

    foreach ($reservas as $r) {
        $inicioR = $r['inicio'];
        $finR    = $inicioR + $duracion;

        if ($inicioR < $finFranja && $finR > $franja) {   // se cruzan
            $total += $r['personas'];
        }
    }
    return $total;
}


/* ------------------------------------------------------------
   HORAS DISPONIBLES DE UN DIA
   Devuelve TODAS las franjas del dia, cada una marcada como
   libre o no. Se devuelven todas (no solo las libres) para poder
   mostrarlas en gris, como en las paginas de reservas reales:
   eso le dice al cliente "si hay servicio, pero a esa hora no".
   ------------------------------------------------------------ */

function horas_del_dia(mysqli $db, string $fecha, int $personas): array
{
    $horario = horario_del_dia($db, $fecha);
    if (!$horario) {
        return [];
    }

    $intervalo = (int)cfg($db, 'intervalo_min', 30);
    $duracion  = (int)cfg($db, 'duracion_min', 90);
    $capacidad = (int)cfg($db, 'capacidad_local', 40);

    $apertura = a_minutos($horario['apertura']);
    $cierre   = a_minutos($horario['cierre']);

    // La ultima franja debe alcanzar a terminar antes de cerrar.
    $ultima = $cierre - $duracion;

    $reservas = reservas_del_dia($db, $fecha);
    $ahora    = a_minutos(date('H:i'));
    $esHoy    = ($fecha === date('Y-m-d'));

    $franjas = [];

    for ($m = $apertura; $m <= $ultima; $m += $intervalo) {

        $ocupado = ocupacion_en($reservas, $m, $duracion);
        $libres  = $capacidad - $ocupado;

        $disponible = ($libres >= $personas);
        $motivo     = $disponible ? '' : 'Sin cupo para ' . $personas . ' personas';

        // Si es hoy, no se puede reservar para una hora que ya paso.
        if ($esHoy && $m <= $ahora) {
            $disponible = false;
            $motivo     = 'Esa hora ya paso';
        }

        $franjas[] = [
            'hora'        => a_hora($m),
            'etiqueta'    => hora_bonita(a_hora($m)),
            'disponible'  => $disponible,
            'motivo'      => $motivo,
            'libres'      => max(0, $libres),
        ];
    }

    return $franjas;
}


/* ------------------------------------------------------------
   ¿SIGUE HABIENDO CUPO EXACTAMENTE EN ESTA HORA?
   ------------------------------------------------------------
   Se llama OTRA VEZ al momento de confirmar, aunque la pagina
   ya habia mostrado esa hora como libre.

   ¿Por que repetir la verificacion? Porque entre que el cliente
   escogio las 6:30 y le dio a confirmar pueden pasar dos minutos,
   y en ese rato otra persona pudo tomar el ultimo cupo. Nunca se
   confia en lo que trae el navegador.
   ------------------------------------------------------------ */

function hay_cupo(mysqli $db, string $fecha, string $hora, int $personas): bool
{
    // Primero lo primero: que ese DIA se pueda reservar.
    // (Este renglon faltaba y era un hueco de verdad: escribiendo la
    //  direccion a mano se podia reservar en un dia bloqueado.)
    if (fecha_reservable($db, $fecha) !== '') {
        return false;
    }

    if ($personas < (int)cfg($db, 'min_personas', 1) ||
        $personas > (int)cfg($db, 'max_personas', 10)) {
        return false;
    }

    $franjas = horas_del_dia($db, $fecha, $personas);

    foreach ($franjas as $f) {
        if ($f['hora'] === substr($hora, 0, 5)) {
            return $f['disponible'];
        }
    }
    return false;   // esa hora ni siquiera existe en el horario del dia
}


/* ------------------------------------------------------------
   CODIGO DE LA RESERVA:  CP-R-000123
   Se arma con el id que MySQL acaba de asignar, asi que nunca
   se repite y no hay que consultar cual fue el ultimo.
   ------------------------------------------------------------ */

function codigo_reserva(int $id): string
{
    return 'CP-R-' . str_pad((string)$id, 6, '0', STR_PAD_LEFT);
}


/* ------------------------------------------------------------
   LARGO DE UN TEXTO
   Se usa mb_strlen para que "Muñoz" cuente 5 letras y no 6.
   Pero mb_strlen pertenece a la extension mbstring, que en
   algunas instalaciones de PHP viene apagada. Si no existe,
   se usa strlen, que funciona igual de bien para validar.
   (Este fallo aparecio al probar en otro computador.)
   ------------------------------------------------------------ */
function largo(?string $texto): int
{
    $texto = (string)$texto;
    return function_exists('mb_strlen') ? mb_strlen($texto, 'UTF-8') : strlen($texto);
}


/** Escapa el texto antes de mostrarlo. Defensa contra XSS. */
function limpiar(?string $texto): string
{
    return htmlspecialchars((string)$texto, ENT_QUOTES, 'UTF-8');
}


/** Nombre del dia en español, sin depender de la configuracion del servidor. */
function nombre_dia(int $n): string
{
    $dias = [1 => 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    return $dias[$n] ?? '';
}

function nombre_mes(int $n): string
{
    $meses = [1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
              'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    return $meses[$n] ?? '';
}
