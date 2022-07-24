<?php

require_once("common/common.php");
require_once("models/post.php");

if(isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 0;
}

if($page < get_number_of_pages()) {
    $posts = getPost($page);
} else {
    $posts = [];
}

$view = "views/_index.php";
include("views/__layout.php");