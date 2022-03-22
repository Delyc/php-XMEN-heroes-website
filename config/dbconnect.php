<?php

    $conn = mysqli_connect('localhost', 'delyce', 'test1234', 'hero');

    if(!$conn){
        echo 'connection failed' .mysqli_connect_error();

    }


?>