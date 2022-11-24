<?php

// show tasks, redirect errors to NUL (hide errors)
/*exec("tasklist 2>NUL", $task_list);
 
echo "<pre>";
print_r($task_list);

exec("taskkill /F /IM putty.exe 2>NUL");*/


//exec('c:\WINDOWS\system32\cmd.exe /c START C:\CACZ-160MW-0B.bat');
//exec("taskkill /F /IM cmd.exe 2>NUL");

  //system("cmd /c C:\CACZ-160MW-0B.bat");

/*function execInBackground($cmd) {
    if (substr(php_uname(), 0, 7) == "Windows"){
        pclose(popen("start /B ". $cmd, "r")); 
    }
    else {
        exec($cmd . " > /dev/null &");  
    }
}
execInBackground("C:\CACZ-160MW-0B.bat");*/



/*$WshShell = new COM("WScript.Shell");
$oExec = $WshShell->Run("cmd /C dir /S %windir%", 0, false);*/

?>
<?php system('start /b C:\\CACZ-160MW-0B.bat'); ?>