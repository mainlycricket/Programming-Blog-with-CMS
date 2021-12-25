<?php

    session_start();

    $id = $_GET['id'];

    include "../config/connect_db.php";

    $updated_at = date('D-M-Y h:i:s');
    $updated_by = $_SESSION['author_email'];

    $sql_delete = "UPDATE tbl_posts SET status = 'draft', updated_at = '$updated_at', updated_by = '$updated_by' where id = $id";

    if($post = mysqli_query($conn, $sql_delete)) {
        
        echo "Post deleted";
        header('location: draft_posts.php');

    }

    else
        echo mysqli_error($conn);
 
?>
