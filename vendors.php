<?
$con = mysql_connect('localhost','scott');
@mysql_select_db('test') or die( "Unable to select database");
$result = mysql_query("SELECT * FROM VENDORS");
echo('<a href="http://localhost">Home</a> <br>');
while($game = mysql_fetch_array($result)){
  print($game['NAME']." | ".$game['TYPE']." | ".'<br>');
  print("-------------------------------------------------------<br>");
}
?>
