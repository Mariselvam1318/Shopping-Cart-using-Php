<?php
include 'config.php';

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password= $_POST['password'];
    $phno = $_POST['phno'];
    $sql="SELECT * from data where email='$email'";
    $result=mysqli_query($connection,$sql);
    if(mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists. Please try another email.');</script>";
    }
    else{
        $password_hash=password_hash($password,PASSWORD_BCRYPT);
        $insertsql="INSERT into data (Username,Email,Password,PhoneNo) VALUES('$username','$email','$password_hash','$phno')";
        if(mysqli_query($connection, $insertsql)){
            echo "<script>alert('Registration successful!');</script>";
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Error: Could not register. Please try again later.');</script>";
        }
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
                    <h3 id="form-description">Join Us!</h3>
                    <form method="post" action="">
                    <div class="input-group mb-3">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="phno" name="phno" class="form-control" placeholder="Phone No.">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="submit" class="btn btn-success">Sign Up</button>
                    </div>                        
                    </form>
                    <p class="mt-3"><span id="toggle-text">Already have an account?</span> <a href="index.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>