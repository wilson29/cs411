<?
$con = mysql_connect('localhost','scott');
@mysql_select_db('test') or die( "Unable to select database");
$result = mysql_query("SELECT * FROM GAMES");
echo('<a href="http://localhost">Home</a> <br>');
while($game = mysql_fetch_array($result)){
  print($game['TITLE']." | ".$game['RATING']." | ".$game['YEAR'].'<br>');
  print("----------------------------------------------------------------------<br>");
}
?>
