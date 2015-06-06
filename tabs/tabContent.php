<?php
for ($i=0; $i<$num; $i++) 
	{	
		$row = mysql_fetch_assoc ($result);
		$checked = $row['checked'];
			
		$uitzenden = "";
		$broadcast = $row['broadcast'];
		if($broadcast == 0)
		{
			$uitzenden = "<b>Bericht wordt niet uitgezonden!</b>";
		}
		
		$extra = "";
		if($checked==0)
		{
			$extra = "style=\"background:none;background-color:yellow;\"";
		}
		else
		{
			$extra = "style=\"background:none;background-color:lightgreen;\"";
		}	

		$bericht = $row['publication_text'];
		$splitted = explode("#NEWSUBPAGE#", $bericht);
		$arr_size=count($splitted);
					
		echo "<h3 ".$extra.">".$row['publication_title']."\r  ".$uitzenden."</h3>";
		echo "<div>";		
		echo "<h3><b>Huidige teletekst-weergave</b></h3>";
		echo "<input type=\"text\" name=\"titel\" value=\"".strtoupper($row['publication_title'])."\" size=\"35\" style=\"font-family: monospace;font-size: 10pt; resize: none;\" readonly=\"readonly\" />";
		for($j=0; $j<$arr_size; $j++)
		{
			echo "<textarea name=\"subpages[]\" style=\"font-family: monospace;font-size: 10pt; resize: none; width: 400px; height: 330px; background-image: url(backgroundTextArea.png);\" wrap=\"hard\" readonly=\"readonly\" cols=\"45\">".$splitted[$j]."</textarea>";
		}
		
		echo "<br /><h3><a class=\"loadextradata\" href=\"editDialog.php?id=".$row['item_id']."\">Bewerk bericht</a></h3>";
		echo "</div>";
	}			
	echo "</div>";
?>