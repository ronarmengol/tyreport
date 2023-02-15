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


    <div class="flex min-h-screen">

        <div class="hidden md:flex">
            <?php require_once __DIR__ . '/layout/sidebar.php'; ?>
        </div>
        
        <div class="main grow w-full md:w-[500px]">
            <div class="block md:hidden ">
                <?php require_once __DIR__ .'/layout/navbar.php'; ?>
            </div>
            
            <div class="">

                <h1 class="text-center mt-10 text-3xl font-semibold text-indigo-600 mb-16">Users</h1>
                
                <div class="w-11/12 block mx-auto overflow-x-auto px-2 ">
                    <table class="table-fixed border-collapse border border-slate-500 mx-auto">
                        <thead class="bg-indigo-100">
                            <tr>
                                <th class="border border-indigo-600 px-5 py-2">firstname</th>
                                <th class="border border-indigo-600 px-5 py-2">lastname</th>
                                <th class="border border-indigo-600 px-5 py-2">username</th>
                                <th class="border border-indigo-600 px-5 py-2">password</th>
                                <th class="border border-indigo-600 px-5 py-2">level</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $user): ?>
                                <tr>
                                    <td class="py-2 border border-indigo-600 px-2"><?php echo htmlspecialchars($user['firstname']); ?></td>
                                    <td class="py-2 border border-indigo-600 px-2"><?php echo htmlspecialchars($user['lastname']); ?></td>
                                    <td class="py-2 border border-indigo-600 px-2"><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td class="py-2 border border-indigo-600 px-2"><?php echo htmlspecialchars($user['password']); ?></td>
                                    <td class="py-2 border border-indigo-600 text-center"><?php echo htmlspecialchars($user['level']); ?></td>

                                </tr>
                            </tbody>

                        <?php endforeach; ?>
                    </table>

                </div>

                
            </div>
        </div>
    </div>
        


<?php require_once __DIR__ . '/layout/header.php'; ?>