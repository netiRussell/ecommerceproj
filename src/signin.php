<form id="signin_form" class="w-auth_container" action="/action_page.php" method="post">
  <div class="auth_container">
    <div class="auth_inputs">
      <div class="section_auth">
        <label for="uname" class="auth_text">Username </label>
        <input id="signin_uname" type="text" class="auth_input" placeholder="Username" name="uname" required />
      </div>

      <div class="section_auth">
        <label for="psw" class="auth_text">Password </label>
        <input id="signin_psw" type="password" class="auth_input" placeholder="Password" name="psw" required />
      </div>

      <div class="section_auth">
        <button id="signin_submit" type="submit" class="btn"><p>Login</p></button>
        <button type="button" class="btn cancelbtn"><a class="link" href="/signup">New user? Sign-up</a></button>
      </div>

      <div class="section_auth">
        <p id="auth_msgReciever" class="hide">Default html</p>
      </div>
      <!-- <div class="w-auth_forgot">
        <span class="auth_forgot">Forgot <a href="#">password?</a></span>
      </div> -->
    </div>
  </div>
</form>
