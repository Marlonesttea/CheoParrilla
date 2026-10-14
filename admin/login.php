
<?php
require __DIR__ . '/../includes/config/database.php';
$db = conectarDB();

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        $errores[] = "Todos los campos son obligatorios";
    }

    if (empty($errores)) {

        $stmt = $db->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        if ($usuario && password_verify($password, $usuario['password'])) {

            session_regenerate_id(true);
            $_SESSION['login'] = true;
            $_SESSION['usuario'] = $usuario['username'];

            header("Location: index.php");
            exit;

        } else {
            $errores[] = "Usuario o contraseña incorrectos";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso administrativo</title>
    <link rel="stylesheet" href="../assets/css/paginas/login.css?v=<?= filemtime(__DIR__ . '/../assets/css/paginas/login.css') ?>">
</head>
<body>
    <form method="POST" class="form">
        <img class="login-mark" src="../img/logoc.png" alt="" aria-hidden="true">
        <h1 class="heading">Iniciar sesión</h1>
        <p class="login-description">Ingresa tus datos para acceder al panel.</p>

        <?php foreach ($errores as $error): ?>
            <div class="login-error"><?= htmlspecialchars($error) ?></div>
        <?php endforeach; ?>

        <label class="visually-hidden" for="username">Nombre de usuario</label>
        <input id="username" class="input" name="username" placeholder="Nombre de usuario" type="text" autocomplete="username" required>

        <label class="visually-hidden" for="password">Contraseña</label>
        <input id="password" class="input" name="password" placeholder="Contraseña" type="password" autocomplete="current-password" required>

        <button class="btn" type="submit">Entrar</button>
    </form>
</body>
</html>