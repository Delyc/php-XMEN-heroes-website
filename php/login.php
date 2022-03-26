<?php
$login = 0;
$invalid = 0;

session_start();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/dbconnect.php');

    $email = $_POST['email'];
    $pass_word = $_POST['pass_word'];
    $salt = "salt";
    $password_encrypted = sha1($pass_word.$salt);




    $sql = "SELECT * FROM user WHERE email='".$email."' and pass_word='".$password_encrypted."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            header('location:admin.php');
        
        
                $login = 1;
                session_start();
                $_SESSION['email'] = $email;
                if ($row["usertype"] == "admin") {
                    header('location:admin.php');
                } else {
                    
                    header('location:home.php');
                }
                
            }
        } else {
            echo "test";

            $invalid = 1;
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
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>
<script src="https://cdn.tailwindcss.com"></script>
<title>Document</title>
</head>

<body>


    <?php
    if ($invalid) {
        echo ' <div class="bg-white p-20 border-l-8 w-1/4 mt-10 p-10 ml-10 animate-bounce mb-10 border-red-500 rounded text-red-500 p-4" role="alert">
        <p class="font-bold text-red-500 w-full">Login failed, Invalid data try again</p>
        
    </div>';
    }
    ?>
    <?php
    if ($login) {
        echo ' <div class="bg-white border-l-8 w-1/2 p-10 ml-10  mb-10 border-green-500 text-green-500 p-4" role="alert">
        <p class="font-bold text-green-500">login success, you have logged in successfully</p>
      
    </div>';
    }
    ?>

    <div class="login">
        <?php
        if (isset($_SESSION['status'])) {
        ?>
            <div class="bg-white border-l-4 mt-10 ml-10 border-green-500 text-black font-extrabold w-1/2 p-4" role="alert">
                <p class="font-bold text-black text-green-300">success</p>
                <p class="font-bold text-black">Signed up successfully <span>Login to contnue</span></p> <?php echo $_SESSION['status']; ?>
            </div>
        <?php

            unset($_SESSION['status']);
        }
        ?>
        <button class="btnback"><a href="./home.php"><img src="../assets/icons/back.png" alt=""></a> </button>

        <form class="" action="login.php" method="POST">




            <input class="" type="email" placeholder="your email" name="email">


            <input class=" " id="inline-password" type="password" placeholder="your password" name="pass_word">

            <button class="send1" type="submit">
                Login
            </button>
            <p>already have an account? <span><a class="sign" href="./signup.php">sign up here</a> </span> </p>

        </form>

    </div>



</body>

</html>