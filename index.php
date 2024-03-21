<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecommerce</title>
</head>
<body>
  <?php
    $uri = $_SERVER['REQUEST_URI'];

    if( $uri == '/signup' ){
      include "./src/signup.php";
    } else if( $uri == '/signin' ){
      include "./src/signin.php";
    } else {
      echo "This page doesnt exist: " . $uri;
    }
  ?>
</body>
</html>