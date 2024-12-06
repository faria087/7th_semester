<?php
include_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE checkout SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $order_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    $stmt->close();
}
?>







<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Turner</title>

    <link rel="stylesheet" href="css/style2.css">

    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Link -->


    <!-- Font Awesome Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- Font Awesome Cdn -->


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <!-- Google Fonts -->
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sideber">
        <?php include_once 'side-menu.php'; ?>
    </div>
    <div class="main-content">
        <header>
            <label for="menu-toggle" class="menu-toggler">
                <span class="las la-bars"></span>
            </label>
            <div class="search">
                <span class="las la-search"></span>
                <input type="search" placeholder="Enter Keyword">
            </div>
            <div class="head-icon">
                <span class="las la-bell"></span>
                <span class="las la-bookmark"></span>
                <span class="las la-comment"></span>
            </div>
        </header>
        <main>
            <div class="table-content">
                <div class="table-header">
                    <div class="table-btn">
                        <h3 style="color:orange;">Confirm Order</h3>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Name</th>
                            <th>Phone NO</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Source</th>
                            <th>Total Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    <?php
                    include_once 'config.php';

                    $sql = "SELECT 
            checkout.*,
            users.name AS user_name,
            users.phone AS user_phone,
            users.image AS user_image,
            users.email AS user_email
        FROM 
            checkout
        INNER JOIN 
            users 
        ON 
            checkout.user_id = users.id";

                    $result = mysqli_query($conn, $sql);
                    $id = 1;
                    ?>

<tbody>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $id++ ?></td>
        <td><?= $row['user_name'] ?></td>
        <td><?= $row['user_phone'] ?></td>
        <td><?= $row['user_email'] ?></td>
        <td>
            <img src="<?= $row['user_image'] ?>" alt="User Image" style="width: 50px; height: 50px;">
        </td>
        <td><?= $row['c_name'] ?></td>
        <td><?= $row['grand_total'] ?> /=</td>
        <td>
            <?php if ($row['status'] === 'Accepted') { ?>
                <span class=" text-success">Accepted</span>
            <?php } elseif ($row['status'] === 'Denied') { ?>
                <span class=" text-danger">Denied</span>
                <button class="btn-accept btn btn-success" data-order="<?= $row['id'] ?>">Accept</button>
            <?php } else { ?>
                <span  style="background: #0069D9;padding:10px;border-radius:3px;color:white;">Pending</span>
                <button class="btn-accept btn btn-success" data-order="<?= $row['id'] ?>">Accept</button>
                <button class="btn-deny btn btn-danger" data-order="<?= $row['id'] ?>">Deny</button>
            <?php } ?>
        </td>
    </tr>
<?php } ?>
</tbody>





                </table>
            </div>


        </main>
    </div>

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Your custom script -->
    <script>
$(document).on('click', '.btn-accept, .btn-deny', function () {
    const button = $(this);
    const order_id = button.data('order'); // Order ID
    const status = button.hasClass('btn-accept') ? 'Accepted' : 'Denied';

    const confirmMessage = status === 'Accepted' 
        ? 'Are you sure you want to accept this order?' 
        : 'Are you sure you want to deny this order?';

    if (confirm(confirmMessage)) {
        $.ajax({
            url: 'order-confirm.php',
            type: 'POST',
            data: {
                order_id: order_id,
                status: status
            },
            success: function (response) {
                if (response.trim() === 'success') {
                    const row = button.closest('tr');

                    // Update the UI for the row
                    if (status === 'Accepted') {
                        row.find('td:last-child').html('<span class="status text-success">Accepted</span>');
                    } else if (status === 'Denied') {
                        row.find('td:last-child').html(`
                            <span class="status text-danger">Denied</span>
                            <button class="btn-accept btn btn-success" data-order="${order_id}">Accept</button>
                        `);
                    }
                } else {
                    alert('Failed to update status. Please try again.');
                }
            },
            error: function (xhr, status, error) {
                alert('An error occurred: ' + error);
            }
        });
    }
});

    </script>







    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./chart.js"></script>
</body>

</html>