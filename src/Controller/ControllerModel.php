<?php

class ControllerModel
{

  protected $conn;
  public function __construct()
  {
    $this->conn = $this->conexao();
  }
  public static function conexao()
  {
    try {
      $host = DB_HOST;
      $dbname = DB_NAME;
      $username = DB_USER;
      $password = DB_PASS;  
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
