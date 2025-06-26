<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="login.css" type="text/css" />
  <title>HealthMate | Login</title>
</head>
<body>
    
  <div class="bar">
    <div class="logo">Health<sec>Mate</sec></div>
    <div class="nav-links">
      <a href="home.php">Home</a>
      <a href="aboutus.php">About Us</a>
      <a href="bmi.php">BMI Calculator</a>
      <a href="login.php" class="login-btn">Log In</a>
    </div>
  </div>

<div><h1> | Log In</h1></div>
  <section class="login-section">
    <article>
      <div class="login-box">
        <form id="myForm" action="login.php" method="post">
          <table>
            <tr>
              <td><label for="loginAs">Login As:</label></td>
              <td>
                <select name="loginAs" id="loginAs" required>
                  <option value="Admin">Admin</option>
                  <option value="Coach">Coach</option>
                  <option value="User">User</option>
                </select>
              </td>
            </tr>
            <tr>
              <td><label for="username">Username:</label></td>
              <td><input type="text" id="username" name="username" required /></td>
            </tr>
            <tr>
              <td><label for="IdNo">Id No.:</label></td>
              <td><input type="text" id="IdNo" name="idNo" required></td>
            </tr>
            <tr>
              <td><label for="pass">Password:</label></td>
              <td>
                <input type="password" id="pass" name="password" required /><br />
                <input type="checkbox" onclick="togglePass()" /> Show password
              </td>
            </tr>
            <tr>
              <td colspan="2" style="text-align: center;">
                <input class="btn" type="submit" name="submit" value="Log In" />
              </td>
            </tr>
          </table>
        </form>
        <p class="center">
          <b>Don't have an account? Sign Up for <a href="register_coach.php">Coach</a></b>
        </p>
      </div>
    </article>
  </section>

  <footer>
    <div class="social-icons">
      <a href="https://www.instagram.com/" target="_blank"><img src="image/instagram.png" alt="Instagram" /></a>
      <a href="https://x.com/" target="_blank"><img src="image/twitter.png" alt="Twitter" /></a>
      <a href="https://www.facebook.com/" target="_blank"><img src="image/facebook.png" alt="Facebook" /></a>
      <a href="http://www.youtube.com/" target="_blank"><img src="image/youtube.png" alt="YouTube" /></a>
    </div>
    <div class="footer-links">
      <a href="#">Terms & Conditions</a>
      <a href="#">Privacy Policies</a>
    </div>
  </footer>

  <script>
    function togglePass() {
      var input = document.getElementById("pass");
      input.type = input.type === "password" ? "text" : "password";
    }
  </script>
</body>
</html>
