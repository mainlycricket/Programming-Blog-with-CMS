<?php

  session_start();

  if(!isset($_SESSION['author_email'])) {
    header('location:../login');
    exit;
  }

  $author_email = $_SESSION['author_email'];
  $author_role = $_SESSION['author_role'];
  $author_name = $_SESSION['author_name'];

?>

<!doctype html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href = "../admin-css/dashboard.css" rel = "stylesheet" type = "text/css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Drafts | Admin Panel</title>

  </head>

  <body>

  <div id = "outer">

      <div id = "header">

        <h1>Draft Posts: Ace Dev Blog</h1>

        <div id = "h-nav">

          <div id = "view-site">
            <a href = "../" target = "_blank" class="btn btn-dark" role = "button">View Site</a>
          </div>

          <div id = "logout">
          <a href = "logout"><i class="fa fa-power-off" aria-hidden="true" style = "color: red;"></i></a>
          </div>

          <div id = "greetings">
            <i style='font-size:24px;' class='fas'>&#xf406;</i>&emsp;Hello, <?php echo $author_name.'!'; ?>
          </div>

        </div>

        <br/>
      
      </div>  <!-- end of header -->

      <br/>

      <div id = "main">

      <?php include "admin_menu.php"; ?>

        <div id = "posts">

        <?php

          include "../config/connect_db.php";

          echo '<div class="table-responsive">';

          echo "<table class = 'table table-hover post_list' ";

          echo "<thead class='table-dark'>";
              echo "<tr>";
                  echo "<th scope='col'>" . "#" . "</th>";
                  echo "<th scope='col'>" . "Title" . "</th>";
                  echo "<th scope='col'>" . "Category" . "</th>";
                  echo "<th scope='col'>" . "Saved At" . "</th>";
              echo "</tr>";
          echo "</thead>";

          $sql = "SELECT id, title, category, updated_at, status from tbl_posts where status = 'draft' and updated_by = '{$_SESSION['author_email']}'";

          if($post = mysqli_query($conn, $sql)) {
              
              if(mysqli_num_rows($post) > 0) {

                  while($row = mysqli_fetch_array($post)) {

                      echo "<tr scope = 'row'>";
                      echo "<td>".$row['id']."</td>";
                      echo "<td>".$row['title']."<br/>".
                      "<a href = 'edit?id={$row['id']}'>Edit Post</a>&emsp;".
                      "<a href = 'delete?id={$row['id']}'>"."Delete Post"."</a>".
                      "</td>";
                      echo "<td>".$row['category']."</td>";
                      echo "<td>".$row['updated_at']."</td>";
                      echo "</tr>";

                  }

              }

            }

          else
              echo mysqli_error($conn);

          echo "</table>";

          echo "</div>";

        ?>

        </div>  <!-- end of posts -->
      
      </div>  <!-- end of main -->

      <div id = "footer">

      </div>  <!-- end of footer -->
    
    </div>  <!-- end of outer -->

    <!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> -->

    <script type = "text/javascript" src = "icon.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   
  </body>

</html>
