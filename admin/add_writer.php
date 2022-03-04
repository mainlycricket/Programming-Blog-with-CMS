<?php 

session_start();

if(!isset($_SESSION['author_email'])) {
  header('location:../login');
  exit;
}

else if($_SESSION['author_role'] != 'admin') {
  header('location:dashboard');
  exit;
}

if($_SERVER['REQUEST_METHOD'] == "POST") {

    include "../config/connect_db.php";
       
    $author_name = $_POST['author_name'];
    $author_email = $_POST['author_email'];
    $author_password = $_POST['author_password'];
    $author_role = $_POST['author_role'];

    $err_name;
    $err_password;

    $check_email = "select * from tbl_authors where author_email = '$author_email'";

    $result = mysqli_query($conn, $check_email);
    $count = mysqli_fetch_array($result);

    if($count > 0)
      $err_email = "An author with this email already exists!";
   
    else {
    
      if(empty(trim($author_name)) || empty(trim($author_password))) {

          if(empty(trim($author_name))) {
              $err_name = "Author Name can't be empty";
              echo $err_name;
          }

          if(empty(trim($author_password))) {
              $err_password = "Password can't be empty";
              echo $err_password;
          }

      }

      else {

          $sql = "insert into tbl_authors(author_name, author_email, author_password, author_role) values('$author_name', '$author_email', '$author_password', '$author_role')";

          if(mysqli_query($conn, $sql)) {
              echo "Author Added";
              header('location:dashboard');
          }

          else
              echo mysqli_error($conn);

      }

    }

}

?>

<!doctype html>
<html lang="en">

  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href = "../admin-css/dashboard.css" rel = "stylesheet" type = "text/css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Add Author | Admin Panel</title>

  </head>

  <body>

    <div id = "outer">

      <div id = "header">

        <h1>Add Author: AceDevBlog</h1>
      
      </div>  <!-- end of header -->

      <br/>

      <div id = "main">

      <?php include "admin_menu.php"; ?>

        <div id = "add_author_form">

            <form method = "POST" >

                <div class="col-md-4">

                    <label for="author_name" class="form-label">Author Name</label>
                    
                    <input type="text" class="form-control" id="author_name" name = "author_name" required>

                </div> <br/>
                
                <div class="col-md-4">

                  <div>

                    <label for="author_email" class="form-label">Author Email</label>

                    <input type="email" class="form-control" name = "author_email" id="author_email" required>

                  </div>

                  <?php if(isset($err_email)) { echo '<p style = "color: red; margin-top: 5px;">'.$err_email."</p>"; } ?>

                </div> <br/>

                <div class="col-md-4">

                    <label for="author_password" class="form-label">Author Password</label>
                    
                    <input type="password" class="form-control" name = "author_password" id="author_password" required>

                </div> <br/>

                <div class="col-md-3">

                    <label for="author_role" class="form-label">Author Role</label>

                    <select class="form-select" id="author_role" name = "author_role" required>
                        <option selected disabled value="">Choose...</option>
                        <option value = "admin">Admin</option>
                        <option value = "contributor">Contributor</option>
                    </select>

                </div>

                <br/>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Add Author</button>
                </div>

            </form>

        </div>  <!-- end of form -->
      
      </div>  <!-- end of main -->

      <div id = "footer">

      </div>  <!-- end of footer -->
    
    </div>  <!-- end of outer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
  
</html>
