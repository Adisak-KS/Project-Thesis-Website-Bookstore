<?php
session_start();
session_unset();
header('Location: login_form.php');
?>