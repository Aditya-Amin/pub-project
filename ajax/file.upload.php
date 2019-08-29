<?php
$path = dirname(__DIR__);
include $path.'/inc/User.php';
Session::init();
$ID = Session::get('id');

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES['file']['name'] != ''){
    $user = new User();
    $movePath = dirname(__DIR__);
    $location = $movePath.'/uploads';
    $fileUpload = $user->upload_file($_FILES, $location);
   
    if($fileUpload){
        $update = $user->updateUser($fileUpload, $ID);
        if($update === true){
            echo "<img id='imgView' src='uploads/$fileUpload' class='img-thumbnail rounded-circle z-depth-1-half avatar-pic' alt='$fileUpload'>";
        }
    }
    
}