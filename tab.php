<?php
   $pagenumberText = ($countUp > 0) ? $countUp : "";
   $i = 0;
   if ($result = $mysqli->query($query)) {
      echo "<div id=\"accordion\" class=\"accordion\">";
      while ($row = $result->fetch_assoc()) {
         $extraText = ($row['broadcast'] == 0) ? "<b>Bericht wordt niet uitgezonden!</b>" : "";
         $extraStyling = ($row['item_checked']==0) ?  "style=\"background:none;background-color:yellow;\"" : "style=\"background:none;background-color:lightgreen;\"";
         
         if($i>($maxBroadcast-1) || $row['broadcast'] == 0) {
            $extratext = "";
         }
         else {
            $extratext = $pagenumberText;
            $pagenumberText++;
         }

         echo "<h3 ".$extraStyling."><b>".$extratext."</b> : ".$row['publication_title']."\r  ".$extraText."</h3>";
         echo "<div>";     
         ?>
            <div class="panel panel-info">
               <div class="panel-heading">
                  <h3 class="panel-title">Huidige teletekst weergave</h3>
               </div>
               <div class="panel-body">
                  <?php
         echo "<input type=\"text\" name=\"titel\" value=\"".strtoupper($row['publication_title'])."\" size=\"35\" style=\"font-family: monospace;font-size: 10pt; resize: none;\" readonly=\"readonly\" />";
         
         foreach(explode("#NEWSUBPAGE#", $row['publication_text']) as $value) {
                echo "<textarea name=\"subpages[]\" style=\"font-family: monospace; font-size: 10pt; resize: none; background:#CBFFB3; overflow:hidden;\" wrap=\"hard\" readonly=\"readonly\" cols=\"39\" rows=\"19\">".$value."</textarea>";}

         echo "<br />
                  <a class=\"loadextradata btn btn-default\" href=\"editDialog.php?id=".$row['item_id']."\">
                  <span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span>
                  Bewerk bericht</a>";
         echo "</div>";
         ?>
               </div>
            </div>
         <?php
         $i++;
      }        
      echo "</div>";
   }
?>