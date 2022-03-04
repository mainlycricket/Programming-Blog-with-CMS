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
       
    $category_name = trim($_POST['category_name']);
    $description = trim($_POST['description']);
    $banner_link = trim($_POST['banner_link']);
    $banner_caption = trim($_POST['banner_caption']);
    $tutorial_link = trim($_POST['tutorial_link']);

    $err_category_name;
    $err_description;
    $err_banner_link;
    $err_banner_caption;
    $err_tutorial_link;
    $err = 0;
    
    if(empty($category_name)) {

        $err_category_name = "Category Name can't be empty";
        $err++;

    }

    else {

        $check_category = "select * from tbl_category where category = '$category_name'";
        $result = mysqli_query($conn, $check_category);
        $count = mysqli_fetch_array($result);
       
        if($count > 0) {
            $err_category_name = "This subject already exists!";
            $err++;
        }

    }

    if(empty($description)) {

        $err_description = "Description can't be empty";
        $err++;
       
    }

    if(!filter_var($banner_link, FILTER_VALIDATE_URL)) {

        $err_banner_link = "Enter a valid URL";
        $err++;
       
    }

    if(empty($banner_caption)) {

        $err_banner_caption = "Banner caption can't be empty";
        $err++;
       
    }

    if(!filter_var($tutorial_link, FILTER_VALIDATE_URL)) {

        $err_tutorial_link = "Enter a valid URL";
        $err++;
       
    }

    if($err == 0) {

        $sql = "insert into tbl_category(category, description, banner_link, banner_caption, tutorial_link, status) values('$category_name', '$description', '$banner_link', '$banner_caption', '$tutorial_link', 'active')";

        if(mysqli_query($conn, $sql)) {
            echo "Category Added";
            header('location:dashboard');
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

    <link href = "../admin-css/dashboard.css" rel = "stylesheet" type = "text/css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Add Category | Admin Panel</title>

  </head>

  <body>

    <div id = "outer">

      <div id = "header">

        <h1>Add Category: Ace Dev Blog</h1>
      
      </div>  <!-- end of header -->

      <br/>

      <div id = "main">

      <?php include "admin_menu.php"; ?>

        <div id = "add_category_form">

            <form method = "POST" >

                <div class="col-md-4">

                    <div>

                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name = "category_name" required>

                    </div>

                    <?php if(isset($err_category_name)) { echo '<p style = "color: red; margin-top: 5px;">'.$err_category_name."</p>"; } ?>

                </div>

                <br/>

                <div class="col-md-4">

                    <div>

                        <label for="description" class="form-label">Category Description</label>
                        <textarea class="form-control" id="description" name = "description" rows="3" cols="10" required></textarea>
                    
                    </div>

                    <?php if(isset($err_description)) { echo '<p style = "color: red; margin-top: 5px;">'.$err_description."</p>"; } ?>
                
                </div>

                <br/>

                <div class="col-md-4">

                    <div>

                        <label for="banner_link" class="form-label">Banner Link</label>
                        <input type="url" class="form-control" id="banner_link" name = "banner_link" required>
                    
                    </div>

                    <?php if(isset($err_banner_link)) { echo '<p style = "color: red; margin-top: 5px;">'.$err_banner_link."</p>"; } ?>

                </div>

                <br/>

                <div class="col-md-4">

                <div>

                    <label for="banner_caption" class="form-label">Banner Caption</label>
                    <input type="text" class="form-control" id="banner_caption" name = "banner_caption" required>

                </div>

                <?php if(isset($err_banner_caption)) { echo '<p style = "color: red; margin-top: 5px;">'.$err_banner_caption."</p>"; } ?>
                
                </div>

                <br/>

                <div class="col-md-4">

                <div>

                    <label for="tutorial_link" class="form-label">Tutorial Link</label>
                    <input type="url" class="form-control" id="tutorial_link" name = "tutorial_link" required>

                </div>

                <?php if(isset($err_tutorial_link)) { echo '<p style = "color: red; margin-top: 5px;">'.$err_tutorial_link."</p>"; } ?>
                
                </div>

                <br/>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Add Category</button>
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
