<?
$con = mysql_connect('localhost','scott');
@mysql_select_db('test') or die( "Unable to select database");
$result = mysql_query("SELECT * FROM GAMES");
while($game = mysql_fetch_array($result)){
  print($game['TITLE']." is rated ".$game['RATING'].'<br>');
}
?>
