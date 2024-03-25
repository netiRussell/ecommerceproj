<?php

// ! Utilize lines 4-6 for debugging
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();
$request = isset($_POST['request']) ? $_POST['request'] : null;

// Connect to DB
include_once 'dbh_inc.php';
$status = true;
$message = "";

switch($request){
  case "sign_up":
      $fname = isset($_POST['fname']) && !empty($_POST['fname']) ? $_POST['fname'] : false;
      $lname = isset($_POST['lname']) && !empty($_POST['lname']) ? $_POST['lname'] : false;
      $uname = isset($_POST['uname']) && !empty($_POST['uname']) ? $_POST['uname'] : false;
      $psw = isset($_POST['psw']) && !empty($_POST['psw']) ? $_POST['psw'] : false;
      $cpsw = isset($_POST['cpsw']) && !empty($_POST['cpsw']) ? $_POST['cpsw'] : false;
      $email = isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : false;
      $accType_seller = isset($_POST['accType_seller']) && !empty($_POST['accType_seller']) ? $_POST['accType_seller'] : false;
      $accType_buyer = isset($_POST['accType_buyer']) && !empty($_POST['accType_buyer']) ? $_POST['accType_buyer'] : false;
      $accType = $accType_seller;

      
      // Check if the input data is valid
      if( !$accType_seller && !$accType_buyer ){
        $message = "No account type chosen";
        $status = false;
      }else if( !$fname || !$lname || !$uname || !$psw || !$cpsw || !$email){
        $message = "One of the text fields is empty.";
        $status = false;
      } else if( $psw != $cpsw ){
        $message = "Passwords don't match";
        $status = false;
      }

      // Check if username is taken already
      $stmt = $conn->prepare("SELECT username FROM users WHERE username=?");
      $stmt->bind_param('s', $uname);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($username_duplicate);
      if($stmt->num_rows == 1) {
        $status = false;
        $message = "This username is taken already";
      }
    
      if($status){

        // Encode the password
        $password_hash = password_hash($psw, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (first_name, last_name, user_type, username, password, email) VALUES ('".$fname."', '".$lname."', ".$accType.", '".$uname."', '".$password_hash."', '".$email."')";
    
        $result = mysqli_query($conn, $sql);
    
        if(!$result){
          $status = false;
          $message = "MySQL error (Server-side error)";
        }
    
      }
    
      echo json_encode(
        array(
          'status' => $status,
          'message' => $message
        )
      );
    break;

    case "sign_in":
      $uname = isset($_POST['uname']) ? $_POST['uname'] : '';
      $psw = isset($_POST['psw']) ? $_POST['psw'] : '';

      if( !isset($_POST['uname']) || empty($_POST['uname']) ){
        $message = "Username cannot be empty! ";
        $status = false;
      }

      if( !isset($_POST['psw']) || empty($_POST['psw']) ){
        $message = "Password cannot be empty! ";
        $status = false;
      }

      if($status){
        $stmt = $conn->prepare("SELECT id, first_name, last_name, user_type, email, password, products_rated FROM users WHERE username=?");
        $stmt->bind_param('s', $uname);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check on the case when uname doesn't exist
        if($result->num_rows == 1) {
          $data = $result->fetch_assoc();
        } else {
          $message = "There is no such user";
          $status = false;

          echo json_encode(
            array(
              'status' => $status,
              'message' => $message
            )
          );
          return;
        }

        if( !password_verify($psw, $data['password']) ){
          $message = "Password is incorrect";
          $status = false;

          // Validation error
          echo json_encode(
            array(
              'status' => $status,
              'message' => $message
            )
          );
        } else {
          // Success
          echo json_encode(
            array(
              'status' => $status,
              'id' => $data['id'],
              'user_type' => $data['user_type'],
              'first_name' => $data['first_name'],
              'last_name' => $data['last_name'],
              'email' => $data['email'],
              'products_rated' => $data['products_rated']
            )
          );
        }
      } else{
        // Error before validation  
        echo json_encode(
          array(
            'status' => $status,
            'message' => $message
          )
        );
      }
  break;

  case "init_session":
    $_SESSION['id'] = $_POST['id'];
    $_SESSION['user_type'] = $_POST['user_type'];
    $_SESSION['first_name'] = $_POST['first_name'];
    $_SESSION['last_name'] = $_POST['last_name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['products_rated'] = $_POST['products_rated'];
  break;

  case "delete_session":
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();
  break;

  default:
    $status = false;
    $message = "There is no such request";

    echo json_encode(
      array(
        'status' => $status,
        'message' => $message
      )
    );
    break;
}