<?php

session_start();
include_once 'config.php';
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header('Location: login.php'); 
    exit;
}



if (isset($_POST['update_cart_quantity'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_sql = "UPDATE brrow SET quantity='$update_value' WHERE id='$update_id'";
    $update_result = mysqli_query($conn, $update_sql);
    if ($update_result) {
        header('location:brrow.php');
    } else {
        echo "<script>alert('Quantity not updated')</script>";
    }
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $remove_sql = "DELETE FROM brrow WHERE id='$remove_id'";
    $remove_result = mysqli_query($conn, $remove_sql);
    if ($remove_result) {
        header('location:brrow.php');
    } else {
        echo "<script>alert('Product not removed')</script>";
    }
}

$grand_total = 0;

$sql = "SELECT * FROM brrow";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

if ($count > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $grand_total += $row['price'] * $row['quantity'];
    }
}




if (isset($_POST['submit'])) {
    $names = $_POST['name'];
    $images = $_POST['image'];
    $quantities = $_POST['quantity'];
    $prices = $_POST['price'];
    $username = $_POST['user-name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $date = $_POST['date'];

    foreach ($names as $index => $name) {
        $image = $images[$index];
        $quantity = $quantities[$index];
        $price = $prices[$index];

        $sql = "INSERT INTO `give` (`name`, `image`, `quantity`, `price`, `user-name`, `address`, `phone`, `email`, `date`) 
                VALUES ('$name', '$image', '$quantity', '$price', '$username', '$address', '$phone', '$email', '$date')";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Failed to submit item: ' . $name . '
                  </div>';
        }
    }
    if ($result) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> All items submitted successfully.
              </div>';
        header("Location: brrow.php");
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/about.css">
    <link rel="stylesheet" href="./css/cart.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>PageTerner</title>
</head>

<body>

    <div class="container">
        <?php include 'header.php'; ?>

        <div class="about">

            <div class="about-bread">
                <a href="index.php" class="about-bread__link">Home</a>
                <i class="las la-angle-right"></i>
                <a href="brrow.php" class="about-bread__link">Brrow</a>
            </div>

            <div class="about-content">
                <h1 class="about-title">My<Span>Brrows</Span></h1>
                <p class="about-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>

            <div class="cart">
                <div class="cart-table">
                    <div class="cart-header">
                        <h2>Brrow Item</h2>
                        <p><?php echo $count; ?> items</p>
                    </div>
                    <div class="cart-table-item">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $sql = "SELECT * FROM brrow";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?= $row['name'] ?></td>
                                        <td>
                                            <img src="<?= $row['image'] ?>" alt="">
                                        </td>
                                        <td><?= number_format($row['price'], 2) ?> /=</td>
                                        <td>
                                            <form action="" method="POST">
                                                <input type="hidden" value="<?= $row['id'] ?>" name="update_quantity_id">
                                                <input type="number" min="1" value="<?= $row['quantity'] ?>" name="update_quantity" required>
                                                <input type="submit" value="Update" name="update_cart_quantity">
                                            </form>
                                        </td>
                                        <td><?= number_format($row['price'] * $row['quantity']) ?> /=</td>
                                        <td>
                                            <a href="brrow.php?remove=<?= $row['id'] ?>" onclick="return confirm('are you sure you want to delete this product?');"><i class="las la-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-footer">
                        <a href="books.php">Back to Shop</a>
                    </div>
                </div>
                <div class="cart-summary">
                    <div class="cart-summary-header">
                        <h2>Summary</h2>
                    </div>
                    <!-- <form action="" method="POST" enctype="multipart/form-data">
                        <?php

                        $sql = "SELECT * FROM brrow";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <input type="hidden" value="<?= $row['name'] ?>" name="name">
                            <input type="hidden" value="<?= $row['image'] ?>" name="image">
                            <input type="hidden" value="<?= $row['quantity'] ?>" name="qty">
                            <input type="hidden" value="<?= $row['price'] ?>" name="price">

                            <?php } ?>
                            <div class="cart-summary-items">
                                <p>Name</p>
                                <input type="text" name="user-name" placeholder="Enter Name" style="padding: 10px;">
                            </div>
                            <div class="cart-summary-items">
                                <p>Address</p>
                                <input type="text" name="address" placeholder="Enter Address" style="padding: 10px;">
                            </div>
                            <div class="cart-summary-items">
                                <p>Phone No</p>
                                <input type="number" name="phone" placeholder="Enter Number" style="padding: 10px;">
                            </div>
                            <div class="cart-summary-items">
                                <p>Email</p>
                                <input type="email" name="email" placeholder="Enter Email" style="padding: 10px;">
                            </div>
                            <div class="cart-summary-items">
                                <p>Date</p>
                                <input type="date" name="date" style="padding: 10px;">
                            </div>
                            <div class="cart-summary-footer">
                                <button type="submit" name="submit">Give Me</button>
                            </div>
                        
                    </form> -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?php
                        $sql = "SELECT * FROM brrow";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <input type="hidden" name="name[]" value="<?= $row['name'] ?>">
                            <input type="hidden" name="image[]" value="<?= $row['image'] ?>">
                            <input type="hidden" name="quantity[]" value="<?= $row['quantity'] ?>">
                            <input type="hidden" name="price[]" value="<?= $row['price'] ?>">
                        <?php } ?>
                        <!-- Collect user details -->
                        <div class="cart-summary-items">
                            <p>Name</p>
                            <input type="text" name="user-name" placeholder="Enter Name" required style="padding: 10px;">
                        </div>
                        <div class="cart-summary-items">
                            <p>Address</p>
                            <input type="text" name="address" placeholder="Enter Address" required style="padding: 10px;">
                        </div>
                        <div class="cart-summary-items">
                            <p>Phone No</p>
                            <input type="number" name="phone" placeholder="Enter Number" required style="padding: 10px;">
                        </div>
                        <div class="cart-summary-items">
                            <p>Email</p>
                            <input type="email" name="email" placeholder="Enter Email" required style="padding: 10px;">
                        </div>
                        <div class="cart-summary-items">
                            <p>Date</p>
                            <input type="date" name="date" required style="padding: 10px;">
                        </div>
                        <div class="cart-summary-footer">
                            <button type="submit" name="submit">Give Me</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>



        <?php include 'footer.php'; ?>
    </div>



    <script src="./js/app.js"></script>
</body>

</html>