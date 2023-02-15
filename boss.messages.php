<?php
declare(strict_types=1);
    session_start();

    if (empty($_SESSION['user'])) {
        header("Location: index.php");
    }

    $title = "Tyreport : boss message list";

    require_once __DIR__ . '/autoload.php';
    $db = new Database();

    $username = $_SESSION['user'];

    // Number of messages
    $db->select("SELECT name, IF(LENGTH(message) > 20, CONCAT(SUBSTRING(message, 1, 20), '...'), message) as message, created_at, DATE_FORMAT(created_at, '%d %b %Y') as date FROM contact_msg ORDER BY created_at desc");
    $messages = $db->rows;

?>

<!---------------------------------------------------
-         VIEW
---------------------------------------------------->
<?php require_once __DIR__ . '/layout/header.php'; ?>


    <div class="bossusers">

        <div class="bossusers__sidebar">
            <?php require_once __DIR__ . '/layout/sidebar.php'; ?>
        </div>
        
        <div class="bossusers__content">
            <div class="bossusers__main_nav ">
                <?php require_once __DIR__ .'/layout/navbar.php'; ?>
            </div>
            
            <div class="">

                <h1 class="bossusers__title ">messages</h1>
                
                <div class="bossusers__table_wrapper">

                    <table class="bossusers__table">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>message</th>
                                <th>received</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($messages as $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                                    <td><?php echo htmlspecialchars($item['message']); ?></td>
                                    <td><?php echo htmlspecialchars($item['date']); ?></td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                            
                    </table>
                        
                </div>

                
            </div>
        </div>
    </div>
        


<?php require_once __DIR__ . '/layout/header.php'; ?>
