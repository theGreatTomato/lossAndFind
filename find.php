<?php
   /* echo "Upload: " . $_FILES["fileFile"]["name"] . "<br />";
    echo "Type: " . $_FILES["fileFile"]["type"] . "<br />";
    echo "Size: " . ($_FILES["fileFile"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["fileFile"]["tmp_name"] . "<br />";*/
 
include 'mysql_connect.php';
$select = 'SELECT *FROM pick';
$result = mysql_query($select);
class RM{
  public $id;
  public $pickorloss;
  public $name;
  public $image;
  public $text;
  public $connect;
  function __construct($id,$pickorloss,$name,$image,$text,$connect){
    $this->id = $id;
    $this->pickorloss = $pickorloss;
    $this->name = $name;
    $this->image = $image;
    $this->text = $text;
    $this->connect = $connect;
  }
}

$arr = array();
while($row = mysql_fetch_array($result))//可以用这种循环让它一直执行下去 
  {
  $newRm = new RM($row['id'],$row['pickorloss'],$row['name'],
    $row['image'],$row['text'],$row['connect']);
  array_push($GLOBALS['arr'],$newRm);
 }
echo json_encode($arr);
mysql_close($link);

?>