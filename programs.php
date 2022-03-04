<?php

    include "config/connect_db.php";

    $sql = "select category from tbl_category where status = 'active'";

    $subject = $_GET['sub'];

    if (!isset($subject))
      header("location: home");

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href = "common-css/posts.css" rel = "stylesheet" type = "text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <title><?php echo $subject; ?> Progams</title>
  </head>
  <body>

  <div id="outer">

    <div id = "header"> <!-- start of header -->

      <h1 id = "title">Ace Dev Blog</h1>

      <h6 style="color:red; text-align: end;">Tutorials <span class="badge bg-warning text-dark">Comming Soon!</span></h6>
    
      <div id = "menu">   <!-- start of menu -->
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            
          <div class="container-fluid">

            <!-- <a class="navbar-brand" href="#">Programs</a> -->

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
                    
              <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav">

                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="home">Home</a>
                  </li>

                    <?php

                        if($category = mysqli_query($conn, $sql)) {
            
                            if(mysqli_num_rows($category) > 0) {
                                
                                while($row = mysqli_fetch_array($category)) {
                                    echo '<li class="nav-item">
                                            <a href="programs'.'?sub='.$row['category'].'"'."class = 'nav-link ";
                                        if($subject == $row['category']) {
                                          echo "active";}
                                        echo "'>".$row['category']."</a>
                                        </li>";
                                }
                                
                            }
                            
                        }
                            
                        else
                            echo mysqli_error($conn);

                    ?>

                  <li class="nav-item">
                    <?php session_start(); ?>
                    <?php if(isset($_SESSION['author_email'])): ?>
                      <a class="btn btn-danger" href="admin/"  role = "button">Dashboard</a>
                    <?php else: ?>
                    <a class="btn btn-danger" href="login" role = "button">Log in</a>        
                    <?php endif; ?>
                  </li>

                </ul>

              </div>

          </div>
        
        </nav>

      </div> <!-- end of menu -->

      <h1 class = "category">Basic <?php echo $subject; ?> Programs</h1>

    </div>  <!-- end of header -->

    <div id = "main">   <!-- start of main -->

    <?php

        $sql = "SELECT title, article from tbl_posts where category = '$subject' and status = 'published'";

            if($post = mysqli_query($conn, $sql)) {
                
                if(mysqli_num_rows($post) > 0) {

                    $i = 1;

                    while($row = mysqli_fetch_array($post)) {
                        echo "<div class = 'post'>";
                        echo "<h3 class = 'post_title'>".$i.". ".$row['title'].":"."</h3>";
                        echo "<div class = 'post_article'>".$row['article']."</div>";
                        echo "</div>";
                        $i++;
                    }

                }

            }

        else
            echo mysqli_error($conn);

    ?>

    </div>  <!-- end of main -->

    <br/>

    <div id = "footer"> <!-- start of footer -->

                <div class="footer-dark">

                    <footer>

                        <div class="container">

                            <div class="row">

                                <div class="col-sm-6 col-md-3 item">

                                    <h3>Services</h3>

                                    <ul>
                                        <li><a href="#">Career Counselling</a></li>
                                        <li><a href="#">Web Development</a></li>
                                        <li><a href="#">Programming Courses</a></li>
                                    </ul>

                                </div>

                                <div class="col-sm-6 col-md-3 item">

                                    <h3>About</h3>

                                    <ul>
                                        <li><a href="#">Company</a></li>
                                        <li><a href="#">Team</a></li>
                                        <li><a href="#">Careers</a></li>
                                    </ul>
                                </div>

                                <div class="col-md-6 item text">

                                    <h3>Ace Dev Blog</h3>

                                    <p>We are here to help you, young programmer!</p>
                                
                                </div>

                                <div class="col item social">

                                    <a href="https://twitter.com/"  target = "_blank">
                                        <i class="icon ion-social-twitter"></i>
                                    </a>

                                    <a href="https://www.instagram.com/"  target = "_blank">
                                        <i class="icon ion-social-instagram"></i>
                                    </a>

                                    <a href="https://www.facebook.com/" target = "_blank">
                                        <i class="icon ion-social-facebook"></i>
                                    </a>

                                </div>

                            </div>

                            <p class="copyright">Ace Dev Blog © 2021</p>

                        </div>

                    </footer>

                </div>

            </div>  <!-- end of footer -->

  </div>  <!-- end of outer -->
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>

</html>
