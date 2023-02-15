<?php
declare(strict_types=1);
    session_start();

    if (empty($_SESSION['user'])) {
        header("Location: index.php");
    }

    $title = "Tyreport : boss users list";

    require_once __DIR__ . '/autoload.php';
    $db = new Database();

    $username = $_SESSION['user'];

    // Number of users
    $db->select("SELECT * FROM users_rn ORDER BY level desc");
    $users = $db->rows;


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

                <h1 class="bossusers__title ">Users</h1>
                
                <div class="bossusers__table_wrapper">

                    <table class="bossusers__table">
                        <thead>
                            <tr>
                                <th>firstname</th>
                                <th>lastname</th>
                                <th>username</th>
                                <th>password</th>
                                <th>level</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['firstname']); ?></td>
                                    <td><?php echo htmlspecialchars($user['lastname']); ?></td>
                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td><?php echo htmlspecialchars($user['password']); ?></td>
                                    <td><?php echo htmlspecialchars($user['level']); ?></td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                            
                    </table>
                        
                </div>

                
            </div>
        </div>
    </div>
        


<?php require_once __DIR__ . '/layout/header.php'; ?>
