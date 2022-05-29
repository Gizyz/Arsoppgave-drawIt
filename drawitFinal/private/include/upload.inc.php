<?php
require_once "../autoload.php";
session_start();

if(isset($_POST['submit'])) {
    echo 'submitted<br>';
    if(isset($_SESSION["url"])){
        //Getting img data and name from form 
        $imgData = $_POST['imgData'];
        $imgName = $_POST['imgName'];
        //getting user url from sessions
        $url = $_SESSION["url"];
        createImgPath($url);
        
        if(invalidUid($imgName) !== false) {
            header("location: ../../public/index.php?error=invalidName");
            exit();
        }

        //removing initial url info text from img data
        $img = str_replace('data:image/jpeg;base64,', '', $imgData);
        $img = str_replace(' ', '+', $img);
        // decoding data to jpeg file
        $data = base64_decode($img);

        $file = "../uploads/$url/$imgName.jpg";
        // Creating img file in folder
        file_put_contents($file, $data);  

        echo '<img src="'.$file.'"/>';
        //store user url and imgname
        imgUpload ($conn, $url, $imgName);
    };

};