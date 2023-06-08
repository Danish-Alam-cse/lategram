<?php
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
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <button type="submit" name="signup" class="btn btn-primary">Submit</button>
            </form>
</body>
</html>

<?php
    if(isset($_POST['signup'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $signup = mysqli_query($con,"insert into users(name,email,password)values('$name','$email','$password')");
        if($signup){
            header("location: login.php");
        }
        else{
            echo "nhi hua";
        }
    }
?>