<?
$con = mysql_connect('localhost','scott');
@mysql_select_db('test') or die( "Unable to select database");
$game = '%'.$_POST['game'].'%';
echo('<a href="http://localhost"> Home </a><br>');
echo("You searched for $game <br><br><br>");
$result = mysql_query("SELECT * FROM GAMES WHERE TITLE LIKE '$game';");
if (mysql_num_rows($result) == 0) {
  print("No results found");
}
else{
  while($game_data = mysql_fetch_array($result)){
  print($game_data['TITLE']." | ".$game_data['RATING']." | ".$game_data['YEAR'].'<br>');
  print("----------------------------------------------------------------------<br>");
  }
}
?>
