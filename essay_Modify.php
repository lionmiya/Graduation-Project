<?php
session_start();
include("conn.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/style3.css"/>
<link rel="shortcut icon" type="image/x-icon" href="img/logo.ico"/>
<title>管理页面</title>
</head>

<body>
<?php
 $perNumber=20; 
 $page=isset($_GET['page'])?(int)$_GET['page']:1;
 $count=mysql_query("SELECT count(*) FROM essay");
 $rs=mysql_fetch_array($count); 
 $totalNumber=$rs[0];
 $totalPage=ceil($totalNumber/$perNumber); //计算总页数
 if(!isset($page)){
	 $page=1;
 }
 $startCount=($page-1)*$perNumber; //开始分页
 $result=mysql_query("SELECT * FROM essay ORDER BY eID DESC LIMIT $startCount,$perNumber");
while($row=mysql_fetch_array($result)){
?>
<a href="essay_ModifySave.php?eID=<?php echo $row[0];?>" class="aa"><?php echo $row[1];?></a>
<br/><br/>
<?php
}
?>
 <div class="fpage">
 <ul class="pagination">
 <li><a href="essay_Modify.php?&page=1">首页</a></li>
 <?php
 if($page!=1){ 
?>
  
  <li><a href="essay_Modify.php?&page=<?php echo $page-1;?>">上一页</a></li>
<?php
}
?>

<?php
$step=floor(($page-1)/4)*4+1;
 for($i=$step;$i<=$step+4;$i++){  //循环显示出页面
?>
  <li><a href="essay_Modify.php?&page=<?php echo $i;?>"><?php echo $i;?></a></li>
<?php
}
   if ($page<$totalPage){
?>
    <li><a href="essay_Modify.php?&page=<?php echo $page+1;?>">下一页</a></li>
	<li><a href="essay_Modify.php?&page=<?php echo $totalPage;?>">尾页</a></li>
<?php
} 
?>
</ul>
</div>
</body>
</html>