<?php include "inc/conn.php";?><?php include "inc/excel.php";?>
<?php include "inc/pubs.php";?><?php $tts = date("YmdHis",time());?>
<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="gb2312" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<title><?php echo $title;?></title>
<meta name="author" content="yujianyue, admin@ewuyi.net">
<meta name="copyright" content="www.12391.net">
<link href="inc/css/style.css?t=180328" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="inc/js/js.js?t=180328"></script>
</head>
<body onLoad="inst();">
<div class="html">
<div class="divs" id="divs">
<div id="head" class="head" onclick="location.href='?t=<?php echo $tts;?>';">
<?php echo $title;?>
<!--div class="back" id="pageback">
<a href="?t=<?php echo $tts;?>" class="d">����</a>
</div-->
</div>
<div class="main" id="main">
<?php 
$stime=microtime(true); 
$codes = trim($_POST['code']);
$shujus = trim($_POST['time']);
$shuru1 = trim($_POST['name']);
if(!$shujus){
?>
<form name="queryForm" method="post" action="?t=<?php echo $tts;?>" onsubmit="return startRequest(0);">
<div class="select" id="10">
<select name="time" id="time" onBlur="startRequest(1)" >
<?php traverse($UpDir."/",$dbtype);?></select></div>
<div class="so_box" id="11">
<input name="name" type="text" class="txts" id="name" value="" placeholder="������<?php echo $tiaojian1;?>" onfocus="st('name',1)" onBlur="startRequest(2)" />
</div>
<?php 
if($ismas=="1"){
?>
<div class="so_box" id="33">
<input name="code" type="text" class="txts" id="code" placeholder="��������֤��" onfocus="this.value=''" onBlur="startRequest(3)" />
<div class="more" id="clearkey">
<img src="inc/code.php?t=<?php echo $tts;?>" id="Codes" onClick="this.src='inc/code.php?t='+new Date();" />
</div></div>
<?php }?>
<div class="so_but">
<input type="submit" name="button" class="buts" id="sub" value="������ѯ" />
<input type="button" class="buts" value="ˢ�±�ҳ" name="print" onclick="location.reload();">
</div>
<div class="so_bus" id="tishi">
˵��:��<?php echo $tiaojian1;?><?php 
if($ismas=="1"){
?>+��֤��<?php }?>����������ȷ����ʾ��Ӧ�����
<!--�������˵����������ӣ���ʼ-->
<?php
if(!file_exists($doup2s)){
//echo "<!-- $doup2s ������ -->";
}else{
echo file_get_contents($doup2s);
}
?>
<!--�������˵����������ӣ�����-->
</div>
<div id="tishi1" style="display:none;">������<?php echo $tiaojian1;?></div>
<div id="tishi4" style="display:none;">������4������֤��</div>
</form>
<?php 
}else{
if($ismas=="1"){
session_start();
if($codes!=$_SESSION['PHP_M2T']){
 webalert("����ȷ������֤�룡");
}
}
if(!$shuru1){
 webalert("������$tiaojian1!");
}
$files = $UpDir."/".$shujus.$dbtype;
$files = charaget($files);
if(!file_exists($files)){
$files = charaget($files);
}
if(!file_exists($files)){
 webalert('�������ݿ��ļ�');
}else{
 echo '<h2>&nbsp;</h2><p align="center"> ';
 echo $shujus; 
 echo '</p>';
}
echo '<!--startprint-->';
$data = new Spreadsheet_Excel_Reader(); 
$data->setOutputEncoding('UTF-8'); 
$data->read($files); 
for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) { 
 if($i=="1"){
 $iaa=0;
 $iab=0;
 $iac=0;
echo "<table cellspacing=\"0\">";
echo '<caption align="center">��ѯ���' . $iae . '</caption><thead>';
 echo '<tr class="tt">';
for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) { 
$taba = ''.$data->sheets[0]['cells'][$i][$j].'';
$taba = iconv('UTF-8', 'GB2312//IGNORE', $taba); 
  $bh0=stristr($bubuxians,"--$taba--");
if(!$bh0){
      $ix++; 
  echo '<td>'.$taba.'</td>';
 }
      $io++; 
    if($taba==$tiaojian1){
      $iaa=$io; 
    }
} 
 echo "</tr></thead><tbody>";
    if(strlen($iaa)<1){
 webalert('����Excel���ݵ�1���Ƿ���ڡ�'.$tiaojian1.'���ֶ�!');
    }
echo "\r\n";
 }else{
 $Excelx=$data->sheets[0]['cells'][$i][$iaa];
$Excelx=iconv('UTF-8', 'GB2312//IGNORE', $Excelx); 
if("_".$shuru1=="_".$Excelx){
//echo "<!-- $shuru1 == $Excelx  -->\r\n";
 $iae++; 
 echo '<tr>';
for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) { 
 $tabe = ''.$data->sheets[0]['cells']['1'][$j].'';
 $tabe = iconv('UTF-8', 'GB2312//IGNORE', $tabe); 
$tabu = Trim($data->sheets[0]['cells'][$i][$j]);
$tabu = iconv('UTF-8', 'GB2312//IGNORE', $tabu); 
 //echo '<td class="r">'.$tabe.'</td>';
 echo '<td  data-label='.$tabe.'>'.$tabu.'</td>';
} 
 echo "</tr>\r\n";
} 
}
}
if($iae<1){
 $shuru1 = rephtmls($shuru1);
  echo '<tr>';
  echo "<td colspan={$j}  data-label=\"��ʾ\">û�в�ѯ��$tiaojian1 = $shuru1 �����ϢŶ</td>";
    echo '</tr>';
}
 echo "<tbody></table>\r\n";
echo '<!--endprint-->';
?>
<div class="so_but">
<input type="button" class="buts" value="Ԥ ��" name="print" onclick="preview()">
<input type="button" class="buts" value="�� ��" id="reset" onclick="location.href='?t=back';"></div>
<?php 
}
$etime=microtime(true);
$total=$etime-$stime;
echo "<!----ҳ��ִ��ʱ�䣺{$total} ]��--->";
?>
</div>
<div class="boto" id="boto">
&copy;<?php echo date('Y');?>&nbsp; <a href="<?php echo $copyu;?>" target="_blank"><?php echo $copyr;?></a>
</div>
</div>
</div>
</body>
</html>
