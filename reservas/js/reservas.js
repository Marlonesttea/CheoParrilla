/* ============================================================
   RESERVAS.JS  -  Paso 1
   ------------------------------------------------------------
   Este archivo NO decide si hay cupo. Solo le pregunta al
   servidor (api_horas.php) y pinta la respuesta. La decision
   siempre la toma PHP, porque el JavaScript se puede desactivar
   o modificar desde el navegador.
   ============================================================ */

(function () {
    'use strict';

    // --- Elementos de la pagina ---
    var zonaPersonas = document.getElementById('personas');
    var zonaHoras    = document.getElementById('horas');
    var diaElegido   = document.getElementById('diaElegido');
    var btnContinuar = document.getElementById('btnContinuar');
    var errorGeneral = document.getElementById('errorGeneral');

    var inPersonas = document.getElementById('inPersonas');
    var inFecha    = document.getElementById('inFecha');
    var inHora     = document.getElementById('inHora');

    var rPersonas = document.getElementById('rPersonas');
    var rFecha    = document.getElementById('rFecha');
    var rHora     = document.getElementById('rHora');

    // --- Lo que el cliente lleva escogido ---
    var seleccion = { personas: 2, fecha: '', hora: '' };

    var temporizador = null;   // para refrescar solo cada cierto tiempo


    /* --------------------------------------------------------
       1. PERSONAS
       -------------------------------------------------------- */
    zonaPersonas.addEventListener('click', function (e) {
        var boton = e.target.closest('.rsv-bola');
        if (!boton) { return; }

        zonaPersonas.querySelectorAll('.rsv-bola').forEach(function (b) {
            b.classList.remove('rsv-activo');
        });
        boton.classList.add('rsv-activo');

        seleccion.personas = parseInt(boton.dataset.personas, 10);
        inPersonas.value = seleccion.personas;
        rPersonas.textContent = seleccion.personas + (seleccion.personas === 1 ? ' persona' : ' personas');

        // Cambiar el numero de personas cambia las horas disponibles:
        // una hora que servia para 2 puede no servir para 8.
        seleccion.hora = '';
        inHora.value = '';
        rHora.textContent = '—';
        pedirHoras();
    });


    /* --------------------------------------------------------
       2. FECHA
       -------------------------------------------------------- */
    document.addEventListener('click', function (e) {
        var dia = e.target.closest('.rsv-dia');
        if (!dia || !dia.dataset.fecha) { return; }

        document.querySelectorAll('.rsv-dia').forEach(function (d) {
            d.classList.remove('rsv-activo');
        });
        dia.classList.add('rsv-activo');

        seleccion.fecha = dia.dataset.fecha;
        inFecha.value = seleccion.fecha;

        seleccion.hora = '';
        inHora.value = '';
        rHora.textContent = '—';

        pedirHoras();
    });


    /* --------------------------------------------------------
       3. PEDIRLE LAS HORAS AL SERVIDOR
       -------------------------------------------------------- */
    function pedirHoras() {

        if (!seleccion.fecha) {
            zonaHoras.innerHTML = '';
            diaElegido.textContent = 'Escoge primero una fecha';
            revisarBoton();
            return;
        }

        zonaHoras.innerHTML = '<p class="rsv-cargando">Consultando disponibilidad...</p>';

        var url = 'api_horas.php?fecha=' + encodeURIComponent(seleccion.fecha) +
                  '&personas=' + encodeURIComponent(seleccion.personas);

        fetch(url)
            .then(function (r) { return r.json(); })
            .then(function (datos) {

                if (!datos.ok) {
                    zonaHoras.innerHTML = '';
                    diaElegido.textContent = datos.mensaje;
                    revisarBoton();
                    return;
                }

                diaElegido.textContent = datos.etiqueta;
                rFecha.textContent = datos.etiqueta;
                pintarHoras(datos.horas);
            })
            .catch(function () {
                zonaHoras.innerHTML =
                    '<p class="rsv-cargando">No se pudo consultar. Revisa que el servidor esté encendido.</p>';
            });
    }


    function pintarHoras(horas) {

        if (!horas.length) {
            zonaHoras.innerHTML = '<p class="rsv-cargando">Ese día no hay horarios.</p>';
            revisarBoton();
            return;
        }

        zonaHoras.innerHTML = '';

        horas.forEach(function (h) {
            var b = document.createElement('button');
            b.type = 'button';
            b.className = 'rsv-hora' + (h.disponible ? '' : ' rsv-hora-no');
            b.textContent = h.etiqueta;
            b.dataset.hora = h.hora;

            if (!h.disponible) {
                b.disabled = true;
                b.title = h.motivo;
            } else {
                b.title = 'Quedan ' + h.libres + ' puestos';
            }

            // Si la hora que el cliente tenia escogida sigue libre, se vuelve a marcar.
            if (h.hora === seleccion.hora && h.disponible) {
                b.classList.add('rsv-activo');
            }

            zonaHoras.appendChild(b);
        });

        // Si la hora que tenia escogida se ocupo mientras decidia, se le avisa.
        var sigueLibre = horas.some(function (h) {
            return h.hora === seleccion.hora && h.disponible;
        });

        if (seleccion.hora && !sigueLibre) {
            seleccion.hora = '';
            inHora.value = '';
            rHora.textContent = '—';
            errorGeneral.textContent = 'La hora que habías escogido acaba de ocuparse. Elige otra.';
        }

        revisarBoton();
    }


    /* --------------------------------------------------------
       4. HORA
       -------------------------------------------------------- */
    zonaHoras.addEventListener('click', function (e) {
        var boton = e.target.closest('.rsv-hora');
        if (!boton || boton.disabled) { return; }

        zonaHoras.querySelectorAll('.rsv-hora').forEach(function (b) {
            b.classList.remove('rsv-activo');
        });
        boton.classList.add('rsv-activo');

        seleccion.hora = boton.dataset.hora;
        inHora.value = seleccion.hora;
        rHora.textContent = boton.textContent;
        errorGeneral.textContent = '';

        revisarBoton();
    });


    /* --------------------------------------------------------
       5. EL BOTON CONTINUAR SOLO SE ENCIENDE CON TODO ESCOGIDO
       -------------------------------------------------------- */
    function revisarBoton() {
        btnContinuar.disabled = !(seleccion.personas && seleccion.fecha && seleccion.hora);
    }


    /* --------------------------------------------------------
       6. REFRESCO AUTOMATICO
       Cada 45 segundos se vuelven a pedir las horas, por si
       alguien mas reservo mientras el cliente decide.
       -------------------------------------------------------- */
    temporizador = setInterval(function () {
        if (seleccion.fecha) { pedirHoras(); }
    }, 45000);


    // Estado inicial
    rPersonas.textContent = '2 personas';
    revisarBoton();

})();
