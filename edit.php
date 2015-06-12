<?php

include_once 'dbconfig.php';
include_once 'texthelper.php';

$item_id             =	$_POST['item_id'];
$text                =	$_POST['subpages'];
$category            =	$_POST['item_category'];
$publication_title   =	$_POST['publication_title'];
$broadcast           = 	0;
 
$finalText = "";
$first = true;

foreach($text as $subpaginaText) {
   if($subpaginaText != "") {
      $wrappedText = word_wrap($subpaginaText, 39);
      $tempresult = "";
      $splitted = preg_split("/((\r?\n)|(\r\n?))/", $wrappedText);

      for($i=0; $i<count($splitted); $i++) {		
         $tempresult = $tempresult . $splitted[$i] . "\r\n";
         echo "Regel".sprintf('%02d', $i)." : ".$splitted[$i]. "<br />";

			if($splitted[$i] == " ") echo "leeg";
		}
	
		if(!$first){
			$finalText = $finalText . "#NEWSUBPAGE#";
		}
		$finalText = $finalText . $tempresult;
		$first = false;	
	}
}

if(isset($_POST['broadcast'])){
	$broadcast = 1;
}

$updateItemQuery = "UPDATE items SET publication_text = '".mysqli_real_escape_string($mysqli, $finalText)."', item_checked=1, broadcast=".$broadcast.", publication_title = '".mysqli_real_escape_string($mysqli, $publication_title)."' WHERE item_id = '".$item_id."'";
$result1 = mysqli_query($mysqli, $updateItemQuery) or die(mysqli_error($mysqli));

if($category == "nieuws" || $category == "sport") {
	$updateOptionsQuery = "UPDATE options SET value = 'true' WHERE option_id = 'newsUpdate'";
	mysqli_query($mysqli, $updateOptionsQuery) or die(mysqli_error($mysqli));
}
else if($category == "agenda") {
	$updateOptionsQuery = "UPDATE options SET value = 'true' WHERE option_id = 'agendaUpdate'";
	mysqli_query($mysqli, $updateOptionsQuery) or die(mysqli_error($mysqli));
}

?>