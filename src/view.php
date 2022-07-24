<?php

if(isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    header("Location: index.php");
    exit;
}

require("models/post.php");

$post = getPostById($id);

if($post == null) {
    header("Location: index.php");
    exit;
}

$view = "views/_view.php";
include("views/__layout.php");