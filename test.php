<?php

$regNo="CMT6/KLS/16/01";

	 //Check if user exist
	 $curl = curl_init();

     //Set some options/settings
     curl_setopt_array($curl, array(
     CURLOPT_RETURNTRANSFER => 1,
     CURLOPT_URL =>'http://tiis.go.tz/training/api2/index.php/nacte_graduates_tbl',
		
     CURLOPT_USERAGENT => 'TIIS to WAO cURL Request'
      ));
        
       // Send the request & save response to $resp(JSON string)
        if(!curl_exec($curl)){ 
        die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
        }else{
	    $json_resp = curl_exec($curl);
        }

      //Close request to clear up some resources
      curl_close($curl);

      // Convert JSON string to Array
      $institutionArray = json_decode($json_resp, true);
		

	  
	  foreach ($institutionArray as $key => $value) {
			echo "-".$value['graduate_id']."<br/>";
      }