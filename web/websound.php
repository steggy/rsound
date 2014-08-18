<?

?>

<html>
<head>
	<title>Remote Sound</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<script src="jquery.min.js"></script>

        <script type="text/javascript">
            //For Ajax call
            function mm(){ 
		     var selects = document.getElementById("p350");
			//var red = document.getElementById("red");
			//var green = document.getElementById("green");
			//var blue = document.getElementById("blue");
		     var vv = selects.options[selects.selectedIndex].value;
		     //var rr = red.options[red.selectedIndex].value;
		     //var gg = red.options[green.selectedIndex].value;
		     //var bb = red.options[blue.selectedIndex].value;
                 //alert('This is vv: ' + vv);
                $.ajax({
                    type: "POST",
                    url: "websndclient.php",
                    data: "ss="+vv,
                    success:function(data){
                        //alert('This was sent back: ' + data);
                        //Next line adds the data from PHP into the DOM
                        //$('#div1').html(data);
                        //document.getElementById("button"+zone).background-color="green";
                        //s = data.responsetext;
                        /*var myarray = data.split(",");				
                        $('#div1').html(myarray[0]);
                        document.getElementById('button1').style.backgroundColor=myarray[1];
                        document.getElementById('button2').style.backgroundColor=myarray[2];
                        document.getElementById('button3').style.backgroundColor=myarray[3];
                        document.getElementById('button4').style.backgroundColor=myarray[4];*/
                    }
                    });
                }
            function ww(ss){
                 //alert('This is vv: ' + vv);
                $.ajax({
                    type: "POST",
                    url: "websndclient.php",
                    data: "ww="+ss,
                    success:function(data){
                        var myarray = data.split(",");				
                        $('#div1').html(myarray[0]);
                        //var x = document.getElementById('p350');
                        //var option = document.createElement('option');
                        //var i
                        //for (i = 0; i < myarray.length; ++i) {
                        //// Append the element to the end of Array list
                        //dropdown[dropdown.length] = new Option(myarray[i],myarray[i]);
                        //option.text = myarray[i];
                        //x.add(option,x[i]);
                        //}​
                        
                        var select = document.getElementById('p350');
                        //var options = ["Asian", "Black"];
                        var i;
                        for (i = 0; i < myarray.length; i++) {
                            var opt = myarray[i];
                            var el = document.createElement("option");
                            el.textContent = opt;
                            el.value = i;
                            select.appendChild(el);
                        }


                        //document.getElementById('button1').style.backgroundColor=myarray[1];
                        //document.getElementById('button2').style.backgroundColor=myarray[2];
                        //document.getElementById('button3').style.backgroundColor=myarray[3];
                        //document.getElementById('button4').style.backgroundColor=myarray[4];
                    }
                    });
                }    
        </script>
        <style>
        input[type=submit] 
        {
        border: 1px solid #5C755E;
        border-radius: 6px;
        box-shadow: 5px 5px 3px #888;
        }

        button
        {
        border: 1px solid #5C755E;
        border-radius: 6px;
        box-shadow: 5px 5px 3px #888;
        font-size:20px;
        }
        </style>
        <script type="text/javascript">

        </script>
</head>
<body onload="ww('status');" bgcolor=#F7DCB4>
	<div id=divss style="width:300px;background-color:#9C9F84;border: 1px solid #5C755E;
	padding: 1em;
	border-radius: 10px;
	box-shadow: 5px 5px 3px #888;">
        <span style="font-size:1em;">Halloween Sound Player</span>
		<div id=div1 style="background-color:yellow;width:200px;">&nbsp;</div>
        <!--<form action="<?=$_SERVER['REQUEST_URI'];?>" method="get">-->
        <select name=playit id='p350'></select>
        <!--<input type=submit onclick="mm()">
    </form>-->
        <br><br>
		<button id="button1" style=width:172px;height:55px;background-color:red; onclick="mm()">Play</button>
		
		<br><br>
		<button id="button4" style=width:72px;height:55px; onclick="ww('status')">Status</button>
        <br><br>
        <form action="sprinksched.php" method=post>
            <input type=submit value="Schedule">
        </form>
	</div>
</body>
</html>