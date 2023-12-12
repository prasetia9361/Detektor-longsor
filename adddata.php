<?php
require "config.php";
$webhookRespons = json_decode(file_get_contents('php://input'),true);
date_default_timezone_set('Asia/Jakarta');
$topic = $webhookRespons["topic"];
$payload = $webhookRespons["payload"];
$waktu = date('j/n/Y H:i:s');
    $sql = "INSERT INTO riwayat (topic,payload,waktu) VALUES ('$topic','$payload','$waktu')";
    mysqli_query($db, $sql);
    // $sql1 = "INSERT INTO serial (topic,payload,topic2,sensor1,topic3,sensor2,topic4,level,topic5,waktu) VALUES ('$topic1','$payload1','$topic2','$payload2','$topic3','$payload3','$topic4','$payload4','$topic5','$payload5')";
    // mysqli_query($db, $sql1);

?>