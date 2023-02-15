<?php
declare(strict_types=1);
// session_start();

function isurl($url) {
    if ($_SERVER['REQUEST_URI'] == $url) {
        return true;
    }
    return false;
}