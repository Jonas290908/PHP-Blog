<?php

require_once("common/database.php");

class Post {
    public $id;
    public $title;
    public $content;
    public $created_at;
    
    public function __construct($id, $title, $content, $created_at)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->created_at = $created_at;
    }
}

function getPostById($id) {
    global $db;
    $sql = "SELECT * FROM posts WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return new Post($result["id"], $result["title"], $result["content"], $result["created_at"]);
}

function get_number_of_posts() {
    global $db;
    $sql = "SELECT COUNT(*) FROM posts";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result["COUNT(*)"];
}

function get_number_of_pages() {
    global $db;
    $sql = "SELECT COUNT(*) FROM posts";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return ceil($result["COUNT(*)"] / 5);
}

// returns a page of 5 posts
function getPost($page) {
    global $db;
    $offset = $page * 5;
    // idk why but this is the only way to set the offset bindParam doesn't work
    $sql = "SELECT * FROM `posts` ORDER BY created_at LIMIT 5 OFFSET $offset;";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $posts = [];
    foreach($result as $post) {
        $posts[] = new Post($post["id"], $post["title"], $post["content"], $post["created_at"]);
    }
    return $posts;
}

// this function will create a new post. with and random uuid4 string as id.
function createPost($title, $content) {
    global $db;
    $uuid = generateUuid();
    $sql = "INSERT INTO posts (id, title, content, created_at) VALUES (:id, :title, :content, :created_at)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $uuid);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":content", $content);
    $stmt->bindParam(":created_at", date("Y-m-d H:i:s"));
    $stmt->execute();
    return $uuid;
}

function deletePost($id) {
    global $db;
    $sql = "DELETE FROM posts WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
}