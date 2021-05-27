<?php

  $serverName   = '127.0.0.1';
  $dbName       = 'book-store';
  $port         = '3306';
  $username     = 'root';
  $password     = '';

  try {
    $db_connect = new PDO(
      "mysql:host=$serverName;dbname=$dbName;port=$port",
      $username,
      $password,
      [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]
    );

  } catch (PDOException $e){
    // Failed to connect
    die();
  }

?>


