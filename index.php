<?
include('simple_html_dom.php'); 
/*connect to mysql */
$con = mysql_connect('localhost','scott');
@mysql_select_db('test') or die( "Unable to select database");
$url_part1 = 'http://www.walmart.com/browse/Games/_/N-91cgZ1z0gls9Zaq90Zaqce/Ne-aq7g?tab_value=Online&catNavId=482412&pref_store=1734&depts=&ref=125866.421648+500524.4293873225&ic=60_';
$html = new simple_html_dom(); 
for($i=0; $i<=660; $i+=60){
  $url = $url_part1.$i; 
  $html->load_file($url);
  $games = $html->find('div[class=prodInfoBox]'); 
  foreach($games as $game) {
    $ret = $game->find('.VGRating');
    if(sizeof($ret) > 0){
      $title = $game->children(0)->plaintext; 
      $title = str_replace("(Xbox 360)", "", $title);
      $title = str_replace("(Xbox 360/ Kinect)", "", $title);
      $title = str_replace("(Xbox 360/Kinect)", "", $title);    
      $title = str_replace("- Pre-Owned", "", $title);  
      $rating = $game->children(3)->plaintext;
      $rating = str_replace("ESRB Rating: ", "", $rating);
      $price = $game->children(2)->children(1)->first_child()->first_child()->plaintext; //price
      $query = "INSERT INTO GAMES (TITLE, RATING) VALUES ('$title', '$rating')
                  ON DUPLICATE KEY UPDATE TITLE = Values(TITLE), RATING = Values(RATING);";
      mysql_query($query);
      print $query."<br>";
      }
  }
  break;
}
mysql_close($con);
?>
