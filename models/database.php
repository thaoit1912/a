<?php
class Database {
  private static $instance = NULL;
  public static function getInstance() {
    if (!isset(self::$instance)) {
      try {
       self::$instance = new PDO('mysql:host=remotemysql.com;dbname=qBLNzVpGXB','qBLNzVpGXB' , 'QBPRqcr0u9');
      } catch (PDOException $ex) { echo 'ERROR'; die($ex->getMessage()); }
    }
    return self::$instance;
  }
}
?>