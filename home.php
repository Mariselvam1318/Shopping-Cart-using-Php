<?php
session_start();
include 'config.php';
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
if (!isset($user_id)) {
  header('location:index.php');
}
if (isset($_GET['Logout'])) {
  unset($user_id);
  session_destroy();
  header('location:index.php');
}
if (isset($_POST['cartsubmit'])) {
  $user_id = $_SESSION['user_id'];
  $product_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $insert_query = "INSERT INTO cart (user_id, product_id, product_name, product_price, product_image) 
  VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')";
  mysqli_query($connection, $insert_query);
  echo "<script>alert('Success: Product added to Cart Successfully!..');</script>";
}
if (isset($_POST['contactsubmit'])) {
  $name = $_POST['user_name'];
  $email = $_POST['user_email'];
  $message = $_POST['message'];
  $insert_query = "INSERT INTO feedback (Name,Email,Message) 
  VALUES ('$name', '$email', '$message')";
  mysqli_query($connection, $insert_query);
}
?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_email'])) {
  $mail = new PHPMailer(true);

  try {

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'msmariselvam18@gmail.com';
    $mail->Password   = 'igzr ovec jtmh mcky';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;


    $mail->addAddress($_POST['user_email'], $_POST['user_name']);
    $mail->setFrom('msmariselvam18@gmail.com', 'Mari');



    $mail->isHTML(true);
    $mail->Subject = 'Thank you for contacting us';
    $mail->Body    = 'Dear ' . htmlspecialchars($_POST['user_name']) . ',<br>Thank you for your message. We will get back to you shortly.<br>Best regards,<br>From Shopping Cart';
    $mail->AltBody = 'Dear ' . htmlspecialchars($_POST['user_name']) . ', Thank you for your message. We will get back to you shortly. Best regards, From Shopping Cart';

    $mail->send();
    echo "<script>alert('Success: Message sent Successfully!..');</script>";
  } catch (Exception $e) {
    echo "<script>alert('Error: Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .navbar {
      background-color: #333;
      padding: 1rem;
    }

    .navbar-nav .nav-item .nav-link {
      color: #fff;
      margin-right: 1rem;
      font-size: 1rem;
      transition: color 0.3s ease-in-out;
    }

    .navbar-nav .nav-item .nav-link:hover {
      color: #f39c12;
    }

    .carousel-item img {
      width: 100%;
      height: auto;
      object-fit: cover;
    }

    .zoom-container {
      overflow: hidden;
    }

    .zoom-container img {
      transition: transform 0.5s ease;
    }

    .zoom-container img:hover {
      transform: scale(1.1);
    }
  </style>
</head>

