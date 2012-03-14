<?
print("<strong>SEARCH FOR AN XBOX GAME</strong>");
print('<form name="search" action="xbox_game.php" method="post">
Game Name: <input type="text" name="game" />
<input type="submit" value="Search" />
</form>');

print("<br><br><br>");
print("<strong>ADD A GAME TO THE DATABASE</strong>");
print('<form name="add" action="xbox_add.php" method="post">
Game Name: <input type="text" name="title" />
Rating: <input type="text" name="rating" />
Year: <input type="text" name="year" />
<input type="submit" value="Add" />
</form>');

print("<br><br><br>");
print("<strong>DELETE A GAME FROM THE DATABASE</strong>");
print('<form name="delete" action="xbox_delete.php" method="post">
Game Name: <input type="text" name="title" />
<input type="submit" value="Delete" />
</form>');





echo('<a href="http://localhost/xbox.php">List of All Xbox Games</a>');
echo('<a href="http://localhost/vendors.php">List of All Vendors Games</a>');


?>
