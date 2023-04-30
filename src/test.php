<!-- <html>
 <head>
 </head>
 <body>
 <h3 id='toupiao'>Please choose your opinion</h3>
<div id="div">
 Good Idea:<input type="radio" name="vote" value="0" onclick="getpiao(this.value)"><br>
 Bad idea:<input type="radio" name="vote" value="1" onclick="getpiao(this.value)"></div>
 <table style='display:none' id="table">
 <tr>
 <td>choose good:</td>
 <td>
    <input style=" height:20px;background-color:red" value="" id="yes"/>%
 </td>
 </tr>
 <tr>
 <td>choose bad:</td>
 <td>
    <input style=" height:20px;background-color:blue" value="" id="no">%
 </td>
 </tr>
 </table>
 <script type="text/javascript" src="jquery-1.8.1.min.js"></script>
 <script>
 function getpiao(int)
 {
    $.post("/toupiao/piao.php",{"piao":int},function(data){
            if(data.yes!="" || data.no!=""){
                var newno = parseInt(data.no);
                var newyes = parseInt(data.yes);
                $('#yes').val((newyes/(newno+newyes)*100).toFixed(2));
                $('#yes').css('width', (newyes/(newno+newyes)*100).toFixed(2)+'px');
                $('#no').val((newno/(newno+newyes)*100).toFixed(2));
                $('#no').css('width', (newno/(newno+newyes)*100).toFixed(2)+'px');
                $('#table').css('display',"block");
                $('#div').css('display',"none");
                $('#toupiao').html('result');
            }
    },"json");
 }
 </script>
 </body>
 </html> -->
 <form>
 <fieldset>
    <legend>Select a maintenance drone:</legend>

    <div>
      <input type="radio" id="huey" name="drone" value="huey"
             checked>
      <label for="huey">Huey</label>
    </div>

    <div>
      <input type="radio" id="dewey" name="drone" value="dewey">
      <label for="dewey">Dewey</label>
    </div>

    <div>
      <input type="radio" id="louie" name="drone" value="louie">
      <label for="louie">Louie</label>
    </div>
    <input type = 'submit'/>
</fieldset>
</form>
