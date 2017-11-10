<?php
   /* echo "Upload: " . $_FILES["fileFile"]["name"] . "<br />";
    echo "Type: " . $_FILES["fileFile"]["type"] . "<br />";
    echo "Size: " . ($_FILES["fileFile"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["fileFile"]["tmp_name"] . "<br />";*/
    //获取文件后缀名函数 

//生成随机文件名函数 
function random($filename) 
{ 
    $arr = explode('.', $filename);
    $filename = array_pop($arr);
    $a = rand(100,10000);
    $filename = $a.".".$filename;
    return $filename;
}  
    include 'header.html';
    if($_FILES["fileFile"]["name"]){
      $_FILES["fileFile"]["name"]=random($_FILES['fileFile']['name']);
        while (file_exists("upload/" . $_FILES["fileFile"]["name"]))
          {
            $a = rand(1,10);
          $_FILES["fileFile"]["name"] = (string)$a.$_FILES["fileFile"]["name"];
          }
          move_uploaded_file($_FILES["fileFile"]["tmp_name"],
          "upload/" . $_FILES["fileFile"]["name"]);
    }
    
      //压缩图片
  function resizeImg($upimg){  
    if(!$upimg){
      echo "程序出现错误，请重新上传";
      return false;
    }
    echo "<h3>上传成功</h3>";
    list($width, $height,$type) = getimagesize($upimg);//$type = 1是gif  $type = 3是png  $type = 2是jpg 
   // echo $width . "<br />";
  //  echo $height . "<br />";
   // echo $type . "<br />";
    if($width > $height){
      $newwidth = 120;
      $newheight = $height/$width*120;
    }
    else{
      $newheight = 120;
      $newwidth = $width/$height*120;
    }
    $uploaddir_resize = imagecreatetruecolor($newwidth, $newheight);
    if($type === 1){
      $img_origin = imagecreatefromgif($upimg);
      imagecopyresampled($uploaddir_resize, $img_origin, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
      imagegif($uploaddir_resize,'upload_resize/'.$_FILES["fileFile"]["name"]);
    }
    else if($type === 3){
      $img_origin = imagecreatefrompng($upimg);
      imagecopyresampled($uploaddir_resize, $img_origin, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
      imagepng($uploaddir_resize,'upload_resize/'.$_FILES["fileFile"]["name"]);
    }
    else{
      $img_origin = imagecreatefromjpeg($upimg);
      imagecopyresampled($uploaddir_resize, $img_origin, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
      imagejpeg($uploaddir_resize,'upload_resize/'.$_FILES["fileFile"]["name"]);
    }
    ImageDestroy ($uploaddir_resize);
  }
  resizeImg("upload/" . $_FILES["fileFile"]["name"]);
//连接数据库上传
   include 'mysql_connect.php';
      $pickOrLoss = $_POST["something"];
      $name = $_POST["name"];
      $image = $_FILES["fileFile"]["name"];
      $text = $_POST["text"];
      $connect = $_POST["connect"];
      mysql_query("INSERT INTO pick(pickorloss,name,image,text,
        connect)VALUES('$pickOrLoss','$name','$image','$text','$connect')");
      echo "<h1><a href ='index.html'>点击跳转首页</h1>"; 
?>