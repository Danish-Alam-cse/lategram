<?php
    include "config.php";
    session_start();
    $email = $_SESSION['user_email'];

    if(!$email){
        header("location: login.php");
    }
    if($_GET['edit']){
        $edit = $_GET['edit'];
        $q = mysqli_query($con,"select * from posts where post_id = '$edit'");
        $row = mysqli_fetch_array($q);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand"><?php echo $email;
 ?></a>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <a href="my_posts.php" class="btn btn-primary">My posts</a>


    <form class="d-flex" method="get">
      <input class="form-control me-2" type="search" placeholder="Search" name="search">
      <button class="btn btn-outline-success" type="submit" name="find">Search</button>
    </form>
  </div>
</nav>



<div class="container mt-3">
    <div class="row">
        <div class="col-lg-4">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Content</label>
                    <textarea name="content" id="" cols="10" rows="4" class="form-control"><?php echo $row['content'];?></textarea>
                </div>
                <button type="submit" name="update" class="btn btn-primary form-control">Submit</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>


<?php
    if(isset($_POST['update'])){
        $content = mysqli_real_escape_string($con,$_POST['content']);
        $user_id = $row['user_id'];
        //Image Work
        $img = $_FILES['image'] ['name'];
        $tmp_img = $_FILES['image'] ['tmp_name'];
        move_uploaded_file($tmp_img,"images/$img");    
        $send = mysqli_query($con,"update posts set content = '$content',user_id='$user_id',image='$img' where post_id = '$edit'");
        if($send){
            header("location: index.php");
        }
        else{
            echo "nhi hua";
        }
    }
?>