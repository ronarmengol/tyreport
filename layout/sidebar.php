<?php
declare(strict_types=1);

// $db = new Database();

$db->select("SELECT * from users_rn where username='boss1'; ");
$rows = $db->rows;
$firstname = $rows[0]['firstname'];


?>


<div class="sidebar__main">
    <div class="sidebar__title">
        tyreport
    </div>
    <hr class="sidebar__hr">
    
    <p class="sidebar__user"><?php echo htmlspecialchars($firstname); ?></p>

    <hr class="sidebar__hr">

    <div class="sidebar__nav mt100">
        <a href="boss.php">main</a>
    </div>
    <div class="sidebar__nav">
        <a href="logout.php">logout</a>
    </div>

</div>