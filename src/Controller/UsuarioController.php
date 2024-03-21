<?php

include_once 'ControllerModel.php';

class UsuarioController extends  ControllerModel
{
    public function validadaEntrada(array $valores): array
    {
        $email = $valores['email'];
        $senha = $valores['senha'];

        // Validação de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Email inválido.";
        }

        // Validação de senha
        $tamanhoSenha = strlen($senha);
        if ($tamanhoSenha < 8) {
            throw new Exception("Senha muito curta. Mínimo de 8 caracteres.");
        }

        if (!preg_match('/[a-z]/i', $senha)) {
            throw new Exception("Senha precisa conter pelo menos uma letra.");
        }

        if (!preg_match('/[0-9]/', $senha)) {
            throw new Exception("Senha precisa conter pelo menos um número.");
        }
        return ['email' => $email, 'senha' => $senha];
    }
    public function auth(string $email, string $senha): void
    {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
            $stmt =  $this->conn->prepare($sql);

            // Substitui os parâmetros pela variáveis com segurança
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":senha", $senha);

            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }


        if ($usuario) {
            if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
                // session isn't started
                session_start();
            }
            $_SESSION['usuario_id'] = $usuario['usuario_id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            return;
        } else {
            if (session_id() != '' || isset($_SESSION) || session_status() !== PHP_SESSION_NONE) {
                // session isn't started
                session_destroy();
            }
            throw new Exception('usuario ou senha invalido');
        }
    }

    public function validadaNovoCliente(array $valores)
    {
        $nome = $valores['nome'];
        $cpf = $valores['cpf'];
        $rg = $valores['rg'];
        $telefone = $valores['telefone'];

        // Validação de nome
        if (!preg_match('/^[a-zA-Z ]+$/', $nome) || strlen($nome) > 150) {
            throw new Exception('Nome inválido. Utilize apenas letras e espaços (máx. 150 caracteres).');
        }

        // Validação de CPF
        if (!preg_match('/^[0-9]{11}$/', $cpf)) {
            throw new Exception('CPF inválido. Digite apenas números.');
        }

        // Validação de data de nascimento
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data_nascimento)) {
            throw new Exception('Data de nascimento inválida. Utilize o formato YYYY-MM-DD.');
        }

        // Validação de rg (opcional)
        if ($rg && !preg_match('/^[a-zA-Z0-9]+$/', $rg)) {
            throw new Exception('rg inválido. Utilize apenas letras e números.');
        }

        // Validação de telefone (opcional)
        if ($telefone && !preg_match('/^\([0-9]{2}\) [0-9]{4}-[0-9]{4}$/', $telefone)) {
            throw new Exception('Telefone inválido. Utilize o formato (XX) XXXX-XXXX.');
        }

        return [
            'nome' => $valores['nome'],
            'cpf' => $valores['cpf'],
            'rg' => $valores['rg'],
            'telefone' => $valores['telefone']
        ];
    }

    public function saveCliente($nome, $cpf, $data_nascimento, $rg, $telefone)
    {


        // Conexão com o banco de dados (substitua os detalhes da sua conexão)
        $pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', 'password');

        // Preparação da query
        $stmt = $pdo->prepare('INSERT INTO clientes (nome, cpf, data_nascimento, rg, telefone) VALUES (:nome, :cpf, :data_nascimento, :rg, :telefone)');

        // Vinculação dos parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':rg', $rg);
        $stmt->bindParam(':telefone', $telefone);

        // Execução da query
        $stmt->execute();

        // Retorno do ID do cliente
        return $pdo->lastInsertId();
    }
}
