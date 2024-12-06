<div class="category-section">
    <h1>Real Time<span> Count</span></h1>
    <div class="realtimes">
        <?php
        include 'config.php';
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        $totalUsers = mysqli_num_rows($result);
        ?>
        <div class="realtime">
            <h2>Users</h2>
            <h1 id="users">
                <?php echo $totalUsers; ?>
                 <sup>+</sup></h1>
        </div>
        <div class="realtime">
            <h2>Orders</h2>
            <h1 id="orders">0</h1>
        </div>
        <?php
        include 'config.php';
        $sql = "SELECT * FROM books";
        $result = mysqli_query($conn, $sql);
        $totalBooks = mysqli_num_rows($result);
        ?>
        <div class="realtime">
            <h2>Books</h2>
            <h1 id="products">
                <?php echo $totalBooks; ?>
                 <sup>+</sup>
            </h1>
        </div>
        <?php
        include 'config.php';
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($conn, $sql);
        $totalCategories = mysqli_num_rows($result);
        ?>
        <div class="realtime">
            <h2>Categories</h2>
            <h1 id="categories">
                <?php echo $totalCategories; ?>
                 <sup>+</sup>
            </h1>
        </div>
        <div class="realtime">
            <h2>Delivaries</h2>
            <h1>0</h1>
        </div>

        <?php
        include 'config.php';
        $sql = "SELECT * FROM brrow";
        $result = mysqli_query($conn, $sql);
        $totalBrrows = mysqli_num_rows($result);
        ?>
        <div class="realtime">
            <h2>Brrows</h2>
            <h1 id="brrows">
                <?php echo $totalBrrows; ?>
                 <sup>+</sup>
            </h1>
        </div>

    </div>

</div>