<?php
session_start();
include_once 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo '<script>
        alert("Please log in to view your orders.");
        window.location.href = "login.php";
    </script>';
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user information
$user_sql = "SELECT name, email, phone FROM users WHERE id = '$user_id'";
$user_result = mysqli_query($conn, $user_sql);
$user_data = mysqli_fetch_assoc($user_result);

// Fetch order details for the logged-in user
$order_sql = "SELECT * FROM checkout WHERE user_id = '$user_id'";
$order_result = mysqli_query($conn, $order_sql);
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
                <a href="myorder.php" class="about-bread__link">My Order</a>
            </div>

            <div class="about-content">
                <h1 class="about-title">My<Span>Order</Span></h1>
                <p class="about-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>
            <div class="order">
                <div class="user-details">
                    <div class="section-title">User Details</div>
                    <div class="details">
                        <p><strong>Name:</strong> <?= htmlspecialchars($user_data['name']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($user_data['email']) ?></p>
                        <p><strong>Phone:</strong> <?= htmlspecialchars($user_data['phone']) ?></p>
                    </div>
                </div>
                <div class="order-details">
                    <div class="section-title">Order Details</div>
                    <?php if (mysqli_num_rows($order_result) > 0) { ?>
                        <div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Card Name</th>
                                    <th>Card Number</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($order = mysqli_fetch_assoc($order_result)) { ?>
                                    <tr>
                                        <td><?= htmlspecialchars($order['c_name']) ?></td>
                                        <td><?= htmlspecialchars($order['c_num']) ?></td>
                                        <td><?= number_format($order['grand_total'], 2) ?> /=</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        </div>
                        <!-- Button to Download PDF -->
                        <div>
                        <form action="generate_pdf.php" method="post" style="margin-top: 20px;">
                            <input type="hidden" name="user_id" value="<?= $user_id ?>">
                            <button type="submit" style="padding: 10px 20px; background-color: orange; color: white; border: none; cursor: pointer;">Download Receipt as PDF</button>
                        </form>
                        </div>
                    <?php } else { ?>
                        <div class="no-orders">You have no orders yet.</div>
                    <?php } ?>
                </div>
            </div>



            <?php include 'footer.php'; ?>
        </div>
    </div>
</body>

</html>