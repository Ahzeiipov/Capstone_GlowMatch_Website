<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../../include/database-connection/user_database.php'; // Include the database connection
if(isset($_POST['submit_signup'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

  $query = $con->prepare("INSERT INTO users (UserName, Email, password) VALUES (?, ?, ?)");
  $query->bind_param("sss", $name, $email, $password);
  $result = $query->execute();

  if($result){
    $_SESSION['user_id'] = $con->insert_id; // Store user ID in session
    $_SESSION['message'] = 'User Registered Successfully.';
    header("Location:/GlowMatch(1)/pages/homepage/homepage.php");
    exit();
  }else{
    echo "<script>alert('User Not Registered.')</script>";
  }
}

if(isset($_POST['submit_login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = $con->prepare("SELECT UserID, password FROM users WHERE email=?");
  $query->bind_param("s", $email);
  $query->execute();
  $query->store_result();

  if($query->num_rows == 1){
    $query->bind_result($user_id, $hashed_password);
    $query->fetch();

    if(password_verify($password, $hashed_password)){
      $_SESSION['user_id'] = $user_id; // Store user ID in session
      $_SESSION['message'] = 'Login Successful.';
      header("Location: /GlowMatch(1)/pages/homepage/homepage.php");
      exit();
    } else {
      $_SESSION['login_error'] = 'Invalid Email or Password.';
      header("Location: /GlowMatch(1)/pages/homepage/homepage.php");
      exit();
    }
  } else {
    $_SESSION['login_error'] = 'Invalid Email or Password.';
    header("Location: /GlowMatch(1)/pages/homepage/homepage.php");
    exit();
  }
}
?>

