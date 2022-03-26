<?php
session_start();

include('../config/dbconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // if (isset($_POST['submit'])) {
    if (empty($_POST['name'])) {
        $name_error = "required";
    }
    if (empty($_POST['realName'])) {
        echo 'required';
    }
    if (empty($_POST['shortBio'])) {
        echo 'required';
    }
    if (empty($_POST['longBio'])) {
        echo 'required';
    }


    if ($_FILES["image"]["error"] == 4) {
        echo " image does not exist";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo " image invalid";
        } else if ($fileSize > 1000000) {
            echo "too large";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;
            move_uploaded_file($tmpName, 'img/' . $newImageName);
        }
    }


    $file = $_FILES['image']['name'];
    print_r($file);






    $name = $_POST['name'];
    $realName = $_POST['realName'];
    $shortBio = $_POST['shortBio'];
    $longBio = $_POST['longBio'];

    $sql = "INSERT INTO heroes (heroName, heroProfile, realName, shortBio, longBio)
     VALUES ('$name', '$newImageName', '$realName', '$shortBio','$longBio')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['status'] = "Hero inserted successfully";
        $_SESSION['status_code'] = "success";
    } else {
        die(mysqli_error($conn));
    }
}
// }


?>











<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../styles/main.css"> -->
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/footerres.css">

    <!-- <link href="https://unpkg.com/tailwindcss@^2.2.7/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn-tailwindcss.vercel.app/"></script> -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<header>
    <ul>
        <li>login</li>
        <li>Contact us</li>
    </ul>
</header>



