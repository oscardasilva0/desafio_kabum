<?php

use Controller\UsuarioController\UsuarioController as usuario;



try {

  $metodo = $_SERVER['REQUEST_METHOD'];
  $recurso = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
  $conteudo = file_get_contents('php://input');
  $request = $_SERVER['REQUEST_URI'];
  $requestSplit = mb_split('/', $_SERVER['REQUEST_URI']);

  var_dump($metodo);
  die;
  if (!strcasecmp($metodo, 'GET')) {
    var_dump($metodo);

    $viewDir = '/src/Views/';
    switch ($request) {
      case '':
      case '/':
        require __DIR__ . $viewDir . 'login.php';
        break;

      case '/view/usuarios/lista':
        require __DIR__ . $viewDir . 'usuariosLista.php';
        break;

      case '/view/usuarios/inserir/':
        require __DIR__ . $viewDir . 'usuariosLista.php';
        break;

      case '/view/usuarios/edit/':
        require __DIR__ . $viewDir . 'usuariosLista.php';
        break;
      default:
        http_response_code(404);
        require __DIR__ . $viewDir . '404.php';
    }
  }
  if (!strcasecmp($metodo, 'POST')) {
    var_dump($request);
    die;
    switch ($request) {
      case '/auth/login':
        $usuarios = new Usuario();

        echo 1;
        break;
      case '/auth/logout':
        echo 1;
        break;
      case '/auth/user':
        echo 1;
        break;
    }
  }
} catch (Exception $e) {
  var_dump($e->getMessage());
}
