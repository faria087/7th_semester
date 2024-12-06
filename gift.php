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
                <a href="gift.php" class="about-bread__link">Gifts</a>
            </div>

            <div class="about-content">
                <h1 class="about-title">Gift<Span>s</Span></h1>
                <p class="about-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>

            <div class="cart">
                <div class="cart-table">
                    <div class="cart-header">
                        <h2>My Gifts</h2>
                        <p>3 items</p>
                    </div>
                    <div class="cart-table-item">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="cart-product">
                                            <img src="./images/book1.jpg" alt="">
                                            <div class="cart-product-info">
                                                <h3>Book Name</h3>
                                                <p>Author Name</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$20.00</td>
                                    <td>
                                        <input type="number" value="1">
                                    </td>
                                    <td>$20.00</td>
                                    <td>
                                        <button class="cart-remove">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="cart-product">
                                            <img src="./images/book2.jpg" alt="">
                                            <div class="cart-product-info">
                                                <h3>Book Name</h3>
                                                <p>Author Name</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$20.00</td>
                                    <td>
                                        <input type="number" value="1">
                                    </td>
                                    <td>$20.00</td>
                                    <td>
                                        <button class="cart-remove">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="cart-product">
                                            <img src="./images/book3.jpg" alt="">
                                            <div class="cart-product-info">
                                                <h3>Book Name</h3>
                                                <p>Author Name</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$20.00</td>
                                    <td>
                                        <input type="number" value="1">
                                    </td>
                                    <td>$20.00</td>
                                    <td>
                                        <button class="cart-remove">
                                            <i class="las la-trash"></i>
                                        </button>
                                    </td>
                                </tr>
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
                    <div class="cart-summary-item">
                        <p>Total item price</p>
                        <p>$60.00</p>
                    </div>
                    <div class="cart-summary-items">
                        <p>Shipping</p>
                        <select>
                            <option value="standard">Standard Delivary $5.00</option>
                            <option value="express">Express Delivary $10.00</option>
                        </select>
                    </div>
                    <div class="cart-summary-item" style="border-top: 2px solid orange;">
                        <p>Total</p>
                        <p>$65.00</p>
                    </div>
                    <div class="cart-summary-footer">
                        <a href="checkout.php">CheckOut</a>
                    </div>
                </div>
            </div>

        </div>



        <?php include 'footer.php'; ?>
    </div>



    <script src="./js/app.js"></script>
</body>

</html>