<?php

use Exception;

include_once 'src/Controller/UsuarioController.php';
include_once 'src/Controller/ClientesController.php';
include_once 'src/Controller/EnderecoController.php';
require __DIR__ . '/config/config.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$recurso = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
$conteudo = file_get_contents('php://input');
$request = $_SERVER['REQUEST_URI'];
$requestSplit = mb_split('/', $_SERVER['REQUEST_URI']);

$erros = null;
$clientes = [];

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

if (!strcasecmp($metodo, 'GET')) {
  $parametros = explode('?', $request, 2);
  $request =  $parametros[0];
  switch ($request) {
    case '':
    case '/':
      $script = 'login.php';
      break;

    case '/view/clientes/lista':
      $clienteController = new ClientesController();
      $clientes = $clienteController->getClientes();
      $script = 'clientes.php';
      break;

    case '/view/clientes/inserir':
      $script = 'clientesEditar.php';
      break;

    case '/view/clientes/editar':
      $clienteController = new ClientesController();
      $cliente_id = explode('=', $parametros[1], 2)[1];
      $cliente = $clienteController->getCliente(intval($cliente_id));
      $script = 'clientesEditar.php';
      break;
    case '/view/enderecos':
      $cliente_id = explode('=', $parametros[1], 2)[1];
      $enderecosController = new EnderecoController();
      $enderecos = $enderecosController->getEnderecos(intval($cliente_id));
      $script = 'enderecos.php';
      break;

    case '/view/enderecos/inserir':
      $cliente_id = explode('=', $parametros[1], 2)[1];
      $script = 'enderecoEditar.php';
      break;

    case '/view/enderecos/editar':
      $enderecosController = new EnderecoController();
      $parmetroExplode = explode('&', $parametros[1], 2);
      $cliente_id = explode('=', $parmetroExplode[0], 2)[1];
      $endereco_id = explode('=', $parmetroExplode[1], 2)[1];
      $endereco = $enderecosController->getEndereco(intval($cliente_id), intval($endereco_id));
      $script = 'enderecoEditar.php';
      break;

    case '/auth/logout':
      session_destroy();
      header('Location: /');
      break;

    default:
      http_response_code(404);
      $script = '404.php';
      break;
  }
} elseif (!strcasecmp($metodo, 'POST')) {
  $conteudo = $_POST;
  try {
    switch ($request) {
      case '/auth/login':
        $usuarioController = new UsuarioController();
        $valoresValidados = $usuarioController->validadaEntrada($conteudo);
        $usuarioController->auth($valoresValidados['email'], $valoresValidados['senha']);
        header('Location: ' . '/view/clientes/lista');
        break;
      case '/auth/logout':
        session_destroy();
        header('Location: /');
        break;
      case '/cliente':
        if ($conteudo['acao'] == 'deletar') {
          $cliente = new ClientesController();
          $valoresValidados = $cliente->validadaEntradaDelete($conteudo);
          $cliente->delete(intval($valoresValidados['cliente_id']));
        } elseif ($conteudo['acao'] == 'salvar') {
          $clienteController = new ClientesController();
          $valoresValidados = $clienteController->validadaNovoCliente($conteudo);
          $clienteController->saveCliente(
            $valoresValidados['cliente_id'],
            $valoresValidados['nome'],
            $valoresValidados['cpf'],
            $valoresValidados['data_nascimento'],
            $valoresValidados['rg'],
            $valoresValidados['telefone'],
          );
          header('Location: ' . '/view/cliente/lista');
        } else {
          $script = '404.php';
        }
        break;

      case '/enderecos':
        if ($conteudo['acao'] == 'deletar') {
          $enderecos = new EnderecoController();
          $valoresValidados = $enderecos->validadaEntradaDelete($conteudo);
          $enderecos->delete(intval($valoresValidados['cliente_id']), intval($valoresValidados['endereco_id']));
          header('Location: ' . '/view/enderecos?cliente_id=' . intval($valoresValidados['cliente_id']));
        } elseif ($conteudo['acao'] == 'salvar') {
          $enderecoController = new EnderecoController();

          $valoresValidados = $enderecoController->validadaNovoEndereco($conteudo);

          $enderecoController->saveEndereco(
            $valoresValidados['endereco_id'],
            $valoresValidados['cliente_id'],
            $valoresValidados['cep'],
            $valoresValidados['logradouro'],
            $valoresValidados['numero'],
            $valoresValidados['complemento'],
            $valoresValidados['bairro'],
            $valoresValidados['cidade'],
            $valoresValidados['estado'],
          );
          header('Location: ' . '/view/enderecos?cliente_id=' . intval($valoresValidados['cliente_id']));
        } else {
          $script = '404.php';
        }
        break;
      default:
        http_response_code(404);
        $script = '404.php';
        break;
    }
  } catch (\Exception $e) {
    $erros = $e->getMessage();
    $script = 'login.php';
  }
}

require __DIR__ . '/src/Views/header.php';
require __DIR__ . '/src/Views/' . $script;
require __DIR__ . '/src/Views/footer.php';
