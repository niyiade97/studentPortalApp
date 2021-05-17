<?php
session_start();
include('db.php');
include('logout.php');
$student_id = "";
if(!$_SESSION["isLoggedIn"]){
  header('Location: login.php');
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
                      <table class="course-table">
                      
                        <?php
                              $student_id = $_SESSION["user"]["student_id"];
                              $sql = "SELECT * FROM `studentcourses` WHERE Student_id='$student_id' ORDER BY Course_id ";
                              $result = mysqli_query($conn,$sql);
                              if($result && mysqli_num_rows($result) > 0){
                               echo" <tr>
                                      <th>Course Code</th>
                                      <th>Course Title</th>
                                    </tr>";
                                  while($row = mysqli_fetch_assoc($result)) { 
                                    
                                  echo "<tr>
                                          <td>".$row["Course_code"]."</td>
                                          <td>".$row["Course_title"]."</td>
                                        </tr>";
                                  }
                              }
                              else{
                                echo"<h1>No Registered Course</h1>";
                              }
                          ?>
                      </table>
                  </form>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

   
  </body>
</html>
