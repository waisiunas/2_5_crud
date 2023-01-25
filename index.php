<?php require_once('./database/connection.php'); ?>

<?php
$sql = "SELECT * FROM `users`";
$result = $conn->query($sql);
$users = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h4>Users</h4>
                            </div>
                            <div class="col-6 text-end">
                                <a href="./add_user.php" class="btn btn-outline-primary">Add User</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($result->num_rows > 0) { ?>

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    // while ($user = $result->fetch_assoc()) { 
                                    ?>
                                    <!-- <tr>
                                            <td>1</td>
                                            <td><?php echo $user['name']; ?></td>
                                            <td><?php echo $user['email']; ?></td>
                                            <td><?php echo $user['created_at']; ?></td>
                                        </tr> -->
                                    <?php
                                    // }
                                    ?>

                                    <?php
                                    foreach ($users as $user) { ?>
                                        <tr>
                                            <td>1</td>
                                            <td><?php echo $user['name']; ?></td>
                                            <td><?php echo $user['email']; ?></td>
                                            <td><?php echo $user['created_at']; ?></td>
                                            <td>
                                                <a href="./edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">Edit</a>
                                                <a href="" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>

                        <?php
                        } else { ?>

                            <div class="alert alert-danger">No Record Found!</div>

                        <?php
                        }
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>