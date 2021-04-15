<?php

$errors = [];
$email = '';
$password = '';
$json = [];

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];


    if (!$email) $errors[] = 'Enter a valid email';
    if (!$password) $errors[] = 'Enter a valid password';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";


    $users = [
        "email" =>  $email,
        "password" => $password
    ];

    if (!$errors) {

        $data = file_get_contents("reg.json");
        $json = json_decode($data, true);
        foreach ($json as $key => $value) {
            if ($value['email'] == $email) {
                $value[$key]['password'] = $password;
                header('Location: http://localhost/php-zuri/home.php');
                exit;
            } else {
                $errors[] = 'Credentials dont match';
                header('Location: http://localhost/php-zuri/reset.php');
                exit;
            }
        }
        file_put_contents('reg.json', json_encode($json));
    }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php foreach ($errors as $error) : ?>
        <ul>
            <li style="color: red;"><?= $error ?></li>
        </ul>
    <?php endforeach; ?>


    <h1 style=" margin: 1.5rem auto; text-align: center;">Reset Password</h1>
    <div class="card" style="width: 50rem; margin: 0 auto;">
        <form method="post" action="" style="padding: 3rem ; position: relative;">
            <a style="position: absolute; top: 0.9rem; right: 0.9rem; " href="http://localhost/php-zuri/register.php" class="btn btn-success btn-sm">Register</a>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="email" value="<?php echo $email ?>" name="email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="password" name="password">
            </div>


            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>

</html>