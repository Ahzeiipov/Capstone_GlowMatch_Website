<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$current_page = basename($_SERVER['PHP_SELF']); // Get the current page name
?>