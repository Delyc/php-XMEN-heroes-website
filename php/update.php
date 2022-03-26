<?php

session_start();

include('../config/dbconnect.php');
if(isset($_POST['updatedata'])){
    $id=$_POST['id'];
    $name= $_POST['name'];
    $realName=$_POST['realName'];
    $shortBio=$_POST['shortBio'];
    $longBio=$_POST['longBio'];

    $sql = "UPDATE heroes SET  heroName='$name', realName='$realName', shortBio='$shortBio', longBio='$longBio' WHERE id=$id";

     $result = mysqli_query($conn, $sql);
     if($result){
        $_SESSION['status'] = "Hero updated successfully";
        $_SESSION['status_code'] = "success";
        header('location:admin.php');
     }
     else{
         die(mysqli_error($conn));
     }

}


?>





