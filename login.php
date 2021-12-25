<?php

session_start();

if(isset($_SESSION['email'])) {
    header('location: admin/index.php');
    exit;
}

include "config/connect_db.php";  

$sql = "select * from tbl_category where status = 'active'";

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    include "config/connect_db.php";

    $entered_email = $_POST['email'];
    $entered_password = $_POST['password'];

    $finding_user = "SELECT * from tbl_authors where author_email = '$entered_email'";

    if($result = mysqli_query($conn, $finding_user)) {

        $count = mysqli_fetch_array($result);

        if($count == 0) 
            $err_email = "User not found!";

        else {

            $email = $count['author_email'];
            $password = $count['author_password'];
            $role = $count['author_role'];
            $id = $count['id'];
            $name = $count['author_name'];

            if($entered_password == $password) {
                session_start();
                $_SESSION['author_email'] = $email;
                $_SESSION['author_id'] = $id;
                $_SESSION['author_role'] = $role;
                $_SESSION['author_name'] = $name;
                echo "Logged in succesfully!";
                header('location: admin/');
            }

            else
                $err_password = "Incorrect Password!";

        }

    }

    else
        echo mysqli_error($conn);

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Page</title>

    <base href = "ace-dev-blog.herokuapp.com">

    <link href = "common-css/home.css" rel = "stylesheet" type = "text/css" />
        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="common-css/login.css">

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
                                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
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

    <div class="container-login">
        <p class="heading">Log in</p>
        <div class="box">
            <form method = "POST">
            <p>Email</p>
            <div>
                <input type="email" name="email" placeholder="Enter Your Email">
            </div>
            <?php if(isset($err_email)) { echo '<p style = "color: red; margin-top: 5px;">'.$err_email."</p>"; } ?>
        </div>
        <div class="box">
            <p>Password</p>
            <div>
                <input type="password" name="password" placeholder="Enter Your Password">
            </div>
            <?php if(isset($err_password)) { echo "<p style = 'color: red; margin-top: 5px;'>".$err_password."</p>"; } ?>
        </div> 
        <input type = "submit" value = "Login" class="loginBtn"/>
            </form>
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
