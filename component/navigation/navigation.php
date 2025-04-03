<?php include($_SERVER['DOCUMENT_ROOT'] . '/GlowMatch(1)/include/database-connection/page_logic.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <link rel="stylesheet" href="../../asset/css/navigation.css">
  <link rel="stylesheet" href="../../asset/fonts/style.css">
  <link rel="stylesheet" href="../../asset/css/button.css">
  <link rel="stylesheet" href="../../asset/css/drop_down_menu.css">
  <link rel="stylesheet" href="../../pages/homepage/homepage.php">
  <script src="../../js/navigation.js"></script>
  <script src="../../js/register_form_pop.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <nav>
    <div class="navbar">
      <img src="/Glowmatch(1)/asset/image/logo/logo.png" class="img-responsive" alt="Image" width="200" height="70" style="margin-top: 10px;">
      <ul class="menu">
        <li class="home">
          <a href="http://localhost/GlowMatch(1)/pages/homepage/homepage.php">Home</a>
        </li>
        <li>
          <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="javascript:void(0);" onclick="openModal()">Analyze</a>
          <?php else: ?>
            <a href="http://localhost/GlowMatch(1)/pages/analysis/analysis.php">Analyze</a>
          <?php endif; ?>
        </li>

        <li>
          <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="javascript:void(0);" onclick="openModal()">Consulting</a>
          <?php else: ?>
            <a href="http://localhost/GlowMatch(1)/screen/wellcome_page/consulting_wellcome_page.php">Consulting</a>
          <?php endif; ?>
        </li>

        <li>
          <a href="http://localhost/GlowMatch(1)/pages/about-us/about_us.php">About us</a>
        </li>

        <li>
          <?php if (isset($_SESSION['user_id'])): ?>
            <div class="dropdown">
              <a href="#" class="dropbtn"><i class="fas fa-user"></i> Profile</a>
              <div class="dropdown-content">
                <a href="../../pages/profile/edit_profile.php">Edit Profile</a>
                <a href="../../include/authentication/logout.php">Logout</a>
              </div>
            </div>
          <?php else: ?>
            <a href="javascript:void(0);" onclick="openModal()" class="register-button">Login</a>
          <?php endif; ?>
        </li>
      </ul>
    </div>
  </nav>

  <div id="modal" class="modal-container">
    <?php include '../../component/register_form/sign-in.php'; ?>
  </div>

</body>

</html>