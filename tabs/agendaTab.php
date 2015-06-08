<?php
   $date = new DateTime();
   $limit = 100;
   $query = "select * from items where item_category='agenda' AND timestamp > '".$date->format('Y-m-d H:i:s')."' order by timestamp limit 100";
   
   if ($result = $mysqli->query($query)) {
      echo "<div id=\"accordion1\">";

      while ($row = $result->fetch_assoc()) {
		   $checked = $row["item_checked"];
         $extraText = ($row['broadcast'] == 0) ? "<b>Bericht wordt niet uitgezonden!</b>" : "";
         $extraStyling = ($row['item_checked']==0) ?  "style=\"background:none;background-color:yellow;\"" : "style=\"background:none;background-color:lightgreen;\"";
		 			
		   echo "<h3 ".$extraStyling.">".$row['publication_title']."\r  ".$extraText."</h3>";
		   echo "<div>";		
		   echo "<h3><b>Huidige teletekst-weergave</b></h3>";
		   echo "<input type=\"text\" name=\"titel\" value=\"".strtoupper($row['publication_title'])."\" size=\"35\" style=\"font-family: monospace;font-size: 10pt; resize: none;\" readonly=\"readonly\" />";
		   
         foreach(explode("#NEWSUBPAGE#", $row['publication_text']) as $value) {
            echo "<textarea name=\"subpages[]\" style=\"font-family: monospace;font-size: 10pt; resize: none; width: 400px; height: 330px; overflow:hidden; background-image: url(backgroundTextArea.png);\" wrap=\"hard\" readonly=\"readonly\" cols=\"45\">".$value."</textarea>";
         }

         echo "<br /><h3><a class=\"loadextradata btn btn-primary\" href=\"editDialog.php?id=".$row['item_id']."\">Bewerk bericht</a></h3>";
         echo "</div>";
	   }			
	   echo "</div>";
      $result->close();
	}
?>