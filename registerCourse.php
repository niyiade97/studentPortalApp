<?php
session_start();
include('db.php');
include('logout.php');
$message = "";

if(!$_SESSION["isLoggedIn"]){
  header('Location: login.php');
}
if(isset($_POST['register-course'])){
    $course = $_POST['course'];
    $student_id = $_SESSION["user"]["student_id"];
   
   
    $sql = "SELECT * FROM `courses` WHERE Course_code= '$course'";
    $Result = mysqli_query($conn,$sql);
    if($Result && mysqli_num_rows($Result) > 0){
      $course_data = mysqli_fetch_assoc($Result);
      $course_id = $course_data["course_id"];
      $course_title = $course_data["Course_title"];
      $course_code = $course_data["Course_code"];
      

      $sql1 = "INSERT INTO `studentcourses` (`Student_id`,`Course_id`,`Course_title`,`Course_code`)
        VALUES ('$student_id','$course_id','$course_title','$course_code')";
        $Result = mysqli_query($conn, $sql1);
        $message = "Course Registered";
    }
   else{
    $message = "Course doesnt exist!!!";
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
                STU<span class="logo-text">DENT</span>
              </h2>
            </a>
          </div>
          <ul class="side-nav">
            <li class="side-nav_item">
              <a href="studentView.php" name="signupRequest" class="side-nav_link">
                <i class="fa fa-google-wallet" aria-hidden="true"></i>
                <span>Courses</span>
              </a>
            </li>
            <li class="side-nav_item">
              <a href="registerCourse.php" class="side-nav_link">
                <i class="fa fa-credit-card" aria-hidden="true"></i>
                <span>Add Course</span>
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
                  <div class="new-course-wrapper">
                    <h3><?= $message ?></h3>
                    <div class="header-wrapper">
                        <h1>Register Course</h1>
                    </div class="new-course-wrapper">
                       
                        <div>
                        <select name="course">
                          <option>Select Course</option>
                                <?php
                                $level = $_SESSION["user"]["level"];
                                    $sql = "SELECT * FROM `courses` WHERE level='$level'";
                                    $Result = mysqli_query($conn,$sql);
                                    if($Result && mysqli_num_rows($Result) > 0){
                                        while($row = mysqli_fetch_assoc($Result)) { 
                                            echo" <option>". $row["Course_code"]."</option>";
                                        }
                                       
                                    } 
                                    else{
                                       echo" <option>No Course</option>";
                                    }
                                ?>
                               
                        </select>
                        </div>
                        
                        <div>
                            <input type="submit" name="register-course" value="Register" /> 
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
