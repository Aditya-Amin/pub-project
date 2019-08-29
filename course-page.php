<?php
      include 'inc/User.php';
      Session::init();
      if(isset($_GET['action']) && $_GET['action'] == 'logout'){
        Session::destroy();
        Session::set('login',false);
      }

     $user = new User();    
     $ID = Session::get('id');

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

     echo $ID." ".$course_code;
     $getPosts = $user->getuserPosts($course_code, $ID);
     $getUser = $user->getuserInfo($ID);
  
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
  </style>
</head>

<body>

  <div id="snow_fall"></div>

  <aside class="sidebar-left-collapse">
    <a href="#" class="company-logo"><img src="images/profile.jpg" alt=""></a>
  
    <h2><?php echo Session::get('name');?></h2>
  
    <div class="sidebar-links">
      <div class="link-blue">
        <a href="#">
          First Month
        </a>
      </div>

      <div class="link-red">
        <a href="#">
          Second Month
        </a>
      </div>

      <div class="link-yellow">
        <a href="#">
          Third Month
        </a>
      </div>

      <div class="link-green">
        <a href="#">
          Fourth Month
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
        <?php if($ID = $userID){?>
        <div class="col-sm-12">
          <p id="showErr"></p>
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

              <div class="post-actions post-actions">
                <div class="post-actions-attachments">
                  <button type="button" class="btn post-actions__upload attachments-btn">
                    <label for="upload-image" class="post-actions-label">
                      <i class="fa fa-upload" aria-hidden="true"></i>
                      upload fies
                    </label>
                  </button>
                  <input type="file" id="upload-file" name="file" multiple>
                </div>
                <input type="hidden" id="course_code" value="<?php echo $course_code; ?>">
                <div class="post-actions__widget">
                  <button id="publish" type="button" class="btn post-actions__publish">publish</button>
                </div>

              </div>
            </form>
          </div>
        </div>
        <?php }?>


        <?php if($getPosts){?>
        <?php foreach($getPosts as $getPost){?>
        <div class="col-sm-12">
          <div class="box">
            <h1><?php echo $user->convertDateTime($getPost['date']);?></h1>
            <p><?php echo $getPost['post_content']?></p>
            <a href="uploads/<?php echo $getPost['attach_file']?>"><?php echo $getPost['attach_file']?></a>
          </div>
        </div>
        <?php }?>
        <?php }?>





        <nav aria-label="..." class="custom-pegi">
          <ul class="pagination">
            <li class="page-item disabled">
              <span class="page-link">Previous</span>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active" aria-current="page">
              <span class="page-link">
                2
                <span class="sr-only">(current)</span>
              </span>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>
      </div>

    </div>

  </div>






  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="js/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
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
  <script src="js/ajax.functions.js"></script>
  <script src="js/ajax.request.js"></script>
  <script src="js/main.js"></script>
</body>

</html>