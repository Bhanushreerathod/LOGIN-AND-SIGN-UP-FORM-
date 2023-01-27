<?php

$con = mysqli_connect("localhost","root","","LOGIN FORM");

if (isset($_POST['register_submit'])) {
    $Firstname = $_POST['firstname'];
    $Lastname = $_POST['lastname'];
    $Email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $Gender = $_POST['r1'];
    $Country = $_POST['country'];
    $received= $_POST['received'];
    $check= implode("  ",$received);
    $insert_sql ="INSERT INTO users(Firstname,Lastname,Email,PSW,Gender,Country,received) VALUES('$Firstname','$Lastname','$Email','$password','$Gender','$Country','$check')";
    $res = mysqli_query($con,$insert_sql);
    if($res){
        echo "Registration Successful";
    }else{
        echo "Registration Failed";
    }
}


session_start();
$con = mysqli_connect("localhost","root","","LOGIN FORM");

if (isset($_POST['login_submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE Email = '$email'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $hash_password= $row['PSW'];
    if(password_verify($password, $hash_password)){
        $_SESSION['Email'] = $row['email'];
        header("Location: dashboard.php");
    }else{
    echo "Invalid Login";
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Rest Password</title>
    <link rel="stylesheet" href="style.css" />

    <style>
      @import url(https://fonts.googleapis.com/css?family=Roboto:300);

      .login-page {
        width: 500px;
        padding: 8% 0 0;
        margin: auto;
      }
      .form {
        position: relative;
        z-index: 1;
        background: #ffffff;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        border-top: 7px solid rgb(41, 57, 194);
        border-bottom: 7px solid rgb(41, 57, 194);
        box-shadow: 0 0 7px 5px rgba(0, 0, 0, 0.5);
      }
      .textt {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
        width: 100%;
      }

      .form .radiobutton {
        margin-left: 2px;
      }

      .textt {
        width: 100%;
      }
      .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #4caf50;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #ffffff;
        font-size: 19px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
      }
      .form button:hover,
      .form button:active,
      .form button:focus {
        background: blue;
      }
      .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
      }
      .form .message a {
        color: #4caf50;
        text-decoration: none;
      }
      .form .register-form {
        display: none;
      }
      .container {
        position: relative;
        z-index: 1;
        max-width: 300px;
        margin: 0 auto;
      }
      .container:before,
      .container:after {
        content: "";
        display: block;
        clear: both;
      }
      .container .info {
        margin: 50px auto;
        text-align: center;
      }
      .container .info h1 {
        margin: 0 0 15px;
       
        padding: 0;
        font-size: 36px;
        font-weight: 300;
        color: #1a1a1a;
      }
      .container .info span {
        color: #4d4d4d;
        font-size: 12px;
      }
      .container .info span a {
        color: #000000;
        text-decoration: none;
      }
      .container .info span .fa {
        color: #ef3b3a;
      }
      .input-name {
        width: 90%;

        margin: 20px auto;
      }

      body {
        background: gray; /* fallback for old browsers */

        font-family: "Roboto", sans-serif;
      }
      .country {
        display: inline-block;
        width: 100%;
        height: 35px;
        padding: 0px 15px;
        cursor: pointer;
        border: 3px solid #cccccc;
        color: #7b7b7b;
        background-color: white;
        appearance: none;
      }
    </style>
  </head>
  <body>
    <div class="login-page">
      <div class="form">
        <!-- SignUp Form -->
        <form action="" method="post" class="register-form">
          <h1>Responsive Registrstion Form</h1>

          <input class="textt" type="text" name="firstname" placeholder="First Name" 
           />
          <input class="textt" type="text" name="lastname" placeholder="Last Name" />
          <input
            class="textt"
            type="text"
            name="email"
            
            placeholder="email address"
          />

          <input
            class="textt"
            type="password"
            name="password"
         
            placeholder="password"
          />

          <div class="input-name">
            <input id="gender" type="radio" class="radio-button" value="Male" name="r1" required />
            <label style="margin-right: 0px">Male</label>
            <input id="gender" type="radio" class="radio-button"value="Female" name="r1" required />
            <label>Female</label>
          </div>
          <div class="input-name">
            <select id="select" class="country" name="country">
              <option>Select a country</option>
              <option value="india" >India</option>
              <option value="brazil">Brazil</option>
              <option value="france">France</option>
              <option value="austrlia">Austrlia</option>
              <option value="canada">Canada</option>
            </select>
          </div>
          <div class="input-name">
            <input id="check" type="checkbox" class="button1" name="received[]" value="accepted " />
            <label> I accept the terms and conditions </label>
          </div>
          <div class="input-name">
            <input id="check" type="checkbox" class="button2" name="received[]" value="news letter" />
            <label> I want to recive the news letter </label>
          </div>
          <button type="submit" name="register_submit">Register</button>
          <p class="message">Already registered? <a href="#">Sign In</a></p>
        </form>

        <!-- Login Form -->
        <form action="" method="post" class="login-form">
          <h1>Login Form</h1>

          <input class="textt" type="text" name="email" placeholder="Email" />

          <input
            class="textt"
            type="password"
            name="password"
            placeholder="password"
          />

          <button type="submit" name="login_submit">login</button>

          <p class="message">
            Not registered? <a href="#">Create an account</a>
          </p>
        </form>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
      $(".message a").click(function () {
        $("form").animate({ height: "toggle", opacity: "toggle" }, "slow");
      });
    </script>
  </body>
</html>
