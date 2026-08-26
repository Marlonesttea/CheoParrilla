<?php
function conectarDB(): mysqli {
$db = new mysqli("localhost", "root", "", "restaurante_db");
if ($db->connect_error) {
echo "Error de conexión: " . $db->connect_error;
exit;
}
return $db;
}