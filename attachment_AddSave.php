<?php
session_start();
include('conn.php');
$type=$_POST['select'];
$title=$_POST['title'];
$author=$_POST['author'];
$reference=$_POST['reference'];
$info=$_POST['info'];
if ($_FILES["file"]["error"] > 0){
	echo "Error: " . $_FILES["file"]["error"] . "<br>";
}else{
	echo "上传: " . $_FILES["file"]["name"] . "<br>";
	echo "大小: " . ($_FILES["file"]["size"] / 1024) . " KB<br>";
	if (file_exists("uploadfile/" . $_FILES["file"]["name"])){
		echo $_FILES["file"]["name"] . " already exists. ";
	}else{
		move_uploaded_file($_FILES["file"]["tmp_name"],"uploadfile/".$_FILES["file"]["name"]);
	}
}
$context="uploadfile/" . $_FILES["file"]["name"];
$result=mysql_query("INSERT INTO attachment(atitle,addtime,info,atID,text,author,reference) VALUES ('$title',now(),'$info','$type','$context','$author','$reference')");
?>