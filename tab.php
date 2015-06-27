<div id="accordion" class="accordion">

<?php
   $pagenumberText = ($countUp > 0) ? $countUp : "";
   $i = 0;
   if ($result = $mysqli->query($query)) {
      while ($message = $result->fetch_assoc()) {
         $extraText = ($message['broadcast'] == 0) ? "<b>Bericht wordt niet uitgezonden!</b>" : "";
         $extraStyling = ($message['item_checked']==0) ?  "style=\"background:none;background-color:yellow;\"" : "style=\"background:none;background-color:lightgreen;\"";
         
         if($i>($maxBroadcast-1) || $message['broadcast'] == 0) {
            $extratext = "";
         }
         else {
            $extratext = $pagenumberText;
            $pagenumberText++;
         }

         echo "<h3 ".$extraStyling."><b>".$extratext."</b> : ".$message['publication_title']."\r  ".$extraText."</h3>";
 
         ?>
         <div>
            <div class="panel panel-info">
               <div class="panel-heading">
                  <h3 class="panel-title">Huidige teletekst weergave</h3>
               </div>
               <div class="panel-body">
                  <div class="col-sm-12" style="padding-left:0px; padding-bottom:5px">
                     <input type="text" class="form-control" id="timestamp" name="timestamp" 
                        value="<?php echo strtoupper($message['publication_title']) ?>" readonly>
                  </div>
                  
                  <div class="col-sm-12" style="padding-left:0px; padding-bottom:5px">
                     <?php
                        foreach(explode("#NEWSUBPAGE#", $message['publication_text']) as $value) {
                           echo "<textarea name=\"subpages[]\" style=\"font-family: monospace; font-size: 10pt; 
                           resize: none; background:#CBFFB3; overflow:hidden;\" wrap=\"hard\" 
                           readonly=\"readonly\" cols=\"39\" rows=\"19\">".$value."</textarea>";
                        }
                     ?>

                     <div class="col-sm-12" style="padding-left:0px">
                        <a class="loadextradata btn btn-default" href="editDialog.php?id=<?php echo $message['item_id'] ?>">
                           <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>Bewerk bericht
                        </a>
                     </div>
                  </div>   
               </div>
            </div>
         </div>
         <?php
         $i++;
      }        
   }
?>
</div>