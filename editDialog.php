<script language="javascript">
	function addExtraSubPageTextarea()
	{
		var newdiv = document.createElement('div');
		newdiv.innerHTML = "<textarea name=\"subpages[]\" cols=\"39\" wrap=\"hard\" style=\"font-family: monospace;font-size: 10pt; resize: none; border: 1px solid #808080; height: 330px; overflow:hidden; background-image: url(backgroundTextArea.png) \"></textarea>";
		document.getElementById("subpages").appendChild(newdiv);
	}

	$(document).ready(function()
	{
		$("#editMessageForm").submit( function ()
		{    
			$.post('edit.php', $(this).serialize(), function(data)
			{ 
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
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	$id = $_GET['id'];
	$result = mysql_query("SELECT * FROM items WHERE item_id = '".mysql_real_escape_string($id)."'"); 
	$row = mysql_fetch_assoc($result);

	$bericht = $row['publication_text'];
	$check = "";
	$broadcast = $row['broadcast'];
	
	if($broadcast==1)
	{
		$check = "checked=\"checked\"";
	}
	
	$splitted = explode("#NEWSUBPAGE#", $bericht);
	
	echo "<form id=\"editMessageForm\" action=\"edit.php\" method=\"post\">
	<input type=\"hidden\" name=\"item_id\" value=".$row['item_id'].">
	<input type=\"hidden\" name=\"item_category\" value=".$row['item_category'].">
	Website-titel: <br /><input type=\"website_title\" name=\"website_title\" value=\"".$row['original_title']."\" readonly size=\"80\" />
	Teletekst-titel: <br /><input type=\"publication_title\" name=\"publication_title\" value=\"".$row['publication_title']."\" style=\"font-family: monospace;font-size: 10pt; resize: none; \" maxlength=\"35\" size=\"35\" wrap=\"hard\" />
	Datum: <br /><input type=\"timestamp\" name=\"timestamp\" value=\"".strtoupper($row['timestamp'])."\" wrap=\"hard\" readonly=\"readonly\"/>
 	Uitzenden<input type=\"checkbox\" name=\"broadcast\"".$check.">
	Bericht: <br /><div id=\"subpages\">";
	
	$arr_size=count($splitted);
	for($i=0; $i<$arr_size; $i++)
	{
		echo "<textarea name=\"subpages[]\" cols=\"39\" wrap=\"hard\" style=\"font-family: monospace;font-size: 10pt; resize: none; border: 1px solid #808080; height: 330px; overflow:hidden; background-image: url(backgroundTextArea.png) \">".$splitted[$i]."</textarea>";
	}
	
	echo  "</div><input type=\"button\" value=\"Extra subpagina toevoegen\" onClick=\"addExtraSubPageTextarea()\"><input type=\"submit\" value=\"Opslaan\" />
			</form>";
	
	echo "<div id=\"message_ajax\"></div>";
	
	mysql_close();
?>