<script language="javascript">
   function addExtraSubPageTextarea() {
      var newdiv = document.createElement('div');
      newdiv.innerHTML = "<textarea name=\"subpages[]\" cols=\"39\" wrap=\"hard\" style=\"font-family: monospace;font-size: 10pt; resize: none; border: 1px solid #808080; height: 330px; overflow:hidden; background-image: url(backgroundTextArea.png) \"></textarea>";
      document.getElementById("subpages").appendChild(newdiv);
   }

   $(document).ready(function() {
      $("#editMessageForm").submit( function () {    
         $.post('edit.php', $(this).serialize(), function(data) { 
            $("#editMessageForm").html(data)
         });
         $('#dialog').dialog("close");
         window.setTimeout(function(){location.reload(true)}, 900)
         return false;
      });

      $('#publication_title').maxlength({
         alwaysShow: true,
         validate: true,
         allowOverMax: false
      });
   });
</script>

<?php 
   include("dbconfig.php");
   $query = "SELECT * FROM items WHERE item_id = '".mysqli_real_escape_string($mysqli, $_GET['id'])."'";
   if ($result = $mysqli->query($query)) {
      $mysqli->close();
      $row = $row = $result->fetch_assoc();
      $bericht = $row['publication_text'];
      $extraStyling = ($row['broadcast']==1) ? "checked=\"checked\"" : "";
      $splitted = explode("#NEWSUBPAGE#", $bericht);
      ?>

      <form class="form-horizontal" id="editMessageForm" action="edit.php" method="post">
         <input type="hidden" name="item_id" 
            value="<?php echo $row['item_id']?>">
         
         <input type="hidden" name="item_category" 
            value="<?php echo $row['item_category']?>">
         
         <div class="form-group">
            <label for="website_title" class="col-sm-3 control-label">Website titel</label>
            <div class="col-sm-7">
               <input type="text" class="form-control" id="website_title" name="website_title" 
                      value="<?php echo $row['original_title']?>" readonly>
            </div>
         </div>

         <div class="form-group">
            <label for="publication_title" class="col-sm-3 control-label">Teletekst titel</label>
            <div class="col-sm-7">
               <input type="text" class="form-control" id="publication_title" name="publication_title" 
                      value="<?php echo $row['publication_title']?>"
                      maxlength="35" size="35" wrap="hard" 
                      style="font-family: monospace;font-size: 10pt; resize: none" required>
            </div>
         </div>
         
         <div class="form-group">
            <label for="timestamp" class="col-sm-3 control-label">Datum</label>
            <div class="col-sm-7">
               <input type="text" class="form-control" id="timestamp" name="timestamp" 
                      value="<?php echo strtoupper($row['timestamp']) ?>" readonly>
            </div>
         </div>

         <div class="form-group">
            <label for="broadcast" class="col-sm-3 control-label">Uitzenden</label>
            <div class="col-sm-1">
               <input type="checkbox" class="form-control" id="broadcast" name="broadcast" 
                  <?php echo $extraStyling; ?> readonly>
            </div>
         </div>
    
         <span class="label label-default">Teletekst pagina's</span>

         <div id="subpages">      
            <?php
               $arr_size=count($splitted);
               for($i=0; $i<$arr_size; $i++) {
                  echo "<textarea name=\"subpages[]\" cols=\"39\" wrap=\"hard\" 
                  style=\"font-family: monospace;font-size: 10pt; resize: none; border: 1px solid #808080; 
                  height: 330px; overflow:hidden; background-image: url(backgroundTextArea.png) \">".
                  $splitted[$i]."</textarea>";
               }
            ?>
         </div>
         
         <button type="button" class="btn btn-default" value="Extra subpagina toevoegen" onClick="addExtraSubPageTextarea()">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            Extra subpagina toevoegen
         </button>
         <button type="submit" class="btn btn-primary" value="Opslaan">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            Opslaan
         </button>
      </form>
      <?php
   }
?>