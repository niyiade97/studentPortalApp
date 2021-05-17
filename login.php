<?php
session_start();
include('db.php');
$errorMessage = "";
$_SESSION["isLoggedIn"] = false;


function clean_input($form_input){
    $form_input = trim($form_input);
    $form_input = stripslashes($form_input);
    $form_input = htmlspecialchars($form_input);
    return $form_input;
}

if(isset($_POST["submit"])){
    $matric = clean_input($_POST['matric']);
    $password = clean_input($_POST['password']);
    if($matric == "admin" && $password == "admin"){
        $_SESSION["isLoggedIn"] = true;
        header('Location: createStudent.php');
    }
    else{

    
        $sql = "SELECT * FROM `student` WHERE MatricNumber='$matric'";
        $result = mysqli_query($conn, $sql);
            
        if($result && mysqli_num_rows($result) > 0){

            $user_data = mysqli_fetch_assoc($result);
           
                $user_password = $user_data["Password"];
                $matric = $user_data["MatricNumber"];
                $level = $user_data["Level"];
                $surname =  $user_data["Surname"];
                $studentId =  $user_data["Student_id"];
                
                if(password_verify($password, $user_password)) {
    
                    $_SESSION["isLoggedIn"] = true;
                    $_SESSION["user"] = [
                        "password" => $user_password,
                        "matric" => $matric,
                        "level" => $level,
                        "student_id" => $studentId
                    ];
                    header('Location: studentView.php');
                }
                else{
                    $errorMessage = "Matric Num or password!!!";
            
             }
            }
            else{
                $errorMessage = "user not registered!!!";
            }
        }
        mysqli_close($conn);
       
    }
   
  
?>

<!DOCTYPE html>
<html>
    <head>
        <title>BOOKIT</title>
        <link rel="icon" href="favicon.ico">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/style.css" type="text/css"> 
        <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@1,700&display=swap" rel="stylesheet">
        <script src='https://kit.fontawesome.com/7638b55f18.js' crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <section class="main-container">
            <div class="register-wrapper">
                <div class="login-header">
                    <i class="far fa-calendar-alt"></i>
                    <p>BOOKIT</p>
                </div>
                <div class="register-header">
                    <div class="register-h1-text">
                        <h1>Login In</h1>
                    </div>
                    <div class="social-media-icon">
                        <i class="media-icon fa fa-facebook"></i>
                        <i class="media-icon fa fa-google"></i>
                        <i class="media-icon fa fa-twitter"></i>
                    </div>
                    <div class="register-p-text">
                        <p>or use your email account</p>
                    </div>
                    <form  method="POST">
                        <p class="error-message"><?= $errorMessage ?></p>
                    <div class="input-container">
                        <div class="inner-input-container">
                            <i class="fa fa-envelope icon"> 
                            </i> 
                            <input type="text" placeholder="Matric" name="matric" required>
                        </div>
                        <div class="inner-input-container">
                            <i class="fa fa-lock icon"> 
                            </i> 
                            <input type="password" placeholder="Password" name="password" required>
                        </div>
                    </div>
                    <input type="submit" class="register-btn" name="submit" value="LOG IN">
                    <div class="register-and-forgotPassword-container">
                        <a class="register-link" href="/register">register</a>|
                        <a class="forgot-password-link" href="">forgot Password</a>
                    </div>
                    </form>
                </div>
            </div>
            <div class="login-wrapper">
                <div class="login-inner-container">
                    <div class="login-h1-text">
                        <h1>Hello, Friend!</h1>
                    </div>
                    <div class="login-p-text">
                        <p>Enter personal details and start your journey with us</p>
                    </div>
                    <a href="/register">
                        <input class="login-btn" type="submit" value="SIGN UP">
                    </a>
                </div>
            </div>
        </section>
    </body>
</html>