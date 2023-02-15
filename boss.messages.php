<?php
declare(strict_types=1);
    session_start();

    if (empty($_SESSION['user'])) {
        header("Location: index.php");
    }

    $title = "Tyreport : boss users list";

    require_once __DIR__ . '/autoload.php';
    $db = new Database();

    $itemname = $_SESSION['user'];

    // Number of users
    $db->select("SELECT name, message, created_at, DATE_FORMAT(created_at, '%d %b %Y') as date FROM contact_msg ORDER BY created_at desc");
    $messages = $db->rows;


?>

<!---------------------------------------------------
-         VIEW
---------------------------------------------------->
<?php require_once __DIR__ . '/layout/header.php'; ?>


    <div class="flex">

        <div class="hidden md:flex">
            <?php require_once __DIR__ . '/layout/sidebar.php'; ?>
        </div>
        
        <div class="main grow w-full md:w-[500px]">
            <div class="block md:hidden ">
                <?php require_once __DIR__ .'/layout/navbar.php'; ?>
            </div>
            
            <div class="">

                <h1 class="text-center mt-10 text-3xl font-semibold text-indigo-900 mb-16">Users</h1>
                
                <div class="w-11/12 block mx-auto overflow-x-auto px-2 pb-20">
                    <table class="table-fixed border-collapse border border-slate-500 mx-auto">
                        <thead class="bg-indigo-100">
                            <tr>
                                <th class="border border-indigo-600 px-5 py-2">name</th>
                                <th class="border border-indigo-600 px-5 py-2">message</th>
                                <th class="border border-indigo-600 px-5 py-2">received</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($messages as $item): ?>
                                <tr>
                                    <td class="py-2 border border-indigo-600 px-2"><?php echo htmlspecialchars($item['name']); ?></td>
                                    <td class="py-2 border border-indigo-600 px-2"><?php echo htmlspecialchars($item['message']); ?></td>
                                    <td class="py-2 border border-indigo-600 px-2"><?php echo htmlspecialchars($item['date']); ?></td>

                                </tr>
                            </tbody>

                        <?php endforeach; ?>
                    </table>

                </div>

                
            </div>
        </div>
    </div>
        


<?php require_once __DIR__ . '/layout/header.php'; ?>
