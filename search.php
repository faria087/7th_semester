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
                <a href="books.php" class="about-bread__link">Books</a>
            </div>

            <div class="about-content">
                <h1 class="about-title">Book<Span>s</Span></h1>
                <p class="about-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>

            <div class="category-section">
                <div class="packages">
                    <?php
                    include_once 'config.php';
                    if (isset($_GET['search'])) {
                        $search = $_GET['search'];
                        $sql = "SELECT * FROM books WHERE name LIKE '%$search%'";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                                    <div class="package">
                                        <div class="package-img">
                                            <img src="<?= $row['image'] ?>" alt="">
                                            <div class="btn">
                                                <a href="show-book.php?id=<?= $row['id'] ?>"><i class="las la-eye"></i></a>

                                            </div>
                                        </div>
                                        <div class="package-content">
                                            <h2><?= $row['name'] ?></h2>
                                            <div class="price">
                                                <p class="original-price"><?= $row['price'] ?> Tk</p><span class="offer-price"><?= $row['discount_price'] ?> Tk</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php }?>
                            <?php } else {
                                echo "<h1>No Books Found</h1>";
                            }
                        }
                    } else {
                        $sql = "SELECT * FROM books";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="package">
                                    <div class="package-img">
                                        <img src="<?= $row['image'] ?>" alt="">
                                        <div class="btn">
                                            <a href="show-book.php?id=<?= $row['id'] ?>"><i class="las la-eye"></i></a>

                                        </div>
                                    </div>
                                    <div class="package-content">
                                        <h2><?= $row['name'] ?></h2>
                                        <div class="price">
                                            <p class="original-price"><?= $row['price'] ?> Tk</p><span class="offer-price"><?= $row['discount_price'] ?> Tk</span>
                                        </div>
                                    </div>
                                </div>
                    <?php }
                    } ?>
                    


                </div>

            </div>

            <?php include 'footer.php'; ?>
        </div>

        <script src="./js/app.js"></script>
</body>

</html>