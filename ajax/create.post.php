<?php

include dirname(__DIR__).'/inc/User.php';

Session::init();
$ID = Session::get('id');

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES['file']['name'] != '' && isset($_POST['post']) && $_POST['post'] = 'post'){
    $DB = new Database();
    $user = new User();
    $contents = $_POST['contents'];
    $code = $_POST['code'];
    $movePath = dirname(__DIR__);
    $location = $movePath.'/uploads';
    $fileUpload = $user->upload_file($_FILES, $location);
    $date = date("Y-m-d H:i:s");
    date_default_timezone_set('Asia/Dhaka');
    $gmt = gmdate("Y-m-d H:i:s", strtotime($date));
    

    $create = $DB->pdo->prepare("INSERT INTO `course_timeline` (`id`, `course_code`, `user_id`, `post_content`, `attach_file`, `date`) VALUES (:id, :code, :user_id, :contents, :file, :date)");
    $create->bindValue(':id', NULL);
    $create->bindValue(':code', $code);
    $create->bindValue(':user_id', $ID);
    $create->bindValue(':contents', $contents);
    $create->bindValue(':file', $fileUpload);
    $create->bindValue(':date', $gmt);
    $result = $create->execute();
    if($result){
        echo '<span class="text-success">Contents Added</span>';
    }else{
        echo '<span class="text-danger">Something went wrong!</span>';
        unlink($location.'/'.$fileUpload);
    }
}