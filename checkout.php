<?php
session_start();
include_once 'config.php';

// Initialize variables from the session or set default values
$grand_total = isset($_SESSION['grand_total']) ? $_SESSION['grand_total'] : 0.00;
$shipping_cost = isset($_SESSION['shipping_cost']) ? $_SESSION['shipping_cost'] : 0.00;

if (isset($_POST['submit'])) {
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; // Logged-in user's ID
    $c_name = mysqli_real_escape_string($conn, $_POST['c_name']);
    $c_num = mysqli_real_escape_string($conn, $_POST['c_num']);
    $grand_total = mysqli_real_escape_string($conn, $_POST['grand_total']);

    if ($user_id) {
        // Insert payment details with user ID
        $sql = "INSERT INTO `checkout` (`user_id`, `c_name`, `c_num`, `grand_total`, `status`) 
                VALUES ('$user_id', '$c_name', '$c_num', '$grand_total', 'Pending')";
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            echo '<div style="background:green;color:white;z-index: 1000;" role="alert">
                <strong>Success!</strong> Payment Successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            echo '<script>
                setTimeout(function(){
                    window.location.href = "myorder.php";
                }, 3000); // Redirect after 3 seconds
                </script>';
        } else {
            echo '<div style="background:red;color:white;" role="alert">
                <strong>Error!</strong> Failed to process payment. Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    } else {
        echo '<div style="background:red;color:white;" role="alert">
            <strong>Error!</strong> You need to log in to proceed.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
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
                <a href="checkout.php" class="about-bread__link">CheckOut</a>
            </div>

            <div class="about-content">
                <h1 class="about-title">Payment<Span>Tarm</Span></h1>
                <p class="about-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>

            <div class="cart">




                <div class="cart-summary">
                    <div class="cart-summary-header">
                        <h2>Payment Term</h2>
                    </div>

                    <div class="cart-summary-item" style="border-top: 2px solid orange;">
                        <p>Total Item Price</p>
                        <p><?= number_format($grand_total - $shipping_cost, 2) ?> /=</p>
                    </div>

                    <div class="cart-summary-item" style="border-top: 2px solid orange;">
                        <p>Total Shipping Cost</p>
                        <p><?= number_format($shipping_cost, 2) ?> /=</p>
                    </div>

                    <div class="cart-summary-item" style="border-top: 2px solid orange;">
                        <p>Grand Total</p>
                        <p><?= number_format($grand_total, 2) ?> /=</p>
                    </div>
                    <form action="" method="POST">
                        <div class="cart-summary-items">
                            <p>Credit Card Name</p>
                            <input type="text" name="c_name" placeholder="Enter Card Name" style="padding: 10px;">
                        </div>
                        <div class="cart-summary-items">

                            <p>Card NO</p>
                            <input type="number" name="c_num" placeholder="Enter Card Number" style="padding: 10px;">
                        </div>
                        <div class="cart-summary-items">
                            <p>Other Payment Method</p>
                            <div class="payment-term">
                                <a href="bkash.php">
                                    <img src="./images/bkash.png" alt="">
                                </a>
                                <a href="rocket.php">
                                    <img src="./images/dutch-bangla-rocket-logo.png" alt="">
                                </a>
                                <a href="nagad.php">
                                    <img src="./images/nagad.png" alt="">
                                </a>
                                <a href="upay.php">
                                    <img src="./images/upay.png" alt="">
                                </a>
                            </div>
                        </div>


                        <input type="hidden" name="grand_total" value="<?= $grand_total + $shipping_cost ?>">
                        <button type="submit" name="submit" style="cursor: pointer;width:100%;padding:10px;background-color:orange;border:none;font-weight:bold;font-size:20px;">Proceed to Payment</button>
                    </form>
                </div>

            </div>

        </div>



        <?php include 'footer.php'; ?>
    </div>




    <script src="./js/app.js"></script>
</body>

</html>