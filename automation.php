<?php
//   include 'inc/User.php';
//   Session::init();
  $userID = Session::get('id');
//   $user = new User();
 
  $currentDate = date("Y-m-d");
  date_default_timezone_set('Asia/Dhaka');
  $currentGmt = gmdate("Y-m-d", strtotime($currentDate));
  $currentTimestamp = strtotime($currentGmt);

  $getAllcourses = $user->getAllCourse($userID);
  $getPosts = $user->getuserPostsBy($userID);
  // checking course which is expired
  if($getAllcourses){
      foreach($getAllcourses as $course){
          $date = $course['created'];
          $timestamp = strtotime($date);
          $finalTimestamp = $currentTimestamp - $timestamp;
          $month = date("m", $finalTimestamp);
          if($month > 4){
              $user->delete('course_tbl','created', $date);
          }
      }
  }
  if($getPosts){
    foreach($getPosts as $course){
        $date = $course['date'];
        $timestamp = strtotime($date);
        $finalTimestamp = $currentTimestamp - $timestamp;
        $month = (int)date("m", $finalTimestamp);
        if($month > 4){
            $user->delete('course_timeline', 'date', $date);
        }
    }
}

