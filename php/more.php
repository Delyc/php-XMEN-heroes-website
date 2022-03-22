<?php
include('../config/dbconnect.php');
if(isset($_GET['id'])){
    $id =  mysqli_real_escape_string($conn, $_GET['id']);

    

    $sql = "SELECT * FROM heroes WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    $hero = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);

    
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/more.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>

<header>
    <nav>
        <div class="logo">
            <h4>X-MEN</h4>
        </div>


        <ul>
            <li><a href="logout.php"> Home</li></a>
            <li><a href="logout.php"> Contact us</li></a>
            <li><a href="logout.php"> Login</li></a>

        </ul>


    </nav>
</header>

<body>

   
<div>
    <?php if ($hero): ?>

        <div class="more">

        <p class=""><?php echo htmlspecialchars(($hero['id'])); ?></p>
        <h4 class=""><?php echo htmlspecialchars(($hero['heroName'])); ?></h4>


        
        <img class=" " src="img/<?php echo htmlspecialchars(($hero['heroProfile'])); ?>" alt="">
        <p class=""><?php echo htmlspecialchars(($hero['realName'])); ?></p>
        <p class=""><?php echo htmlspecialchars(($hero['shortBio'])); ?></p>
        <p class=""><?php echo htmlspecialchars(($hero['longBio'])); ?></p>


        </div>
       
    

        
       
            

     




      
    
        
    

    <?php else: ?>
        <div class="flex items-center justify-center w-screen h-screen">
        <h5 class="text-center text-white font-bold font-2xl ">
            No such hero exists
        </h5>
    </div>
        <?php endif; ?>
</div>
    

    
  
<footer class="relative bottom-0 top-10">
        <div class="parent flex  md:flex-row mb-10 mt-10 md:w-screen md:justify-evenly sm:flex-row sm:justify-evenly  lg:flex-row lg:justify-evenly">
        <div class="child1 flex-col md:w-1/4 ">
           <h3 class="font-extrabold text-white text-xl">
           X-MEN
           </h3>
           <p class="text-stone-300 font-medium ">
           simply dummy text of the printing and typesetting industry
           </p>
           <div class="flex-col w-full">
       
        <form action="" class="flex-col gap-2 mt-5"> 
            <h3 class="font-extrabold text-white text-xl">Subscribe</h4>
            <input class="text-center rounded-lg h-10 w-3/4 mt-4 mb-4" type="email" placeholder="Your email">
            <button class="subscribe text-white font-bold w-24 h-10 rounded-lg text-center send">Submit</button>
        </form>
        </div>
           <div class="media">
            <h4 class="font-extrabold text-white text-xl">Follow us</h4>

            <div class="flex gap-2 mt-3">
            <img class="social w-8" src="../assets/icons/insta.png" alt="">
            <img class="w-8 social" src="../assets/icons/youtube.png" alt="">
            <img class="w-8 social" src="../assets/icons/twitte.png" alt="">
            
            </div>
            
            
        </div>
        </div>
        

        
        <div class="child2 flex-col md:w-1/4 mt-5 ">
            <h4 class="font-extrabold text-white text-xl">Contact us</h4>
            <div class="flex-col">
            <form action="">
                <input class="text-center rounded-lg h-10 w-full mt-2 mb-2 inputname" type="text" placeholder="full name">
                <div class="flex gap-2">
                <input class="text-center rounded-lg h-10 w-2/3 mt-2 mb-2" type="text" placeholder="Phone number">
                <input class="text-center rounded-lg h-10 w-2/3 mt-2 mb-2" type="email" placeholder="email">
                </div>
                <textarea  class="text-center rounded-lg text-gray-400 font-medium w-full mt-2 mb-2" type="text" placeholder="message" name="" id="" cols="30" rows="7"> message</textarea>
                
            
                <button class="subscribe text-white font-bold w-24 h-10 rounded-lg text-center send">Send</button>
            </form>
            </div>
            
        </div>
        </div>
       
    </footer>




    
</body>
</html>
