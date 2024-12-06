
<?php
include_once 'config.php';

if (isset($_POST['submit'])) {
    // Escape special characters to prevent SQL syntax errors and SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $sms = mysqli_real_escape_string($conn, $_POST['sms']);


    $sql = "INSERT INTO `contact`(`name`, `email`, `sms`) VALUES ('$name', '$email', '$sms')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Message Sent Successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Message Not Sent.
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
    <link rel="stylesheet" href="./css/contact.css">
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
                <a href="contact.php" class="about-bread__link">Contact</a>
            </div>

            <div class="about-content">
                <h1 class="about-title">Contact <Span>Us</Span></h1>
                <p class="about-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>

            <div class="contact-section-main">
                <div class="contact-section">
                    <div class="contact-info">
                        <div class="contact-details">
                            <div class="contact-details-item">
                                <i class="las la-map-marker"></i>
                                <span>123 Main Street, Anytown, CA 12345 - USA</span>
                            </div>
                            <div class="contact-details-item">
                                <i class="las la-envelope"></i>
                                <span>fariya@gmail.com </span>
                            </div>
                            <div class="contact-details-item">
                                <i class="las la-phone"></i>
                                <span>+123 456 7890</span>
                            </div>
                        </div>
                    </div>

                    <div class="contact-form">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" placeholder="Enter Your Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Enter Your Email">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="sms" id="message" col="30" rows="3" placeholder="Enter Your Message"></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <?php include 'footer.php'; ?>
    </div>

    <script src="./js/app.js"></script>
</body>

</html>