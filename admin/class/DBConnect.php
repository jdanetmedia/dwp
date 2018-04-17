<?php

class DBConnect {
  define("DB_SERVER", "mysql5.unoeuro.com");
  define("DB_USER", "rasmusandre_dk");
  define("DB_PASS", "rasm8468");
  define("DB_NAME", "rasmusandreas_dk_db3");

  function __construct() {
    $link = new \PDO(
      'mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=utf8mb4',
      DB_USER,
      DB_PASS,
      array(
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_PERSISTENT => false
      )
    );
  }

}
