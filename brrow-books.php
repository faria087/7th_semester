<?php
include_once 'config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user']; // User identifier (e.g., email, name)
    $status = $_POST['status'];

   
    if (!in_array($status, ['Accepted', 'Denied'])) {
        echo 'invalid_status';
        exit;
    }

    $stmt = $conn->prepare("UPDATE give SET status = ? WHERE `user-name` = ?");
    $stmt->bind_param("ss", $status, $user);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
    $conn->close();
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
                        <h3 style="color:orange;">Brrow Books</h3>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Book name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <td>QTY</td>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <?php
                    include_once 'config.php';





                    $sql = "SELECT 
                    MAX(id) AS id, 
                    `user-name`, 
                    `address`, 
                    `email`, 
                    `phone`, 
                    `date`, 
                    COALESCE(status, 'Pending') AS status,
                    GROUP_CONCAT(name SEPARATOR '<br>') AS book_names,
                    GROUP_CONCAT(CONCAT('<img src=\"', image, '\" alt=\"\" style=\"width:50px;\">') SEPARATOR '<br>') AS book_images,
                    GROUP_CONCAT(price SEPARATOR '<br>') AS prices,
                    GROUP_CONCAT(quantity SEPARATOR '<br>') AS quantities
                FROM give
                GROUP BY `user-name`, `address`, `email`, `phone`, `date`, `status`
                ORDER BY id DESC";







                    $result = mysqli_query($conn, $sql);
                    $id = 1;
                    ?>

                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= $id++ ?></td>
                                <td><?= $row['book_names'] ?></td>
                                <td><?= $row['book_images'] ?></td>
                                <td><?= $row['prices'] ?></td>
                                <td><?= $row['quantities'] ?></td>
                                <td><?= $row['user-name'] ?></td>
                                <td><?= $row['address'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['phone'] ?></td>
                                <td><?= $row['date'] ?></td>



                                <td>
                                    <?php if ($row['status'] === 'Pending') { ?>
                                        <button class="btn-accept btn btn-success" data-user="<?= $row['user-name'] ?>">Accept</button>
                                        <button class="btn-deny btn btn-danger" data-user="<?= $row['user-name'] ?>">Deny</button>
                                        <span class=" btn btn-primary">Pending</span>
                                    <?php } elseif ($row['status'] === 'Accepted') { ?>
                                        <span class="accepted-text text-success">Accepted</span>
                                    <?php } elseif ($row['status'] === 'Denied') { ?>
                                        <span class="denied-text text-danger">Denied</span>
                                        <button class="btn-accept btn btn-success" data-user="<?= $row['user-name'] ?>">Accept</button>
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
        $(document).on('click', '.btn-accept, .btn-deny', function() {
            const button = $(this);
            const user = button.data('user'); // User identifier
            const status = button.hasClass('btn-accept') ? 'Accepted' : 'Denied';

         
            const confirmMessage = status === 'Accepted' ? 'Are you sure you want to accept this request?' : 'Are you sure you want to deny this request?';

           
            if (confirm(confirmMessage)) {
                $.ajax({
                    url: 'brrow-books.php',
                    type: 'POST',
                    data: {
                        user: user,
                        status: status
                    },
                    success: function(response) {
                        if (response.trim() === 'success') {
                            const rows = $(`.row[data-user="${user}"]`);

                            rows.each(function() {
                                const row = $(this);

                                if (status === 'Accepted') {
                                    row.find('.btn-accept, .btn-deny').remove(); // Remove buttons
                                    row.find('.status').html('<span class="accepted-text text-success">Accepted</span>'); // Update status
                                } else if (status === 'Denied') {
                                    row.find('.btn-accept, .btn-deny').remove();
                                    row.find('.status').html('<span class="denied-text text-danger">Denied</span>'); // Update status
                                    row.find('.status').after('<button class="btn-accept btn btn-success" data-user="' + user + '">Accept</button>');
                                }
                            });
                        } else {
                            alert('Failed to update status. Try again.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    },
                });
            } else {
                console.log('Action cancelled');
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