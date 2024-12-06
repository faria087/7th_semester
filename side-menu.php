<div class="brand">
    <span class="lab la-affiliatetheme"></span>
    <h3>Page Turner</h3>
</div>
<div class="sudemenu">

<!-- <?php
    session_start();
    include 'config.php';

    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $stmt = $conn->prepare("SELECT name, email, image FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
    ?>
            <div class="sideber-user">
                <div class="side-img">
                    <img src="<?= $user['image'] ?>" alt="User Image" style="text-align:center;">
                </div>
                <div class="user">
                    <small><?= $user['name'] ?></small>
                    <p><?= $user['email'] ?></p>
                </div>
            </div>
    <?php
        }
    } else {
        echo '<p>Please <a href="login.php">log in</a> to see your profile.</p>';
    }
    ?> -->
<?php
include 'config.php';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    
    // Update the query to also fetch the user type
    $stmt = $conn->prepare("SELECT name, email, image, user_type FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Check if the user is an admin
        if ($user['user_type'] == 'admin') {
    ?>
            <div class="sideber-user">
                <div class="side-img">
                    <img src="<?= $user['image'] ?>" alt="User Image" style="text-align:center;">
                </div>
                <div class="user">
                    <small><?= $user['name'] ?></small>
                    <p><?= $user['email'] ?></p>
                </div>
            </div>
    <?php
        } else {
            echo '<p>You are not an admin, so no user information will be displayed here.</p>';
        }
    }
} else {
    echo '<p>Please <a href="login.php">log in</a> to see your profile.</p>';
}
?>



    <ul>
        <li>
            <a href="./admin.php">
                <span class="las la-home"></span>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="./sliders.php" class="active">
                <span class="lab la-slideshare"></span>
                <span>Slider</span>
            </a>
        </li>

        <li>
            <a href="./categories.php">
                <span class="las la-tags"></span>
                <span>Books Category</span>
            </a>
        </li>

        <li>
            <a href="bookes.php">
                <span class="las la-book"></span>
                <span>Books</span>
            </a>
        </li>

        <li>
            <a href="./gallaries.php">
                <span class="las la-image"></span>
                <span>Gallaries</span>
            </a>
        </li>

        <li>
            <a href="./abouts.php">
                <span class="las la-user-friends"></span>
                <span>About Teams</span>
            </a>
        </li>

        <li>
            <a href="./brrow-books.php">
                <span class="las la-hand-holding-heart"></span>
                <span>Brrow Books</span>
            </a>
        </li>

        <li>
            <a href="./order-confirm.php">
                <span class="las la-cart-plus"></span>
                <span>Payment Order</span>
            </a>
        </li>

        <li>
            <a href="./logout.php">
                <span class="las la-sign-out-alt"></span>
                <span>LogOut</span>
            </a>
        </li>
    </ul>
</div>