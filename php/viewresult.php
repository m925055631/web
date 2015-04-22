<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
  <title>vier order</title>
</head>
<body>
<?php  
require_once('DBManager.php');
echo '<p><strong>评分记录</strong></p>';
echo "<table border=1>\n";
echo '<tr>
  <th bgcolor="#CCCCFF">user_ip</th>
  <th bgcolor="#CCCCFF">语言流畅</th>
  <th bgcolor="#CCCCFF">条理清晰</th>
  <th bgcolor="#CCCCFF">准备充分</th>
  <th bgcolor="#CCCCFF">主题鲜明</th>
  <th bgcolor="#CCCCFF">收获及感受</th>
  <th bgcolor="#CCCCFF">总分</th>
    </tr> ';
$db = new DBManager();
$sql = 'select * from anonymouscomments';
$result = $db->query($sql);

$result =  json_decode( json_encode($result),true);
             

//var_dump($result);
$num = count($result);
for ($i=0;$i<$num;$i++) { 
 // $line = explode ('\t',$order[$i]);
  //对数字进行转换
  //$line[1] = intval($line[1]);
  //$line[2] = intval($line[2]);
  //$line[3] = intval($line[3]);
  echo ' <tr>
      <td align="left">'.$result[$i]['user_ip'].'</td>
      <td align="left">'.$result[$i]['LanguageFluency'].'</td>
      <td align="left">'.$result[$i]['Clear'].'</td>
      <td align="left">'.$result[$i]['Theme'].'</td>
      <td align="left">'.$result[$i]['Ready'].'</td>
      <td align="left">'.$result[$i]['HarvestFeelings'].'</td>
	<td align="left">'.$result[$i]['TotalPoints'].'</td>
    </tr> ';
}

echo '</table>';

?>
<a href="../pages/admin.html">返回</a>
</body>
</html>
