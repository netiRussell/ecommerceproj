<!DOCTYPE html>
<html lang="en">
<head>
  <!-- 
  Color code:
  orange - #FFAE5D
  gray - #404040
  red - #FF3232
  white - #FFFFFF
  -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet" type="text/css" />
  <title>Ecommerce</title>
</head>
<body>
  <?php
    session_start();
    $uri = $_SERVER['REQUEST_URI'];

    if( $uri == '/' ){
      echo 'Home page - to be created';
    } else if( $uri == '/signup' ){
      include "./src/signup.php";
    } else if( $uri == '/signin' ){
      include "./src/signin.php";
    } else {
      echo "This page doesnt exist: " . $uri;
    }
  ?>

  <script src="js/script.js"></script>
</body>
</html>