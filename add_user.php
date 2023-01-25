<?php require_once('./database/connection.php'); ?>

<?php
$error = $success = $name = $email = '';

if (isset($_POST['submit'])) {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $c_password = htmlspecialchars($_POST['cPassword']);

    if (empty($name)) {
        $error = 'Please Provide your Name!';
    } elseif (empty($email)) {
        $error = 'Please Provide your Email!';
    } elseif (empty($password)) {
        $error = 'Please Provide your password!';
    } elseif ($password != $c_password) {
        $error = 'Password does not match!';
    } elseif (strlen($password) < 5) {
        $error = 'Password minimum length is 5!';
    } else {

        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $error = "Email alreday exists!";
        } else {
            $encrypted_password = sha1($password);
            $sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name','$email','$encrypted_password')";

            if ($conn->query($sql)) {
                $success = "Magic has been spelled";
                $name = $email = '';
            } else {
                $error = "Magic has failed to spell";
            }
        }

        // echo '<pre>';
        // print_r($result);
        // echo '</pre>';


        // echo $sql;
        // 
    }
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
}
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
                                <h4>Add User</h4>
                            </div>
                            <div class="col-6 text-end">
                                <a href="./index.php" class="btn btn-outline-primary">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (!empty($error)) {
                        ?>
                            <div class="text-danger"><?php echo $error; ?></div>
                        <?php
                        }

                        if (!empty($success)) { ?>
                            <div class="text-success"><?php echo $success; ?></div>
                        <?php
                        }
                        ?>

                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your name!">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>" placeholder="Enter your email!">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password!">
                            </div>

                            <div class="mb-3">
                                <label for="cPassword" class="form-label">Confirm Password</label>
                                <input type="password" name="cPassword" id="cPassword" class="form-control" placeholder="Please confirm your Password!">
                            </div>

                            <div>
                                <input type="submit" class="btn btn-primary" name="submit">
                                <input type="reset" class="btn btn-dark">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>