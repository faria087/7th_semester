
<?php
session_start();
include_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login first.'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];  

if (isset($_POST['submit2'])) {
    if (!empty($_POST['book_id']) && !empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['discount_price']) && !empty($_POST['image'])) {
        $book_id = $_POST['book_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $discount_price = $_POST['discount_price'];
        $image = $_POST['image'];
        $product_quantity = 1;

        $select_sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND book_id = '$book_id'";
        $select_result = mysqli_query($conn, $select_sql);
        $select_count = mysqli_num_rows($select_result);

        if ($select_count > 0) {
            echo "<script>alert('Product Already Added to Cart');</script>";
            echo "<script>window.location.href = 'cart.php';</script>";
        } else {
       
            $sql = "INSERT INTO cart (user_id, book_id, name, price, discount_price, image, quantity) 
                    VALUES ('$user_id', '$book_id', '$name', '$price', '$discount_price', '$image', '$product_quantity')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<script>alert('Product Added Successfully');</script>";
                echo "<script>window.location.href = 'cart.php';</script>";
            } else {
                echo "<script>alert('Product Addition Failed');</script>";
                echo "<script>window.location.href = 'cart.php';</script>";
            }
        }
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
    <link rel="stylesheet" href="./css/books.css">
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
                <a href="show-book.php" class="about-bread__link">Books-Details</a>
            </div>

            <div class="about-content">
                <h1 class="about-title">Book<Span></Span></h1>
                <p class="about-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>

            <?php
            include_once 'config.php';

            if (isset($_POST['submit'])) {
                if (!empty($_POST['book_id']) && !empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['discount_price']) && !empty($_POST['image'])) {
                    $book_id = $_POST['book_id'];
                    $name = $_POST['name'];
                    $price = $_POST['price'];
                    $discount_price = $_POST['discount_price'];
                    $image = $_POST['image'];

                    $sql = "INSERT INTO wishlist (book_id, name, price, discount_price, image) VALUES ('$book_id', '$name', '$price', '$discount_price', '$image')";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        echo "<script>alert('Wish Added Successfully');</script>";
                    } else {
                        echo "<script>alert('Wish Addition Failed');</script>";
                    }
                } else {
                    echo "<script>alert('Missing form data.');</script>";
                }
            }
      

            if (isset($_POST['submit3'])) {
                if (!empty($_POST['book_id']) && !empty($_POST['name']) && !empty($_POST['price'])  && !empty($_POST['image'])) {
                    $book_id = $_POST['book_id'];
                    $name = $_POST['name'];
                    $price = $_POST['price'];
                    $image = $_POST['image'];
                    $product_quantity = 1;
                    $select_sql = "SELECT * FROM brrow WHERE name = '$name'";
                    $select_result = mysqli_query($conn, $select_sql);
                    $select_count = mysqli_num_rows($select_result);

                    if($select_count > 0){
                        echo "<script>alert('Product Already Added')</script>";
                        echo "<script>window.location.href = 'brrow.php'</script>";
                    }else{
                        $sql = "INSERT INTO brrow (book_id,name, price, image, quantity) VALUES ('$book_id','$name', '$price', '$image', '$product_quantity')";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            echo "<script>alert('Product Added Successfully')</script>";
                            echo "<script>window.location.href = 'brrow.php'</script>";
                        }else{
                            echo "<script>alert('Product Added Failed')</script>";
                            echo "<script>window.location.href = 'brrow.php'</script>";
                        }
                    }
                }
            }
            ?>

          
           
            <div class="category-section">
                <div class="packages">
                    <?php
                    include_once 'config.php';
                    $sql = "SELECT * FROM books WHERE id = {$_GET['id']}";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="package">
                            <div class="package-img">
                                <img src="<?= $row['image'] ?>" alt="">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="update_quantity_id" value="<?= $row['id'] ?>">
                                    <div class="btn">

                                        <input type="hidden" name="book_id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="name" value="<?= $row['name'] ?>">
                                        <input type="hidden" name="price" value="<?= $row['price'] ?>">
                                        <input type="hidden" name="discount_price" value="<?= $row['discount_price'] ?>">
                                        <input type="hidden" name="image" value="<?= $row['image'] ?>">
                                        <button name="submit" type="submit"><i class="las la-heart"></i></button>
                                        <button name="submit2" type="submit"><i class="las la-shopping-cart"></i></button>
                                        <a href="gift.php"><i class="las la-gift"></i></a>
                                        <button name="submit3" type="submit"><i class="las la-hand-holding-heart"></i></button>

                                    </div>
                                </form>

                            </div>
                            <div class="package-content">
                                <h2><?= $row['name'] ?></h2>
                                <div class="price">
                                    <p class="original-price"><?= $row['price'] ?> Tk</p><span class="offer-price"><?= $row['discount_price'] ?> Tk</span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


                </div>

            </div>

            <?php include 'footer.php'; ?>
        </div>

        <script src="./js/app.js"></script>
</body>

</html>