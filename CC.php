<?php

    $startDir = "C:\ProgramFiles\PuTTY";
    $runExe   = "$startDir\putty.exe";
    $envars   = " -ssh pi@192.168.75.218 -pw 1234";
    $runPath = $runExe . $envars;

    chdir($startDir);

    $descriptorspec = array (
        0 => array("pipe", "r"),
        1 => array("pipe", "w"),
    );

    if ( is_resource( $prog = proc_open("start /b " . $runPath, $descriptorspec, $pipes  , $startDir, NULL) ) )
    {
        $ppid = proc_get_status($prog)['pid'];
    }
    else
    {
        echo("Failed to execute!");
        exit();
    }

    $output = array_filter(explode(" ", exec("wmic process get parentprocessid,processid | find \"$ppid\"")));
    array_pop($output);
    $pid = end($output);


    echo("\nProcess ID: $pid ; Parent's Process ID: $ppid/n");

    // returns right process
    $task = shell_exec("tasklist /fi \"PID eq $pid\"");
    echo("\n\nProcess: \n$task\n\n");

    // returns no process found
    $task = shell_exec("tasklist /fi \"PID eq $ppid\"");
    echo("\n\nParent Process: \n$task\n\n");

?>

