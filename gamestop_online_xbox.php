<?
/*
Address, System_Name, Game  ,Current_Condition, Price	
  X           X           X         X                X
*/
include('simple_html_dom.php'); 
$url_part1 = 'http://www.gamestop.com/browse/xbox-360/games?nav=2b';
$url_part2 = ',1385-ffff2418';
$html = new simple_html_dom(); 

for($i=0; $i<=1728; $i+=12){
  $got_html = 0;
  try{
    $html->load_file($url_part1.$i.$url_part2);
  }
  catch(Exception $e){
   $html->load_file($url_part1.$i.$url_part2);
  }

  $games = $html->find('div[class=product]'); 
  //print_r($url_part1.$i.$url_part2."<br>");
  foreach($games as $info) {
    $game = $info->children(1);
    $price_info = $info->children(2);
    $price= $price_info->children(1)->plaintext;
    //sometimes two prices are listed, just take the second one...
    $last_index = strrpos($price, "$");
    $price = substr($price, $last_index);
    $title=$game->first_child()->plaintext;
    $title = str_replace(" for  Xbox 360", "", $title);
    $title = str_replace(" - with Bonus!", "", $title);
    $title = trim($title); 
    $title = addslashes($title); 
    //print_r($title."<br>");
    $publisher =$game->children(1)->plaintext;
    $new_or_used_array = explode(" ",$game->parent()->class);
    $new_or_used = $new_or_used_array[1];
    if(strpos($new_or_used, "New") !== false){
      $condition = "New";
    }  
    else{
      $condition = "Used";
    }
   $address = "www.gamestop.com";
   $system_name = "Xbox 360";
   $sells_query = "INSERT INTO Sells (Address, System_Name, Game, Current_Condition, Price) 
                       VALUES ('$address', '$system_name', '$title', $condition , '$price')";
   print_r($sells_query."<br>");
  }
}
?>












