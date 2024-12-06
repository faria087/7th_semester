<div class="category-section">
    <h1>Image<span>s</span></h1>
    <div class="images">
    <?php
    include_once 'config.php';
    $sql = "SELECT * FROM gallaries";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="image">
            <img src="<?= $row['image']?>" alt="">
            <h2> <?= $row['name']?></h2>
        </div>
        <?php } ?>
    </div>

</div>