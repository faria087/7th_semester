<?php
session_start();
include_once 'config.php';
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header('Location: login.php'); 
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Turner</title>

    <link rel="stylesheet" href="css/style2.css">

    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Link -->


    <!-- Font Awesome Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- Font Awesome Cdn -->


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <!-- Google Fonts -->
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sideber">
        <?php include_once 'side-menu.php'; ?>
    </div>
    <div class="main-content">
        <header>
            <label for="menu-toggle" class="menu-toggler">
                <span class="las la-bars"></span>
            </label>
            <div class="search">
                <span class="las la-search"></span>
                <input type="search" placeholder="Enter Keyword">
            </div>
            <div class="head-icon">
                <span class="las la-bell" id="notification-bell">
                    <span class="notification-badge" id="notification-badge" style="display: none;">1</span>
                </span>

                <span class="las la-bookmark"></span>
                <span class="las la-comment"></span>
            </div>
        </header>
        <main>
            <div class="cards">
                <div class="card-ad">
                    <div class="card-icon follow">
                        <span class="las la-users"></span>
                    </div>
                    <?php
                    include 'config.php';
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql);
                    $totalUsers = mysqli_num_rows($result);
                    ?>
                    <div class="card-info">
                        <h2>
                            <?php echo $totalUsers; ?>
                        </h2>
                        <small>Total Users</small>
                    </div>

                    <div class="card-images">
                        <div>
                            <?php
                            $sql = "SELECT * FROM users LIMIT 3";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <img src="<?= $row['image'] ?>" alt="">
                            <?php }
                            } ?>
                        </div>
                    </div>

                </div>


                <div class="card-ad ">
                    <div class="card-icon likes">
                        <span class="las la-book" style="color: green;"></span>
                    </div>
                    <?php
                    include 'config.php';
                    $sql = "SELECT * FROM books";
                    $result = mysqli_query($conn, $sql);
                    $totalBooks = mysqli_num_rows($result);
                    ?>
                    <div class="card-info blink">
                        <h2>
                            <?php echo $totalBooks; ?>
                        </h2>
                        <small>Total Books</small>
                    </div>
                    <div class="card-images">
                        <div>
                            <?php
                            $sql = "SELECT * FROM books LIMIT 3";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <img src="<?= $row['image'] ?>" alt="">
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>


                <div class="card-ad">
                    <div class="card-icon comment">
                        <span class="lab la-buffer"></span>
                    </div>
                    <?php
                    include 'config.php';
                    $sql = "SELECT * FROM categories";
                    $result = mysqli_query($conn, $sql);
                    $totalCategories = mysqli_num_rows($result);
                    ?>
                    <div class="card-info">
                        <h2>
                            <?php echo $totalCategories; ?>
                        </h2>
                        <small>Total Categories</small>
                    </div>
                    <div class="card-images">
                        <div>
                            <?php
                            $sql = "SELECT * FROM categories LIMIT 3";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <img src="<?= $row['image'] ?>" alt="">
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="card-ad">
                    <div class="card-icon comment">
                        <span class="las la-shopping-cart" style="color: purple;"></span>
                    </div>
                    <?php
                    include 'config.php';
                    $sql = "SELECT * FROM checkout";
                    $result = mysqli_query($conn, $sql);
                    $totalOrders = mysqli_num_rows($result);
                    ?>
                    <div class="card-info">
                        <h2>
                            <?php echo $totalOrders; ?>
                        </h2>
                        <small>Total Orders</small>
                    </div>
                    <div class="card-images">
                        <div>
                            <?php
                            $sql = "SELECT * FROM categories LIMIT 3";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <img src="<?= $row['image'] ?>" alt="">
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="card-ad">
                    <div class="card-icon comment">
                        <span class="las la-hand-holding-heart" style="color:#F50263;"></span>
                    </div>
                    <?php
                    include 'config.php';
                    $sql = "SELECT * FROM give";
                    $result = mysqli_query($conn, $sql);
                    $totalCategories = mysqli_num_rows($result);
                    ?>
                    <div class="card-info">
                        <h2>
                            <?php echo $totalCategories; ?>
                        </h2>
                        <small>Total Brrows</small>
                    </div>
                    <div class="card-images">
                        <div>
                            <?php
                            $sql = "SELECT * FROM give LIMIT 3";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <img src="<?= $row['image'] ?>" alt="">
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>


                <div class="card-ad">
                    <div class="card-icon comment">
                        <span class="las la-heart" style="color: red;"></span>
                    </div>
                    <?php
                    include 'config.php';
                    $sql = "SELECT * FROM wishlist";
                    $result = mysqli_query($conn, $sql);
                    $totalWishes = mysqli_num_rows($result);
                    ?>
                    <div class="card-info">
                        <h2>
                            <?php echo $totalWishes; ?>
                        </h2>
                        <small>Total Wishes</small>
                    </div>
                    <div class="card-images">
                        <div>
                            <?php
                            $sql = "SELECT * FROM wishlist LIMIT 3";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <img src="<?= $row['image'] ?>" alt="">
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chart-grid">
                <div class="chart-follow">
                    <div class="chart-head">
                        <h3>Books</h3>
                        <span class="las la-book"></span>
                    </div>
                    <div id="myfirstchart" style="height: 250px;"></div>
                </div>
                <div class="chart-sales">
                    <div class="chart-head">
                        <h3>Sales</h3>
                        <span class="las la-ellipsis-h"></span>
                    </div>
                    <div id="donut-example" style="height: 250px;"></div>
                </div>
            </div>
        </main>
    </div>




   

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./js/chart.js"></script>
</body>

</html>