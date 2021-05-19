<?php
session_start();
ob_start();
define("BASE", "");
if (!isset($_SESSION['session_admin'])) {
?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php include BASE . 'commons/head.php'; ?>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/css/NT_login.css?v=<?= time(); ?>" />
    <title>Login</title>
  </head>

  <body class="d-flex flex-column">
    <main class="m-auto shadow-none bg-transparent">
        <div class="login-container">
          <div class="text-center">
            <h3>Gestión de Costos</h3>
          </div>
          <form id="f_login_usuario" name="f_login_usuario">
            <div class="mt-5 mb-2">
              <div class="pb-4 text-admin"><b>Hola, inicia sesi&oacute;n con tu usuario</b></div>
              <input type="text" name="usuario" id="login_usuario" placeholder="Usuario" class="form-control" required />
              <input type="password" name="clave" id="login_clave" placeholder="Clave" class="mt-2 form-control" required />
            </div>
            <div class="text-center">
              <button id="login-email-btn" name="login-email-btn" type="submit" class="btn-theme form-control">Continuar</button>
            </div>
          </form>
        </div>
    </main>
    <script type="text/javascript" src="assets/js/adm_login_x.js?v=<?= time(); ?>"></script>
  </body>

  </html>
<?php
} else {
  header('Location: ' . BASE . 'views/home.php');
}
?>