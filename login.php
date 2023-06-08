<?php
    session_start();
    include "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <h1>Login Form</h1>
<form method="post">
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <button type="submit" name="login" class="btn btn-primary">Submit</button>
            </form>
</body>
</html>

<?php
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $login = mysqli_query($con,"select * from users where email = '$email' AND password='$password'");
        $count = mysqli_num_rows($login);
        if($count > 0){
            $_SESSION['user_email'] = $email;
            header("location: index.php");
        }
        else{
            echo "login nhi hua";
        }
    }
?>