<body class="">

    <!-- ================================================more Modal =============================================================-->
    <div class="modal fade" id="hero_moreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Add a hero</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body-add">


                    <!-- =========================modal body(form)================================ -->

                    <form class=" form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">

                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input class=" image" id="inline-full-name" type="file" placeholder="Hero's name" name="image"></span>
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">

                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" placeholder="Hero's name" name="name">
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">

                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" placeholder="Hero's real name" name="realName">
                            </div>
                        </div>

                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">

                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" placeholder="Hero's short bio" name="shortBio" id="" rows="3"></textarea>

                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">

                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" placeholder="Hero's long bio" name="longBio" id="" rows="5"></textarea>

                            </div>
                        </div>

                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3"></div>
                            <div class="md:w-2/3">
                                <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded add" type="submit" name="submit">
                                    Add Hero
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!--===================== end of add modal ========================= -->



    <!-- ================================================edit Modal =============================================================-->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Add a hero</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <!-- =========================modal body(form)================================ -->


                    <form class="w-full max-w-sm form" action="update.php" method="post" enctype="multipart/form-data">
                        <div class="md:flex md:items-center mb-6">
                            <input type="hidden" name="id" id="id">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">

                                </label>
                            </div>

                            <div class="md:w-2/3">
                                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" value="hi test me" placeholder="Hero's name" name="image" id="image">
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">

                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" placeholder="Hero's name" name="name" id="name">
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">

                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" placeholder="Hero's real name" name="realName" id="realName">
                            </div>
                        </div>

                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">

                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" placeholder="Hero's short bio" name="shortBio" id="shortBio" cols="" rows="3"></textarea>

                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">

                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" placeholder="Hero's long bio" name="longBio" id="longBio" cols="" rows="5"></textarea>

                            </div>
                        </div>

                        <input type="hidden" name="addedAt" id="addedAt">

                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3"></div>
                            <div class="buttonupdate">
                                <button data-dismiss="modal" class="cancel flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit" name="updatedata">
                                    cancel
                                </button>
                                <button class="update flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit" name="updatedata">
                                    update
                                </button>


                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!--===================== end of edit modal ========================= -->





    <!-- ================================================edit Modal =============================================================-->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Add a hero</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <!-- =========================modal body(form)================================ -->


                    <form class="w-full max-w-sm form" action="update.php" method="post" enctype="multipart/form-data">
                        <div class="md:flex md:items-center mb-6">
                            <input type="hidden" name="id" id="id">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">

                                </label>
                            </div>

                            <div class="md:w-2/3">
                                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" value="hi test me" placeholder="Hero's name" name="image" id="image">
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">

                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" placeholder="Hero's name" name="name" id="name">
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">

                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" placeholder="Hero's real name" name="realName" id="realName">
                            </div>
                        </div>

                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">

                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" placeholder="Hero's short bio" name="shortBio" id="shortBio" cols="" rows="3"></textarea>

                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">

                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" placeholder="Hero's long bio" name="longBio" id="longBio" cols="" rows="5"></textarea>

                            </div>
                        </div>

                        <input type="hidden" name="addedAt" id="addedAt">

                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3"></div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!--===================== end of more modal ========================= -->


    <!-- ================================================delete Modal =============================================================-->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>delete</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <!-- =========================modal body(form)================================ -->

                    <form class="w-full max-w-sm" action="delete.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="deleteid" id="deleteid">
                        <p>are you sure you want to delete this hero</p>
                        <button type="submit" class="delete text-black rounded text-white" name="deletedata">
                            delete
                        </button>
                        <button type="button" class="canceldelete rounded text-white" data-dismiss="modal">cancel</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!--===================== end of delete modal ========================= -->


    <!-- ====================actual body content============== -->

    <div class="section-hero">
        <h3 class="text-center">Admin page</h3>
        <div class="addbutton">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hero_moreModal">
                Add Hero
            </button>
           
        </div>
        <!--  -->


        <!-- ====================================fetching =====================-->











        <?php

        $sql = "SELECT * FROM heroes";
        $result = mysqli_query($conn, $sql);
        ?>
        <div class="table">
            <table id="heroTable">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">profile</th>
                        <th scope="col">name</th>

                        <th scope="col">Real name</th>
                        <th scope="col">ahsort bio</th>
                        <th scope="col">long bio</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <?php
                if ($result) {
                    foreach ($result as $row) {
                ?>
                        <tbody>
                            <tr>
                                <td class="id"><?php echo $row['id'] ?></td>
                                <td class="">
                                    <img class="imghero" src="<?php echo "img/" . $row['heroProfile'] ?>" alt="">
                                </td>
                                <td><?php echo $row['heroName'] ?></td>

                                <td><?php echo $row['realName'] ?></td>
                                <td><?php echo $row['shortBio'] ?></td>
                                <td class="long"><?php echo $row['longBio'] ?></td>

                                <td class="buttons">
                                    <button class="editbtn flex items-center justify-center" type="button"><img class="imgicon" src="../assets/icons/edit.png" alt=""></button>
                                    <button class="deletebtn flex items-center justify-center" type="submit"><img src="../assets/icons/del.png" alt=""></button>
                                </td>
                            </tr>

                        </tbody>
                <?php
                    }
                } else {
                    echo "no record found";
                }
                ?>
            </table>











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
                            <textarea class="text-center rounded-lg text-gray-400 font-medium w-full mt-2 mb-2" type="text" placeholder="message" name="" id="" cols="30" rows="7"> message</textarea>


                            <button class="subscribe text-white font-bold w-24 h-10 rounded-lg text-center send">Send</button>
                        </form>
                    </div>

                </div>
            </div>

        </footer>






        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js" integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
        <script src="../script/sweetalert.min.js"></script>
        <script src="../script/dataTables.js"></script>

        <script src="../script/updateModal.js"></script>
        <script src="../script/deleteModal.js"></script>
        
             <?php
            if (isset($_SESSION['status'])) {

            ?>
            <script>
               swal({
                title: "Success!",
                icon: "success",
                button: "close!",
            });
               
        </script>
               
            <?php
                unset($_SESSION['status']);
            }
            ?>
      



        <!-- <script src="../script/burger.js"></script> -->


</body>

</html>