<?php


$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<img src='images/ravi.jpg'>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>Subodh</th>
<th>Acharya</th>
</tr>
<tr
<td>Ravi</td>
<td>Yadav</td>
</tr>
</table>
</body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <cleckhfmart@gmail.com>' . "\r\n";
// $headers .= 'Cc: asubodh21@tbc.edu.np' . "\r\n";

if(mail("raviiiyadav7372@gmail.com", "HTML Email", $message, $headers)){
    echo "mail sent";
}
else{
    echo "unable to connect";
}


?>