<?php
session_start();
include 'config.php';
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password= $_POST['password'];
    $sql="SELECT * from data where Username='$username'";
    $result=mysqli_query($connection,$sql);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        $db_password = $row['Password'];
        if(password_verify($password, $db_password)) {
            $_SESSION['user_id']=$row['id'];
            header('location:home.php');
        }
        else {
            echo "<script>alert('Error: Login Failed - Username or Password is Incorrect');</script>";
        }
    }
    else{
        echo "<script>alert('Error: Login Failed-Username or Password is Incorrect');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping_cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
    max-width: 600px;
    margin: 0 auto;
    margin-top: 150px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
.card img {
    max-width: 100%;
    height: auto;
}
    </style>
</head>
<body>
<div class="container-fluid">
        <div class="card">
            <div class="row align-items-center justify-content-between">
                <div id="image-column" class="col-md-6 mb-4">
                    <img src="https://img.freepik.com/free-vector/mobile-login-concept-illustration_114360-83.jpg" alt="">
                </div>
                <div id="form-column" class="col-md-6 mb-4">
                    <h1 id="form-title" class="mb-4">Hello User</h1>
                    <p id="form-description">We are happy to have you back!</p>
                    <form method="post" action="">
                        <div class="input-group mb-3">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div id="extra-options" class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="exampleCheckbox1">
                            <label class="form-check-label" for="exampleCheckbox1">Remember me</label>
                            <a href="#" class="ms-2">Forgot Password?</a>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="submit" class="btn btn-success">Login</button>
                        </div>
                    </form>
                    <p class="mt-3"><span id="toggle-text">Don't have an account?</span> <a href="signup.php">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>