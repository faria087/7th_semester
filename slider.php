<div class="slider">


    <div class="list">
    <?php 
                    include_once 'config.php';
                    $sql = "SELECT * FROM sliders";
                    $result = mysqli_query($conn,$sql);
                    $id = 1;
                    while ($row = mysqli_fetch_assoc($result)){
                    ?>


        <div class="item">
            <img src="<?= $row['image']?>" alt="">

            <div class="content">
                <div class="title"><?= $row['title']?></div>
                <div class="type"><?= $row['name']?></div>
                <div class="description">
                <?= $row['description']?>
                </div>
                <div class="button">
                    <button>SEE MORE</button>
                </div>
            </div>
        </div>
        

        <?php } ?>

    </div>


    <div class="thumbnail">
    <?php 
                    include_once 'config.php';
                    $sql = "SELECT * FROM sliders";
                    $result = mysqli_query($conn,$sql);
                    $id = 1;
                    while ($row = mysqli_fetch_assoc($result)){
                    ?>

    

        <div class="item">
            <img src="<?= $row['image']?>" alt="">
        </div>
        <?php } ?>

    </div>
   

    <div class="nextPrevArrows">
        <button class="prev">
            < </button>
                <button class="next"> > </button>
    </div>


</div>