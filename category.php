<div class="category-section">
    <h1>Categ<span>ories</span></h1>
    <div class="category">
    <?php
      include_once 'config.php';
      $sql = "SELECT * FROM categories";
      $result = mysqli_query($conn,$sql);
      while ($row = mysqli_fetch_assoc($result)){

    ?>
        <a href="category-item.php?id=<?= $row['id']?>" class="category-item">
            <img src="<?= $row['image']?>" alt="" style="width: 200px;height: 200px;">
            <h2><?= $row['name']?></h2>
        </a>
        <?php } ?>
    </div>

</div>