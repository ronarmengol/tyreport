<?php
declare(strict_types=1);

require_once __DIR__ . '/autoload.php';

$db = new Database();

if(isset($_POST['delete'])) {
    
    $id = $db->escape($_POST['id']);
    echo $id;

    $db->delete("DELETE FROM contact_msg WHERE id=$id");

    header("Location: boss.messages.php");
}