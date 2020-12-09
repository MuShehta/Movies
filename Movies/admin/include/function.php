<?php
session_start();

function page_title(){
    global $page_title;
    $title = "None";
    if (isset($page_title)) {
        $title = $page_title;
    }
    echo $title;
}

function login_as_admin() {
    if (!isset($_SESSION["user_name"])) {
        header("Location:login.php");
    }
}

function count_item($from , $where) {
    global $conn;
    $stmt = $conn -> prepare("select * from $from  $where");
    $stmt -> execute();
    return $stmt -> rowCount();
}

?>