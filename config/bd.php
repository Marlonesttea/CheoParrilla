<?php
/* ============================================================
   CONEXION DEL MODULO DE RESERVAS
   ------------------------------------------------------------
   El modulo trae su propia conexion a proposito: asi funciona
   aunque el resto del proyecto tenga algun archivo roto.
   Si quieren usar la conexion general del proyecto, cambien
   esta funcion por un require de includes/config/database.php.
   ============================================================ */

function bd(): mysqli
{
    // Estos son los datos de XAMPP recien instalado.
    $host   = 'localhost';
    $user   = 'root';
    $clave  = '';
    $base   = 'restaurante_db';

    // Con esta linea, cualquier error de MySQL lanza una excepcion
    // en vez de seguir de largo con datos incompletos.
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $db = new mysqli($host, $user, $clave, $base);
    $db->set_charset('utf8mb4');   // para que las tildes y la ñ no se dañen
    return $db;
}
