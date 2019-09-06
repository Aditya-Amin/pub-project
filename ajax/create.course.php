<?php
   include dirname(__DIR__).'/inc/Database.php';
   include dirname(__DIR__).'/inc/Session.php';
  
   Session::init();
   $ID = Session::get('id');

   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] = 'create'){
    
       $DB = new Database();
       $course_code  = $_POST['name']; 
       $course_title = $_POST['title'];
       $date = date("Y-m-d");
       date_default_timezone_set('Asia/Dhaka');
       $gmt = gmdate("Y-m-d", strtotime($date));

       $create = $DB->pdo->prepare("INSERT INTO `course_tbl` (`id`, `user_id`, `course_code`, `course_title` , `created`) VALUES (:ID, :userid, :code, :title, :date)");
       $create->bindValue(':ID', NULL);
       $create->bindValue(':userid', $ID);
       $create->bindValue(':code', $course_code);
       $create->bindValue(':title', $course_title);
       $create->bindValue(':date', $gmt);
       $result = $create->execute();
       if($result){
           echo '<span class="alert alert-success">Course has been added</span>';
       }else{
           echo '<span class="alert alert-danger">Something went wrong!</span>';
       }
   }else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
        
        $DB = new Database();
        $designation = $_POST['designation'];
        $create = $DB->pdo->prepare("UPDATE `pub_users` SET `designation` = :des WHERE `pub_users`.`id` = :ID");
        $create->bindValue(':ID', $ID);
        $create->bindValue(':des', $designation);
     
        $result = $create->execute();
        if($result){
            echo '<span class="alert alert-success">Profile Updated!</span>';
        }else{
            echo '<span class="alert alert-danger">Something went wrong!</span>';
        }
   }
?>