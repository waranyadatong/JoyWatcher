<?php
    $startDir = "C:\ProgramFiles\PuTTY";
    $path = "cd /home/pi/Desktop/QtGUI/MySQL\n";
    $runExe   = "$startDir\putty.exe";
    $envars   = " -ssh pi@192.168.75.218 -pw 1234";
    $runPath = $runExe . $envars;
    if (isset($_POST['on']))
    {
    $cmd = shell_exec($runPath);
    echo "Program is running";
    }
    if (isset($_POST['off']))
    {
    shell_exec('sudo kill -9 $(pgrep -f python)');
    echo "Program Stop";
    }
    ?>

<html>
 <head>
 <meta name="viewport" content="width=device-width" />
 <title>Joy Watcher</title>
 </head>
 <body>
     Run Raspberry Pi Program:
     <form method="POST" >
          <input type="submit" value="Run" name="on">
          <input type="submit" value="Stop" name="off">
     </form>
 </body>
</html>