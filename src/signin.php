<!DOCTYPE html>
<html>
  <!-- 
  Color code:
  orange - #FFAE5D
  gray - #404040
  red - #FF3232
  white - #FFFFFF
  -->
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Ecommerce</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <form class="w-auth_container" action="/action_page.php" method="post">
      <div class="auth_container">
        <div class="auth_inputs">
          <div class="section_auth">
            <label for="uname" class="auth_text">Username </label>
            <input type="text" class="auth_input" placeholder="Username" name="uname" required />
          </div>

          <div class="section_auth">
            <label for="psw" class="auth_text">Password </label>
            <input type="password" class="auth_input" placeholder="Password" name="psw" required />
          </div>

          <div class="section_auth">
            <button type="submit" class="btn"><p>Login</p></button>
            <button type="button" class="btn cancelbtn"><a class="link" href="/signup">New user? Sign-up</a></button>
          </div>

          <!-- <div class="w-auth_forgot">
            <span class="auth_forgot">Forgot <a href="#">password?</a></span>
          </div> -->
        </div>
      </div>
    </form>

    <script src="script.js"></script>
  </body>
</html>
