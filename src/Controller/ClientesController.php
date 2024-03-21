<?php

include_once 'ControllerModel.php';

class ClientesController extends  ControllerModel
{
    public function validadaEntradaDelete(array $valores): array
    {
        try {
            $cliente_id = $valores['cliente_id'];
            // Validação de clinte_id
            if (!filter_var($cliente_id, FILTER_VALIDATE_INT)) {
                throw new Exception("id inválido.");
            }
            return ['cliente_id' => $cliente_id];
        } catch (Exception $e) {
            throw new Exception('parametro invalido');
        }
    }
    public function getClientes(): array
    {
        try {

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT cliente_id, nome, data_nascimento, cpf, rg, telefone FROM clientes";
            $stmt =  $this->conn->prepare($sql);
            $stmt->execute();

            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        return $usuarios;
    }

    public function getCliente(int $cliente_id): array
    {
        try {

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT cliente_id, nome, data_nascimento, cpf, rg, telefone FROM clientes where cliente_id = :cliente_id";
            $stmt =  $this->conn->prepare($sql);
            $stmt->bindParam(":cliente_id", $cliente_id);
            $stmt->execute();
            $usuarios = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        return $usuarios;
    }

    public function delete(int $cliente_id,): void
    {
        try {

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM clientes WHERE  cliente_id = :cliente_id";
            $stmt =  $this->conn->prepare($sql);
            $stmt->bindParam(":cliente_id", $cliente_id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function validadaNovoCliente(array $valores)
    {
        $nome = $valores['nome'];
        $cpf = $valores['cpf'];
        $rg = $valores['rg'];
        $telefone = $valores['telefone'];
        $data_nascimento = $valores['data_nascimento'];

        // Validação de nome
        if (!preg_match('/^[a-zA-Z ]+$/', $nome) || strlen($nome) > 150) {
            throw new Exception('Nome inválido. Utilize apenas letras e espaços (máx. 150 caracteres).');
        }

        $regex = '/[^0-9]/';
        $cpf =  preg_replace($regex, '', $cpf);

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

        $regex = '/[^0-9]/';
        $telefone =  preg_replace($regex, '', $telefone);
        // Validação de telefone (opcional)
        // if ($telefone) {
        //     throw new Exception('Telefone inválido. Utilize o formato (XX) XXXX-XXXX.');
        // }

        return [
            'nome' => $nome,
            'cpf' => $cpf,
            'rg' => $rg,
            'telefone' => $telefone,
            'data_nascimento' => $data_nascimento,
            'cliente_id' => intval($valores['cliente_id'])
        ];
    }

    public function saveCliente($cliente_id, string $nome, string $cpf, string $data_nascimento, string $rg, string $telefone): void
    {
        if (empty($cliente_id) || $cliente_id == null || $cliente_id == '') {
            $stmt = $this->conn->prepare('INSERT INTO clientes (nome, cpf, data_nascimento, rg, telefone) VALUES (:nome, :cpf, :data_nascimento, :rg, :telefone)');

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':data_nascimento', $data_nascimento);
            $stmt->bindParam(':rg', $rg);
            $stmt->bindParam(':telefone', $telefone);

            // Execução da query
            $stmt->execute();
        } else {
            $stmt = $this->conn->prepare('UPDATE clientes SET nome = :nome, cpf = :cpf, data_nascimento = :data_nascimento, rg = :rg, telefone = :telefone WHERE cliente_id = :cliente_id');

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':data_nascimento', $data_nascimento);
            $stmt->bindParam(':rg', $rg);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':cliente_id', $cliente_id);

            // Execução da query
            $stmt->execute();
        }
    }
}
