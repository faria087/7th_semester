<!-- 

<?php 
include_once 'config.php';
session_start();
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $user_type = $_POST['user_type'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $image = $_FILES['image'];
    $img_loc = $_FILES['image']['tmp_name'];
    $img_name = $_FILES['image']['name'];
    $path = "uploads/" . $img_name;
    move_uploaded_file($img_loc, $path);

    $select = "SELECT * FROM users WHERE email = '$email'&& password = '$password'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($password != $cpassword){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO users (name, email, phone, image, password, user_type) VALUES ('$name', '$email', '$phone', '$path', '$password', '$user_type')";
         mysqli_query($conn, $insert);
         header('location:login.php');
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
                <a href="signup.php" class="about-bread__link">Signup</a>
            </div>

            <div class="about-content">
                <h1 class="about-title">Sign<Span>Up</Span></h1>
                <p class="about-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>

            <div class="login">
                <div class="login-form">
                    <form action=""  method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" placeholder="Enter Your Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Enter Your Email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone No</label>
                            <input type="number" name="phone" placeholder="Enter Your Phone No">
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" placeholder="Enter Your Password">
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Confirm Password</label>
                            <input type="password" name="cpassword" placeholder="Enter Your Password Again">
                        </div>
                        <div class="form-group">
                                <label for="user-type">User Type</label>
                                <select name="user_type" >
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                        </div>
                        <p>
                            I have an account <a href="login.php">Login</a>
                        </p>
                        <button class="login-btn" name="submit">SignUp</button>
                    </form>
                </div>
            </div>

        </div>



        <?php include 'footer.php'; ?>
    </div>



    <script src="./js/app.js"></script>
</body>

</html> -->

<?php 
include_once 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $user_type = $_POST['user_type'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    // Initialize file variables
    $path = "";
    $error = [];

    // Check if the image file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $targetDir = "uploads/";
        $img_name = basename($_FILES['image']['name']);
        $path = $targetDir . $img_name;
        $imageFileType = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        // Validate file type
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedTypes)) {
            $error[] = "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        }

        // Validate file size (limit: 5MB)
        if ($_FILES['image']['size'] > 5000000) {
            $error[] = "File size exceeds the limit of 5MB.";
        }

        // Move file to target directory
        if (empty($error)) {
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                $error[] = "Image upload failed.";
            }
        }
    } else {
        $error[] = "No file uploaded or file upload error.";
    }

    // Check for other errors
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'")) > 0) {
        $error[] = "User already exists!";
    } elseif ($password !== $cpassword) {
        $error[] = "Passwords do not match!";
    }

    // If no errors, insert data into the database
    if (empty($error)) {
        $insert = "INSERT INTO users (name, email, phone, image, password, user_type) 
                   VALUES ('$name', '$email', '$phone', '$path', '$password', '$user_type')";

        if (mysqli_query($conn, $insert)) {
            header('Location: login.php');
        } else {
            $error[] = "Failed to register user.";
        }
    }

    // Display errors if any
    if (!empty($error)) {
        foreach ($error as $err) {
            echo "<p style='color: red;'>$err</p>";
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
                <a href="signup.php" class="about-bread__link">Signup</a>
            </div>

            <div class="about-content">
                <h1 class="about-title">Sign<Span>Up</Span></h1>
                <p class="about-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>

            <div class="login">
                <div class="login-form">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" placeholder="Enter Your Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Enter Your Email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone No</label>
                            <input type="number" name="phone" placeholder="Enter Your Phone No" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" placeholder="Enter Your Password" required>
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Confirm Password</label>
                            <input type="password" name="cpassword" placeholder="Enter Your Password Again" required>
                        </div>
                        <div class="form-group">
                            <label for="user-type">User Type</label>
                            <select name="user_type" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <p>
                            I have an account <a href="login.php">Login</a>
                        </p>
                        <button class="login-btn" name="submit">SignUp</button>
                    </form>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>

    <script src="./js/app.js"></script>
</body>
</html>
