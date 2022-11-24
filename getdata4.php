<?php 
  date_default_timezone_set('Asia/Bangkok');
  $page_title = 'Admin Home Page';
  require_once('includes/load.php');
  page_require_level(1); 
  if(isset($_GET['Program'])){
    $program = $_GET['Program'];
     require_once ( 'WShell.phpclass');
     $python = strtolower("python ");
     $py = strtolower(".py");
     $pi = strtolower("pi");
     $startpi =  $python.$program.$py;     
     //$PATH=realpath('C:\ProgramFiles\PuTTY\putty.exe');


    $wshell   =  new  WShell ( ) ;
    if ( $wshell ){
    
    $ppid = proc_get_status($wshell)['pid'];

    $wshell -> environment('USER');
    
    $wshell -> Exec ("cd C:\\ProgramFiles\\PuTTY\\putty.exe");
    sleep ( 2 ) ;
    //$wshell -> SendKeys ( "{CAPSLOCK}");
    $wshell -> SendKeys ( "192.168.75.218{ENTER}".$pi);
    sleep ( 1 ) ;
    //$wshell -> SendKeys ( "{CAPSLOCK}");
    $wshell ->  SendKeys("{ENTER}");
    //sleep ( 0.1 ) ;
    $wshell -> SendKeys ("1234{ENTER}");
    sleep ( 0.1 ) ;
    $wshell -> SendKeys ("cd /home/pi/Desktop/FileProduct{ENTER}");
    sleep ( 0.1 ) ;
    $wshell -> SendKeys ($startpi);
     //sleep ( 0.1) ;      
    }
    else
    {
        echo("Failed to execute!");
        exit();
    }

    $output = array_filter(explode(" ", exec("wmic process get parentprocessid,processid | find \"$ppid\"")));
    array_pop($output);
    $wshell = end($output);

    //echo("\nProcess ID: $pid ; Parent's Process ID: $ppid/n");

    $task = shell_exec("tasklist /fi \"PID eq $pid\"");
    //echo("\n\nProcess: \n$task\n\n");

    $task = shell_exec("tasklist /fi \"PID eq $ppid\"");
    //echo("\n\nParent Process: \n$task\n\n");

    //$wshell -> SendKeys ( "%(F){DOWN 3}{ENTER}example.txt", 100 ) ;
    /*echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

  if(mysqli_num_row() > 0){
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "Program is Running",
                  type: "success"
              }, function() {
                  window.location = "admin.php"; 
              });
            }, 1000);
        </script>';
    }else{
       echo '<script>
             setTimeout(function() {
              swal({
                  title: "Program is Stop",
                  type: "error"
              }, function() {
                  window.location = "admin.php"; 
              });
            }, 1000);
        </script>';
    }

  /*$page = $_SERVER['PHP_SELF'];
  $sec = "1";
  header("Refresh: $sec; url=$page");*/
  header( "location: admin.php" );
  exit();
  //$db = null;*/
}
?>     


