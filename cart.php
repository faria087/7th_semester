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
    $update_sql = "UPDATE cart SET quantity='$update_value' WHERE id='$update_id'";
    $update_result = mysqli_query($conn, $update_sql);
    if ($update_result) {
        header('location:cart.php');
    } else {
        echo "<script>alert('Quantity not updated')</script>";
    }
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $remove_sql = "DELETE FROM cart WHERE id='$remove_id'";
    $remove_result = mysqli_query($conn, $remove_sql);
    if ($remove_result) {
        header('location:cart.php');
    } else {
        echo "<script>alert('Product not removed')</script>";
    }
}

$shipping_cost = isset($_POST['shipping_cost']) ? $_POST['shipping_cost'] : 0;
$grand_total = 0;


$user_id = $_SESSION['user_id'];
$sql = "SELECT c.id, c.book_id, c.name, c.price, c.discount_price, c.image, c.quantity 
        FROM cart c 
        WHERE c.user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_assoc($result)) {
    $grand_total += $row['price'] * $row['quantity'];
}

$grand_total += $shipping_cost;

$_SESSION['grand_total'] = $grand_total;
$_SESSION['shipping_cost'] = $shipping_cost;





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
                <a href="cart.php" class="about-bread__link">Cart</a>
            </div>

            <div class="about-content">
                <h1 class="about-title">My<Span>Cart</Span></h1>
                <p class="about-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>
            <div class="cart">
                <?php
                if ($count == 0) {
                    echo "<h2 style='color:orange;'>No items in your cart.</h2>";
                } else {
                ?>
                    <div class="cart-table">
                        <div class="cart-header">
                            <h2>Shopping Cart</h2>
                            <p><?php echo $count; ?> items</p>
                        </div>
                        <div class="cart-table-item">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Discount Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    mysqli_data_seek($result, 0);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?= $row['name'] ?></td>
                                            <td>
                                                <img src="<?= $row['image'] ?>" alt="">
                                            </td>
                                            <td><?= number_format($row['price'], 2) ?> /=</td>
                                            <td><?= number_format($row['discount_price'], 2) ?> /=</td>
                                            <td>
                                                <form action="" method="POST">
                                                    <input type="hidden" value="<?= $row['id'] ?>" name="update_quantity_id">
                                                    <input type="number" min="1" value="<?= $row['quantity'] ?>" name="update_quantity" required>
                                                    <input type="submit" value="Update" name="update_cart_quantity">
                                                </form>
                                            </td>
                                            <td><?= number_format($row['price'] * $row['quantity']) ?> /=</td>
                                            <td>
                                                <a href="cart.php?remove=<?= $row['id'] ?>" onclick="return confirm('are you sure you want to delete this product?');"><i class="las la-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php

                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                }
                    ?>

                    <?php
                    if ($grand_total > 0) {
                    ?>
                        <div class='cart-footer' style='display: flex;justify-content:space-between;align-items:center;'>
                            <a href='books.php'>Back to Shop</a>
                            <h2 style='color:orange;'>Grand total : <?= number_format($grand_total - $shipping_cost, 2) ?> /=</h2>
                        </div>

                    </div>

                    <div class='cart-summary'>
                        <div class='cart-summary-header'>
                            <h2>Summary</h2>
                        </div>
                        <div class='cart-summary-item'>
                            <p>Total item price</p>
                            <p><?= number_format($grand_total - $shipping_cost, 2) ?> /=</p>
                        </div>
                        <div class='cart-summary-items'>
                            <p>Shipping</p>
                            <form action="cart.php" method="POST" style="width: 100%;">
                                <select name="shipping_cost" onchange="this.form.submit()" style="width: 100%;">
                                    <option value="0" <?= ($shipping_cost == 0) ? 'selected' : ''; ?>>Free Delivery $0.00</option>
                                    <option value="5" <?= ($shipping_cost == 5) ? 'selected' : ''; ?>>Standard Delivery $5.00</option>
                                    <option value="10" <?= ($shipping_cost == 10) ? 'selected' : ''; ?>>Express Delivery $10.00</option>
                                </select>
                            </form>
                        </div>
                        <div class='cart-summary-item' style='border-top: 2px solid orange;'>
                            <p>Total</p>
                            <!-- <p><?= number_format($grand_total + $shipping_cost, 2) ?> /=</p> -->
                            <p><?= number_format($grand_total, 2) ?> /=</p>
                        </div>
                        <div class='cart-summary-footer'>
                            <a href='checkout.php'>CheckOut</a>
                        </div>
                    </div>
                <?php
                    }
                ?>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>

    </div>

    <script src="./js/app.js"></script>
</body>

</html>