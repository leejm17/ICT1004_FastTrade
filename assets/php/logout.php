<?php
session_start();
unset($_SESSION['userid']);
unset($_SESSION['activated']);
session_destroy();
header('Location:../../index.php');
?>