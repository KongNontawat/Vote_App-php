<?php


class Db_conn
{
  public $server = "localhost";
  public $user = "root";
  public $password = "123456";
  public $dbName = "php_learn01";

  public function connect()
  {
    try {
      $pdo = new PDO("mysql:host=$this->server; dbname=$this->dbName", $this->user, $this->password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      echo "<script> console.log('database connect success!!') </script>";
      return $pdo;
    } catch (PDOException $e) {
      echo "database fail {$e->getMessage()}";
      return false;
    }
  }
}
