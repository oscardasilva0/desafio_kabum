<?php

namespace Controller;

use PDO;
use PDOException;

class Controller
{
  private $conn = null;

  public function __construct()
  {
    $this->conn = $this->conexao();
  }
  public static function conexao()
  {
    try {
      $host = "localhost";
      $dbname = "desafio";
      $username = "root";
      $password = "root";

      return new PDO(
        "mysql:host=$host;dbname=$dbname",
        $username,
        $password
      );
    } catch (PDOException $pe) {
      var_dump("Não foi possível se conectar ao banco de dados $dbname :" . $pe->getMessage());
    }
  }
}
