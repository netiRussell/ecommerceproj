// Sign up page JS code
if (document.URL.includes("signup")) {
  // Conditions for stings to check upon
  const allSymbols = ["!", "`", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "=", ";", ":", ",", ".", "/", "?", "<", ">", "|", "'", "\\", '"', "[", "]", "{", "}"];
  const numbers = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];
  const emailConditions = ["@", "."];
  const form = document.getElementById("signup_form");

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    // Checks (True stands for an error)
    const fname_status = allSymbols.some((el) => document.getElementById("fname").value.includes(el)) || numbers.some((el) => document.getElementById("fname").value.includes(el));

    const lname_status = allSymbols.some((el) => document.getElementById("lname").value.includes(el)) || numbers.some((el) => document.getElementById("lname").value.includes(el));

    const email_status = !emailConditions.every((el) => document.getElementById("email").value.includes(el)) || document.getElementById("email").value.length < 6;

    const username_status = allSymbols.some((el) => document.getElementById("uname").value.includes(el)) || document.getElementById("uname").value.length < 6;

    const password_status = document.getElementById("psw").value != document.getElementById("cpsw").value || document.getElementById("psw").length < 6;

    const accType_status = !document.getElementById("accType_buyer").checked && !document.getElementById("accType_seller").checked;

    // Check if first name or last name fields have symbols
    if (fname_status || lname_status) {
      alert("First and last names can't have any special characters or numbers");
    } else if (username_status) {
      // Passwords must match and their length must be >= 6
      alert("Username can't have special characters and must be greater than 6 symbols");
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
      alert("success"); //! Redundant
      form.submit();
    }
  });
}
