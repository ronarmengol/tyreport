<?php
declare(strict_types=1);
    session_start();

    if (empty($_SESSION['user'])) {
        header("Location: index.php");
    }

    $title = "Tyreport : message page";

    require_once __DIR__ . '/autoload.php';
    $db = new Database();

    if(isset($_POST['view'])) {
    
        $id = $db->escape($_POST['id']);
    
        $db->select("SELECT id, name, message, company, email, mobile, DATE_FORMAT(created_at, '%d %b %Y') as date, DATE_FORMAT(created_at, '%H:%i') AS time FROM contact_msg where id=$id");
        $message = $db->rows;

        // mark message as read
        $db->update("UPDATE contact_msg set is_read=1 WHERE id=$id");
    
    } else {
        header("Location: boss.messages.php");
    }



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

                <h1 class="boss__title">Message</h1>
                
                <div class="boss__mainbar_content">
                    <?php include_once __DIR__ .'/layout/nav_boss.php'; ?>
                </div>


                
                <div class="boss__container">
                    <div class="bossview__card">
                        <p><?php echo htmlspecialchars($message[0]['company']); ?></p>
                        <p><?php echo htmlspecialchars($message[0]['name']); ?></p>
                        <hr>
                        <p><?php echo htmlspecialchars($message[0]['message']); ?></p>
                        <hr>
                        <p><?php echo htmlspecialchars($message[0]['mobile']); ?></p>
                        <p><?php echo htmlspecialchars($message[0]['email']); ?></p>
                        <div class="bossview__card_time">
                            <div><?php echo htmlspecialchars($message[0]['date']); ?></div> 
                            <div><?php echo htmlspecialchars($message[0]['time']); ?> hrs</div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


    
<?php require_once __DIR__ . '/layout/header.php'; ?>
