<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location:/php/GlowMatch/pages/homepage/homepage.php");
    exit();
}

include '../../include/database-connection/user_database.php'; 

$user_id = $_SESSION['user_id'];
$query = $con->prepare("SELECT UserName, Email FROM users WHERE UserID=?");
$query->bind_param("i", $user_id);
$query->execute();
$query->bind_result($username, $email);
$query->fetch();
$query->close();

if (isset($_POST['update_profile'])) {
    $new_username = $_POST['username'];
    $new_password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;

    if ($new_password) {
        $update_query = $con->prepare("UPDATE users SET UserName=?, password=? WHERE UserID=?");
        $update_query->bind_param("ssi", $new_username, $new_password, $user_id);
    } else {
        $update_query = $con->prepare("UPDATE users SET UserName=? WHERE UserID=?");
        $update_query->bind_param("si", $new_username, $user_id);
    }
    
    $result = $update_query->execute();

    if ($result) {
        $_SESSION['message'] = 'Profile Updated Successfully.';
        header("Location:/php/GlowMatch/pages/homepage/homepage.php");
        exit();
    } else {
        echo "<script>alert('Profile Not Updated.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../../asset/css/profile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../asset/image/gm.png" type="x-icon">
</head>

<body>
    <div class="profile-container">
        <h2>Edit Profile</h2>
        <form action="edit_profile.php" method="post">
            <div class="input-box">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>" required>
            </div>
            <div class="input-box">
                <label for="password">New Password (optional)</label>
                <input type="password" name="password" placeholder="Enter new password">
            </div>
            <div class="button input-box">
                <input type="submit" name="update_profile" value="Update Profile">
            </div>
            <div class="button input-box">
                <input type="button" value="Cancel" onclick="window.location.href='/php/GlowMatch/pages/homepage/homepage.php';">
            </div>
        </form>
    </div>
</body>

</html>
