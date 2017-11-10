<?php
$id = $_POST['id'];//[]....
include 'mysql_connect.php';
$select = "SELECT *FROM pick WHERE id = '$id'";//注意单双引号的混合使用
$result = mysql_query($select);
$row = mysql_fetch_array($result);
$arr = array($row['name'],$row['text'],$row['connect'],$row['image'] );
echo json_encode($arr);