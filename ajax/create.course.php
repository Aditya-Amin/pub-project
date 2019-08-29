<?php
   include dirname(__DIR__).'/inc/Database.php';
  
  

   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] = 'create'){
       $DB = new Database();
       $course_code  = $_POST['name']; 
       $course_title = $_POST['title'];

       $create = $DB->pdo->prepare("INSERT INTO `course_tbl` (`id`, `course_code`, `course_title`) VALUES (:ID, :code, :title)");
       $create->bindValue(':ID', NULL);
       $create->bindValue(':code', $course_code);
       $create->bindValue(':title', $course_title);
       $result = $create->execute();
       if($result){
           echo '<span class="text-success">Course Listed</span>';
       }else{
           echo '<span class="text-danger">Something went wrong!</span>';
       }
   }
?>