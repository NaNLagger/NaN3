<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Загрузка изображения</title>
</head>
<body bgcolor="#FFFFFF">
<?php
	function imageresize($outfile,$infile,$neww,$newh,$quality) {

    $im=imagecreatefromjpeg($infile);
    $im1=imagecreatetruecolor($neww,$newh);
    imagecopyresampled($im1,$im,0,0,0,0,$neww,$newh,imagesx($im),imagesy($im));

    imagejpeg($im1,$outfile,$quality);
    imagedestroy($im);
    imagedestroy($im1);
    }

   if($_FILES["filename"]["size"] > 1024*3*1024)
   {
     echo ("Размер файла превышает три мегабайта");
   }
   // Проверяем загружен ли файл
   if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
   {
     // Если файл загружен успешно, перемещаем его
     // из временной директории в конечную
     move_uploaded_file($_FILES["filename"]["tmp_name"], "Z:/home/localhost/www/v3/images/".$_FILES["filename"]["name"]);
	 /*imageresize("Z:/home/localhost/www/v3/images/".$_FILES["filename"]["name"],"Z:/home/localhost/www/v3/images/".$_FILES["filename"]["name"],140,140,75);*/
     $avatar=$_FILES['filename']['name'];
	 print "Загрузка завершена<br> Ссылка на изображение: <a href='http://localhost/v3/images/".$avatar."'>http://localhost/v3/images/".$avatar."</a>";
	 print "<br><img width='200' src='http://localhost/v3/images/".$avatar."'>";
   } else {
      echo("Ошибка загрузки файла");
   }
?>
</body>
</html>