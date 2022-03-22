
<?php
$success = 0;
$user = 0;


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
    $username=$_POST['username'];
    $email=$_POST['email'];
    $pass_word=$_POST['pass_word'];
    $hashed_password = password_hash($pass_word, PASSWORD_DEFAULT);
    // $file = $_FILES['image'];
    // $fileName = $file["name"];
    // $fileType = $file["type"];
    // $fileTempName = $file["tmp_name"];
    // $fileError = $file["error"];
    // $fileSize = $file["size"];

    // $fileExt = explode(".", $fileName);
    // $fileActualExt = strtolower(end($fileExt));
    // $allowed = array("jpg", "jpeg", "png");
    // if(in_array($fileActualExt, $allowed)){
    //     if($fileError === 0){
    //         if($fileSize > 2000000){
                

    //         }else{
    //             echo "too big error";
    //             exit();
                
    //         }

    //     }else{
    //         echo "error";
    //     exit();
    //     }
       

    // }else{
    //     echo "error";
    //     exit();
    // }


    

    $sql= "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if($result){
        $num = mysqli_num_rows($result);
        if($num>0){
            $user =1;
        }
        else{
    $sql = "INSERT INTO user(username, email, pass_word) VALUES ('$username', '$email', '$hashed_password')";
    $result = mysqli_query($conn, $sql);
    if($result){
        $success=1;
        header('location:login.php');
    } else{
        die(mysqli_error($conn));
    }

        }
    }
}






?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/signup.css">
    <title>Document</title>
</head>
<body>
<?php
    if($user){
        echo ' <div class="bg-orange-100 border-l-8 w-1/2 p-10 ml-10 animate-bounce mb-10 border-red-500 text-red-500 p-4" role="alert">
        <p class="font-bold">Sign up failed</p>
        <p>User with this email already exist, try again!</p>
    </div>';

    }
    ?>
     <?php
    if($success){
        echo ' <div class="bg-orange-100 border-l-8 w-1/2 p-10 ml-10  mb-10 border-green-500 text-green-500 p-4" role="alert">
        <p class="font-bold">Sign up success</p>
        <p>You have signed up successfully</p>
    </div>';

    }
    ?>
    

    <div>
    <button class="btnback"><img src="../assets/icons/back.png" alt=""></button>

    <form class="w-full max-w-sm" action="signup.php" method="POST">




 






      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" placeholder="your user name" name="username">
   
  
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"  type="email" placeholder="your email" name="email">
 
 
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-password" type="password" placeholder="your password" name="pass_word">
  
 
 
      <button class="send shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
        Sign Up
      </button>
   
</form>

    </div>


    
</body>
</html>

    
    
 

