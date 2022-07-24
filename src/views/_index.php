
<div class="container">
    <?php
        foreach($posts as $post) {
            echo "<div class='card'>";
            echo "<small>".$post->created_at."</small>";
            echo "<h2 class='display-6'><a href=\"view.php?id=".$post->id."\">".$post->title."</a></h2>";
            echo "<p class='card-text'>".strlen($post->content) > 150 ? substr($post->content,0,150)."..." : $post->content."</p>";
            echo "</div>";
        }
    ?>
</div>

<ul class="pagination justify-content-center">
    <?php
        if($page > 0) {
            echo "<li class='page-item'><a class='page-link' href='index.php?page=".($page - 1)."'>Previous</a></li>";
        }
        if($page < get_number_of_pages()-1) {
            echo "<li class='page-item'><a class='page-link' href='index.php?page=".($page + 1)."'>Next</a></li>";
        }
    ?>
</ul>