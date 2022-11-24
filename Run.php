<?php
$gotIt = array();
$file111 = "CACZ-160MW-0B.bat";
//echo $file; exit;
$kkk =  exec( $file111, $gotIt );
//echo $kkk;
$usr = implode("",$gotIt);
echo '<pre>'; print_r($usr);exit;
?>