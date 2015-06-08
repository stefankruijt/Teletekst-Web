<!doctype html>

<html lang="en">
<head>

	<title>WOS Teletekst</title>
	<meta charset="UTF-8">
    <?php
      	error_reporting(E_ALL);
      	ini_set('display_errors', '1');
      	date_default_timezone_set('Europe/Amsterdam');
    ?>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-1.8.3.js"></script>
	<script src="jqueryCookie.js"></script>
	<script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	
	<style>
			body { font-size: 62.5%; }
			label, input { display:block; }
			input.text { margin-bottom:12px; width:95%; padding: .4em; }
			fieldset { padding:0; border:0; margin-top:25px; }
			h1 { font-size: 1.2em; margin: .6em 0; }
			div#users-contain { width: 350px; margin: 20px 0; }
			div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
			div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
			.ui-dialog .ui-state-error { padding: .3em; }
			.validateTips { border: 1px solid transparent; padding: 0.3em; }		
			.ui-menu { width: 150px; }
	</style>
	
			<style type="text/css" media="screen">
			@import "css/style.css";
		</style>

		<!-- SimpleTabs -->
		<script type="text/javascript" src="js/simpletabs_1.3.js"></script>
		<style type="text/css" media="screen">
			@import "css/simpletabs.css";
		</style>
	
	<script>
    		$(document).ready(function()
			{
				$("#accordion1, #accordion2, #accordion3").accordion({ collapsible: true, clearStyle: true, fillSpace:false});

    			function updateTips(t) 
    			{
    				tips.text(t).addClass( "ui-state-highlight" );
    				setTimeout(function(){tips.removeClass( "ui-state-highlight", 1500 );}, 500 );
    			}

    			$('.loadextradata').on('click', function() 
    			{
    	    		var url = this.href;
    	    		var dialog = $("#dialog"); // get DOM element
    				if ($("#dialog").length == 0) 
    				{
    	        		dialog = $('<div id="dialog" style="display:hidden"></div>').appendTo('body');
    				}
    						
    				// load remote content
    				dialog.load(url, {}, function(responseText, textStatus, XMLHttpRequest) 
    				{
    					dialog.dialog({height: 600, width:700, title:"Bericht aanpassen", modal: true, position: 'top'});					
    				});
    	    		return false;
    			});
    		});    	    
		</script>
</head>
<body>
	<div class="simpleTabs">
		    <ul class="simpleTabsNavigation">
		      <li><a href="#">Agendaberichten</a></li>
		      <li><a href="#">Nieuwsberichten</a></li>
		      <li><a href="#">Sportberichten</a></li>
		      <li><a href="#">Sport Extra</a></li>
		    </ul>
		    <div class="simpleTabsContent">
		       <?php       		
        			require 'dbconfig.php';
        			include "tabs/agendaTab.php"; 
        		?> 
        		</div>
		    <div class="simpleTabsContent">
		      <div>
		        <div>
		          <div>
		            <div>
		              <?php 
        			require 'dbconfig.php'; 
        			include "tabs/newsTab.php"; 
        		?> </div>
		          </div>
		        </div>
		      </div>
		    </div>
		    <div class="simpleTabsContent">
		     <?php 
        			require 'dbconfig.php';
        			//include "tabs/sportTab.php"; 
        		?>
        	</div>
        	<div class="simpleTabsContent">
		     <?php 
        			require 'dbconfig.php';
        			//include "tabs/sportExtraTab.php"; 
        		?>
        	</div>
		  </div> 
	</body>
</html>