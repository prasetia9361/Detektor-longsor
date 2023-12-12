<?php 
// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'id21009767_webiot');
// define('DB_PASSWORD','Kere_1234');
// define('DB_NAME', 'id21009767_datalogging');
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD','');
define('DB_NAME', 'belajar_iot');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($db === false){
    die("ERRoR: Tidak dapat dapat terhubung." . mysql_connect_error()); 
}
function cekSerial($db, $serial_number){
    $sql = "SELECT * FROM devices WHERE serialnumber = '$serial_number'";
    $result = mysqli_query($db, $sql);

    if(mysqli_fetch_row($result) > 0){
        return true;
    } else {
        return false;
    }
}
?>