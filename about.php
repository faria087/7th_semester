<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/about.css">
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
                <a href="about.php" class="about-bread__link">About</a>
            </div>

            <div class="about-content">
                <h1 class="about-title">About <Span>Us</Span></h1>
                <p class="about-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>

            <div class="about-team">
                <h2 class="about-team-title">Our Team</h2>
                <div class="about-team-members">
                    <?php
                     include_once 'config.php';
                     $sql = "SELECT * FROM abouts";
                     $result = mysqli_query($conn,$sql);
                     $id = 1;
                     while ($row = mysqli_fetch_assoc($result)){
                     ?>
                    <div class="about-team-member">
                        <img src="<?= $row['image']?>" alt="Team Member 1" class="about-team-member-image">
                        <h3 class="about-team-member-name"><?= $row['name']?></h3>
                        <p class="about-team-member-role"><?= $row['designation']?></p>
                    </div>
                    <?php } ?>
                </div>
            </div>

        </div>
        
        <?php include 'footer.php'; ?>
    </div>

    <script src="./js/app.js"></script>
</body>

</html>