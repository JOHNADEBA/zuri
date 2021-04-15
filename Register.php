<?php

$errors = [];
$firstname = '';
$lastname = '';
$email = '';


if ($_SERVER["REQUEST_METHOD"] === 'POST') {

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];


  if (!$firstname) $errors[] = 'Enter firstname';
  if (!$lastname) $errors[] = 'Enter lastname';
  if (!$email) $errors[] = 'Enter email';
  if (!$password) $errors[] = 'Enter password';
  if (!$cpassword) $errors[] = 'Enter confirm password';
  if ($cpassword !== $password) $errors[] = 'Both password do not match';


  if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) $errors[] = "Only letters and white space allowed in FIRSTNAME";
  if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) $errors[] = "Only letters and white space allowed in LASTNAME";
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";


  $users = [
    "firstname" => $firstname,
    "lastname" => $lastname,
    "email" =>  $email,
    "password" => $password,
    "cpassword" => $cpassword

  ];


  if (!$errors) {
    $path = 'reg.json';

    file_put_contents($path, json_encode($users) . PHP_EOL, FILE_APPEND);


    header('Location: http://localhost/php-zuri/login.php');
    exit;
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
  <h1 style=" margin: 1.5rem auto; text-align: center;">Register</h1>
  <div class="card" style="width: 50rem; margin: 0 auto;">

    <form method="post" action="" style="padding: 3rem ; position: relative;">
      <a style="position: absolute; top: 0.9rem; right: 0.9rem; " href="http://localhost/php-zuri/login.php" class="btn btn-success btn-sm">Login</a>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="firstname">FirstName</label>
          <input type="text" class="form-control" id="firstname" value="<?php echo $firstname ?>" placeholder="firstname" name="firstname">
        </div>
        <div class="form-group col-md-6">
          <label for="firstname">LastName</label>
          <input type="text" class="form-control" id="lastname" value="<?php echo $lastname ?>" placeholder="lastname" name="lastname">
        </div>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" value="<?php echo $email ?>" placeholder="email" name="email">
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" placeholder="password" name="password">
        </div>
        <div class="form-group col-md-6">
          <label for="cpassword">Confirm Password</label>
          <input type="password" class="form-control" id="cpassword" placeholder="confirm password" name="cpassword">
        </div>
      </div>
      <div class="form-group">
        <a href="reset.php"> Reset Password</a>
      </div>

      <button type="submit" class="btn btn-primary">Register</button>
    </form>

  </div>

</body>

</html>