<?
include('simple_html_dom.php'); 

echo "USE cs411_phpfogapp_com;<br>";
/*SELLS:

Address, System_Name, Game  ,Current_Condition, Price	
  X           X           X         X                X

include('simple_html_dom.php'); 
/*connect to mysql */
$con = mysql_connect('localhost','scott');
@mysql_select_db('test') or die( "Unable to select database");
$url_part1 = 'http://www.walmart.com/browse/Games/_/N-91cgZ1z0gls9Z1yznszw?tab_value=All&path=0%3a2636&pref_store=1734&depts=&ref=421648+4293873225+4292529548&ic=60_';
$html = new simple_html_dom(); 
for($i=0; $i<=180; $i+=60){
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
      $is_preowned = strpos($title, "Pre-Owned");
      if($is_preowned === false){
        $condition = "New";
      }
      else{
        $condition = "Used";
      }      
      $title = str_replace("- Pre-Owned", "", $title);  
      $title = trim($title); 
      $title = mysql_real_escape_string($title);     
      $rating = $game->children(3)->plaintext;
      $rating = str_replace("ESRB Rating: ", "", $rating);
      $price = $game->children(2)->children(1)->first_child()->first_child()->plaintext; //price
      $price = substr($price, 1);
      $system_name = "XBOX 360";
      $address = "www.walmart.com";
      //query to add to the sells database      
      //$sells_query = "INSERT IGNORE INTO Sells (Address, System_Name, Game_Title, Current_Condition, Price) 
      //               VALUES ('$address', '$system_name', '$title', '$condition', $price);";
      //query to add it into the games database
      //$games_query = "INSERT INTO Games (Title, Rating) VALUES ('$title', '$rating')
      //            ON DUPLICATE KEY UPDATE Title=VALUES(Title);";
     // print $games_query."<br>";
      $oftype_query = "INSERT IGNORE INTO ofType (Category, Game_Title) VALUES ('Action & Adventure', '$title');";      

      print $oftype_query."<br>";
      }
  }
}
mysql_close($con);
?>
