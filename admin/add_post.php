<?php

session_start();

if(!isset($_SESSION['author_email'])) {
  header('location:../login.php');
  exit;
}

$author_name = $_SESSION['author_name'];

include "../config/connect_db.php";

$select_category = "select * from tbl_category where status = 'active'";

if(($_SERVER['REQUEST_METHOD'] == 'POST') && ($_POST['submit'] == 'Publish Post')) {

  $title = $_POST['article_title'];
  $category = $_POST['category'];
  $published_at = date('D-M-Y h:i:s');
  $status = 'published';
  $published_by = $_SESSION['author_email'];
  $err = 0;

  if(empty(trim($_POST['article_title']))) {
    $err_title = "Title can't be empty!";
    $err++;
  }

  if(empty(trim($_POST['article_content']))) {
    $err_content = "Content can't be empty!";
    $err++;
  }

  else
    $article = mysqli_real_escape_string($conn, $_POST['article_content']);

  if($err == 0) {

    $sql = "insert into tbl_posts(title, category, article, published_at, published_by, status) values('$title', '$category', '$article', '$published_at', '$published_by', '$status')";

    if(mysqli_query($conn, $sql)) {
      echo "Post Published";
      header('location:published_posts.php');
    }

    else
      echo mysqli_error($conn);

  }

}

if(($_SERVER['REQUEST_METHOD'] == 'POST') && ($_POST['submit'] == 'Save Draft')) {

  $title = $_POST['article_title'];
  $category = $_POST['category'];
  $updated_at = date('D-M-Y h:i:s');
  $updated_by = $_SESSION['author_email'];
  $status = 'draft';
  $err = 0;

  if(empty(trim($_POST['article_title']))) {
    $err_title = "Title can't be empty!";
    $err++;
  }

  if(empty(trim($_POST['article_content']))) {
    $err_content = "Content can't be empty!";
    $err++;
  }

  else
    $article = mysqli_real_escape_string($conn, $_POST['article_content']);

  if($err == 0) {

    $sql = "insert into tbl_posts(title, category, article, updated_by, updated_at, status) values('$title', '$category', '$article', '$updated_by', '$updated_at', '$status')";

    if(mysqli_query($conn, $sql)) {
      echo "Draft Saved";
      header('location: draft_posts.php');
    }

    else
      echo mysqli_error($conn);

  }

}

if(($_SERVER['REQUEST_METHOD'] == 'POST') && ($_POST['submit'] == 'Submit Post')) {

  $title = $_POST['article_title'];
  $category = $_POST['category'];
  $updated_at = date('D-M-Y h:i:s');
  $status = 'pending';
  $published_by = $_SESSION['author_email'];
  $err = 0;

  if(empty(trim($_POST['article_title']))) {
    $err_title = "Title can't be empty!";
    $err++;
  }

  if(empty(trim($_POST['article_content']))) {
    $err_content = "Content can't be empty!";
    $err++;
  }

  else
    $article = mysqli_real_escape_string($conn, $_POST['article_content']);

  if($err == 0) {

    $sql = "insert into tbl_posts(title, category, article, updated_at, published_by, status) values('$title', '$category', '$article', '$updated_at', '$published_by', '$status')";

    if(mysqli_query($conn, $sql)) {
      echo "Post Submitted";
      header('location:pending_posts.php');
    }

    else
      echo mysqli_error($conn);

  }

}

?>

<!doctype html>

<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link href = "../admin-css/add_post.css" rel = "stylesheet" type = "text/css" />

    <title>New Post | Editor</title>

  </head>

  <body>

    <div id = "header">

      <div id = "h-nav">

        <div id = "dashboard-link">
          <a href = "index.php" class="btn btn-dark" role = "button">Dashboard</a>
        </div>

        <div id = "greetings">
          <i style='font-size:24px;' class='fas'>&#xf406;</i>&emsp;Hello, <?php echo $author_name.'!'; ?>
        </div>

      </div>

    </div>

    <div class = "container">

        <br/>
       
        <h2>Add a New Post:</h2>

        <form method = "POST">

            <div class="mb-3">
                <label for="article_title" class="form-label">Title</label>
                <input type="text" id = "article_title" name = "article_title" class="form-control" placeholder="Enter title here" aria-label="title" aria-describedby="basic-addon1" required>
            </div>

            <?php if(isset($err_title)) { echo '<p style = "color: red; margin-top: 5px;">'.$err_title."</p>"; } ?>

            <div class = "article_category">

              Category:&ensp;

              <?php

                if($category = mysqli_query($conn, $select_category)) {
            
                  if(mysqli_num_rows($category) > 0) {
                            
                    while($row = mysqli_fetch_array($category)) {

                      echo '<div class="form-check">';

                        echo '<input class="form-check-input" type="radio" name="category" id="'.$row['category'].'" value = "'.$row['category'].'" required>';
                        echo '<label class="form-check-label" for="'.$row['category'].'">'.$row['category'].'&emsp;</label>';

                      echo '</div>';
                                                
                    }
                            
                  }
                            
                }
                            
                else
                  echo mysqli_error($conn);

              ?>

            </div>

            <div class="mb-3">
              <div>
                <label for="article_content" class="form-label">Type Content Here</label><br/>
                <textarea class="form-control" id="article_content" name = "article_content" rows="3" required></textarea>
              </div>
              <?php if(isset($err_content)) { echo '<p style = "color: red; margin-top: 5px;">'.$err_content."</p>"; } ?>
            </div>

            <?php
              if($_SESSION['author_role'] == 'admin'):
            ?>

              <?php
                echo '<input type="submit" name = "submit" class="btn btn-primary mb-3" value = "Publish Post">';
              ?>

              <?php else:
                echo '<input type="submit" name = "submit" class="btn btn-primary mb-3" value = "Submit Post">';
                endif;
              ?>

            <input type="submit" name = "submit" class="btn btn-primary mb-3" value = "Save Draft">

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> -->

    <script type = "text/javascript" src = "icon.js"></script>
    
    <script src = "CKEditor/ckeditor.js"></script>

    <script>
      CKEDITOR.replace('article_content');
    </script>


  </body>
  
</html>
