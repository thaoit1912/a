<?php
class Database {
  private static $instance = NULL;
  public static function getInstance() {
    if (!isset(self::$instance)) {
      try {
       self::$instance = new PDO('mysql:host=localhost;dbname=shoppingproject', 'root', '');
      } catch (PDOException $ex) { echo 'ERROR'; die($ex->getMessage()); }
    }
    return self::$instance;
  }
}
?>