<?

mysql_connect('localhost','scott');
@mysql_select_db('test') or die( "Unable to select database");
echo('<a href="http://localhost"> Home </a><br>');
$title = $_POST['title'];
$year = $_POST['year'];
$rating = $_POST['rating'];
$query = "INSERT INTO GAMES (TITLE, YEAR, RATING) VALUES ('$title', '$year', '$rating');";
mysql_query($query);
echo($query. " has been executed...<br> Try searching for the new record in the database! <br>");

?>
