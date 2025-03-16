<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "user-data";

$con = mysqli_connect($host, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit_reset_password'])){
  $email = $_POST['email'];
  $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

  $query = $con->prepare("UPDATE user SET password=? WHERE email=?");
  $query->bind_param("ss", $new_password, $email);
  $result = $query->execute();

  if($result){
    $_SESSION['message'] = 'Password has been reset successfully.';
    header("Location: sign_n_log.php"); 
    exit();
  } else {
    echo "<script>alert('Password reset failed.')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="/project_capstone_skincare/GlowMatch-front/component/sign-in/Signup_and_login/sign-in.css">
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
      }
      body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px;
      }
      .container {
        position: relative;
        max-width: 850px;
        width: 30%;
        background: #fff;
        padding: 40px 30px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        perspective: 2700px;
      }
      .form-content {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
      }
      .title {
        position: relative;
        font-size: 24px;
        font-weight: 500;
        color: #333;
        margin-bottom: 20px;
      }
      .title {
        position: relative;
        font-size: 24px;
        font-weight: 500;
        color: #333;
        margin-bottom: 20px;
      }
      .title:before {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3px;
        width: 25px;
        background: #89CFF0;
      }
      .input-boxes {
        margin-top: 30px;
        width: 100%;
      }
      .input-box {
        display: flex;
        align-items: center;
        height: 50px;
        width: 100%;
        margin: 10px 0;
        position: relative;
      }
      .input-box input {
        height: 100%;
        width: 100%;
        outline: none;
        border: none;
        padding: 0 30px;
        font-size: 16px;
        font-weight: 500;
        border-bottom: 2px solid rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
      }
      .input-box input:focus,
      .input-box input:valid {
        border-color: #89CFF0;
      }
      .input-box i {
        position: absolute;
        color: #89CFF0;
        font-size: 17px;
      }
      .button {
        color: #fff;
        margin-top: 40px;
        width: 100%;
      }
      .button input {
        color: #fff;
        background: #89CFF0;
        border-radius: 6px;
        padding: 0;
        cursor: pointer;
        transition: all 0.4s ease;
        width: 100%;
        height: 50px;
        border: none;
      }
      .button input:hover {
        background: #4379c0;
      }
    </style>
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
  <div class="container">
    <div class="form-content">
      <div class="title">Reset Password</div>
      <form action="" method="post">
        <div class="input-boxes">
          <div class="input-box">
            <i class="fas fa-envelope"></i>
            <input type="text" name="email" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <i class="fas fa-lock"></i>
            <input type="password" name="new_password" placeholder="Enter your new password" required>
          </div>
          <div class="button input-box">
            <input type="submit" name="submit_reset_password" value="Submit">
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>