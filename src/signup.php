
<form id="signup_form" class="w-auth_container" action="#" method="post">
  <div class="auth_container">
    <div class="auth_inputs">
      <div class="section_auth">
        <label for="fname" class="auth_text">First name </label>
        <input id="fname" type="text" class="auth_input" placeholder="First name" name="fname" required />
      </div>

      <div class="section_auth">
        <label for="lname" class="auth_text">Last name </label>
        <input id="lname" type="text" class="auth_input" placeholder="Last name" name="lname" required />
      </div>

      <div class="section_auth">
        <label for="uname" class="auth_text">Username </label>
        <input id="uname" type="text" class="auth_input" placeholder="Username" name="uname" required />
      </div>

      <div class="section_auth">
        <label for="psw" class="auth_text">Password </label>
        <input id="psw" type="password" class="auth_input" placeholder="Password" name="psw" required />
        <input id="cpsw" type="password" class="auth_input" placeholder="Re-enter password" name="cpsw" required />
      </div>

      <div class="section_auth">
        <label for="email" class="auth_text">Email</label>
        <input id="email" type="text" class="auth_input" placeholder="Email" name="email" required />
      </div>

      <div class="section_auth">
        <p class="auth_text">Are you a Buyer or a Seller?</p>

        <div class="auth_radios">
          <input id="accType_buyer" type="radio" name="account_type" value="Buyer" /> <label for="account_type">Buyer</label><br />
          <input id="accType_seller" type="radio" name="account_type" value="Seller" />
          <label for="account_type">Seller</label>
        </div>
      </div>

      <div class="section_auth">
        <button id="singup_btn" type="submit" class="btn"><p>Sign-up</p></button>
        <button id="return_btn" type="button" class="btn cancelbtn"><a class="link" href="/signin">Cancel</a></button>
      </div>

      <div class="section_auth">
        <p id="auth_msgReciever" class="hide auth_error"></p>
      </div>
    </div> 
  </div>
</form>
