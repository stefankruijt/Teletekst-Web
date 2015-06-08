<?php
   $date = new DateTime();
   $query = "SELECT * FROM items WHERE item_category='nieuws' ORDER BY timestamp DESC LIMIT 30";

   if ($result = $mysqli->query($query)) {
      echo "<div id=\"accordion2\">";

      while ($row = $result->fetch_assoc()) {
         $extraText = ($row['broadcast'] == 0) ? "<b>Bericht wordt niet uitgezonden!</b>" : "";
         $extraStyling = ($row['item_checked']==0) ?  "style=\"background:none;background-color:yellow;\"" : "style=\"background:none;background-color:lightgreen;\"";

         echo "<h3 ".$extraStyling.">".$row['publication_title']."\r  ".$extraText."</h3>";
         echo "<div>";
         echo "<h3><b>Huidige teletekst-weergave</b></h3>";
         echo "<input type=\"text\" name=\"titel\" value=\"".strtoupper($row['publication_title'])."\" size=\"35\" style=\"font-family: monospace;font-size: 10pt; resize: none;\" readonly=\"readonly\" />";  
         
         foreach(explode("#NEWSUBPAGE#", $row['publication_text']) as $value) {
            echo "<textarea name=\"subpages[]\" style=\"font-family: monospace;font-size: 10pt; resize: none; width: 400px; height: 330px; overflow:hidden; background-image: url(backgroundTextArea.png);\" wrap=\"hard\" readonly=\"readonly\" cols=\"45\">".$value."</textarea>";
         }

         echo "<br /><h3><a class=\"loadextradata\" href=\"editDialog.php?id=".$row['item_id']."\">Bewerk bericht</a></h3>";
         echo "</div>";
      }
      echo "</div>";
   }
?>