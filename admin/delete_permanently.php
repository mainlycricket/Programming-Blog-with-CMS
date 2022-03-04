<?php

    session_start();

    $id = $_GET['id'];

    include "../config/connect_db.php";

    $sql_delete = "DELETE FROM tbl_posts where id = $id";

    if($post = mysqli_query($conn, $sql_delete)) {
        
        echo "Post deleted";
        header('location: trash');

    }

    else
        echo mysqli_error($conn);
 
?>