<body>
  <!-- navbar section -->
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="home.php">
        <img src="./images/logo.png" alt="Brand Logo" width="50" height="50">
      </a>

      <!-- Toggle button for mobile view -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu" aria-controls="navmenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar Links -->
      <div class="collapse navbar-collapse" id="navmenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a href="home.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="#aboutus" class="nav-link">About Us</a>
          </li>
          <li class="nav-item">
            <a href="#products" class="nav-link">Products</a>
          </li>
          <li class="nav-item">
            <a href="cart.php" class="nav-link">Cart</a>
          </li>
          <li class="nav-item">
            <a href="signup.php" class="nav-link">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="home.php?Logout=<?php echo $user_id; ?>"
              onclick="return confirm('are you sure you want to Logout')">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- user profile -->
  <div class="container mt-3 text-center">
    <?php
    $sql = "SELECT * from data WHERE id='$user_id'";
    $user = mysqli_query($connection, $sql);
    if (mysqli_num_rows($user) > 0) {
      $fetch_user = mysqli_fetch_assoc($user);
    }
    ?>
    <h3>Welcome,<img src="./images/icons8-user-48.png" alt="User Avatar" class="img-fluid rounded-circle"> <?php echo $fetch_user['Username']; ?></h3>
    <br>
    <h4>Your Email id : <?php echo $fetch_user['Email']; ?></h4>
    <br>

  </div>
  <br>

  <!-- carousel images -->
  <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./images/online-6817350_640.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://martech.org/wp-content/uploads/2014/08/ecommerce-retail-ss-1920.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://www.pngitem.com/pimgs/m/9-98563_ecommerce-website-development-ecommerce-website-banner-design-hd.png" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- About us section -->
  <div id="aboutus" class="container-fluid p-5 bg-info-subtle text-dark">
    <div class="row align-items-center justify-content-between">
      <div class="col-md-6 mb-4">
        <div class="zoom-container">
          <img src="https://media.istockphoto.com/id/1286378180/vector/website-information-concept.jpg?s=612x612&w=0&k=20&c=6v9Hcbp0zp5itIPIywobPQF13YsHIQ4j_srF5VbQusY=" class="img-fluid rounded mx-auto d-block" alt="about us">
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <h1>About Us</h1>
        <h3>Our Mission</h3>
        <p>Our mission is to deliver high-quality products that bring value to our customers. We strive to innovate and continuously improve our offerings, ensuring that our customers receive the best experience possible.</p>

        <h3>Our Vision</h3>
        <p>We envision a world where technology seamlessly integrates into everyday life, enhancing productivity and creating opportunities for everyone. Our goal is to lead in this transformation by providing cutting-edge solutions that empower people to achieve more.</p>
      </div>
    </div>
  </div>

  <!-- product section -->
  <div id="products" class="container">
    <h2 class="mt-4 text-center">Products</h2>
    <br>
    <div class="row">
      <?php
      $sql = "SELECT * FROM products";
      $products = mysqli_query($connection, $sql);
      if (mysqli_num_rows($products) > 0) {
        while ($fetch_product = mysqli_fetch_assoc($products)) {
      ?>
          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="zoom-container">
                <img src="<?php echo $fetch_product['Images']; ?>" class="card-img-top" alt="<?php echo $fetch_product['Name']; ?>" style="height: 400px; width: 100%; object-fit: cover;">
              </div>
              <div class="card-body">
                <h5 class="card-title"><?php echo $fetch_product['Name']; ?></h5>
                <p class="card-text">Price: $<?php echo $fetch_product['Price']; ?></p>
                <form action="home.php" method="POST">
                  <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_product['Name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_product['Price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_product['Images']; ?>">
                  <button type="submit" name="cartsubmit" class="btn btn-primary">Add to Cart</button>
                </form>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<p>No products found.</p>";
      }
      ?>
    </div>
  </div>

  <!-- contact us -->
  <div id="contactus" class="container p-3">
    <div class="container-fluid bg-info-subtle text-dark">
      <div class="row align-items-center justify-content-between">
        <div class="col-md-6 mb-4 p-5 text-center">
          <h1>Contact Us</h1>
          <div class="zoom-container">
            <img src="https://msinuk.in/wp-content/uploads/elementor/thumbs/Contact-Us-phndoyj3w0tnpiw789cdr0mvhstunn3gej0usu4564.png" class="img-fluid rounded mx-auto d-block" alt="Contact Us">
          </div>
        </div>
        <div class="col-md-6 mb-4 p-5">
          <form action="home.php" method="POST">
            <div class="mb-3">
              <label for="user_name" class="form-label">Name</label>
              <input name="user_name" type="text" class="form-control" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
              <label for="user_email" class="form-label">Email address</label>
              <input name="user_email" type="email" class="form-control" placeholder="name@example.com" required>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea name="message" class="form-control" placeholder="Enter your message here.." rows="4" required></textarea>
            </div>
            <button type="submit" name="contactsubmit" class="btn btn-primary" id="button-addon2">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- footer section -->
  <footer class="bg-dark text-white text-center py-4">
    <div class="container">
      <p>&copy; Created by Mariselvam. All Rights Reserved.</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#aboutus" class="text-white">About Us</a></li>
        <li class="list-inline-item"><a href="#contactus" class="text-white">Contact Us</a></li>
        <!-- <li class="list-inline-item"><a href="privacy.php" class="text-white">Privacy Policy</a></li> -->
      </ul>
      <p>Follow us on:</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="https://www.linkedin.com/in/mari-selvam-680b36262/" class="text-white">LinkedIn</a></li>
        <li class="list-inline-item"><a href="https://github.com/Mariselvam1318" class="text-white">Github</a></li>
        <li class="list-inline-item"><a href="https://www.instagram.com/mariselvam1318/" class="text-white">Instagram</a></li>
      </ul>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>