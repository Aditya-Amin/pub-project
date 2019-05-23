<?php
    header("Content-Type: application/json; charset=UTF-8");
    $path = realpath(dirname(__FILE__));
    include 'User.php';
    $user = new User();
    $data = json_decode($_POST["data"],false);

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($data->register)){
        $usrReg = $user->userRegister($data);
        echo $usrReg;
    }

?>
