<?php
    require_once __DIR__ . '/init.php';

    $title = $title ?? 'tyre port';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="output.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body class="font-montserrat">