<?php $user = current_user(); date_default_timezone_set('Asia/Bangkok');?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php if (!empty($page_title))
        echo remove_junk($page_title);
        elseif(!empty($user))
        echo ucfirst($user['name']);
        else echo "Project Joy Watcher";?>
      </title>
      <link rel="stylesheet" href="libs/css/main.css" />
      <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
      <!-- <link href="plugins/css/style.css" rel="stylesheet">-->
      <!--<link href="assets/css/bootstrap.min.css" rel="stylesheet">-->
      <!--<link href="assets/style.css" rel="stylesheet">-->
      <link rel="stylesheet" href="css/bootstrap.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
      <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    </head>
    <body>
      <?php  if ($session->isUserLoggedIn(true)): ?>
        <header id="header">     
          <div class="logo pull-left" style="font-size: 18px;">Joy Watcher</div>
          <div class="header-content">
            <div class="header-date pull-left">
              <!--<strong id="time" style="font-size:1.25em;color:green;"><?php echo date("D j F, Y, g:i a");?></strong>-->
              <strong id="time" style="font-size:1.75em;color:green;"><?php echo date("Y-m-d H:i:s");?></strong>
            </div>
            <div class="pull-right clearfix">
              <ul class="info-menu list-inline list-unstyled">
                <li class="profile">
                  <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
                    <img src="uploads/users/<?php echo $user['image'];?>" alt="user-image" class="img-circle img-inline">
                    <span><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="last">
                      <a href="logout.php">
                        <i class="glyphicon glyphicon-off"></i>
                        Logout
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </header>
        <div class="sidebar">
          <?php if($user['user_level'] === '1'): ?>
          <!-- admin menu -->
          <?php include_once('admin_menu.php');?>
          <?php elseif($user['user_level'] === '2'): ?>
          <!-- User menu -->
          <?php include_once('user_menu.php');?>
          <?php endif;?>
        </div>
      <?php  elseif ($session->isUserLoggedIn(false)): ?>
      <?php include_once('includes/cookie.php');?>
        <?php include_once('index.php');?>
        <?php endif;?>
        <div class="page">
          <div class="container-fluid">
            <!--<script>
              $(function() {
                function realTime() {
                  setTimeout(function(){  
                    $("#time").html("time");  
                    $("#time").addClass("realtime");      
                    realTime();  
                  }, 1000); 
                }
                realTime();
              });
            </script>-->
