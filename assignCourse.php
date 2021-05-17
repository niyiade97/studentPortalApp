<?php
session_start();
include('db.php');
include('logout.php');
$message = "";
if(!$_SESSION["isLoggedIn"]){
    header('Location: login.php');
}

if(isset($_POST['assign-course'])){
    $level= $_POST['level'];
    $course = $_POST['course'];
  
    $sql = "SELECT * FROM `courses` WHERE Course_code= '$course'";
    $Result = mysqli_query($conn,$sql);
    if($Result && mysqli_num_rows($Result) > 0){
        // $message = "Course already exist!!!";
        if(!($level === "Select Level")){
            $sql1 = "UPDATE `courses` SET Level='$level' WHERE Course_code='$course'";
            $Result1 = mysqli_query($conn, $sql1);
            $message = "Course assigned";
        }
        else{
            $message = "Select a valid level!!!";
        }
        
    }
   
    else{
        $message = "Course does not exist!!!";
       
        
    }
      
    }
?>

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
                    <div class="new-course-wrapper">
                    <div class="header-wrapper">
                        <h3><?= $message ?></h3>
                        <h1>Assign Course</h1>
                    </div class="new-course-wrapper">
                    <div>
                        <select name="level">
                                <option>Select Level</option>
                                <option>100</option>
                                <option>200</option>
                                <option>300</option>
                                <option>400</option>
                            </select>
                    </div>
                        <div>
                            <select name="course">
                                <?php
                                    $sql = "SELECT * FROM `courses`";
                                    $Result = mysqli_query($conn,$sql);
                                    if($Result && mysqli_num_rows($Result) > 0){
                                        while($row = mysqli_fetch_assoc($Result)) { 
                                            echo" <option>". $row["Course_code"]."</option>";
                                        }
                                       
                                    } 
                                    else{
                                       echo" <option>No Created Course</option>";
                                    }
                                ?>
                               
                            </select>
                        </div>
                       
                        
                        <div>
                            <input type="submit" name="assign-course" value="add" /> 
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
