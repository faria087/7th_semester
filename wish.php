<?php 
include_once 'config.php';
$sql = "SELECT * FROM wishlist";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $remove_sql = "DELETE FROM wishlist WHERE id='$remove_id'";
    $remove_result = mysqli_query($conn, $remove_sql);
    if ($remove_result) {
        header('location:wish.php');
    } else {
        echo "<script>alert('Book not removed')</script>";
    }
} 
if (isset($_POST['submit2'])) {
    if (!empty($_POST['book_id']) && !empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['discount_price']) && !empty($_POST['image'])) {
        $book_id = $_POST['book_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $discount_price = $_POST['discount_price'];
        $image = $_POST['image'];
        $product_quantity = 1;
        $select_sql = "SELECT * FROM cart WHERE name = '$name'";
        $select_result = mysqli_query($conn, $select_sql);
        $select_count = mysqli_num_rows($select_result);

        if($select_count > 0){
            echo "<script>alert('Product Already Added')</script>";
            echo "<script>window.location.href = 'cart.php'</script>";
        }else{
            $sql = "INSERT INTO cart (book_id,name, price,discount_price, image, quantity) VALUES ('$book_id','$name', '$price','$discount_price', '$image', '$product_quantity')";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo "<script>alert('Product Added Successfully')</script>";
                echo "<script>window.location.href = 'cart.php'</script>";
            }else{
                echo "<script>alert('Product Added Failed')</script>";
                echo "<script>window.location.href = 'cart.php'</script>";
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
    <link rel="stylesheet" href="./css/wish.css">
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
                <a href="wish.php" class="about-bread__link">Wish</a>
            </div>

            <div class="about-content">
                <h1 class="about-title">My<Span>Wishes</Span></h1>
                <p class="about-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>

            <div class="wish">
                <div class="wish-table">
                    <div class="wish-header">
                        <h2>Wish List</h2>
                        <p><?php echo $count; ?> items</p>
                    </div>
                    <div class="wish-table-item">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Discount Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include_once 'config.php';
                                    $sql = "SELECT * FROM wishlist";
                                    $result = mysqli_query($conn,$sql);
                                   
                                    $id = 1;
                                    while($row = mysqli_fetch_assoc($result)){
                                ?> 
                                <tr>
                                    <td><?= $row['name']?></td>
                                    <td>
                                        <img src="<?= $row['image']?>" alt="">
                                    </td>
                                    <td><?= $row['price']?> /=</td>
                                    <td><?= $row['discount_price']?> /=</td>
                                    
                                    <td>
                                     <form action="" method="POST" enctype="multipart/form-data" style="display: flex;justify-content:center;align-items:center;gap:15px;">
                                     <input type="hidden" name="update_quantity_id" value="<?= $row['id'] ?>">
                                     <input type="hidden" name="book_id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="name" value="<?= $row['name'] ?>">
                                        <input type="hidden" name="price" value="<?= $row['price'] ?>">
                                        <input type="hidden" name="discount_price" value="<?= $row['discount_price'] ?>">
                                        <input type="hidden" name="image" value="<?= $row['image'] ?>">
                                        <button name="submit2" type="submit">
                                            <i class="las la-shopping-cart"></i>
                                        </button>
                                        <a href="wish.php?remove=<?= $row['id'] ?>" onclick="return confirm('are you sure you want to delete this product?');"><i class="las la-trash"></i></a>
                                     </form>
                                       
                                            
                                       
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <div class="wish-footer">
                            <a href="books.php">Back To Shop</a>
                            <button class="wish-update">Update Wish List</button>
                        </div>

                    </div>
                </div>

            </div>

        </div>



        <?php include 'footer.php'; ?>
    </div>



    <script src="./js/app.js"></script>
</body>

</html>