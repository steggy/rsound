#! /usr/bin/php
<?
//lets look for arg
if(sizeof($argv) < 4 && !isset($argv[1]))
{
	echo "usage: " .$argv[0] ." [server ip] [server port] [command] [options]\n";
	die;
}

if(strtolower($argv[1]) == '-h' || strtolower($argv[1]) == '--help')
{
	echo "usage: " .$argv[0] ." [server ip] [server port] [-h] list commands\n";
	die;
}	
	
$host = $argv[1];
$port = $argv[2];

	for($i=3;$i < sizeof($argv); $i++)
	{
		if ($i == 3) 
		{
			$cstring=$argv[$i];
		}else{
			$cstring .= " " .$argv[$i];
		}
	} 
     sendcmd($cstring);

/*switch ($argv[1]) {
    case 'test':
        sendcmd('test');
        break;
    case '-D':
        setsock();
        $GLOBALS['debug'] = false;
        main();
        break;
    default:
        //showusage();
    	echo "thanks for playing\n\n";
    	return;
        break;
}*/


function sendcmd($cmd)
{
	// where is the socket server?
	 
	// open a client connection
	$fp = @fsockopen ($GLOBALS['host'], $GLOBALS['port'], $errno, $errstr);
	 
	if(!is_resource($fp))
	{
	$result = "Error: could not open socket connection \n";
	$result .= "Trying " .$GLOBALS['host'] ." on port " .$GLOBALS['port'] ."\n";
	$result .= "Check that rsnd.php is running on server\n";
	echo $result ."\n";
	}
	else
	{
	// get the welcome message
	//fgets ($fp, 1024);
	// write the user string to the socket
	fputs ($fp, $cmd);
	// get the result
	//$result = fgets ($fp, 100000);
	$result = fread($fp, 100000);
	// close the connection
	fputs ($fp, "exit");
	fclose ($fp);
	 
	// trim the result and remove the starting ?
	//$result = trim($result);
	//$result = substr($result, 2);
	 echo $result ."\n";

	// now print it to the browser
	/*}
	?>
	Server said: <b><? echo $result; ?></b>
	<?*/
	}
}

//*************************************************************************************
function checkinifile()
{

if (!file_exists($GLOBALS['ini_file'])) 
{
	echo "\nERROR:\n";
	echo "Missing config file, expecting rsnd.ini\n";
	echo "With format:\n";
	echo "[server]\nip=127.0.0.1\nport=9000\n\n\n";
	die;
}
}
//*************************************************************************************

//'*******************************************************************************
function readini()
{
$GLOBALS['ini_array'] = parse_ini_file($GLOBALS['ini_file'],true);
}
//'*******************************************************************************


//'*******************************************************************************
function write_ini_file($assoc_arr, $path, $has_sections=TRUE) { 
    $content = ""; 
    if ($has_sections) { 
        foreach ($assoc_arr as $key=>$elem) { 
            $content .= "[".$key."]\n"; 
            foreach ($elem as $key2=>$elem2) { 
                if(is_array($elem2)) 
                { 
                    for($i=0;$i<count($elem2);$i++) 
                    { 
                        $content .= $key2."[] = \"".$elem2[$i]."\"\n"; 
                    } 
                } 
                else if($elem2=="") $content .= $key2." = \n"; 
                else $content .= $key2." = \"".$elem2."\"\n"; 
            } 
        } 
    } 
    else { 
        foreach ($assoc_arr as $key=>$elem) { 
            if(is_array($elem)) 
            { 
                for($i=0;$i<count($elem);$i++) 
                { 
                    $content .= $key2."[] = \"".$elem[$i]."\"\n"; 
                } 
            } 
            else if($elem=="") $content .= $key2." = \n"; 
            else $content .= $key2." = \"".$elem."\"\n"; 
        } 
    } 

    if (!$handle = fopen($path, 'w')) { 
	fclose($handle); 
        return false; 
    } 
    if (!fwrite($handle, $content)) { 
	fclose($handle);         
	return false; 
    } 
	fclose($handle); 
	return true; 
}
//'*******************************************************************************

?>

