<?php
      include 'inc/User.php';
      Session::init();
      if(isset($_GET['action']) && $_GET['action'] == 'logout'){
        Session::destroy();
        Session::set('login',false);
      }

     $user = new User();    
     $ID = '';
     $sessionID = Session::get('id');
     $login = Session::get('login');
     if(isset($_GET['id'])){
       $ID  = $_GET['id'];
     }

     $userInfos = $user->getuserInfo($ID);
     $userID = '';
     if($userInfos){
       foreach($userInfos as $userInfo){
         $userID = $userInfo['id'];
       }
     }

     $course_code = '';
     if($_GET['courseid']){
       $course_code = $_GET['courseid'];
     }
     
     $getUser = $user->getuserInfo($ID);
     $page = 1;
     if(isset($_GET['page'])){
        $page = $_GET['page'];
     }

     $offset = ($page-1) * 5;
     $getPosts = '';
     if(isset($_GET['shift'])){
      $getPages = $user->getPages($ID, $course_code, $_GET['shift']);
      $getPosts = $user->getuserPostsByShift($course_code, $ID, $_GET['shift'], $offset, 5);
     }else{
      $getPages = $user->getPagesBy($ID, $course_code);
      $getPosts = $user->getuserPosts($course_code, $ID, $offset, 5);
     }
     

?>



<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/fontawesome.all.min.css">
  <link rel="stylesheet" href="css/course-page.css">
  <title>Online Course Timeline</title>
  <style>
    #upload-file {
      display: block;
      position: relative;
      bottom: 37px;
      left: 10px;
      opacity: 0;
    }

    #showFileName {
      position: relative;
      left: 140px;
      bottom: 66px;
    }

    select#selectShift {
      background: transparent;
      border: 1px solid purple;
      padding: 5px 15px;
    }
  </style>
</head>

<body>

  <div id="snow_fall"></div>

  <aside class="sidebar-left-collapse">
    <?php if($user->getuserInfo($ID)){?>
    <?php foreach($user->getuserInfo($ID) as $user){?>
    <?php if($user['pro_img'] == ''){?>
    <a href="profile.php" class="company-logo"><img src="images/profile.jpg" alt=""></a>
    <?php }else {?>
      <a href="profile.php" class="company-logo"><img src="uploads/<?php echo $user['pro_img']; ?>" alt="<?php echo $user['pro_img']; ?>"></a>
    <?php }?>
    <h2><?php echo $user['username']; ?></h2>
    <?php }?>
    <?php }?>
   

    <div class="sidebar-links">

      <div class="link-blue">
        <a href="course-page.php?courseid=<?php echo $course_code; ?>&id=<?php echo $ID; ?>">
          All
        </a>
      </div>

      <div class="link-blue">
        <a href="course-page.php?courseid=<?php echo $course_code; ?>&shift=day&id=<?php echo $ID; ?>">
          Day
        </a>
      </div>

      <div class="link-red">
        <a href="course-page.php?courseid=<?php echo $course_code; ?>&shift=evening&id=<?php echo $ID;?>">
          Evening
        </a>
      </div>

    </div>
  </aside>

  <div class="main-content">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="heading">
            <h1>Course Timeline</h1>
          </div>
        </div>
        <?php if($login !=false){?>
        <?php if($sessionID == $userID){?>
        <div class="col-sm-12">
          <div id="showErr"></div>
          <div class="post">
            <div class="post-header">
              <h2 class="post-title" id="post-header-title">
                <i class="fa fa-pencil" aria-hidden="true"></i>
                write post
              </h2>
            </div>
            <form id="widget-form" class="post-form" name="form">
              <div class="post-content">
                <label for="post-content" class="sr-only">share your moments</label>
                <textarea id="contents" name="post" class="post-text" placeholder="Todays class topics"></textarea>
              </div>

              <div class="post-actions post-actions clearfix">
                <div class="post-actions-attachments">
                  <button type="button" class="btn post-actions__upload attachments-btn">
                    <label for="upload-image" class="post-actions-label">
                      <i class="fa fa-upload" aria-hidden="true"></i>
                      upload fies
                    </label>
                  </button>
                  <input type="file" id="upload-file" name="file" multiple>
                  <span class="text-success" id="showFileName"></span>
                </div>
                <input type="hidden" id="course_code" value="<?php echo $course_code; ?>">
                <select name="" id="selectShift">
                  <option value="day">Day</option>
                  <option value="evening">Evening</option>
                </select>

                <div class="post-actions__widget float-right">
                  <button id="publish" type="button" class="btn post-actions__publish">publish</button>
                </div>

              </div>
            </form>
          </div>
        </div>
        <?php }?>
        <?php }?>


        <?php if($getPosts){?>
        <?php foreach($getPosts as $getPost){?>
        <div class="col-sm-12">
          <div class="box">
            <h1><?php echo User::convertDateTime($getPost['date']); ?></h1>
            <p><?php echo $getPost['post_content']; ?></p>
            <?php if($getPost['attach_file'] != 'N/A'){?>
            <a href="uploads/<?php echo $getPost['attach_file']; ?>"><?php echo $getPost['attach_file'];?></a>
            <?php }?>
            <span>Shift: <?php echo $getPost['shift']; ?></span>
          </div>
        </div>
        <?php }?>
        <?php }?>





        <nav aria-label="..." class="custom-pegi">
          <ul class="pagination">
            <?php if($getPages){?>
            <?php $total_pages = $getPages / 5 ;?>
            <?php for($i=1; $i<=ceil($total_pages); $i++){?>
            <li class="page-item"><a class="page-link"
                href="course-page.php?courseid=<?php echo $course_code; ?>&page=<?php echo $i; ?>&id=<?php echo $ID; ?>"><?php echo $i; ?></a>
            </li>
            <?php }?>
            <?php }?>

          </ul>
        </nav>
      </div>

    </div>

  </div>






  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/particles.js"></script>
  <script type="text/javascript" src="js/app.js"></script>
  <script type="text/javascript">
    $(function () {
      var links = $('.sidebar-links > div');

      links.on('click', function () {
        links.removeClass('selected');
        $(this).addClass('selected');
      });
    });
  </script>
  <script src="js/ajax.request.js"></script>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center" id="show">
        </div>
      </div>
    </div>
  </div>
</body>

</html>