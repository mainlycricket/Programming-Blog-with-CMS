<?php

    session_start();

    $id = $_GET['id'];

    include "../config/connect_db.php";

    $deleted_at = date('D-M-Y h:i:s');
    $deleted_by = $_SESSION['author_email'];

    $sql_delete = "UPDATE tbl_posts SET status = 'deleted', deleted_at = '$deleted_at', deleted_by = '$deleted_by' where id = $id";

    if($post = mysqli_query($conn, $sql_delete)) {
        
        echo "Post deleted";
        header('location: deleted_posts.php');

    }

    else
        echo mysqli_error($conn);
 
?>
