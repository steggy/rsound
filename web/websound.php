<?

?>

<html>
<head>
	<title>Remote Sound</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="websound.css" />
	<script src="jquery.min.js"></script>

        <script type="text/javascript">
            function addDays(theDate, days) 
            {
                return new Date(theDate.getTime() + days*24*60*60*1000);
            }
            //var newDate = addDays(new Date(), 5);

            //For Ajax call
            function mm(ii){ 
		     var selects = document.getElementById('p350'+ii);
			//var red = document.getElementById("red");
			//var green = document.getElementById("green");
			//var blue = document.getElementById("blue");
		     var vv = selects.options[selects.selectedIndex].value;
		     //var rr = red.options[red.selectedIndex].value;
		     //var gg = red.options[green.selectedIndex].value;
		     //var bb = red.options[blue.selectedIndex].value;
             if(document.getElementById('serverip'+ii).value == "")
                    {
                        $('#div'+ii).html("SERVER ERROR");
                        return;
                    }
                    var sip = document.getElementById('serverip'+ii).value;
                    var newDate = addDays(new Date(), 15);
                    document.cookie="server"+ii+"="+sip+"; expires="+newDate+";";
                 //alert('This is vv: ' + vv);
                $.ajax({
                    type: "POST",
                    url: "websndclient.php",
                    data: "ss="+vv+"&si="+sip,
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
                 if(document.getElementById('serverip'+ss).value == "")
                    {
                        $('#div'+ss).html("SERVER ERROR");
                        return;
                    }
                    var sip = document.getElementById('serverip'+ss).value;
                    var newDate = addDays(new Date(), 15);
                    document.cookie="server"+ss+"="+sip+"; expires="+newDate+";";
                $.ajax({
                    type: "POST",
                    url: "websndclient.php",
                    data: "ww="+ss+"&si="+sip,
                    success:function(data){
                        var myarray = data.split(",");				
                        $('#div'+ss).html(myarray[0]);
                        //var x = document.getElementById('p350');
                        //var option = document.createElement('option');
                        //var i
                        //for (i = 0; i < myarray.length; ++i) {
                        //// Append the element to the end of Array list
                        //dropdown[dropdown.length] = new Option(myarray[i],myarray[i]);
                        //option.text = myarray[i];
                        //x.add(option,x[i]);
                        //}​
                        
                        var select = document.getElementById('p350'+ss);
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
<!--<body onload="ww('status');" bgcolor=#F7DCB4>-->
<body bgcolor=#F7DCB4>
	<?
    for ($i = 1; $i < 7; $i++)
    {
        ?>
    <div id=divss>
        <span style="font-size:1em;">Halloween Sound Player</span>
		<div class="divdiv" id="div<?=$i;?>">&nbsp;</div>
        <!--<form action="<?=$_SERVER['REQUEST_URI'];?>" method="get">-->
        <select name=playit id='p350<?=$i;?>' size="4"></select>
        <!--<input type=submit onclick="mm()">
    </form>-->
        <br><br>
		<button id="button1" onclick="mm('<?=$i;?>')">Play</button>
		
		<br><br>
		<button id="button4" onclick="ww('<?=$i;?>')">Status</button>
        <br><br>
        <?
        if (isset($_COOKIE["server" .$i])) 
        {
            $ssip = $_COOKIE["server" .$i];
        }else{
            $ssip ='';
        }
        ?>
        Server IP <input name="serverip<?=$i;?>" id="serverip<?=$i;?>" type=text value="<?=$ssip;?>">
	</div>
    <?
        if($i % 3 == 0)
        {
            echo "<br>";
        }
    }
    ?>
</body>
</html>