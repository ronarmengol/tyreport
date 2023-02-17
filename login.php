<?php
declare(strict_types=1);
session_start();
/*---------------------------------------------------
        CONTROLLER
---------------------------------------------------*/

require_once __DIR__ . '/autoload.php';
$username = '';
$password = '';
$errors = [
    'username'=>'',
    'password'=>''
];

$db = new Database();
if (isset($_POST['submit'])) {
    $username = $db->escape($_POST['username']);
    $password = $db->escape($_POST['password']);

    if (strlen($username) == 0) {
        $errors['username'] = 'username field cannot be empty';
    }

    if (strlen($password) == 0) {
        $errors['password'] = 'password field cannot be empty';
    }

    // Check if data matches in database
    if (empty(array_filter($errors))) {
        $db->select("SELECT username FROM users_rn WHERE username='$username';");
        $rows = $db->rows;
        if(count($rows) == 0) {
            $errors['username'] = 'username does not exist in database';
        }

    }
    if (empty(array_filter($errors))) {
        $db->select("SELECT username, password FROM users_rn WHERE username='$username' AND password='$password';");
        $rows = $db->rows;
        if (count($rows) == 0) {
            $errors['password'] = "password mismatch";
        }
    }

    // Login user
    if (empty(array_filter($errors))) {
        // check level of user
        $route = [
            '1'=> 'base.php',
            '2'=> 'admin.php',
            '10'=> 'boss.php'
        ];

        $db->select("SELECT username, password, level FROM users_rn WHERE username='$username' AND password='$password'");
        $rows = $db->rows;
        $user_level = $rows[0]['level'];

        
        // unset($_SESSION['user']);
        // unset($_SESSION['level']);

        
        header("location: $route[$user_level]");
        // header("location: index.php");
        $_SESSION['level'] = $user_level;
        $_SESSION['user'] = $username;
        die();

    }
}

?>



<!---------------------------------------------------
-         VIEW
---------------------------------------------------->
<?php $title = "Tyreport : login page"; ?>
<?php $heading = "login page"; ?>
<?php require_once __DIR__ . '/layout/header.php'; ?>
<div class="login__main">

    <?php require_once __DIR__ . '/layout/navbar.php'; ?>
    <?php require_once __DIR__ . '/layout/heading-main.php'; ?>
    
    <div class="container">
        
        <form class="mt20" action="login.php" method="post">
            <fieldset class="fieldset">
                <legend class="legend">login</legend>
                <div class="form-div">
                    <input class="input-text" type="text" placeholder="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
                    <p class="error-message"><?php echo htmlspecialchars($errors['username']); ?></p>
                </div>
                
                <div class="mb-3">
                    <input class="input-text" type="text" placeholder="password" name="password">
                    <p class="error-message"><?php echo htmlspecialchars($errors['password']); ?></p>
                </div>
                
                
                <div class="mt20">
                    <button class="btn1 block mxauto" type="submit" name="submit">submit</button>
                </div>
            </fieldset>
        </form>
    </div>
    
    
</div>