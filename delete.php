<?php
include "config.php";
    session_start();
    $email = $_SESSION['user_email'];
    if(!$email){
        header("location: login.php");
    }
    if(isset($_GET['del'])){
        $del = $_GET['del'];
        $q = mysqli_query($con,"delete from posts where post_id='$del'");
        if($q){
            header("location: my_posts.php");
        }      
        else{
            echo "nhi hua";
        }  
    }
    ?>
