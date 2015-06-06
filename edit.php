<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once 'dbconfig.php';
include_once 'texthelper.php';

$item_id			=	$_POST['item_id'];
$text				=	$_POST['subpages'];
$category			=	$_POST['item_category'];
$publication_title	=	$_POST['publication_title'];
$broadcast			= 	0;
 
$finalText = "";
$first = true;

foreach($text as $subpaginaText)
{
	if($subpaginaText != "")
	{
		$wrappedText = word_wrap($subpaginaText, 39);
	
		$tempresult = "";
		$splitted = preg_split("/((\r?\n)|(\r\n?))/", $wrappedText);
		for($i=0; $i<count($splitted); $i++)
		{		
			$tempresult = $tempresult . $splitted[$i] . "\r\n";
			echo "Regel".$i.":".$splitted[$i]. "<br />";
			if($splitted[$i] == " ") echo "leeg";
		}
	
		if($first==false)
		{
			$finalText = $finalText . "#NEWSUBPAGE#";
		}
		$finalText = $finalText . $tempresult;
		$first = false;	
	}
}

if(isset($_POST['broadcast']))
{
	$broadcast = 1;
}

$updateItemQuery = "UPDATE items SET publication_text = '".mysql_real_escape_string($finalText)."', checked=1, broadcast=".$broadcast.", publication_title = '".mysql_real_escape_string($publication_title)."' WHERE item_id = '".$item_id."'";
$result1 = mysql_query($updateItemQuery) or die(mysql_error());

if($category == "nieuws" || $category == "sport")
{
	$updateOptionsQuery = "UPDATE options SET value = 'true' WHERE option_id = 'newsUpdate'";
	mysql_query($updateOptionsQuery) or die(mysql_error());
}
else if($category == "agenda")
{
	$updateOptionsQuery = "UPDATE options SET value = 'true' WHERE option_id = 'agendaUpdate'";
	mysql_query($updateOptionsQuery) or die(mysql_error());
}

echo "Bericht is gewijzigd en opgeslagen.";
?>