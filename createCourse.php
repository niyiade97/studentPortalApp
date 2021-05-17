<?php
session_start();
include('db.php');
include('logout.php');
$message = "";

if(!$_SESSION["isLoggedIn"]){
    header('Location: login.php');
}
if(isset($_POST['submit-course'])){
    $courseTitle = $_POST['course-title'];
    $courseCode = $_POST['course-code'];
  
   
    $sql = "SELECT * FROM `courses` WHERE Course_code= '$courseCode'";
    $Result = mysqli_query($conn,$sql);
    if($Result && mysqli_num_rows($Result) > 0){
        $message = "Course already exist!!!";
    }
   
    else{
        $sql1 = "INSERT INTO `courses` (`Course_title`,`Course_code`,`level`)
        VALUES ('$courseTitle','$courseCode','none')";
        $Result1 = mysqli_query($conn, $sql1);
        $message = "Course created successfully";
        
    }
           
          
        
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>

    <link rel="stylesheet" href="./css/studentStyle.css" type="text/css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>
  <body>
    <div class="container">
      <div class="content">
        <!--Side Bar Nav-->
        <nav class="sidebar">
          <div class="logo">
            <a href="#">
              <h2 class="header-text" id="header-text">
                AD<span class="logo-text">MIN</span>
              </h2>
            </a>
          </div>
          <ul class="side-nav">
          <li class="side-nav_item">
              <a href="createStudent.php" class="side-nav_link">
                <i class="fa fa-credit-card" aria-hidden="true"></i>
                <span>Create Student</span>
              </a>
            </li>
            <li class="side-nav_item">
              <a href="assignCourse.php" name="signupRequest" class="side-nav_link">
                <i class="fa fa-google-wallet" aria-hidden="true"></i>
                <span>Assign Course</span>
              </a>
            </li>
            <li class="side-nav_item">
              <a href="createCourse.php" class="side-nav_link">
                <i class="fa fa-credit-card" aria-hidden="true"></i>
                <span>Create Course</span>
              </a>
            </li>

            <li class="side-nav_item logout">
              <a href="?logout" class="side-nav_link" name="logout">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <span>Logout</span>
              </a>
            </li>
          </ul>
        </nav>
        <!--Dashboard View-->
        <section class="dashboard-view">
         

          <div class="update-div">
            <div class="update-text">
              <div class="Table">
                  <form method="POST">
                  <div class="header-wrapper">
                      <h3><?= $message ?></h3>
                        <h1>Create Course</h1>
                    </div>
                    <div class="new-course-wrapper">
                       
                        <div>
                            <input type="text" name="course-title" placeholder="Course Title" />
                        </div>
                        <div>
                            <input type="text" name="course-code" placeholder="Course Code" />
                        </div>
                        <div>
                            <input type="submit" name="submit-course" value="Create" /> 
                        </div>
                    </div>
                    </form>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

   
  </body>
</html>
