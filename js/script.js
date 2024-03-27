// General JS functions
async function send_request(request_body) {
  return await fetch("php/requests.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: request_body,
  });
}

// Sign up page JS code
if (document.URL.includes("signup")) {
  // Conditions for stings to check upon
  const allSymbols = ["!", "`", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "=", ";", ":", ",", ".", "/", "?", "<", ">", "|", "'", "\\", '"', "[", "]", "{", "}", "_"];
  const numbers = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];
  const emailConditions = ["@", "."];

  // DOM elements
  const fname = document.getElementById("fname");
  const lname = document.getElementById("lname");
  const email = document.getElementById("email");
  const uname = document.getElementById("uname");
  const psw = document.getElementById("psw");
  const cpsw = document.getElementById("cpsw");
  const accType_buyer = document.getElementById("accType_buyer");
  const accType_seller = document.getElementById("accType_seller");

  document.getElementById("signup_form").addEventListener("submit", function (event) {
    event.preventDefault();

    // Checks (True stands for an error)
    const fname_status = allSymbols.some((el) => fname.value.includes(el)) || numbers.some((el) => fname.value.includes(el));
    const lname_status = allSymbols.some((el) => lname.value.includes(el)) || numbers.some((el) => lname.value.includes(el));
    const email_status = !emailConditions.every((el) => email.value.includes(el)) || email.value.length < 6;
    const username_status = allSymbols.some((el) => uname.value.includes(el)) || uname.value.length < 6;
    const password_status = psw.value != cpsw.value || psw.length < 6;
    const accType_status = !accType_buyer.checked && !accType_seller.checked;

    // Check if first name or last name fields have symbols
    if (fname_status || lname_status) {
      alert("First and last names can't have any special characters or numbers");
    } else if (username_status) {
      // Passwords must match and their length must be >= 6
      alert("Username can't have any special characters and must be greater than 6 symbols");
    } else if (password_status) {
      // Passwords must match and their length must be >= 6
      alert("Passwords must match and must be greater than 6 symbols");
    } else if (email_status) {
      // Email has to be >= 6 and must have "@" and "."
      alert("Invalid email");
    } else if (accType_status) {
      // Account type must be selected
      alert("Account type is not selected");
    } else {
      sign_up();
    }
  });

  // Sign-up validation, sending the form.
  async function sign_up() {
    const form = {
      fname: fname.value,
      lname: lname.value,
      uname: uname.value,
      psw: psw.value,
      cpsw: cpsw.value,
      email: email.value,
      accType_seller: accType_seller.checked,
      accType_buyer: accType_buyer.checked,
      messageReciever: document.getElementById("auth_msgReciever"),
    };

    try {
      const response = await send_request(
        `request=sign_up&fname=${form.fname}&lname=${form.lname}&uname=${form.uname}&psw=${form.psw}&cpsw=${form.cpsw}&email=${form.email}&accType_seller=${form.accType_seller}&accType_buyer=${form.accType_buyer}`
      ).then((data) => {
        if (!data.ok) {
          throw new Error("Server related problem(promise didn't come back)");
        }

        return data.json();
      });

      if (response.status) {
        form.messageReciever.classList.remove("auth_error");
        form.messageReciever.classList.add("auth_success");
        form.messageReciever.innerHTML = `Your account was successfully created`;

        document.getElementById("singup_btn").remove();
        document.getElementById("return_btn").innerHTML = '<a class="link" href="/signin">Return to sign-in page</a>';
      } else {
        throw new Error(response.message);
      }
    } catch (error) {
      form.messageReciever.classList.remove("auth_success");
      form.messageReciever.classList.add("auth_error");
      form.messageReciever.innerHTML = `${error}`;
    }

    form.messageReciever.classList.remove("hide");
  }
} else if (document.URL.includes("signin")) {
  const formDOM = document.getElementById("signin_form");

  if (formDOM) {
    formDOM.addEventListener("submit", function (event) {
      event.preventDefault();

      const form = {
        uname: document.getElementById("signin_uname").value,
        psw: document.getElementById("signin_psw").value,
        messageReciever: document.getElementById("auth_msgReciever"),
      };

      singin(form);

      async function singin(form) {
        try {
          const response = await send_request(`request=sign_in&uname=${form.uname}&psw=${form.psw}`).then((data) => {
            if (!data.ok) {
              throw new Error("Server related problem(promise didn't come back)");
            }

            return data.json();
          });

          if (response.status) {
            send_request(`request=init_session&id=${response.id}&user_type=${response.user_type}&first_name=${response.first_name}&last_name=${response.last_name}&email=${response.email}&products_rated=${response.products_rated}`).then((_) => {
              window.location.reload();
            });
          } else {
            throw new Error(response.message);
          }
        } catch (error) {
          form.messageReciever.classList.remove("auth_success");
          form.messageReciever.classList.add("auth_error");
          form.messageReciever.innerHTML = `${error}`;
        }

        form.messageReciever.classList.remove("hide");
      }
    });
  } else {
    document.getElementById("signout_form").addEventListener("submit", function (event) {
      event.preventDefault();

      async function signout() {
        const messageReciever = document.getElementById("auth_msgReciever");

        try {
          await send_request(`request=delete_session`).then((data) => {
            if (!data.ok) {
              throw new Error("Server related problem(promise didn't come back)");
            }
          });

          // Refer to the home page
          document.location.href = "/";
        } catch (error) {
          messageReciever.classList.remove("auth_success");
          messageReciever.classList.add("auth_error");
          messageReciever.innerHTML = `${error}`;
        }

        messageReciever.classList.remove("hide");
      }

      signout();
    });
  }
}
