
 <?php
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DB','login_with_token');

$conn = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
// if(!$conn){
//     echo 'Localhost connect successful';
// }else{
//     echo 'Localhost connection successful';
// }
?>
