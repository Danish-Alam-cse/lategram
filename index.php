<?php
    include "config.php";
    session_start();
    $email = $_SESSION['user_email'];
    if(!$email){
        header("location: login.php");
    }
    $q = mysqli_query($con,"select * from users where email ='$email'");
    $row = mysqli_fetch_array($q);
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
    <a class="navbar-brand"><?php echo $row['name'];
 ?></a>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <a href="my_posts.php" class="btn btn-primary">My posts</a>
    <a href="profile.php" class="btn btn-primary">Profile</a>


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
                    <textarea name="content" id="" cols="10" rows="4" class="form-control"></textarea>
                </div>
                <button type="submit" name="send" class="btn btn-primary form-control">Submit</button>
            </form>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <?php 
                if(isset($_GET['find'])){
                    $search = $_GET['search'];
                    $fetch = mysqli_query($con,"select users.name,posts.content,posts.post_time,posts.image,posts.post_id from users join posts on users.id = posts.user_id where posts.content like '%$search%'");
                }
                else{
                $fetch = mysqli_query($con,"select users.name,posts.content,posts.post_time,posts.image,posts.post_id from users join posts on users.id = posts.user_id");
                }
                while($rows=mysqli_fetch_array($fetch)){?>
                <div class="col-lg-4 mb-2">
                    <div class="card" style="height:420px">
                            <img src="images/<?php echo $rows['image'];?>" alt="" class="card-img-top" height="200px">
                        <div class="card-body">
                            <p class="card-title">Wriiten by :-<?php echo $rows['name'];?></p>
                            <p class="card-text"><?php echo $rows['content'];?></p>
                            <p><?php echo $rows['post_time'];?></p>
                        </div>
                        <div class="card-footer">
                            <a href="desc.php?more=<?= $rows['post_id'];?>" class="btn btn-success">Read More</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>


<?php
    if(isset($_POST['send'])){
        $content = mysqli_real_escape_string($con,$_POST['content']);
        $user_id = $row['id'];
        //Image Work
        $img = $_FILES['image'] ['name'];
        $tmp_img = $_FILES['image'] ['tmp_name'];
        move_uploaded_file($tmp_img,"images/$img");    
        $send = mysqli_query($con,"insert into posts(content,user_id,image)values('$content','$user_id','$img')");
        if($send){
            header("location: index.php");
        }
        else{
            echo "nhi hua";
        }
    }
?>