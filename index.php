<?php

    include "config/connect_db.php";

    $sql = "select * from tbl_category where status = 'active'";

?>

<!doctype html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <base href = "ace-dev-blog.herokuapp.com">

        <link href = "common-css/home.css" rel = "stylesheet" type = "text/css" />
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

        <title>Ace Dev Blog</title>

    </head>

    <body>
        
        <div id = "outer">  <!-- start of outer -->

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
                                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                                </li>

                                <?php

                                    if($category = mysqli_query($conn, $sql)) {
            
                                        if(mysqli_num_rows($category) > 0) {
                            
                                            while($row = mysqli_fetch_array($category)) {
                                                echo '<li class="nav-item">
                                                <a class="nav-link" href="programs.php'.'?sub='.$row['category'].'">'.$row['category'].'</a>
                                            </li>';
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
                                        <a class="btn btn-danger" href="login.php" role = "button">Log in</a>
                                        
                                    <?php endif; ?>
                                </li>

                            </ul>

                        </div>

                    </div>
        
                    </nav>

                </div> <!-- end of menu -->

            </div>  <!-- end of header -->

            <div id = "main">   <!-- start of main --> 

                <!--slider--> 

                <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
 
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <img src="https://i.pinimg.com/originals/94/3d/f0/943df09e7a7968fd91f22f14db8cd3d2.jpg" class="d-block img-fluid rounded" alt="...">
                        </div>

                        <div class="carousel-item">
                            <img src="https://cdn.quotes.pub/1200x630/any-fool-can-write-code-that-a-computer-can-u-419005.jpg" class="d-block img-fluid rounded" alt="...">
                        </div>

                        <div class="carousel-item">
                            <img src="https://wallpaperaccess.com/full/6262367.jpg" class="d-block img-fluid rounded" alt="...">
                        </div>

                    </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>

                </div>
                
                <br>

                <!--Card-->

                <div class="clearfix" id = "intro_text">

                    <p>
                        The craze of <b>computer programming</b> is growing rapidly, thanks to the consistent developments happening in this field. As such, young students are obviously quite inspired to make their careers in this field. And, well, in these pandemic times, this field is among the safest options. With an opportunity of <i>Work from Home</i> and several learning resources available on the Internet, it is among the popular career paths. Learning computer programming can get you a good job quite easily within a short time.
                    </p>

                    <p>
                        As lucrative as its benefits are, computer programming requires plenty of practice, along with a sharp brain. Problem-solving capability, strong logic-building skill, with a solid foundation of the basics is absolute must. Many programming enthusiasts compromise on the time given to learn basics and suffer later. Remember, you can dive deep into the complex concepts, only with a rock-solid base.
                    </p>

                    <p>
                        So, we are here to help the college students who're studying computer programming. You can find the basic programs of three programming languages – C, Java and Python – as of now. We promise to bring more content in the future. In the cards below, we have linked the W3Schools tutorials as well. Learn well and practice hard! &#128074;
                    </p>
                
                </div>
                
                <br>

                <div class="row row-cols-1 row-cols-md-2 g-4">

                    <?php

                        if($category = mysqli_query($conn, $sql)) {
            
                            if(mysqli_num_rows($category) > 0) {
                            
                                while($row = mysqli_fetch_array($category)) {

                                    echo '<div class="col">';

                                        echo '<div class="card">';

                                            echo '<img src = "'.$row['banner_link'].'" class="card-img-top" alt="'.$row['banner_caption'].'" title="'.$row['banner_caption'].'">';

                                            echo '<div class="card-body">';

                                                echo '<h5 class="card-title" style = "text-align: center;">'.$row['category'].' Blog </h5>';

                                                echo '<p class="card-text" style = "text-align: justify;">'.htmlspecialchars($row['description']).'</p>';

                                                echo '<div class="d-grid gap-2 col-6 mx-auto">';
                                                    echo '<a class="btn btn-dark" href="'.$row['tutorial_link'].'" role="button" target = "_blank">Learn '.$row['category'].'</a>';
                                                    echo '<a class="btn btn-primary" href="programs.php'.'?sub='.$row['category'].'" role="button">Read Programs</a>';
                                                echo "</div>";

                                            echo "</div>";

                                        echo "</div>";

                                    echo "</div>";

                                }
                            
                            }
                            
                        }
                            
                        else
                            echo mysqli_error($conn);

                    ?>

                </div>

            </div>  <!-- end of main -->

            <br/> <br/>

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