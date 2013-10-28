<?php

require_once('soap/russianpost.lib.php');


    //init the client
    $client = new RussianPostAPI();
    include_once("cfg.php");

    // Получаем запросом все посылки, которые актуальны
    $sql = "SELECT track_id,title,last_state FROM products WHERE disabled=0";
    $res = mysql_query($sql);

    while ($row=mysql_fetch_assoc($res))
    {
        //fetch info
        $code = $row['track_id'];

	 try {
        $track = $client->getOperationHistory($code);
        $last_state=$track[sizeof($track)-1];
        $date=date('d.m.Y H:i:s',strtotime($last_state->operationDate));

        $stat = $date."<br>".$last_state->operationPlaceName." ".$last_state->operationPlacePostalCode."<br>(".$last_state->operationType.")<BR>".$last_state->operationAttribute;
	 
	 if(strpos($stat,'Красноярск'))
        {
            if (strpos($stat,'Прибыло в место вручения'))
                $stat.= "<br><img src='i/panda1.gif'>";
            else
                $stat.= "<br><img src='i/dance.gif'>";
        }	

        $sql = "UPDATE products SET last_state='$stat',date_upd=ADDDATE(NOW(),INTERVAL 8 HOUR) WHERE track_id='$code'";
        mysql_query($sql);
		

        if(strcmp($stat,$row['last_state'])!=0)
        {
            $title = substr($row['title'], 0, 50);
            $sms_text = $code." ($title) status izmenilsa";
            //$body=file_get_contents("http://sms.ru/sms/send?from=PandaTrack&api_id=ea4d1f4f-2a3f-1364-45ad-294dd9a6531d&to=79233359923&text=".urlencode($sms_text));
        }
	
	} catch(RussianPostException $e) {
	    print 'Оишбка: ' . $e->getMessage();
	}


     }
?>