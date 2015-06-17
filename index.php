<!doctype html>
<html>
   <head>
      <title>WOS Teletekst</title>

      <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
      <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>      
      <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

      <link rel="stylesheet" href="css/wosteletekst.css">

     <script>
         $(document).ready(function() {

            var icons = {
               header: "ui-icon-circle-arrow-e",
               activeHeader: "ui-icon-circle-arrow-s"
            };

            $(function() {
               $(".accordion").accordion({
                  collapsible: true,
                  icons: icons,
                  heightStyle: "content",
               });
            });

            function updateTips(t) 
          {
               tips.text(t).addClass( "ui-state-highlight" );
               setTimeout(function(){tips.removeClass( "ui-state-highlight", 1500 );}, 500 );
          }

          $('.loadextradata').on('click', function() 
          {
              var url = this.href;
              var dialog = $("#dialog");
            if (dialog.length == 0) 
            {
                  dialog = $('<div id="dialog" style="display:hidden"></div>').appendTo('body');
            }

            dialog.load(url, {}, function(responseText, textStatus, XMLHttpRequest) 
            {
              dialog.dialog({
                     width: 800,
                     title: "Bericht aanpassen", 
                     modal: false, 
                  });         
            });
              return false;
          });
        });         
    </script>
      <script>
         $(document).ready(function() {
            if(location.hash) {
               $('a[href=' + location.hash + ']').tab('show');
            }
            $(document.body).on("click", "a[data-toggle]", function(event) {
               location.hash = this.getAttribute("href");
            });
         });

         $(window).on('popstate', function() {
            var anchor = location.hash || $("a[data-toggle=tab]").first().attr("href");
            $('a[href=' + anchor + ']').tab('show');
         });
    </script>
   </head>
   <body>
       <div class="container-fluid">
         <ul class="nav nav-tabs" id="tabs">
            <li class="active"><a href="#agenda" data-toggle="tab">Agendaberichten</a></li>
            <li><a href="#nieuws" data-toggle="tab">Nieuwsberichten</a></li>
            <li><a href="#sport" data-toggle="tab">Sportberichten</a></li>
            <li><a href="#sportExtra" data-toggle="tab">Sport extra</a></li>
         </ul>

      <div class="tab-content">
         <?php  require 'dbconfig.php'; dbConnect(); ?>
         <div class="tab-pane fade in active" id="agenda">
            <?php           
               $query = "select * from items where item_category='agenda' AND timestamp > '".$date->format('Y-m-d H:i:s')."' order by timestamp limit 100";
               $countUp = 302;
               $maxBroadcast = 100;
               include "tab.php"; 
            ?> 
         </div>
         <div class="tab-pane fade" id="nieuws">
            <?php
               $query = "SELECT * FROM items WHERE item_category='nieuws' ORDER BY timestamp DESC LIMIT 30";
               $countUp = 103;
               $maxBroadcast = 18;
               include "tab.php"; 
            ?>
         </div>
         <div class="tab-pane fade" id="sport">
            <?php
               $query = "SELECT * FROM items WHERE item_category='sport' ORDER BY timestamp DESC LIMIT 20";
               $countUp = 650;
               $maxBroadcast = 5;
               include "tab.php"; 
            ?>
         </div>
         <div class="tab-pane fade" id="sportExtra">
            <?php
               $query = "SELECT * FROM items WHERE item_category='sportExtra'";
               $countUp = 0;
               $maxBroadcast = 0;                
               include "tab.php"; 
            ?>
         </div>
      </div>
      <?php dbClose(); ?>
  </body>
</html>