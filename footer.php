<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION['activo'] != true) {
    header("Location:index.php");
}
?>

<footer class="main-footer mt-2">
    <!-- <strong>Copyright &copy; 2023-2026 <a href="http://10.8.8.100/Emailsend/correos.php">EmailSend</a>.</strong> -->
    <strong>Copyright &copy; 2023-2026 <a href="./correos.php">EmailSend</a>.</strong>
    <!-- All rights reserved. -->
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.1.0
    </div>
</footer>
