<?php
$path = $_POST['path'];
$fileName = $_POST['fileName'];

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'."$fileName".'"');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($path)); //Absolute URL
ob_clean();
flush();
readfile($path); //Absolute URL