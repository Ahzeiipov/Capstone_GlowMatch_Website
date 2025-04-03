<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('modal').style.display = 'flex';
        });
    </script>";
}
?>