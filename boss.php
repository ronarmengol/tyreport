<?php
declare(strict_types=1);
    session_start();

    if (empty($_SESSION['user'])) {
        header("Location: index.php");
    }

    $title = "Tyreport : boss page";

    require_once __DIR__ . '/autoload.php';
    $db = new Database();

    $username = $_SESSION['user'];

    // Number of users
    $db->select("SELECT * FROM users_rn");
    $rows = $db->rows;
    $num_of_users = strval(count($rows));

    // numebr of unread messages
    $db->select("SELECT * FROM contact_msg where is_read=0");
    $rows = $db->rows;
    $num_of_unread_msg  = strval(count($rows));


?>

<!---------------------------------------------------
-         VIEW
---------------------------------------------------->
<?php require_once __DIR__ . '/layout/header.php'; ?>


    <div class="boss__main">

        <div class="boss__sidebar">
            <?php require_once __DIR__ . '/layout/sidebar.php'; ?>
        </div>
        
        <div class="boss__mainbar">
            <div class="boss__mainbar_content">
                <?php require_once __DIR__ .'/layout/navbar.php'; ?>
            </div>
            
            <div class="">

                <h1 class="boss__title">Home page</h1>
                

                <?php include_once __DIR__ .'/layout/nav_boss.php'; ?>

                
                <div class="boss__container">
                    
                    <a href="boss.users.php" class="boss__card">
                        <p class="boss__card_title">Users : </p>
                        <p class="text-center"><?php echo htmlspecialchars($num_of_users); ?></p>
                    </a>
                    <a href="boss.messages.php" class="boss__card">
                        <p class="boss__card_title">Messages : </p>
                        <p class="text-center"><?php echo htmlspecialchars($num_of_unread_msg); ?></p>
                    </a>

                </div>
            </div>
        </div>
    </div>
    


    
<?php require_once __DIR__ . '/layout/header.php'; ?>
