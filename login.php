
 <?php
include_once 'config.php';
session_start();
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $select = "SELECT * FROM users WHERE email = '$email'&& password = '$password'";
    $result = mysqli_query($conn, $select);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_image'] = $row['image'];
        if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            header('location:admin.php');
        }else{
            $_SESSION['user_name'] = $row['name'];
            header('location:index.php');
        }
    }else{
        $error[] = 'invalid email or password!';
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
    <link rel="stylesheet" href="./css/login.css">
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
                <a href="login.php" class="about-bread__link">Login</a>
            </div>

            <div class="about-content">
                <h1 class="about-title">Log<Span>In</Span></h1>
                <p class="about-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>

            <div class="login">
                <div class="login-form">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Enter Your Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Enter Your Password">
                        </div>
                        <div class="from-group-item">
                            <input type="checkbox" id="remember" name="remember">
                            <p>
                                Remember Me
                            </p>
                        </div>
                        <p>
                            Don't have an account? <a href="signup.php">Sign Up</a>
                        </p>
                        <button class="login-btn" name="submit">Login</button>
                    </form>
                </div>
            </div>

        </div>



        <?php include 'footer.php'; ?>
    </div>



    <script src="./js/app.js"></script>
</body>

</html>