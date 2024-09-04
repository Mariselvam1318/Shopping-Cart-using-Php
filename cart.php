<?php
session_start();
include 'config.php';
$user_id = $_SESSION['user_id']; 
if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit;
}
if (isset($_GET['Remove'])) {
    $remove_id = $_GET['Remove'];
    $delete_query = "DELETE FROM cart WHERE id = '$remove_id' AND user_id = '$user_id'";
    mysqli_query($connection, $delete_query);
    header('location:cart.php');
    exit;
}

$query = "SELECT * FROM cart WHERE user_id = '$user_id'";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .empty-cart-container {
            text-align: center;
            margin-top: 50px;
        }

        .empty-cart-container img {
            margin-bottom: 20px;
            height: 400px;
            width: 400px;

        }

        .empty-cart-container p {
            font-size: 18px;
            font-weight: bold;
        }

        .table img {
            object-fit: cover;
            height: 100px;
            width: 100px;
        }

        .back-to-home {
            margin-bottom: 20px;
        }
        
    </style>
</head>
<body>
    <div class="container mt-5">
        <a href="home.php" class="btn btn-success">Back to Home</a>
        <br><br>
        <h2>Your Cart</h2>
        <?php if (mysqli_num_rows($result) > 0): ?>
             <table class="table table-bordered border-white "><!-- or dark -->
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><img src="<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>" width="100"></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td>$<?php echo $row['product_price']; ?></td>
                            <td>
                                <a href="cart.php?Remove=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this item?')">Remove</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            
            <!-- <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a> -->
        <?php else: ?>
            <div class="empty-cart-container">
                <img src="https://blogzine.webestica.com/assets/images/icon/empty-cart.svg" alt="Empty Cart">
                <p>Your cart is empty.</p>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
