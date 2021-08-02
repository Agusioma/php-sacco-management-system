<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $from = trim($_POST["emailTS"]);
        $subject = trim($_POST["subEm"]);
        $name = trim($_POST["nameEm"]);
        $message = trim($_POST["messEm"]);
        
$to      = 'contact@sacco.terrence-aluda.com';
$subject = $subject;
$message = "FROM ".$name.", \n\n".$message;
$headers = $from;

mail($to, $subject, $message, $headers);

}
?>