<?php

include('../config/dbconnect.php');
if(isset($_POST['updatedata'])){

    // if($_FILES["image"]["error"] == 4){
    //     echo " image does not exist";
    // }
    // else{
    //     $fileName = $_FILES["image"]["name"];
    //     $fileSize = $_FILES["image"]["size"];
    //     $tmpName = $_FILES["image"]["tmp_name"];
    //     $validImageExtension = ['jpg', 'jpeg', 'png'];
    //     $imageExtension = explode('.', $fileName);
    //     $imageExtension = strtolower(end($imageExtension));
    //     if(!in_array($imageExtension, $validImageExtension)){
    //         echo " image invalid";

    //     }
    //     else if($fileSize > 1000000){
    //         echo "too large"; }

    //     else{
    //             $newImageName = uniqid();
    //             $newImageName .= '.' . $imageExtension;
    //             move_uploaded_file($tmpName, 'img/'.$newImageName);
           
    //     }
    // }

   
    // $file = $_FILES['image']['name'];
    // print_r($file);

  
    


    $id=$_POST['id'];
    $name= $_POST['name'];
    $realName=$_POST['realName'];
    $shortBio=$_POST['shortBio'];
    $longBio=$_POST['longBio'];

    $sql = "UPDATE heroes SET  heroName='$name', realName='$realName', shortBio='$shortBio', longBio='$longBio' WHERE id=$id";

     $result = mysqli_query($conn, $sql);
     if($result){
         echo "data inserted successfully";
     }
     else{
         die(mysqli_error($conn));
     }

}


?>





