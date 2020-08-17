<?php
include '../php_db.php';
function sendQuery ($sql){
    $conn = connect_db();
    $sth = $conn->prepare($sql);
    $sth->execute();
    return $sth;
}
?>
