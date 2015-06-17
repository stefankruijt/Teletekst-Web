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
   });
</script>

<?php 
   include("dbconfig.php");
   $query = "SELECT * FROM items WHERE item_id = '".mysqli_real_escape_string($mysqli, $_GET['id'])."'";
   if ($result = $mysqli->query($query)) {
      
      $row = $row = $result->fetch_assoc();
      $bericht = $row['publication_text'];
      $extraStyling = ($row['broadcast']==1) ? "checked=\"checked\"" : "";
      $splitted = explode("#NEWSUBPAGE#", $bericht);
   
      echo "<form id=\"editMessageForm\" action=\"edit.php\" method=\"post\">
      <input type=\"hidden\" name=\"item_id\" value=".$row['item_id'].">
      <input type=\"hidden\" name=\"item_category\" value=".$row['item_category'].">
      Website-titel: <br /><input type=\"website_title\" name=\"website_title\" value=\"".$row['original_title']."\" readonly size=\"80\" />
      Teletekst-titel: <br /><input type=\"publication_title\" name=\"publication_title\" value=\"".$row['publication_title']."\" style=\"font-family: monospace;font-size: 10pt; resize: none; \" maxlength=\"35\" size=\"35\" wrap=\"hard\" />
      Datum: <br /><input type=\"timestamp\" name=\"timestamp\" value=\"".strtoupper($row['timestamp'])."\" wrap=\"hard\" readonly=\"readonly\"/>
      Uitzenden<input type=\"checkbox\" name=\"broadcast\"".$extraStyling.">
      Bericht: <br /><div id=\"subpages\">";
   
      $arr_size=count($splitted);
      for($i=0; $i<$arr_size; $i++) {
         echo "<textarea name=\"subpages[]\" cols=\"39\" wrap=\"hard\" style=\"font-family: monospace;font-size: 10pt; resize: none; border: 1px solid #808080; height: 330px; overflow:hidden; background-image: url(backgroundTextArea.png) \">".$splitted[$i]."</textarea>";
      }
   
      echo  "</div>
               <button type=\"button\" class=\"btn btn-default\" value=\"Extra subpagina toevoegen\" onClick=\"addExtraSubPageTextarea()\">
                  <span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span>
                  Extra subpagina toevoegen
               </button>
               <button type=\"submit\" class=\"btn btn-primary\" value=\"Opslaan\">
                  <span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>
                  Opslaan
               </button>
             </form>";
   
      echo "<div id=\"message_ajax\"></div>";
   }
   $mysqli->close();
?>