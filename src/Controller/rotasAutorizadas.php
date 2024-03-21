<?
switch ($request) {
  case '':
  case '/':
  case '/auth/login':
    break;
  default:
    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
      // session isn't started
      session_start();
    }
    if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['nome']) || !isset($_SESSION['email'])) {
      header('Location: ' . '/');
    }
    break;
}
