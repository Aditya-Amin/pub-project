<?php

   include_once 'Session.php';
   include 'Database.php';

   class User{
       private $db;

       public function __construct(){
           $this->db = new Database();
       }

       public function userRegister($arr){
           $access  = $arr->access;
           $name  = $arr->userName;
           $email = $arr->userEmail;
           $pass  = $arr->userPass;
           $confirmPass = $arr->userConfirmPass;
           $chkToken = $this->checkToken($access);
           $chkUserName = $this->checkUserName($name);
           $chkUserEmail = $this->checkUserEmail($email);

           if( $access == '' || $name == '' || $email == '' || $pass == '' || $confirmPass == ''){
               $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Field Must Not Be Empty!</span>";
               return $errMsg; 
           }
           if($chkToken == false){
            $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>You are not allowed to register!</span>";
            return $errMsg; 
           }
           if($chkUserName == true){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Username Already Exist!</span>";
                return $errMsg; 
           }
           
           if( strlen($name) < 3){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Username 3 characters Need!</span>";
                return $errMsg; 
           }
           if($chkUserEmail == true){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Email Already Exist!</span>";
                return $errMsg; 
            }
           if( !preg_match('/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/i',$email)){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Invalid Email!</span>";
                return $errMsg; 
           }
           if( $pass != $confirmPass){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Password not match!</span>";
                return $errMsg;
           }
           $pass = md5($confirmPass);
           $insert = "INSERT INTO pub_users(username, useremail,userpass) VALUES(:name,:email,:pass)";

           $query = $this->db->pdo->prepare($insert);
           $query->bindValue(':name', $name);
           $query->bindValue(':email', $email);
           $query->bindValue(':pass', $pass);
           $result = $query->execute();
           if($result){
               $errMsg =  "<span class='alert alert-success'><strong>Success:</strong>Registration Successfull.</span>";
               return $errMsg;
           }else{
               $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Can't Register Now.</span>";
               return $errMsg;
           }

       }

       public function checkToken($name){
        $userName = "SELECT * FROM `access_token` WHERE `access_token` = :name LIMIT 1";
        $query =  $this->db->pdo->prepare($userName);
        $query->bindValue(':name', $name);
        $query->execute();
        if( $query->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    } 
       public function checkUserName($name){
           $userName = "SELECT * FROM `pub_users` WHERE `username` = :name LIMIT 1";
           $query =  $this->db->pdo->prepare($userName);
           $query->bindValue(':name', $name);
           $query->execute();
           if( $query->rowCount() > 0){
               return true;
           }else{
               return false;
           }
       }

       public function delete($tbl, $field, $data){
        $delete = "DELETE FROM $tbl WHERE $field = :data";
        $query =  $this->db->pdo->prepare($delete);
        $query->bindValue(':data', $data);
        $query->execute();
        if( $query->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

       public function checkUserEmail($email){
            $useremail= "SELECT * FROM `pub_users` WHERE `useremail`= :email LIMIT 1";
            $query =  $this->db->pdo->prepare($useremail);
            $query->bindValue(':email', $email);
            $query->execute();
            if( $query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
      }

      public function userLogin($arr){
            $email = $arr['userlogEmail'];
            $pass  = $arr['userlogPass'];
            $md5    = md5($pass);
            $chkUserEmail = $this->checkUserEmail($email);
            $chkUserPass  = $this->checkUserPass($md5);
           

            if($email == '' || $pass == ''){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Field Must Not Be Empty!</span>";
                return $errMsg; 
            }
            if($chkUserEmail == false){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Wrong Email!</span>";
                return $errMsg; 
            }
            if($chkUserPass == false){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Wrong password!</span>";
                return $errMsg; 
            }
          
            $userLogin = $this->getUserLogin($email,$md5);
            if($userLogin){
                Session::init();
                Session::set('login',true);
                Session::set('id', $userLogin->id);
                Session::set('name', $userLogin->username);
                Session::set('email', $userLogin->useremail);
                header("Location:profile.php"); 
            }else{
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>login can't possible!</span>";
                return $errMsg; 
            }

            
      }

      public function checkUserPass($pass){
            $userPass = "SELECT userpass FROM pub_users WHERE userpass = :pass";
            $query =  $this->db->pdo->prepare($userPass);
            $query->bindValue(':pass', $pass);
            $query->execute();
            if( $query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
      }

      public function getUserLogin($email,$pass){
          $select = "SELECT * FROM pub_users WHERE useremail = :email AND userpass = :pass LIMIT 1";
          $query = $this->db->pdo->prepare($select);
          $query->bindValue(':email', $email);
          $query->bindValue(':pass', $pass);
          $query->execute();
          $result = $query->fetch(PDO::FETCH_OBJ);
          return $result;
      }

      public function getAllCourse($id){
          $courses = $this->db->pdo->prepare("SELECT * FROM `course_tbl` WHERE `user_id` = :ID");
          $courses->bindValue(':ID',$id);
          $courses->execute();
          $result = $courses->fetchAll();
          if(empty($result)){
              return false;
          }else{
              return $result;
          }
      }

      public function getPages($id, $code, $shift){
          $courses = $this->db->pdo->prepare("SELECT * FROM `course_timeline` WHERE `course_code` = :code AND `user_id` = :ID AND `shift` = :shift");
          $courses->bindValue(':code',$code);
          $courses->bindValue(':ID',$id);
          $courses->bindValue(':shift',$shift);
         
          $courses->execute();
          $result = $courses->rowCount();
          if(empty($result)){
              return false;
          }else{
              return $result;
          }
      }

      public function getPagesBy($id, $code){
        $courses = $this->db->pdo->prepare("SELECT * FROM `course_timeline` WHERE `course_code` = :code AND `user_id` = :ID");
        $courses->bindValue(':code',$code);
        $courses->bindValue(':ID',$id);
      
       
        $courses->execute();
        $result = $courses->rowCount();
        if(empty($result)){
            return false;
        }else{
            return $result;
        }
    }

      public function getuserInfo($id){
        $courses = $this->db->pdo->prepare("SELECT * FROM `pub_users` WHERE id = :ID");
        $courses->bindValue(':ID',$id);
        $courses->execute();
        $result = $courses->fetchAll();
        if(empty($result)){
            return false;
        }else{
            return $result;
        }
    }

    public function getAllUser(){
        $courses = $this->db->pdo->prepare("SELECT * FROM `pub_users`");
        $courses->execute();
        $result = $courses->fetchAll();
        if(empty($result)){
            return false;
        }else{
            return $result;
        }
    }

    public function getuserPostsBy($id){
        $courses = $this->db->pdo->prepare("SELECT * FROM `course_timeline` WHERE `user_id` = :ID");
        $courses->bindValue(':ID',$id);
        $courses->execute();
        $result = $courses->fetchAll();
        if(empty($result)){
            return false;
        }else{
            return $result;
        }
    }

    public function getuserPosts($code, $id, $offset, $items){
        $courses = $this->db->pdo->prepare("SELECT * FROM `course_timeline` WHERE `course_code` = :code AND `user_id` = :ID ORDER BY id DESC LIMIT $offset, $items");
        $courses->bindValue(':code',$code);
        $courses->bindValue(':ID',$id);
        $courses->execute();
        $result = $courses->fetchAll();
        if(empty($result)){
            return false;
        }else{
            return $result;
        }
    }

    public function getuserPostsByShift($code, $id, $shift, $offset, $items){
        $courses = $this->db->pdo->prepare("SELECT * FROM `course_timeline` WHERE `course_code` = :code AND `user_id` = :ID AND `shift` = :shift ORDER BY id DESC LIMIT $offset, $items");
        $courses->bindValue(':code',$code);
        $courses->bindValue(':ID',$id);
        $courses->bindValue(':shift',$shift);
        $courses->execute();
        $result = $courses->fetchAll();
        if(empty($result)){
            return false;
        }else{
            return $result;
        }
    }

      public function upload_file($arr, $location)
      {
          $fileArr = explode(".", $arr['file']['name']);
          $fileExt = end($fileArr);
          $newName = $fileArr[0] . rand(100, 999) . "." . $fileExt;
          $move_path = $location . '/' . $newName;
          $move = move_uploaded_file($arr['file']['tmp_name'], $move_path);
          chmod($move_path, 0777);
          if ($move === TRUE) {
              return $newName;
          } else {
              return false;
          }
      }

      public function updateUser($image, $id){
          $update = $this->db->pdo->prepare("UPDATE `pub_users` SET `pro_img` = :image WHERE `pub_users`.`id` = :ID");
          $update->bindValue(':image',$image);
          $update->bindValue(':ID',$id);
          $update->execute();
          $result = $update->rowCount();
          if($result){
              return true;
          }else{
              return false;
          }
      }

      public static function convertDateTime($value){
        $timestamp = strtotime($value);
        $month = date("m", $timestamp);
        if($month == '01'){
            $month = 'Jan';
        }elseif($month == '02'){
            $month = 'Feb';
        }elseif($month == '03'){
            $month = 'Mar';
        }elseif($month == '04'){
            $month = 'Apr';
        }elseif($month == '05'){
            $month = 'May';
        }elseif($month == '06'){
            $month = 'June';
        }elseif($month == '07'){
            $month = 'July';
        }elseif($month == '08'){
            $month = 'Aug';
        }elseif($month == '09'){
            $month = 'Sept';
        }elseif($month == '10'){
            $month = 'Oct';
        }elseif($month == '11'){
            $month = 'Nov';
        }else{
            $month = 'Dec';
        }

        $date = $month." ".date("d, Y", $timestamp);

        return $date;
    }

   }
?>