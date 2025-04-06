<?php
session_start();
session_destroy();
header("Location:/php/GlowMatch/pages/homepage/homepage.php");
exit();
?>
