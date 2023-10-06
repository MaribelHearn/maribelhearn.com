<?php
if (preg_match('/admin$/', $_SERVER["REQUEST_URI"])) {
    chdir('admin');
    include_once 'admin.php';
} else { 
    return false;
}
?>