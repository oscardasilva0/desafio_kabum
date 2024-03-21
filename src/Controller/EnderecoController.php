<?php

include_once 'ControllerModel.php';

class EnderecoController extends  ControllerModel
{
    public function validadaEntradaDelete(array $valores): array
    {
        try {
            $cliente_id = $valores['cliente_id'];
            // Validação de clinte_id
            if (!filter_var($cliente_id, FILTER_VALIDATE_INT)) {
                throw new Exception("id inválido.");
            }

            $endereco_id = $valores['endereco_id'];
            // Validação de clinte_id
            if (!filter_var($endereco_id, FILTER_VALIDATE_INT)) {
                throw new Exception("id inválido.");
            }
            return ['cliente_id' => $cliente_id, 'endereco_id' => $endereco_id];
        } catch (Exception $e) {
            throw new Exception('parametro invalido');
        }
    }
    public function getEnderecos(int $cliente_id): array
    {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT endereco_id, cliente_id ,cep ,logradouro  ,numero ,complemento  ,bairro ,cidade ,estado FROM enderecos where cliente_id = :cliente_id";
            $stmt =  $this->conn->prepare($sql);
            $stmt->bindParam(":cliente_id", $cliente_id);
            $stmt->execute();
            $enderecos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        return $enderecos;
    }

    public function getEndereco(int $cliente_id, int $endereco_id): array
    {
        try {

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT endereco_id, cliente_id ,cep ,logradouro  ,numero ,complemento  ,bairro ,cidade ,estado FROM enderecos where cliente_id = :cliente_id AND  endereco_id = :endereco_id";
            $stmt =  $this->conn->prepare($sql);
            $stmt->bindParam(":cliente_id", $cliente_id);
            $stmt->bindParam(":endereco_id", $endereco_id);
            $stmt->execute();
            $endereco = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        return $endereco;
    }

    public function delete(int $cliente_id, int $endereco_id): void
    {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM enderecos WHERE  cliente_id = :cliente_id AND  endereco_id = :endereco_id";
            $stmt =  $this->conn->prepare($sql);
            $stmt->bindParam(":cliente_id", $cliente_id);
            $stmt->bindParam(":endereco_id", $endereco_id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }


    public function validadaNovoEndereco(array $valores): array
    {

        if (empty($valores['cep']) || !preg_match('/^[0-9]{5}-[0-9]{3}$/', $valores['cep'])) {
            throw new Exception('CEP inválido. Digite *****-***.');
        }

        if (empty($valores['logradouro']) || !preg_match('/^[a-zA-Z0-9 .záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]+$/', $valores['logradouro']) || strlen($valores['logradouro']) > 255) {
            throw new Exception('Logradouro inválido. Utilize apenas letras, números, espaços e pontos (máx. 255 caracteres).');
        }

        if (empty($valores['numero']) || !preg_match('/^[0-9]+$/', $valores['numero']) || strlen($valores['numero']) > 10) {
            throw new Exception('Número inválido. Utilize apenas números (máx. 10 caracteres).');
        }

        if (empty($valores['bairro']) || !preg_match('/^[a-zA-Z záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]+$/', $valores['bairro']) || strlen($valores['bairro']) > 100) {
            throw new Exception('Bairro inválido. Utilize apenas letras e espaços (máx. 100 caracteres).');
        }

        if (empty($valores['cidade']) || !preg_match('/^[a-zA-Z záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]+$/', $valores['cidade']) || strlen($valores['cidade']) > 100) {
            throw new Exception('Cidade inválida. Utilize apenas letras e espaços (máx. 100 caracteres).');
        }

        if (empty($valores['estado'])) {
            throw new Exception('Selecione um estado.');
        }

        $cliente_id = $valores['cliente_id'];
        // Validação de clinte_id
        if (!filter_var($cliente_id, FILTER_VALIDATE_INT)) {
            throw new Exception("cliente_id inválido.");
        }

        $endereco_id =  $valores['cliente_id'];

        // Validação de clinte_id
        if ($endereco_id != null && $endereco_id = '' && !filter_var($endereco_id, FILTER_VALIDATE_INT)) {
            throw new Exception("endereco_id inválido.");
        }
        return [
            'cliente_id' => $cliente_id,
            'endereco_id' => $endereco_id,
            'cep' => $valores['cep'],
            'logradouro' => $valores['logradouro'],
            'numero' => $valores['numero'],
            'complemento' => $valores['complemento'],
            'bairro' => $valores['bairro'],
            'cidade' => $valores['cidade'],
            'estado' => $valores['estado'],
        ];
    }

    public function saveEndereco(?int $endereco_id, int $cliente_id, string $cep, string $logradouro, string $numero, string $complemento, string $bairro, string $cidade, string $estado): void
    {
        if (empty($endereco_id) || $endereco_id == null || $endereco_id == '') {
            $stmt = $this->conn->prepare("INSERT INTO enderecos (
                cliente_id, cep, logradouro, numero, complemento, bairro, cidade, estado
              ) VALUES (
                :cliente_id, :cep, :logradouro, :numero, :complemento, :bairro, :cidade, :estado
              )");
            $stmt->bindParam(':cliente_id', $cliente_id);
            $stmt->bindParam(':cep', $cep);
            $stmt->bindParam(':logradouro', $logradouro);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':complemento', $complemento);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':estado', $estado);

            $stmt->execute();
        } else {
            $stmt = $this->conn->prepare("UPDATE enderecos SET
            cliente_id = :cliente_id,cep = :cep,logradouro = :logradouro,numero = :numero,complemento = :complemento,bairro = :bairro,cidade = :cidade,estado = :estado
          WHERE endereco_id = :endereco_id AND cliente_id = :cliente_id");
            $stmt->bindParam(':endereco_id', $endereco_id);
            $stmt->bindParam(':cliente_id', $cliente_id);
            $stmt->bindParam(':cep', $cep);
            $stmt->bindParam(':logradouro', $logradouro);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':complemento', $complemento);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':estado', $estado);

            // Execução da query
            $stmt->execute();
        }
    }
}
