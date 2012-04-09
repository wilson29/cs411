<?
include('simple_html_dom.php'); 
$url_part1 = 'http://www.gamefly.com/buy-games/Browse/?pf=1070&cat=SeeAll&sort=Bestselling&page=';
$url_part2 = '&pageSize=78';
$html = new simple_html_dom(); 
for($z=1; $z<=3; $z++){
  $html->load_file($url_part1.$z.$url_part2);
  $games = $html->find('div[class=product-wrapper]'); 
  foreach($games as $game) {
    $string = $game->plaintext;
    //dont care about games only available to preoder    
    $preorder = strpos($string, "Pre-Order");
    if($preorder !== false){
      continue;
    } 
    $string = str_replace("Xbox 360", "", $string);
    $exploded_by_spaces = preg_split('/ /', $string, -1, PREG_SPLIT_NO_EMPTY);//explode(" ", $string);
    //find the index of the LAST PRICE, everytihng after that is the title 
    $i = 0;    
    $price_index = -1;    
    foreach ($exploded_by_spaces as $word){
      $is_price = strpos($word, "$");
      if($is_price !== false){
        $price_index = $i;
      } 
      $i++;
    }
    // get the new and/or used prices  
    $used = false;
    $used_flag = false;
    $new = false;
    $new_flag = false;
    foreach ($exploded_by_spaces as $word){
      if ($new_flag == true){
        $new_price = $word;
        $new_flag = false;
      }      
      if (strpos($word, "New") !== false){
        $new = true;
        $new_flag = true;
      }      
      if ($used_flag == true){
        $used_price = $word;
        $used_flag = false;
      }      
      if (strpos($word, "Used") !== false){
        $used = true;
        $used_flag = true;
      }
    }
  
    //form the title
    $title = "";
    for($j=$price_index+1; $j<sizeof($exploded_by_spaces); $j++){
      $title = $title." ".$exploded_by_spaces[$j];
    }
    $title = str_replace("&nbsp;", '', $title);
    $title = trim($title);
    $game_query = "INSERT INTO GAMES (TITLE) VALUES ('$title')
                  ON DUPLICATE KEY UPDATE TITLE = Values(TITLE);";

    $address = "www.gamefly.com";
    $system_name = "Xbox 360";
    if($new == true){
       $sells_query_new = "INSERT INTO Sells (Address, System_Name, Game, Current_Condition, Price) 
                           VALUES ('$address', '$system_name', '$title', 'New', '$new_price')";
       print_r($sells_query_new."<br>");       
     }    
    if($used == true){
       $sells_query_used = "INSERT INTO Sells (Address, System_Name, Game, Current_Condition, Price) 
                           VALUES ('$address', '$system_name', '$title', 'Used', '$used_price')";
      print_r($sells_query_used."<br>");    
    }    

    
  }
}
?>
