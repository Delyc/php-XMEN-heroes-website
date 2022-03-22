
<?php
$login = 0;
$invalid = 0;


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('../config/dbconnect.php');

    $email=$_POST['email'];
    $pass_word=$_POST['pass_word'];


    

    $sql= "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if($result){
        $num = mysqli_num_rows($result);
        if($num>0){
            $login=1;
            session_start();
            $_SESSION['email']=$email;
            if($row["usertype"] == "admin"){
                header('location:admin.php');
                
            }else{
                header('location:home.php');

            }
         


        }
        else{
            $invalid=1;

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
    <link rel="stylesheet" href="../styles/login.css">
    <title>Document</title>
</head>
<body>

   
<?php
    if($invalid){
        echo ' <div class="bg-orange-100 border-l-8 w-1/2 p-10 ml-10 animate-bounce mb-10 border-red-500 text-red-500 p-4" role="alert">
        <p class="font-bold">Login failed</p>
        <p>Invalid data, try again!</p>
    </div>';

    }
    ?>
     <?php
    if($login){
        echo ' <div class="bg-orange-100 border-l-8 w-1/2 p-10 ml-10  mb-10 border-green-500 text-green-500 p-4" role="alert">
        <p class="font-bold">Sign up success</p>
        <p>You have logged in successfully</p>
    </div>';

    }
    ?>
    
    <div class="login">
        <button class="btnback"><img src="../assets/icons/back.png" alt=""></button>

    <form class="w-full max-w-sm" action="login.php" method="POST">
  
      
  

      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"  type="email" placeholder="your email" name="email">


      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-password" type="password" placeholder="your password" name="pass_word">
 
      <button class="send shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
        Login
      </button>
      <p>already have an account? <span class="sign">sign up here</span> </p>
 
</form>

    </div>


    
</body>
</html>