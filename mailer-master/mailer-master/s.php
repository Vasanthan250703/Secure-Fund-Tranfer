<?php
   $passw01 = "53nh46u74m3nt3";
   $hashp03 = '$argon2i$v=19$m=1024,t=2,p=2$d1JJWnNHMkVEekZwcTFUdA$zeSi7c/Adh/1KCTHddoF39Xxwo9ystxRzHEnRa0lQeM';
   $algo03 = PASSWORD_ARGON2I;

   $test03 = password_verify($passw01, $hashp03);
   $conf03 = password_needs_rehash($hashp03, $algo03);

   if($conf03 == true) {
      echo "HASH NEEDS TO BE REHASHED!<br>SUGGESTED FOR THE NEW HASH:<br>";
      $nwhas03 = password_hash($passw01, $algo03);
      echo $nwhas03;
   } else {
      echo "HASH DOES HAS NO NEED TO BE REHASHED!<br>";
      echo $hashp03;

      $getinfo03 = password_get_info($hashp03);

      echo "<br><br>algo = " . $getinfo03["algo"] . "<br>algoName = " . $getinfo03["algoName"] . "<br>memory_cost = " 
           . $getinfo03["options"]["memory_cost"] . "<br>time_cost = " . $getinfo03["options"]["time_cost"] 
           . "<br>threds = " . $getinfo03["options"]["threads"] . "<br><br>";  
   }
?>
