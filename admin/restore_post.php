<?php

    $id = $_GET['id'];

    include "../config/connect_db.php";

    $updated_at = date('D-M-Y h:i:s');

    $sql_status = "SELECT published_at from tbl_posts where id = $id";

    if($published_at = mysqli_query($conn, $sql_status)) {
      
      if(mysqli_num_rows($published_at) > 0) {

        while($row = mysqli_fetch_array($published_at)) {

          $isPublished = $row['published_at'];
         
        }

      }

    }

    if(empty($isPublished))
      $status = 'draft';

    else
      $status = 'published';


    $sql_restore = "UPDATE tbl_posts SET status = '$status', updated_at = '$updated_at', deleted_at = NULL, deleted_by = NULL
    where id = $id";

    if($post = mysqli_query($conn, $sql_restore)) {
        
        echo "Post Restored";
        header('location: dashboard');

    }

    else
        echo mysqli_error($conn);
    
?>
