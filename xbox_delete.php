<?

mysql_connect('localhost','scott');
@mysql_select_db('test') or die( "Unable to select database");
echo('<a href="http://localhost"> Home </a><br>');
$title = $_POST['title'];
$query = "DELETE FROM GAMES WHERE TITLE='$title'";
mysql_query($query);
echo($query. " has been executed...<br> Try searching for it in the database! <br>");

?>
