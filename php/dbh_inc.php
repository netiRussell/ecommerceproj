<?php

  $server_name = "localhost";
  $server_username = "root";
  $server_password = "root";

  $db_name = 'ecommerce';
  $conn = new mysqli( $server_name, $server_username, $server_password, $db_name );

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  ?>