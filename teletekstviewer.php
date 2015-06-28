<style type="text/css">            
   #teletextFrame {
      position: relative;
   }
   #iframe {
      border-style: none;
      background-color: #FFFFFF;
      position: absolute;
      top: -570px;
      left: 40px;
      width: 391px;
      height: 289px;   
      overflow: hidden;    
    
      zoom: 1.00;
      -moz-transform: scale(1.80);
      -moz-transform-origin: 0 0;
      -o-transform: scale(1.80);
      -o-transform-origin: 0 0;
      -webkit-transform: scale(1.80);
      -webkit-transform-origin: 0 0;
   }
</style>

<script>
   var pagenumber = 100;
</script

<div class="panel panel-primary" style="padding-bottom:5px">
  <div class="panel-heading">
    <h3 class="panel-title">Afstandsbediening</h3>
  </div>
  <div class="panel-body">
    <div class="input-group col-sm-3">
      <input id="pagenumber" type="number" class="form-control" placeholder="Typ hier gewenst paginanummer">
      <span class="input-group-btn">
         <button class="btn btn-default" type="button" onclick="refresh(document.getElementById('pagenumber'));">
            Wijzig pagina
         </button>
      </span>
   </div>
</div>
<div>
   <canvas id="teletekstCanvas" width="800" height="600" style="background-color:#000000"></canvas>
   <div id="teletextFrame">            
      <iframe id="iframe" style="border: none;" src="http://txt.wos.nl/?pagenumber=100&hideheader=1&hidebuttons=1&backcolor=$000000">Browser not compatible.</iframe>
   </div>

   <script>
      var d_names = new Array("zo", "ma", "di", "wo", "do", "vr", "za");
      var m_names = new Array("jan", "feb", "mar", "apr", "mei", "jun", "jul", "aug", "sep", "okt", "nov", "dec");

      var canvas = document.getElementById("teletekstCanvas");
      var context = canvas.getContext("2d");
      loop();
                                
      function writeText(x, y, color, text) {
         context.fillStyle = color;
         context.font = "bold 25px Monospace";
         context.fillText(text, x*25, y*25);
      }
                
      function loop() {
         var currentDate = new Date();
                    
         context.clearRect(0, 0, 800, 25);
                    
         writeText(1,1, "cyan", "P");
         writeText(3,1, "cyan", this.pagenumber);
         writeText(9,1, "yellow", "WOS Media");
         writeText(19,1, "white", d_names[currentDate.getDay()] + " " + currentDate.getDate() + " " 
            + m_names[currentDate.getUTCMonth()]);
         writeText(26,1, "white", getHours(currentDate) + "." + getMinutes(currentDate) + ":" 
            + getSeconds(currentDate));
                    
         writeText(5,5, "yellow", "Loading teletext image....");
                    
         writeText(2,23, "red", "Nieuws");
         writeText(11,23, "green", "Sport");
         writeText(19,23, "yellow", "TV");
         writeText(26,23, "cyan", "Radio");
      }
      setInterval(loop, 1000);

      function getHours(date) {
         var hours = date.getHours();
         return hours < 10 ? '0' + hours : '' + hours;
      }

      function getMinutes(date) {
         var minutes = date.getMinutes();
         return minutes < 10 ? '0' + minutes : '' + minutes;
      }   

      function getSeconds(date) {
         var seconds = date.getSeconds();
         return seconds < 10 ? '0' + seconds : '' + seconds;
      }   

      function refresh(pagenumber) {
         console.log("Time for a refresh of page: " + pagenumber.value);
         this.pagenumber = pagenumber.value;
         var url = "http://txt.wos.nl/?pagenumber="+this.pagenumber+"&hideheader=1&hidebuttons=1&backcolor=$000000";
         var element = document.getElementById('iframe');
         element.setAttribute("src",url)
      }       
   </script> 
</div>