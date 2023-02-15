<?php
declare(strict_types=1);
session_start();

unset($_SESSION['user']);
unset($_SESSION['level']);
unset($_SESSION['success-contact']);

// echo ($_SESSION['user']);
// print_r($_SESSION);

header("Location: index.php");