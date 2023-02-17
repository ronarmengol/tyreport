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
    $db->select("SELECT id, name, IF(LENGTH(message) > 20, CONCAT(SUBSTRING(message, 1, 20), '...'), message) as message, created_at, DATE_FORMAT(created_at, '%d %b %Y') as date FROM contact_msg WHERE is_read=0 ORDER BY created_at desc limit 10");
    $messages = $db->rows;

?>

<!---------------------------------------------------
-         VIEW
---------------------------------------------------->
<?php require_once __DIR__ . '/layout/header.php'; ?>


    <div class="bossmessages">

        <div class="bossusers__sidebar">
            <?php require_once __DIR__ . '/layout/sidebar.php'; ?>
        </div>
        
        <div class="bossusers__content">
            <div class="bossusers__main_nav ">
                <?php require_once __DIR__ .'/layout/navbar.php'; ?>
            </div>
            
            <div class="">

                <h1 class="bossusers__title ">unread messages</h1>

                <div class="boss__mainbar_content">
                    <?php include_once __DIR__ . '/layout/nav_boss.php'; ?>
                </div>
                
                <div class="bossusers__table_wrapper mt20">

                    <table class="bossusers__table">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>message</th>
                                <th>received</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($messages as $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                                    <td><?php echo htmlspecialchars($item['message']); ?></td>
                                    <td><?php echo htmlspecialchars($item['date']); ?></td>
                                    <td class="bossmessages__table_action">
                                        <form action="boss.delete.php" method="post">
                                        <?php $id = strval($item['id']); ?>
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <button class="table-delete-btn" type="submit" name="delete">delete</button>
                                        </form>

                                        <form action="boss.view.php" method="post">
                                        <?php $id = strval($item['id']); ?>
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <button class="table-view-btn" type="submit" name="view">View</button>
                                        </form>
                                    </td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                            
                    </table>
                        
                </div>

                
            </div>
        </div>
    </div>
        


<?php require_once __DIR__ . '/layout/header.php'; ?>
