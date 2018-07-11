<?php
include('user.php');
function writeTOFile($sql){
    $file = fopen("QueryLog.txt", "w") or die ("Unable to open file ");
    $txt = $sql + " " +  $_SESSION['user'] + "\n";
    fwrite($file, $txt);
    fclose($file);
};

?>