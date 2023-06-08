<?php
//Connect to database
//Written by EnterSoft Systems
//Year 2017
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();

require '../PHPMailer/PHPMailerAutoload.php';

///Login
if (isset($_POST['loginButton'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db->login($username, $password);
}
//Forgot Password
if (isset($_POST['forgotPasswordButton'])) {
    $email = $_POST['email'];

    $checkEmail = $db->checkEmailIfExist($email);
    if ($checkEmail->rowCount() > 0) {
        $rw = $checkEmail->fetch();
        $userid = $rw['user_id'];
        $keyGen = $rw['keyGen'];
        $username = $rw['username'];

        //Send Email
        $emailAddress = $email;
        $sendTo = array();
        $sendTo[] = "sirmido4@gmail.com";
        $sendTo[] = $emailAddress;

        $from = "info@mct.go.tz";
        $headers = 'From:info@tiis.go.tz';
        $url = "http://tiis.go.tz/wao_v4/login/changepassword.php?keygen=" . $keyGen; //Change login url
        $subject = "Notification from WAO Application";
        $msg = "Hellow" . ' ' . addslashes(ucwords(strtolower($username))) . ",<br/><br/>
         Someone requested to change your WAO password. Follow the link below so as to change your password.
		 <br/><br/>
		 <a href=" . $url . ">Click here to change your password</a><br/><br/>
         
         Thank You<br/><br/>
         ";

        /* foreach($sendTo as $email)
         {
          mail($email,$subject,$msg,$headers);//send email
          $confirm="Notification to WAO";
	     } */

        foreach ($sendTo as $email) {
            $mail = new PHPMailer();
            $mail->IsSMTP();                        // set mailer to use SMTP
            $mail->Host = "xterra.websitewelcome.com";         // specify main and backup server
            $mail->SMTPAuth = true;        // turn on SMTP authentication
            $mail->Username = 'noreply@tiis.go.tz';    // SMTP username
            $mail->Password = 'medel2018';    // SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->From = 'info@tiis.go.tz';

            $GLOBEmailOn = true;


            $mail->FromName = $headers;
            $mail->AddAddress($email, $name);
            $mail->AddReplyTo('info@tiis.go.tz');
            $mail->IsHTML(true);                    // set email format to HTML
            $mail->WordWrap = 100;                   // set word wrap to 50 characters

            $mail->Subject = $subject;
            $mail->Body = $msg;

            $mail->Body = $mail->Body;

            if ($GLOBEmailOn == true) {
                // attempt to send the email
                $mail->Send();
            }
        }

        echo '<script language="javascript">';
        echo 'alert("Email with a link to change password is sent to your email. Open your email so as to change password")';
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../login/forgotpassword.php"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: No such email in our database.')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../login/forgotpassword.php"';
        echo '</script>';
    }
}
//Password Reset
if (isset($_POST['passResetButton'])) {
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    $key = $_POST['key'];

    //Check if password match
    if ($password != $password1) {
        echo '<script language="javascript">';
        echo "alert('Error: Passwords do not match')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../login/changepassword.php?keygen=' . $key . '"';
        echo '</script>';
    } else {
        $changeP = $db->changePassword($password, $key);
        if (isset($changeP)) {
            echo '<script language="javascript">';
            echo "alert('Password changed sucessfully, now you can log in')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../login/"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo "alert('Error: Password not changed')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../login/changepassword.php"';
            echo '</script>';
        }
    }
}


//Change Applicant Password
if (isset($_POST['passChangeButton'])) {
    $password = md5($_POST['password']);
    $user = $_SESSION['userid'];
    $NewPassword = md5($_POST['NewPassword']);
    $ConfirmPassword = md5($_POST['ConfirmPassword']);

    // echo $user;exit;

    //Check if password match
    if ($NewPassword != $ConfirmPassword) {
        echo '<script language="javascript">';
        echo "alert('Error: New Password and Confirm Password Field do not match  !!')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href ="../?pg=changePassword"';
        echo '</script>';
    }
    //Check if password exist
    $checkPassword = $db->ApplicantChangePassword($password, $user);
    // $row=$checkPassword->fetch();

    if ($checkPassword->rowCount() > 0) {
        $updatePassword = $db->ApplicantUpdatePassword($NewPassword, $user);
        if ($updatePassword) {
            echo '<script language="javascript">';
            echo "alert('Password changed sucessfully')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=changePassword"';
            echo '</script>';
        }
    } else {
        echo '<script language="javascript">';
        echo "alert('Old Password not match')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=changePassword"';
        echo '</script>';
    }
}


//////////////////////////////////////////
/////PROCESSING USER DETAILS/////////////
//////////////////////////////////////////
//AddEducation
///PART 1: Add new user//////////////////
elseif(isset($_POST['AddEducation'])) {
	$aina = $_POST['aina'];
    $kiwango = $_POST['kiwangoo']; 
    $chuo = $_POST['school'];
    $mwaka = $_POST['year'];
	$maelezo = $_POST['maelezo'];
	$ubunge_id = $_POST['idd'];
	$Insert = $db->addUbungeEdu($aina, $kiwango,$chuo,$mwaka,$maelezo,$ubunge_id);
	if (isset($Insert)) {
            echo '<script language="javascript">';
            echo "alert('Utambulisho umeingia vyema')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bEd"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo "alert('Error: Samahani taarifa za elimu hazikuingia')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bEd"';
            echo '</script>';
        }	 
}
elseif(isset($_POST['EditEducation'])) {
	$aina = $_POST['aina'];
    $kiwango = $_POST['kiwangoo']; 
    $chuo = $_POST['school'];
    $mwaka = $_POST['year'];
	$maelezo = $_POST['maelezo'];
	$ubunge_id = $_POST['idd'];
	$Insert = $db->EditUbungeEdu($aina, $kiwango,$chuo,$mwaka,$maelezo,$ubunge_id);
	if (isset($Insert)) {
            echo '<script language="javascript">';
            echo "alert('Utambulisho umeingia vyema')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bEd"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo "alert('Error: Samahani taarifa za elimu hazikuingia')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bEd"';
            echo '</script>';
        }	 
}
elseif (isset($_POST['AddUbunge'])) {
    
    $first = $_POST['first'];
    $middle = $_POST['middle'];
    $last = $_POST['lastname'];
    $nafasi = $_POST['nafasi'];
	
    $simu = $_POST['simu'];
    $email = $_POST['email'];
    $fedha = $_POST['fedha'];
    $control = $_POST['controli'];
    $maomkoa = $_POST['region_id'];
	$maowilaya = $_POST['wilaya'];
	if($nafasi=="Udiwani")
	{
		$maojimbo = $_POST['kata'];
	}
	else{
    $maojimbo = $_POST['jimbo'];}
	
    $year = $_POST['year'];
    $month = $_POST['month'];
    $days = $_POST['day'];
	$monthG=explode('=',$month);
    $m=$monthG[0];

    $date=$year."-".$m."-".$days;
	//$date=$year."-".$month."-". $days;
	
    $zmgmkoa = $_POST['mkoa'];
    $zmgmtaa = $_POST['mtaa'];//
	$zmgwilaya = $_POST['wilaya_kuza'];
	
	$baba = $_POST['baba'];
    $mkoababa = $_POST['mkoababa'];
    $mtaababa = $_POST['mtaababa'];
    $kuzaliwababa = $_POST['kuzaliwababa'];//date
    $wilayababa = $_POST['wilaya_baba'];
	
    $mama = $_POST['mama'];
    $mkoamama = $_POST['mkoamama'];
    $wilayamama = $_POST['wilaya_mama'];
    $mtaamama = $_POST['mtaamama'];
    $kuzaliwamama = $_POST['kuzaliwamama'];
	
	$uraia = $_POST['national'];
    $ainauraia = $_POST['ainauraia'];
	$mkoaishi = $_POST['mkoaishi'];
    $mtaaishi = $_POST['mtaaishi'];
    $wilayaishi = $_POST['wilayaishi'];
	$hati=$_POST['kuandikishwahati'];
    $userid = $_SESSION['userid'];
	$nida = $_POST['nida'];
   $Insert = $db->addUbunge($first,$middle,$last,$nafasi,$maojimbo,$maowilaya,
   $maomkoa,$date,$zmgmkoa,$zmgwilaya,$zmgmtaa,$baba, $kuzaliwababa, $mkoababa, 
   $wilayababa, $mtaababa,$mama,$mkoamama,$wilayamama,$mtaamama,
	 $kuzaliwamama, $mkoaishi, $wilayaishi, $mtaaishi, $uraia,$ainauraia,$hati,$userid,
	 $simu,$email,$fedha,$control,$nida);
if (isset($Insert)) {
            echo '<script language="javascript">';
            echo "alert('Utambulisho umeingia vyema')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=pDetailUtambulisho"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo "alert('Error: Samahani utambulisho haukuingia')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=pDetailUtambulisho"';
            echo '</script>';
        }	 
  
}

elseif (isset($_POST['EditUbunge'])) {
    
    $first = $_POST['first'];
    $middle = $_POST['middle'];
    $last = $_POST['lastname'];
    $nafasi = $_POST['nafasi'];
	
    $simu = $_POST['simu'];
    $email = $_POST['email'];
    $fedha = $_POST['fedha'];
    $control = $_POST['control'];
    $maomkoa = $_POST['region_id'];
	$maowilaya = $_POST['wilaya'];
	if($nafasi=="Udiwani")
	{
		$maojimbo = $_POST['kata'];
	}
	else{
    $maojimbo = $_POST['jimbo'];}
	
    $year = $_POST['year'];
    $month = $_POST['month'];
    $days = $_POST['day'];
	$monthG=explode('=',$month);
    $m=$monthG[0];

    $date=$year."-".$m."-".$days;
	//$date=$year."-".$month."-". $days;
	
    $zmgmkoa = $_POST['mkoa'];
    $zmgmtaa = $_POST['mtaa'];//
	$zmgwilaya = $_POST['wilaya_kuza'];
	
	$baba = $_POST['baba'];
    $mkoababa = $_POST['mkoababa'];
    $mtaababa = $_POST['mtaababa'];
    $kuzaliwababa = $_POST['kuzaliwababa'];//date
    $wilayababa = $_POST['wilaya_baba'];
	
    $mama = $_POST['mama'];
    $mkoamama = $_POST['mkoamama'];
    $wilayamama = $_POST['wilaya_mama'];
    $mtaamama = $_POST['mtaamama'];
    $kuzaliwamama = $_POST['kuzaliwamama'];
	
	$uraia = $_POST['national'];
    $ainauraia = $_POST['ainauraia'];
	$mkoaishi = $_POST['mkoaishi'];
    $mtaaishi = $_POST['mtaaishi'];
    $wilayaishi = $_POST['wilayaishi'];
	$hati=$_POST['kuandikishwahati'];
    $userid = $_SESSION['userid'];
	$nida = $_POST['nida'];
	$idd = $_POST['idd'];
   $Insert = $db->EditUbunge($idd,$first,$middle,$last,$nafasi,$maojimbo,$maowilaya,
   $maomkoa,$date,$zmgmkoa,$zmgwilaya,$zmgmtaa,$baba, $kuzaliwababa, $mkoababa, 
   $wilayababa, $mtaababa,$mama,$mkoamama,$wilayamama,$mtaamama,
	 $kuzaliwamama, $mkoaishi, $wilayaishi, $mtaaishi, $uraia,$ainauraia,$hati,$userid,
	 $simu,$email,$fedha,$control,$nida);
if (isset($Insert)) {
            echo '<script language="javascript">';
            echo "alert('Utambulisho umeingia vyema')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=pDetailUtambulisho"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo "alert('Error: Samahani utambulisho haukuingia')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=pDetailUtambulisho"';
            echo '</script>';
        }	 
  
}
elseif(isset($_POST['AddUchama'])) {
    
    $kadizamani = $_POST['kadizamani'];
    $mkoazama = $_POST['mkoa'];
    $wilayazama = $_POST['wilaya'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $days = $_POST['days'];
	$tawizama = $_POST['tawi'];
	$monthG=explode('=',$month);
    $m=$monthG[0];
    $datezama=$year."-".$m."-".$days;
	
	$kadimpya = $_POST['kadimpya'];
    $mkoampya = $_POST['mkoam'];
    $wilayampya = $_POST['wilaya_kuza'];
    $yearm = $_POST['yearm'];
    $monthm = $_POST['monthm'];
    $daysm = $_POST['daysm'];
	$tawimpya = $_POST['tawim'];
	 $hadi = $_POST['hadilini'];
	$monthmG=explode('=',$monthm);
    $mm=$monthmG[0];
    $datempya=$yearm."-".$mm."-".$daysm;
	
	$kadijumuia = $_POST['kadijumuia'];
    $mkoaju = $_POST['mkoaju'];
    $wilayavc = $_POST['wilaya_kuza'];
    $yearvc = $_POST['yearvc'];
    $monthvc = $_POST['monthvc'];
    $daysvc = $_POST['daysvc'];
	$tawivc = $_POST['tawivc'];
	$hadilini = $_POST['hadilinivc'];
	$monthvcG=explode('=',$monthvc);
    $mvc=$monthvcG[0];
    $datevc=$yearvc."-".$mvc."-".$daysvc;
	
    $tawilako = $_POST['tawilako'];
    $mwk = $_POST['mwk'];
	$chamakingine = $_POST['kingine'];
	$tajachama = $_POST['tajachama'];
	
    $kodi = $_POST['kodi'];
    $adhabu = $_POST['adhabu'];
    $uzoefu = $_POST['uzoefu'];//date
    $mchango = $_POST['mchango'];
	
    $kazi = $_POST['kazi'];
    $jinai = $_POST['jinai'];
    $jinaiadhabu = $_POST['jinaiadhabu'];
    $nidhamu = $_POST['nidhamu'];
    $nidhamuadhabu = $_POST['nidhamuadhabu'];
	
	$muothibitisha = $_POST['muothibitisha'];
	$muombajithibitarehe = $_POST['muombajithibitarehe'];
	
    $ngazikatibu = $_POST['ngazikatibu'];
	$katibuthibitisha = $_POST['katibuthibitisha'];
	$jinakatibuthibitisha = $_POST['jinakatibuthibitisha'];
	$katibuthibitishatarehe= $_POST['katibuthibitishatarehe'];
	$ubunge_id= $_POST['idd'];
    /* SELECT``zamanikadi`, `zamakadimkoa_id`, `zamakadiwilaya_id`, `zamakaditawi`,`zamatarehe`,
	  mpyakadi,`mpyamkoa_id`, `mpyawilaya_id`,mpyatawi,`mpyatarehe`, `mpyahadilini`, 
	`jumuiyakadi`, `jumuiyamkoa_id`, `jumuiyawilaya_id`, `jumuiatarehe`,`jumuiyahadilini`,  
	`tawijina`,`tawimwkjina`, `chamakingine`, `chamamaelezo`, 
	`kwepakodi`, `kwepakodimaelezo`, `chamauongozi`, `chamamchango`, `kazikipato`, 
	`kosajinai`, `kosajinaimaelezo`, `kosamaadiliccm`, `kosamaadilimaelezo`, 
	`muombajithibitisha`, `muombajithibitishatarehe`, 
	`katibuthibitisha`, `jinalakatibu`, `ngaziyakatibu`, `katibutarehethibitisha`, `ubunge_id`*/
	 //`uanachama_id`,
	 //echo "dfss"
	 $content ="'$kadizamani','$mkoazama','$wilayazama','$tawizama','$datezama',
	 '$kadimpya','$mkoampya','$wilayampya','$tawimpya','$datempya','$hadi',
	 '$kadijumuia','$mkoaju','$wilayavc','$datevc','$hadilini',
	 '$tawilako','$mwk','$chamakingine','$tajachama',
	 '$kodi','$adhabu','$uzoefu','$mchango','$kazi',
	 '$jinai','$jinaiadhabu','$nidhamu','$nidhamuadhabu',
	  '$muothibitisha','$muombajithibitarehe',
	  '$katibuthibitisha', '$jinakatibuthibitisha','$ngazikatibu','$katibuthibitishatarehe'
	  ,'$ubunge_id'";
	  //echo $content;
	  //exit;
   $Insert = $db->insertuanachama($content, $kadimpya);
if (isset($Insert)) {
            echo '<script language="javascript">';
            echo "alert('Utambulisho umeingia vyema')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bEd"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo "alert('Error: Samahani utambulisho haukuingia')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=pDetail"';
            echo '</script>';
        }	 
  
}

elseif(isset($_POST['EditUchama'])) {
    
    $kadizamani = $_POST['kadizamani'];
    $mkoazama = $_POST['mkoa'];
    $wilayazama = $_POST['wilaya'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $days = $_POST['days'];
	$tawizama = $_POST['tawi'];
	$monthG=explode('=',$month);
    $m=$monthG[0];
    $datezama=$year."-".$m."-".$days;
	
	$kadimpya = $_POST['kadimpya'];
    $mkoampya = $_POST['mkoam'];
    $wilayampya = $_POST['wilaya_kuza'];
    $yearm = $_POST['yearm'];
    $monthm = $_POST['monthm'];
    $daysm = $_POST['daysm'];
	$tawimpya = $_POST['tawim'];
	 $hadi = $_POST['hadilini'];
	$monthmG=explode('=',$monthm);
    $mm=$monthmG[0];
    $datempya=$yearm."-".$mm."-".$daysm;
	
	$kadijumuia = $_POST['kadijumuia'];
    $mkoaju = $_POST['mkoaju'];
    $wilayavc = $_POST['wilaya_kuza'];
    $yearvc = $_POST['yearvc'];
    $monthvc = $_POST['monthvc'];
    $daysvc = $_POST['daysvc'];
	$tawivc = $_POST['tawivc'];
	$hadilini = $_POST['hadilinivc'];
	$monthvcG=explode('=',$monthvc);
    $mvc=$monthvcG[0];
    $datevc=$yearvc."-".$mvc."-".$daysvc;
	
    $tawilako = $_POST['tawilako'];
    $mwk = $_POST['mwk'];
	$chamakingine = $_POST['kingine'];
	$tajachama = $_POST['tajachama'];
	
    $kodi = $_POST['kodi'];
    $adhabu = $_POST['adhabu'];
    $uzoefu = $_POST['uzoefu'];//date
    $mchango = $_POST['mchango'];
	
    $kazi = $_POST['kazi'];
    $jinai = $_POST['jinai'];
    $jinaiadhabu = $_POST['jinaiadhabu'];
    $nidhamu = $_POST['nidhamu'];
    $nidhamuadhabu = $_POST['nidhamuadhabu'];
	
	$muothibitisha = $_POST['muothibitisha'];
	$muombajithibitarehe = $_POST['muombajithibitarehe'];
	

	$ubunge_id= $_POST['idd'];
    /* SELECT``zamanikadi`, `zamakadimkoa_id`, `zamakadiwilaya_id`, `zamakaditawi`,`zamatarehe`,
	  mpyakadi,`mpyamkoa_id`, `mpyawilaya_id`,mpyatawi,`mpyatarehe`, `mpyahadilini`, 
	`jumuiyakadi`, `jumuiyamkoa_id`, `jumuiyawilaya_id`, `jumuiatarehe`,`jumuiyahadilini`,  
	`tawijina`,`tawimwkjina`, `chamakingine`, `chamamaelezo`, 
	`kwepakodi`, `kwepakodimaelezo`, `chamauongozi`, `chamamchango`, `kazikipato`, 
	`kosajinai`, `kosajinaimaelezo`, `kosamaadiliccm`, `kosamaadilimaelezo`, 
	`muombajithibitisha`, `muombajithibitishatarehe`, 
	`katibuthibitisha`, `jinalakatibu`, `ngaziyakatibu`, `katibutarehethibitisha`, `ubunge_id`*/
	 //`uanachama_id`,
	 //echo "dfss"
	 $content ="'$kadizamani','$mkoazama','$wilayazama','$tawizama','$datezama',
	 '$kadimpya','$mkoampya','$wilayampya','$tawimpya','$datempya','$hadi',
	 '$kadijumuia','$mkoaju','$wilayavc','$datevc','$hadilini',
	 '$tawilako','$mwk','$chamakingine','$tajachama',
	 '$kodi','$adhabu','$uzoefu','$mchango','$kazi',
	 '$jinai','$jinaiadhabu','$nidhamu','$nidhamuadhabu',
	  '$muothibitisha','$muombajithibitarehe','$ubunge_id'";
	  //echo $content;
	  //exit;
   $Insert = $db->Edituanachama($kadizamani,$mkoazama,$wilayazama,$tawizama,$datezama,
	 $kadimpya,$mkoampya,$wilayampya,$tawimpya,$datempya,$hadi,
	 $kadijumuia,$mkoaju,$wilayavc,$datevc,$hadilini,
	 $tawilako,$mwk,$chamakingine,$tajachama,
	 $kodi,$adhabu,$uzoefu,$mchango,$kazi,
	 $jinai,$jinaiadhabu,$nidhamu,$nidhamuadhabu,
	 $muothibitisha,$muombajithibitarehe,$ubunge_id);
if (isset($Insert)) {
            echo '<script language="javascript">';
            echo "alert('Utambulisho umeingia vyema')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bUchama"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo "alert('Error: Samahani utambulisho haukuingia')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bUchama"';
            echo '</script>';
        }	 
  
}
elseif(isset($_POST['AddMaoni'])) {
    
    $aina = $_POST['aina'];
    $maonikifupi = $_POST['maonikifupi'];
    $ufafanuzi = $_POST['ufafanuzi'];
    $jina = $_POST['katibujina'];
    $ngazi = $_POST['ngazikatibu'];
    $tarehe = $_POST['kikaotarehe'];
	$id = $_POST['idd'];
	
   $Insert = $db->addMaoni($aina, $maonikifupi,$ufafanuzi, $jina,$ngazi, $tarehe,$id);
if (isset($Insert)) {
            echo '<script language="javascript">';
            echo "alert('Utambulisho umeingia vyema')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bMaoni"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo "alert('Error: Samahani utambulisho haukuingia')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bMaoni"';
            echo '</script>';
        }	 
  
}
elseif(isset($_POST['AddUteuzi'])) {
    
    $aina = $_POST['aina'];
    $maonikifupi = $_POST['katibuthibitisha'];
    $ufafanuzi = $_POST['ufafanuzi'];
    $jina = $_POST['jina'];
    $ngazi = $_POST['ngazikatibu'];
    $tarehe = $_POST['tarehe'];
	$id = $_POST['idd'];
	
   $Insert = $db->addUteuzi($aina, $maonikifupi,$ufafanuzi, $jina,$ngazi, $tarehe,$id);
if (isset($Insert)) {
            echo '<script language="javascript">';
            echo "alert('Mapendekezo au uteuzi umeingia vyema')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bUteuzi"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo "alert('Error: Mapendekezo au uteuzi haukuingia')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bUteuzi"';
            echo '</script>';
        }	 
  
}

elseif(isset($_POST['AddJumla'])) {
    
    $idd = $_POST['idd'];
    $ngazi = $_POST['ngazi'];
    $idadi = $_POST['idadi'];
    $haribika = $_POST['haribika'];
    $halali = $_POST['halali'];
    
   $Insert = $db->addJumlaKura($ngazi,$idd,$idadi,$haribika,$halali);
if (isset($Insert)) {
            echo '<script language="javascript">';
            echo "alert('Utambulisho umeingia vyema')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bKurajumlabEd"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo "alert('Error: Samahani utambulisho haukuingia')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bKurajumla"';
            echo '</script>';
        }	 
  
}//AddTafuta
elseif(isset($_POST['AddMtumia'])) {
    
    $jina = $_POST['jina'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $aina = $_POST['aina']; 
	if(!empty($_POST['ngazi']))
	{
    $ngazi = $_POST['ngazi'];
	}else{
	  $ngazi = "";}
	  $kadi = $_POST['kadi'];
	if(!empty($_POST['kazi']))
	{
      $kazi = $_POST['kazi'];
	}
if($ngazi=="Wilaya"){
    $ngazi_id = $_POST['wilaya'];
}elseif($ngazi=="Mkoa"){
    $ngazi_id = $_POST['mkoa']; 
}elseif($ngazi=="Kata"){
     $ngazi_id = $_POST['kata']; 
}else
{ $ngazi_id ="";
}
if(!empty($_POST['kithibitisha'])){
    $kithibitisha = $_POST['kithibitisha'];
}else{
	$kithibitisha="No";}
if(!empty($_POST['kikaokawali'])){
    $kikaokawali = $_POST['kikaokawali'];
}else{
	$kikaokawali="No";}
	
if(!empty($_POST['kikaokpili'])){
    $kikaokpili = $_POST['kikaokpili'];
}else{
	$kikaokpili="No";}	
if(!empty($_POST['kikaoktatu'])){
    $kikaoktatu = $_POST['kikaoktatu'];
}else{
	$kikaoktatu="No";}
if(!empty($_POST['kamatizanziba'])){
    $kamatizanziba = $_POST['kamatizanziba'];
}else{
	$kamatizanziba="No";}
if(!empty($_POST['kikaoutezi'])){
    $kikaoutezi = $_POST['kikaoutezi'];
}else{
	$kikaoutezi="No";}
if(!empty($_POST['kuramaoni'])){
    $kuramaoni = $_POST['kuramaoni'];
}else{
	$kuramaoni="No";}
if(!empty($_POST['kikaobawali'])){
    $kikaobawali = $_POST['kikaobawali'];
}else{
	$kikaobawali="No";}
	
if(!empty($_POST['kikaobpili'])){
    $kikaobpili = $_POST['kikaobpili'];
}else{
	$kikaobpili="No";}
if(!empty($_POST['kikaobtatu'])){
    $kikaobtatu = $_POST['kikaobtatu'];
}else{
	$kikaobtatu="No";}
if(!empty($_POST['kamatimaalumza'])){
    $kamatimaalumza = $_POST['kamatimaalumza'];
}else{
	$kamatimaalumza="No";}
if(!empty($_POST['kamatitaifa'])){
    $kamatitaifa = $_POST['kamatitaifa'];
}else{
	$kamatitaifa="No";}
if(!empty($_POST['kamatimwisho'])){
    $kamatimwisho = $_POST['kamatimwisho'];
}else{
	$kamatimwisho="No";}
    //`email`, `username`, `password`, `ngazi`, `ngazi_id`, `kadi`, `ainamtumia`, `name`,
	//`kazi_mfumo`, `thibitisha`, `kikaokablaawali`, `kikaokablapili`, `kikaokablatatu`, 
	//`kamatikablazanzibar`, `kikaokablauteuzi`, `matokeouchaguzi`, `kikaobaadaawali`, 
	//`Kikaobaadapili`, `kikaobaadatatu`, `kamatibaadazanzibar`, `kamatibaadataifa`, 
	//`kikaobaadauteuzi`, tarehe
	
   $tarehe = date("Y-m-d");
   $Insert = $db->addMtumia($email,$password,$ngazi,$ngazi_id,$kadi,$aina,
   $jina,$kazi,$kithibitisha,$kikaokawali,$kikaokpili,$kikaoktatu,$kamatizanziba,$kikaoutezi,
   $kuramaoni,$kikaobawali,$kikaobpili,$kikaobtatu,$kamatimaalumza,$kamatitaifa,$kamatimwisho,
   $tarehe);
   
   if (isset($Insert)) {
            echo '<script language="javascript">';
            echo "alert('Mtumiaji ameingia vyema')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=regUser"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo "alert('Error: Samahani mtumiaji haukuingia')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=regUser"';
            echo '</script>';
        }	 
  
}//AddTafuta
elseif(isset($_POST['AddTafuta'])) {
    
    $ngazi = $_POST['ngazi'];
    $wilaya = $_POST['wilaya'];
    $mkoa = $_POST['mkoa'];
    
}
elseif(isset($_POST['AddMgKura'])) {
    
    $idd = $_POST['idd'];
    $kura = $_POST['patakura'];
    $nafasi = $_POST['nafasi'];
    $mwaka = date('Y');
    
    
   $Insert = $db->addMgKura($kura,$idd,$nafasi,$mwaka);
if (isset($Insert)) {
            echo '<script language="javascript">';
            echo "alert('Umefanikiwa kuingiza kura za mgombea')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bKuramgombea"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo "alert('Error: Samahani kura haukuingia')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bKuramgombea"';
            echo '</script>';
        }	 
  
}

elseif (isset($_POST['uploadCertificate'])) {
    
    $docuType = $_POST['docuType'];
    $name = $_FILES['photo']['name'];
    $size = $_FILES['photo']['size'];

    $allowed = array("pdf");

    $extensional = getExtension($name); // Get extension
    $applicant_id = $_POST['applicant_id'];
    // echo $extensional;exit;

    if ($size > 1024000 || !in_array($extensional, $allowed)) { //check type and size 500kb
        echo '<script language="javascript">';
        echo "alert('Error: Not uploaded! Only .pdf file with max size of 1MB/1024KB allowed')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=dash"';
        echo '</script>';
    } else {
        //Check if file uploaded
        $checkF = $db->checkIfFileExist($docuType, $applicant_id);

        if ($checkF->rowCount() > 0) {
            $insertF = $db->updateFile($docuType, $applicant_id, $extensional, $name);
            if (isset($insertF)) {
                echo '<script language="javascript">';
                echo "alert('Added sucessfully')";
                echo '</script>';
                echo '<script language="javascript">';
                echo 'location.href = "../?pg=dash"';
                echo '</script>';
            } else {
                echo '<script language="javascript">';
                echo "alert('Error: Not Added sucessfully')";
                echo '</script>';
                echo '<script language="javascript">';
                echo 'location.href = "../?pg=dash"';
                echo '</script>';
            }
        } else {
            $insertF = $db->insertFile($docuType, $applicant_id, $extensional, $name);
            if (isset($insertF)) {
                echo '<script language="javascript">';
                echo "alert('Added sucessfully')";
                echo '</script>';
                echo '<script language="javascript">';
                echo 'location.href = "../?pg=dash"';
                echo '</script>';
            } else {
                echo '<script language="javascript">';
                echo "alert('Error: Not Added sucessfully')";
                echo '</script>';
                echo '<script language="javascript">';
                echo 'location.href = "../?pg=dash"';
                echo '</script>';
            }
        }
    }
} elseif (isset($_POST['uploadPassportSize'])) {
    $docuType = $_POST['docuType'];
    $name = $_FILES['photo']['name'];
    $size = $_FILES['photo']['size'];

    $fileinfo = @getimagesize($_FILES["photo"]["tmp_name"]);
    $width = $fileinfo[0];
    $height = $fileinfo[1];

    $allowed = array("jpg", "jpeg", "png");

    $extensional = getExtension($name); // Get extension
    $applicant_id = $_POST['applicant_id'];
    // echo $extensional;exit;

    if ($size > 512000 || !in_array($extensional, $allowed)) { //check type and size 500kb
        echo '<script language="javascript">';
        echo "alert('Error: Not uploaded, Only .jpg or .png file with max size of 500KB allowed')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=dash"';
        echo '</script>';
    } else if ($width > "300" || $height > "300") {
        echo '<script language="javascript">';
        echo "alert('Error: Not uploaded, File should not exceed width/height 300/300 pixels size')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=dash"';
        echo '</script>';
    } else {
        //Check if file uploaded
        $checkF = $db->checkIfFileExist($docuType, $applicant_id);

        if ($checkF->rowCount() > 0) {
            $insertF = $db->updateFile($docuType, $applicant_id, $extensional, $name);
            if (isset($insertF)) {
                echo '<script language="javascript">';
                echo "alert('Added sucessfully')";
                echo '</script>';
                echo '<script language="javascript">';
                echo 'location.href = "../?pg=dash"';
                echo '</script>';
            } else {
                echo '<script language="javascript">';
                echo "alert('Error: Not Added sucessfully')";
                echo '</script>';
                echo '<script language="javascript">';
                echo 'location.href = "../?pg=dash"';
                echo '</script>';
            }
        } else {
            $insertF = $db->insertFile($docuType, $applicant_id, $extensional, $name);
            if (isset($insertF)) {
                echo '<script language="javascript">';
                echo "alert('Added sucessfully')";
                echo '</script>';
                echo '<script language="javascript">';
                echo 'location.href = "../?pg=dash"';
                echo '</script>';
            } else {
                echo '<script language="javascript">';
                echo "alert('Error: Not Added sucessfully')";
                echo '</script>';
                echo '<script language="javascript">';
                echo 'location.href = "../?pg=dash"';
                echo '</script>';
            }
        }
    }
} elseif (isset($_POST['addNewUser'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $userlevel = $_POST['userlevel'];
    $member_id = $_POST['member_id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $facility = ''; //$_POST['facility'];

    if ($userlevel != 'All') {
        $userlevel = 'Facility';
        $wp_category_id = $_POST['userlevel'];
        $wp_id = $_POST['facName'];
    } else {
        $wp_category_id = '0';
        $wp_id = '0';
    }


    //Check if password match
    if ($password != $password2) {
        echo '<script language="javascript">';
        echo "alert('Error: Passwords do not match')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngUser"';
        echo '</script>';
    } else {
        //Check if username exist
        $checkUser = $db->checkUsername($username);
        if ($checkUser->rowCount() > 0) {
            echo '<script language="javascript">';
            echo "alert('Error: Username already used')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=mngUser"';
            echo '</script>';
        } else {
            $checkEmail = $db->checkEmailIfExist($email);
            if ($checkEmail->rowCount() > 0) {
                echo '<script language="javascript">';
                echo "alert('Error: Email already used')";
                echo '</script>';
                echo '<script language="javascript">';
                echo 'location.href = "../?pg=mngUser"';
                echo '</script>';
            } else {
                $insetUser = $db->insertNewSystemUser($facility, $firstname, $lastname, $gender, $username, $password, $email, $userlevel, $phone, $member_id, $wp_category_id, $wp_id);
                if (isset($insetUser)) {
                    echo '<script language="javascript">';
                    echo "alert('Added sucessfully')";
                    echo '</script>';
                    echo '<script language="javascript">';
                    echo 'location.href = "../?pg=mngUser"';
                    echo '</script>';
                } else {
                    echo '<script language="javascript">';
                    echo "alert('Error: Not added sucessfully')";
                    echo '</script>';
                    echo '<script language="javascript">';
                    echo 'location.href = "../?pg=mngUser"';
                    echo '</script>';
                }
            }
        }
    }
} elseif (isset($_GET['save_permisions'])) {
    $user_id = $_GET['user_id'];
    $user_level = $_GET['user_level'];
    $checkF = $db->getUserPermisions($user_id, $user_level);
    if ($checkF->rowCount() > 0) {
        $stmt = $db->updateUserPermision($_GET);
        $msg = 'Updated ';
    } else {
        $stmt = $db->addUserPermision($_GET);
        $msg = 'Added ';
    }

    if (isset($stmt)) {
        echo '<script language="javascript">';
        echo "alert('".$msg." sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngUser"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not ".$msg." sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngUser"';
        echo '</script>';
    }
}

///////////////////////////////////////////////////
///////////////////mergeDocs//////////////////////
//////////////////////////////////////////////////

elseif (isset($_POST['mergeDocs'])) {
    $cadre_id = $_POST['cadreId'];
    $DocumentID = $_POST['DocumentID'];

    foreach ($DocumentID as $document_id) {
        $merdge = $db->mergeDocs($cadre_id, $document_id);
    }

    if (isset($merdge)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDocuments"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDocuments"';
        echo '</script>';
    }
} elseif (isset($_POST['deleteMergeDoc'])) {

    $merge_id = $_POST['merge_id'];
    $del = $db->deleteMergeDoc($merge_id);
    // echo '$merge_id= '.$merge_id;exit;
    if (isset($del)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDocuments"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDocuments"';
        echo '</script>';
    }
} elseif (isset($_POST['addDocumentName'])) {

    $documentName = $_POST['documentName'];
    $type = $_POST['type'];
    $del = $db->addDocumentName($documentName, $type);

    if (isset($del)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDocuments"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDocuments"';
        echo '</script>';
    }
} elseif (isset($_POST['editDocumentName'])) {
    $documentName = $_POST['documentName'];
    $type = $_POST['type'];
    $DocumentID = $_POST['documentId'];
    $edt = $db->editDocumentName($documentName, $type, $DocumentID);

    if (isset($edt)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDocuments"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDocuments"';
        echo '</script>';
    }
}

///////////////////////////////////////////////////
////Part 2: Edit User Details//////////////////////
//////////////////////////////////////////////////
elseif (isset($_POST['editUserDetails'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $level = $_POST['level'];
    $email = $_POST['email'];
    $userID = $_POST['userID'];


    $editUser = $db->editSystemUser($level, $email, $userID, $firstname, $lastname, $gender, $phone);
    if (isset($editUser)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../pages/mange_users.php"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../pages/mange_users.php"';
        echo '</script>';
    }
}
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
////Part 3: Delete User Details///////////////////////
//////////////////////////////////////////////////////
elseif (isset($_POST['deleteUser'])) {
    $userID = $_POST['userID'];


    $deleteUser = $db->deleteThisUser($userID);
    if (isset($deleteUser)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../pages/mange_users.php"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../pages/mange_users.php"';
        echo '</script>';
    }
}


///////////////////////////////////
//////////////////////////////////
/////////WORK PERMIT CATEGORY//////
///////////////////////////////////
//////////////////////////////////
elseif (isset($_POST['addNewWPCategory'])) {
    $category = $_POST['category'];
    $userID = $_POST['userID'];

    $insertData = $db->addWPCategory($category, $userID);


    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngWPC"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngWPC"';
        echo '</script>';
    }
} ///Edit category
elseif (isset($_POST['editWPC'])) {
    $category = $_POST['category'];
    $wpc_id = $_POST['wpc_id'];

    $insertData = $db->updateWPCategory($category, $wpc_id);


    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngWPC"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngWPC"';
        echo '</script>';
    }
} ///Delete category
elseif (isset($_POST['deleteWPC'])) {
    $wpc_id = $_POST['wpc_id'];

    $updateData = $db->deleteWPCategory($wpc_id);


    if (isset($updateData)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngWPC"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngWPC"';
        echo '</script>';
    }
}

///////////////////////////////////
//////////////////////////////////
/////////CRITERIA TO CADRE///////////
///////////////////////////////////
//////////////////////////////////
elseif (isset($_POST['addCriteriaCadre'])) {

    $lower_age = $_POST['lower_age'];
    $higher_age = $_POST['higher_age'];
    $gender = $_POST['gender'];


    $cadre_id = $_POST['cadre_id'];
    $criteria_id = $_POST['criteria'];
    $credit = $_POST['credit'];
    // $rowId = $_POST['rowId'];


    // for ($row = 1; $row <= $rowId; $row++) {

    //     $criteria_id = $_POST['criteria' . $row];
    //     $credit = $_POST['credit' . $row];

    // $val = array($criteria_id, $credit);

    // //$cadre_id=$val[0];
    // $criteria_id = $val[0];
    // $credit = $val[1];

    $insertData = $db->insertCadreCriteria($cadre_id, $criteria_id, $credit, $lower_age, $higher_age, $gender);
    // }

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCCD&cadreid=' . $cadre_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCCD&cadreid=' . $cadre_id . '"';
        echo '</script>';
    }
} //Edit Cadre to Criteria
elseif (isset($_POST['editCadreCriteria'])) {
    $criteria = $_POST['criteria'];
    $credit = $_POST['credit'];
    $cc_id = $_POST['cc_id'];
    $cadre_id = $_POST['cadre_id'];


    $insertData = $db->editCadreCriteria($criteria, $credit, $cc_id);

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCCD&cadreid=' . $cadre_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCCD&cadreid=' . $cadre_id . '"';
        echo '</script>';
    }
} //Delete Cadre to Criteria
elseif (isset($_POST['deleteCadreCriteria'])) {
    $cc_id = $_POST['cc_id'];
    $cadre_id = $_POST['cadre_id'];


    $insertData = $db->deleteCadreCriteria($cc_id);

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCCD&cadreid=' . $cadre_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCCD&cadreid=' . $cadre_id . '"';
        echo '</script>';
    }
}






///////////////////////////////////
//////////////////////////////////
/////////CADRE CRITERIA///////////
///////////////////////////////////
//////////////////////////////////
elseif (isset($_POST['addNewCCriteria'])) {
    /* $cadreName=$_POST['cadreName'];
	$member_id=$_POST['member_id'];
	$rowId=$_POST['rowId'];

	$insertData=$db->insertFacility($cadreName,$member_id);

	$fac_id=$db->lastId($insertData); */

    $lower_age = $_POST['lower_age'];
    $higher_age = $_POST['higher_age'];
    $gender = $_POST['gender'];


    $cadre_id = $_POST['cadreName'];
    $credit = $_POST['credit'];
    $criteria_id = $_POST['criteria'];
    // $rowId = $_POST['rowId'];


    // for ($row = 1; $row <= $rowId; $row++) {

    //     $criteria_id = $_POST['criteria' . $row];
    //     $credit = $_POST['credit' . $row];

    //     $val = array($criteria_id, $credit);

    //     //$cadre_id=$val[0];
    //     $criteria_id = $val[0];
    //     $credit = $val[1];

    $insertData = $db->insertCadreCriteria($cadre_id, $criteria_id, $credit, $lower_age, $higher_age, $gender);
    // }

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCr"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCr"';
        echo '</script>';
    }
}


///////////////////////////////////
//////////////////////////////////
/////////Add JIMBO///////////
///////////////////////////////////
//////////////////////////////////
elseif (isset($_POST['addJIMBO'])) {
    

    $reg = $_POST['region_id'];
    $name = $_POST['jimbo'];
    $wila = $_POST['wilaya'];


    
    $insertData = $db->addJIMBO($name, $reg, $wila);
    // }

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../page/ConstituentManage.php"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../page/ConstituentManage.php"';
        echo '</script>';
    }
}

///////////////////////////////////
//////////////////////////////////
/////////Add TARAFA///////////
///////////////////////////////////
//////////////////////////////////
elseif (isset($_POST['addTARA'])) {
    

    $reg = $_POST['region_id'];
    $jimbo= $_POST['jimbo'];
    $wila = $_POST['wilaya'];
	$tarafa = $_POST['tarafa'];


    
    $insertData = $db->addTARAFA($tarafa,$reg,$wila,$jimbo);
    // }

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngTarafa"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngTarafa"';
        echo '</script>';
    }
}
///////////////////////////////////
//////////////////////////////////
/////////Add KATA///////////
///////////////////////////////////
//////////////////////////////////
elseif (isset($_POST['addKATA'])) {
    

    $reg = $_POST['region_id'];
    $jimbo= $_POST['jimbo'];
    $wila = $_POST['wilaya'];
	$tarafa = $_POST['tarafa'];
    $kata = $_POST['Kata'];
    //addKATA($kataName,$RegID,$WilID,$JimID,$TaraID)
    $insertData = $db->addKATA($kata,$reg,$wila,$jimbo,$tarafa);
    // }

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../page/WardManage.php"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../page/WardManage.php"';
        echo '</script>';
    }
}
//////////////////////////////////
//////////////////////////////////
/////////Add Mtaa///////////
///////////////////////////////////
//////////////////////////////////
elseif (isset($_POST['addMTAA'])) {
    

    $reg = $_POST['region_id'];
    $jimbo= $_POST['jimbo'];
    $wila = $_POST['wilaya'];
	$tarafa = $_POST['tarafa'];
    $kata = $_POST['Kata'];
	$mtaa = $_POST['mtaa'];
    //addKATA($kataName,$RegID,$WilID,$JimID,$TaraID)
    $insertData = $db->addMTAA($mtaa,$reg,$wila,$jimbo,$tarafa,$kata);
    // }

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../page/StreetManage.php"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../page/StreetManage.php"';
        echo '</script>';
    }
}
//////////////////////////////////
//////////////////////////////////
/////////Add TAWI///////////
///////////////////////////////////
//////////////////////////////////
elseif (isset($_POST['addTAWI'])) {
    

    $reg = $_POST['region_id'];
    $jimbo= $_POST['jimbo'];
    $wila = $_POST['wilaya'];
	$tarafa = $_POST['tarafa'];
    $kata = $_POST['Kata'];
	$mtaa = $_POST['mtaa'];
	$tawi = $_POST['tawi'];
    //addKATA($kataName,$RegID,$WilID,$JimID,$TaraID)
    $insertData = $db->addTAWI($tawi,$reg,$wila,$jimbo,$tarafa,$kata,$mtaa);
    // }

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngTawi"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngTawi"';
        echo '</script>';
    }
}
//editJIMBO($jimboName, $RegID, $WilID,$ras_id)
//////////////////////////////////
elseif (isset($_POST['editJIMBO'])) {
    
    //ras_id
    $ras_id = $_POST['ras_id'];
	$reg = $_POST['region_id'];
    $name = $_POST['jimbo'];
    $wila = $_POST['wilaya'];


    
    $insertData = $db->editJIMBO($name, $reg, $wila,$ras_id);
    // }

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngJimbo"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngJimbo"';
        echo '</script>';
    }
}



///////////////////////////////////
//////////////////////////////////
/////////PROCESSING CADRE TO WP///
///////////////////////////////////
//////////////////////////////////
elseif (isset($_POST['addNewCadreToWP'])) {
    $rowId = $_POST['rowId'];
    $fac_id = $_POST['fac_id'];

    for ($row = 1; $row <= $rowId; $row++) {
        $cadre = $_POST['cadre' . $row];
        $number = $_POST['number' . $row];
        //$status=$_POST['status'.$row];
        $year = $_POST['year' . $row];

        $val = array($cadre, $number, $year);

        $cadre = $val[0];
        $number = $val[1];
        $year = $val[2];


        $insertCadre = $db->insertCadre($cadre, $number, $year, $fac_id);
    }

    if (isset($insertCadre)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFD&fac_id=' . $fac_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFD&fac_id=' . $fac_id . '"';
        echo '</script>';
    }
}


///////////////////////////////////
//////////////////////////////////
/////////ADD CADRE, YEAR///////////
///////////////////////////////////
//////////////////////////////////
elseif (isset($_POST['addNewCadreToYear'])) {
    $number = $_POST['number'];
    $year = $_POST['year'];
    $cadreId = $_POST['cadreId'];
    $fac_id = $_POST['fac_id'];

    $insert = $db->insertDataIntofaccYear($number, $year, $cadreId, $fac_id);

    if (isset($insert)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFD&fac_id=' . $fac_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFD&fac_id=' . $fac_id . '"';
        echo '</script>';
    }
} //EDIT
elseif (isset($_POST['editCadreToYear'])) {
    $number = $_POST['number'];
    $year = $_POST['year'];
    $tableId = $_POST['tableId'];
    $fac_id = $_POST['fac_id'];

    $insert = $db->updateDataIntofaccYear($number, $year, $tableId, $fac_id);

    if (isset($insert)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFD&fac_id=' . $fac_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFD&fac_id=' . $fac_id . '"';
        echo '</script>';
    }
} //DELETE
elseif (isset($_POST['deleteCadreToYear'])) {
    $tableId = $_POST['tableId'];
    $fac_id = $_POST['fac_id'];

    $insert = $db->deleteDataIntofaccYear($tableId);

    if (isset($insert)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFD&fac_id=' . $fac_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFD&fac_id=' . $fac_id . '"';
        echo '</script>';
    }
}



///////////////////////////////////
//////////////////////////////////
/////////PROCESSING WORK FACILITY///
///////////////////////////////////
//////////////////////////////////
elseif (isset($_POST['addNewFacility'])) {
    $category = $_POST['category'];
    // $region=$_POST['region'];
    // $district=$_POST['district'];
    $facName = $_POST['facName'];
    $member_id = $_POST['member_id'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $rowId = $_POST['rowId'];
    $year = $_POST['year'];
    $workpstatus = $_POST['workpstatus'];

    $insertData = $db->insertFacility($category, $facName, $member_id, $startdate, $enddate, $workpstatus);

    $fac_id = $db->lastId($insertData);

    for ($row = 1; $row <= $rowId; $row++) {
        $cadre = $_POST['cadre' . $row];
        $number = $_POST['number' . $row];
        $status = $_POST['status' . $row];

        $val = array($cadre, $number, $status);

        $cadre = $val[0];
        $number = $val[1];
        $status = $val[2];

        $insertCadre = $db->insertCadre($cadre, $number, $year, $fac_id);
    }

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngWk"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngWk"';
        echo '</script>';
    }
} //Edit
elseif (isset($_POST['editFacility'])) {
    $facname = $_POST['facname'];
    $region = $_POST['region'];
    $district = $_POST['district'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $status = $_POST['status'];
    $fac_id = $_POST['fac_id'];


    $insertData = $db->editFacility($facname, $region, $district, $status, $startdate, $enddate, $fac_id);
    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngWk"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngWk"';
        echo '</script>';
    }
} elseif (isset($_POST['deletecadreid'])) {
    $cadreid = $_POST['cadreid'];

    $insertData = $db->deleteCadreCriteriaByCadre($cadreid);

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCr"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCr"';
        echo '</script>';
    }
} elseif (isset($_POST['deleteWP'])) {
    $fac_id = $_POST['fac_id'];
    $status = $_POST['status'];

    $insertData = $db->activateFacilityDetails($fac_id, $status);

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngWk"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngWk"';
        echo '</script>';
    }
}

////////////////////////////////////
///////////////////////////////////
////////MANAGE Mabaraza/////////////
////////////////////////////////////
///////////////////////////////////
//Add New Mabaraza

elseif (isset($_POST['addMabaraza'])) {
    $name = $_POST['name'];
    $userID = $_POST['userID'];

    $insertMabaraza = $db->addMabaraza($name, $userID);
    if (isset($insertMabaraza)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngMabaraza"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngMabaraza"';
        echo '</script>';
    }
} //Edit Region
elseif (isset($_POST['editMabaraza'])) {
    $name = $_POST['name'];
    // $userID=$_POST['userId'];
    $id = $_POST['id'];

    $insertMabaraza = $db->editMabaraza($name, $id);
    if (isset($insertMabaraza)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngMabaraza"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngMabaraza"';
        echo '</script>';
    }
} //Delete RAS
elseif (isset($_POST['deleteMabaraza'])) {
    $id = $_POST['id'];

    $insertMabaraza = $db->deleteMabaraza($id);
    if (isset($insertMabaraza)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngMabaraza"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngMabaraza"';
        echo '</script>';
    }
}

////////////////////////////////////
///////////////////////////////////
////////End MANAGE Mabaraza/////////////
////////////////////////////////////
///////////////////////////////////


/////////////////////////////////
///////edit&delete Manageuser////
////////////////////////////////
///////////////////////////////
//Edit Region
elseif (isset($_POST['editUser'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    // $userlevel=$_POST['userlevel'];
    $member_id = $_POST['member_id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    // $facility = $_POST['facility'];

    $insertUser = $db->editUser($firstname, $lastname, $gender, $email, $phone, $member_id);
    if (isset($insertUser)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngUser"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngUser"';
        echo '</script>';
    }
} //Delete RAS
elseif (isset($_POST['deleteUserEdited'])) {
    $member_id = $_POST['member_id'];

    $insertmember = $db->deleteUserEdited($member_id);
    if (isset($insertmember)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngUser"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngUser"';
        echo '</script>';
    }
}

/////////////////////////////////////
////////End Edit&Delete Manage User//
////////////////////////////////////
///////////////////////////////////


///////////////////////////////////
//////////////////////////////////
/////////PROCESSING CADRE/////////
///////////////////////////////////
//////////////////////////////////
//Add
elseif (isset($_POST['addNewCadre'])) {
    $cadre = $_POST['cadre'];
    $number = $_POST['number'];
    $status = $_POST['status'];
    $fac_id = $_POST['fac_id'];

    $insertData = $db->addCadre($cadre, $number, $status, $fac_id);

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFD&fac_id=' . $fac_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFD&fac_id=' . $fac_id . '"';
        echo '</script>';
    }
} //Edit
elseif (isset($_POST['editCadre'])) {
    $cadre = $_POST['cadre'];
    $number = $_POST['number'];
    $status = $_POST['status'];
    $cadre_id = $_POST['cadre_id'];
    $fac_id = $_POST['fac_id'];

    $insertData = $db->editCadre($cadre, $number, $status, $cadre_id);

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFD&fac_id=' . $fac_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFD&fac_id=' . $fac_id . '"';
        echo '</script>';
    }
} //Delete
elseif (isset($_POST['deleteCadre'])) {
    $cadre_id = $_POST['cadre_id'];
    $fac_id = $_POST['fac_id'];


    $insertData = $db->deleteCadre($cadre_id);

    if (isset($insertData)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFD&fac_id=' . $fac_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFD&fac_id=' . $fac_id . '"';
        echo '</script>';
    }
} ///Delete Facility
elseif (isset($_POST['deleteFacility'])) {
    $fac_id = $_POST['fac_id'];


    $deleteF = $db->deleteFacility($fac_id);
    if (isset($deleteF)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngWk"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngWk"';
        echo '</script>';
    }
}



//////////////////////////////////////////////
/////////////////////////////////////////////
/////////PROCESSING EDUCATION////////////////
//////////////////////////////////////////////
/////////////////////////////////////////////
//------Add EDUCATION----->
elseif (isset($_POST['addNewEducationDetails'])) {
    $levelEdu = $_POST['level'];
    $college = $_POST['college'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $teacher_id = $_POST['teacher_id'];


    $insertEdu = $db->insertEducation($levelEdu, $college, $start, $end, $school_id, $userID, $level, $teacher_id);
    if (isset($insertEdu)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    }
} //ADD PERSON DETAILS
elseif (isset($_POST['addNewPerEduDetails'])) {
    $levelEdu = $_POST['level'];
    $college = $_POST['college'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $id = $_POST['id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];


    $insertPerEdu = $db->insertPerEducation($levelEdu, $college, $start, $end, $id, $userID);
    if (isset($insertPerEdu)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    }
} //EDIT PERSON DETAILS
elseif (isset($_POST['editNewPerEduDetails'])) {
    $levelEdu = $_POST['level'];
    $college = $_POST['college'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $id = $_POST['id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];
    $edu_id = $_POST['edu_id'];


    $insertPerEdu = $db->editPerEducation($levelEdu, $college, $start, $end, $id, $userID, $edu_id);
    if (isset($insertPerEdu)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    }
} //DELETE PERSON DETAILS
elseif (isset($_POST['deletePerEduDetails'])) {
    $tab = $_POST['tab'];
    $edu_id = $_POST['edu_id'];
    $id = $_POST['id'];


    $deletePerEdu = $db->deletePerEducation($edu_id);
    if (isset($deletePerEdu)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    }
} //------Edit Education Teacher----->
elseif (isset($_POST['editEducationDetails'])) {
    $levelEdu = $_POST['level'];
    $college = $_POST['college'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $teacher_id = $_POST['teacher_id'];
    $edu_id = $_POST['edu_id'];





    $editRTeacher = $db->editEducationTeacherDetails($levelEdu, $college, $start, $end, $school_id, $userID, $level, $teacher_id, $edu_id);
    if (isset($editRTeacher)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    }
} //------Delete Education----->
elseif (isset($_POST['deleteEducationDetails'])) {
    $school_id = $_POST['school_id'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $teacher_id = $_POST['teacher_id'];
    $edu_id = $_POST['edu_id'];

    $deleteD = $db->deleteThisEducationDetails($edu_id);
    if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    }
}


//////////////////////////////////////////////
/////////////////////////////////////////////
/////////PROCESSING EMPLOYMENT////////////////
//////////////////////////////////////////////
/////////////////////////////////////////////
//------Add Employment----->
elseif (isset($_POST['addNewEmploymentDetails'])) {
    $employer = $_POST['employer'];
    $position = $_POST['position'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $teacher_id = $_POST['teacher_id'];
    $staff_id = 0;

    $insertEm = $db->insertEmployment($employer, $position, $start, $end, $school_id, $userID, $level, $teacher_id, $staff_id);
    if (isset($insertEm)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    }
} //------Edit Employment----->
elseif (isset($_POST['EditEmploymentDetails'])) {
    $employer = $_POST['employer'];
    $position = $_POST['position'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $teacher_id = $_POST['teacher_id'];
    $emp_id = $_POST['emp_id'];
    $staff_id = 0;

    $editEm = $db->editThisEmployment($employer, $position, $start, $end, $school_id, $userID, $level, $teacher_id, $emp_id, $staff_id);
    if (isset($editEm)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    }
} //------Delete Employment----->
elseif (isset($_POST['deleteEmploymentDetails'])) {
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $teacher_id = $_POST['teacher_id'];
    $emp_id = $_POST['emp_id'];

    $deleteD = $db->deleteThisEmploymentDetails($emp_id);
    if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    }
}


//////////////////////////////////////////////
/////////////////////////////////////////////
/////////PROCESSING TEACHING SUBJECT//////////
//////////////////////////////////////////////
/////////////////////////////////////////////
//------Add Teaching Subject----->
elseif (isset($_POST['addNewTeachingSubject'])) {
    $subjectName = $_POST['subjectName'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $teacher_id = $_POST['teacher_id'];

    $insertTS = $db->insertTeachingSubject($subjectName, $teacher_id, $userID);
    if (isset($insertTS)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    }
} //------Delete----->
elseif (isset($_POST['deleteTeachingSubject'])) {
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $teacher_id = $_POST['teacher_id'];
    $table_id = $_POST['table_id'];

    $deleteD = $db->deleteThisTeachingSubject($table_id);
    if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=teDetails&tab=' . $tab . '&tid=' . $teacher_id . '"';
        echo '</script>';
    }
}


//////////////////////////////////////////////
/////////////////////////////////////////////
/////////STAFFS//////////////////////////////
//////////////////////////////////////////////
/////////////////////////////////////////////
//------Add Staff----->
elseif (isset($_POST['addNewSatffDetails'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $postion = $_POST['postion'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];

    $insertS = $db->insertNewStaff($firstname, $lastname, $gender, $age, $postion, $phone, $email, $school_id, $userID);
    if (isset($insertS)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=staff&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=staff&tab=' . $tab . '"';
        echo '</script>';
    }
} //------Edit Staff----->
elseif (isset($_POST['EditStaffDetails'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $position = $_POST['position'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $staff_id = $_POST['staff_id'];

    $editS = $db->editStaffDetails($firstname, $lastname, $gender, $age, $position, $phone, $email, $school_id, $userID, $staff_id);
    if (isset($editS)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=staff&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=staff&tab=' . $tab . '"';
        echo '</script>';
    }
} //------Delete Staff----->
elseif (isset($_POST['deStaffDetails'])) {
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $staff_id = $_POST['staff_id'];


    $deleteD = $db->deleteThisStaff($staff_id);
    if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=staff&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=staff&tab=' . $tab . '"';
        echo '</script>';
    }
}

//////////////////////////////////////////////
/////////////////////////////////////////////
/////////PROCESSING STAFF EDUCATION////////////////
//////////////////////////////////////////////
/////////////////////////////////////////////
//------Add Staff EDUCATION----->
elseif (isset($_POST['addNewStaffEducationDetails'])) {
    $levelEdu = $_POST['level'];
    $college = $_POST['college'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $staff_id = $_POST['staff_id'];


    $insertEdu = $db->insertStaffEducation($levelEdu, $college, $start, $end, $school_id, $userID, $level, $staff_id);
    if (isset($insertEdu)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=stDetails&tab=' . $tab . '&sid=' . $staff_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=stDetails&tab=' . $tab . '&sid=' . $staff_id . '"';
        echo '</script>';
    }
} //------Edit Education Staff----->
elseif (isset($_POST['editStaffEducationDetails'])) {
    $levelEdu = $_POST['level'];
    $college = $_POST['college'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $staff_id = $_POST['staff_id'];
    $edu_id = $_POST['edu_id'];


    $editRTeacher = $db->editStaffEducationTeacherDetails($levelEdu, $college, $start, $end, $school_id, $userID, $level, $staff_id, $edu_id);
    if (isset($editRTeacher)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=stDetails&tab=' . $tab . '&sid=' . $staff_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=stDetails&tab=' . $tab . '&sid=' . $staff_id . '"';
        echo '</script>';
    }
} //------Delete Education----->
elseif (isset($_POST['deleteStaffEducationDetails'])) {
    $school_id = $_POST['school_id'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $staff_id = $_POST['staff_id'];
    $edu_id = $_POST['edu_id'];


    $deleteD = $db->deleteThisEducationDetails($edu_id);
    if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=stDetails&tab=' . $tab . '&sid=' . $staff_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=stDetails&tab=' . $tab . '&sid=' . $staff_id . '"';
        echo '</script>';
    }
}



//////////////////////////////////////////////
/////////////////////////////////////////////
/////////PROCESSING STAFF EMPLOYMENT////////////////
//////////////////////////////////////////////
/////////////////////////////////////////////
//------Add Staff Employment----->
elseif (isset($_POST['addNewStaffEmploymentDetails'])) {
    $employer = $_POST['employer'];
    $position = $_POST['position'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $staff_id = $_POST['staff_id'];
    $teacher_id = 0;

    $insertEm = $db->insertEmployment($employer, $position, $start, $end, $school_id, $userID, $level, $teacher_id, $staff_id);
    if (isset($insertEm)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=stDetails&tab=' . $tab . '&sid=' . $staff_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=stDetails&tab=' . $tab . '&sid=' . $staff_id . '"';
        echo '</script>';
    }
} //------Edit Employment----->
elseif (isset($_POST['EditStaffEmploymentDetails'])) {
    $employer = $_POST['employer'];
    $position = $_POST['position'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $staff_id = $_POST['staff_id'];
    $emp_id = $_POST['emp_id'];
    $teacher_id = 0;

    $editEm = $db->editThisEmployment($employer, $position, $start, $end, $school_id, $userID, $level, $teacher_id, $emp_id, $staff_id);
    if (isset($editEm)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=stDetails&tab=' . $tab . '&sid=' . $staff_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=stDetails&tab=' . $tab . '&sid=' . $staff_id . '"';
        echo '</script>';
    }
} //------Delete Staff Employment----->
elseif (isset($_POST['deleteStaffEmploymentDetails'])) {
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $staff_id = $_POST['staff_id'];
    $emp_id = $_POST['emp_id'];

    $deleteD = $db->deleteThisEmploymentDetails($emp_id);
    if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=stDetails&tab=' . $tab . '&sid=' . $staff_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=stDetails&tab=' . $tab . '&sid=' . $staff_id . '"';
        echo '</script>';
    }
}

//////////////////////////////////////////////
/////////////////////////////////////////////
/////////PROCESSING STUDENT ENROLMENT///////////
//////////////////////////////////////////////
/////////////////////////////////////////////
//------Add Book----->
elseif (isset($_POST['addNewStudentDetails'])) {
    $boys = $_POST['boys'];
    $girls = $_POST['girls'];
    $class = $_POST['class'];
    $year = $_POST['year'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];

    $insertStu = $db->insertStudentDetails($boys, $girls, $class, $year, $school_id, $userID, $level);
    if (isset($insertStu)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=student&tab=' . $class . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=student&tab=' . $class . '"';
        echo '</script>';
    }
} //------Edit Student----->
elseif (isset($_POST['editStudentDetails'])) {
    $boys = $_POST['boys'];
    $girls = $_POST['girls'];
    $class = $_POST['class'];
    $year = $_POST['year'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $student_id = $_POST['student_id'];

    $editStu = $db->editStudentDetails($boys, $girls, $class, $year, $school_id, $userID, $student_id, $level);
    if (isset($editStu)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=student&tab=' . $class . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=student&tab=' . $class . '"';
        echo '</script>';
    }
} //------Delete Student----->
elseif (isset($_POST['deleteStudentDetails'])) {
    $class = $_POST['class'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $student_id = $_POST['student_id'];


    $deleteSt = $db->deleteStudentDetails($student_id);
    if (isset($deleteSt)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=student&tab=' . $class . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=student&tab=' . $class . '"';
        echo '</script>';
    }
}


//////////////////////////////////////////////
/////////////////////////////////////////////
/////////SCHOOL SOCIAL SERVICE //////////////
//////////////////////////////////////////////
/////////////////////////////////////////////
//------Add Social Service----->
elseif (isset($_POST['addThis_NewSchooService'])) {
    $cat = $_POST['cat'];
    $status = $_POST['status'];
    $type = $_POST['type'];
    $ownership = $_POST['ownership'];
    $ownername = $_POST['ownername'];
    $year = $_POST['year'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];


    $insertSoc = $db->insertSchoolSocialService($cat, $status, $type, $ownership, $ownername, $year, $school_id, $userID);
    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=social&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=social&tab=' . $tab . '"';
        echo '</script>';
    }
} //----->Edit-->
elseif (isset($_POST['editThis_NewSchooService'])) {
    $cat = $_POST['cat'];
    $status = $_POST['status'];
    $type = $_POST['type'];
    $ownership = $_POST['ownership'];
    $ownername = $_POST['ownername'];
    $year = $_POST['year'];
    $school_id = $_POST['school_id'];
    $userID = $_POST['userID'];
    $level = $_POST['lv'];
    $tab = $_POST['tab'];
    $service_id = $_POST['service_id'];


    $editSoc = $db->editSchoolSocialService($service_id, $cat, $status, $type, $ownership, $ownername, $year, $school_id, $userID);
    if (isset($editSoc)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=social&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=schDe&schId=' . $school_id . '&lv=' . $level . '&schP=social&tab=' . $tab . '"';
        echo '</script>';
    }
}


/////////////////////////////////////////////////
////////////////////////////////////////////////
//////////////////KERO///////////////////////////
////////////////////////////////////////////////
///////////////////////////////////////////////
elseif (isset($_POST['addNewKeroDetails'])) {
    $kero = $_POST['kero'];
    $ainaKero = $_POST['ainaKero'];
    $maelezo = $_POST['maelezo'];
    $wahusika = $_POST['wahusika'];
    $tarehe = $_POST['tarehe'];
    $jina = $_POST['jina'];
    $simu = $_POST['simu'];
    $email = $_POST['email'];
    $reg_id = $_POST['reg_id'];
    $disid = $_POST['disid'];
    $cons_id = $_POST['cons_id'];
    $ward_id = $_POST['ward_id'];
    $street_id = $_POST['street_id'];
    $userID = $_POST['userID'];
    $level = $_POST['level'];

    /* $extensional=getExtension($_FILES['photo']['name']);// Get extension
    $valid_formats = array("jpg", "png", "gif", "bmp","jpeg","pdf","docx","doc");
   $name = $_FILES['photo']['name']; //Name of image
   $size = $_FILES['photo']['size']; //Size of image in terms of Byte{1Byte=0.001KB} */


    $addKero = $db->addNewKero($kero, $ainaKero, $maelezo, $wahusika, $tarehe, $jina, $simu, $email, $reg_id, $disid, $cons_id, $ward_id, $street_id, $userID, $level);
    if (isset($addKero)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngKero"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngKero"';
        echo '</script>';
    }
} elseif (isset($_POST['edit_NewKeroDetails'])) {
    $kero = $_POST['kero'];
    $ainaKero = $_POST['ainaKero'];
    $maelezo = $_POST['maelezo'];
    $wahusika = $_POST['wahusika'];
    $tarehe = $_POST['tarehe'];
    $jina = $_POST['jina'];
    $simu = $_POST['simu'];
    $email = $_POST['email'];
    $reg_id = $_POST['reg_id'];
    $disid = $_POST['disid'];
    $cons_id = $_POST['cons_id'];
    $ward_id = $_POST['ward_id'];
    $street_id = $_POST['street_id'];
    $userID = $_POST['userID'];
    $level = $_POST['level'];
    $kero_id = $_POST['kero_id'];
    $status = $_POST['status'];
    $status1 = "Pending";


    $editKero = $db->edit_NewKero($kero, $ainaKero, $maelezo, $wahusika, $tarehe, $jina, $simu, $email, $reg_id, $disid, $cons_id, $ward_id, $street_id, $userID, $level, $kero_id, $status);

    if (isset($editKero)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngKrDetails&cat_id=' . $ainaKero . '&status=' . $status1 . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngKrDetails&cat_id=' . $ainaKero . '&status=' . $status1 . '"';
        echo '</script>';
    }
} //Delete Kero

elseif (isset($_POST['delete_KeroDetails'])) {
    $kero_id = $_POST['kero_id'];
    $type = $_POST['type'];
    $status = $_POST['status'];


    $addKero = $db->delete_NewKero($kero_id);
    if (isset($addKero)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngKrDetails&cat_id=' . $type . '&status=' . $status . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngKrDetails&cat_id=' . $type . '&status=' . $status . '"';
        echo '</script>';
    }
}



////////////////////////////////////////////
////////////////////////////////////////////
/////////KERO TYPE/////////////////////////
//////////////////////////////////////////////
/////////////////////////////////////////////
elseif (isset($_POST['addNewKeroType'])) {
    $keroType = $_POST['keroType'];
    $userID = $_POST['userID'];

    $insertP = $db->insertNewKeroType($keroType, $userID);
    if (isset($insertP)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngKrCat"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngKrCat"';
        echo '</script>';
    }
}


///////////////////////////////////////////
////////////////////////////////////////////
/////////PERSON/////////////////////////
//////////////////////////////////////////////
/////////////////////////////////////////////
elseif (isset($_POST['addNewPerson'])) {
    $region = $_POST['region'];
    $district = $_POST['district'];
    $consName = $_POST['consName'];
    $divName = $_POST['divName'];
    $wardName = $_POST['wardName'];
    $streetName = $_POST['streetName'];
    $substreetName = $_POST['substreetName'];
    $plotnumber = $_POST['plotnumber'];
    $houseNumber = $_POST['houseNumber'];
    $ptype = $_POST['ptype'];
    $kayaType = $_POST['kayaType'];
    $kiongoziF = $_POST['kiongoziF'];
    $uhusiano = $_POST['uhusiano'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $tribe = $_POST['tribe'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $IdType = $_POST['IdType'];
    $nationalID = $_POST['nationalID'];
    $userID = $_POST['userID'];


    if ($ptype == "Kiongozi") {
        $insertP = $db->insertFamilyLeader($nationalID, $IdType, $ptype, $kayaType, $firstname, $lastname, $gender, $dob, $tribe, $phone, $email, $houseNumber, $plotnumber, $streetName, $substreetName, $region, $district, $consName, $divName, $wardName, $userID);
    } else {
        $insertP = $db->insertNewPerson($IdType, $nationalID, $ptype, $kiongoziF, $uhusiano, $firstname, $lastname, $gender, $dob, $tribe, $phone, $email, $houseNumber, $plotnumber, $substreetName, $streetName, $region, $district, $consName, $divName, $wardName, $userID);
    }
    if (isset($insertP)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngPeople"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngPeople"';
        echo '</script>';
    }

    //}
} //Edit Person details
elseif (isset($_POST['editNewPerson'])) {
    $nationalID = $_POST['nationalID'];
    $ptype = $_POST['ptype'];
    $kayaType = $_POST['kayaType'];
    $kiongoziF = $_POST['kiongoziF'];
    $uhusiano = $_POST['uhusiano'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $tribe = $_POST['tribe'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $houseNumber = $_POST['houseNumber'];
    $street_id = $_POST['street_id'];
    $ward_id = $_POST['ward_id'];
    $userID = $_POST['userID'];
    $person_id = $_POST['person_id'];

    $getSt = $db->getStreetNameByWardId($street_id);
    $rw = $getSt->fetch();
    $reg_id = $rw['reg_id'];
    $disid = $rw['dis_id'];
    $cons_id = $rw['cons_id'];
    $ward_id = $rw['ward_id'];

    //Check if National Id Exit

    if ($ptype == "Kiongozi") {
        $insertP = $db->editFamilyLeader($nationalID, $ptype, $kayaType, $firstname, $lastname, $gender, $dob, $tribe, $phone, $email, $houseNumber, $street_id, $reg_id, $disid, $cons_id, $ward_id, $userID, $person_id);
    } else {
        $insertP = $db->editNewPerson($nationalID, $ptype, $kiongoziF, $uhusiano, $firstname, $lastname, $gender, $dob, $tribe, $phone, $email, $houseNumber, $street_id, $reg_id, $disid, $cons_id, $ward_id, $userID, $person_id);
    }
    if (isset($insertP)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngPeople"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngPeople"';
        echo '</script>';
    }
} //Add Person Proffesional
elseif (isset($_POST['addNewPerProffesion'])) {
    $profCategory = $_POST['profCategory'];
    $profName = $_POST['profName'];
    $edulevel = $_POST['edulevel'];
    $college = $_POST['college'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $id = $_POST['id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];


    $insertPerEdu = $db->insertPerProffesional($profCategory, $profName, $edulevel, $college, $start, $end, $id, $userID);
    if (isset($insertPerEdu)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    }
} //Edit Person Proffesional
elseif (isset($_POST['editNewPerProffesion'])) {
    $profCategory = $_POST['profCategory'];
    $profName = $_POST['profName'];
    $edulevel = $_POST['edulevel'];
    $college = $_POST['college'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $id = $_POST['id'];
    $prof_id = $_POST['prof_id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];


    $insertPerEdu = $db->editPersonProffesional($profCategory, $profName, $edulevel, $college, $start, $end, $id, $userID, $prof_id);
    if (isset($insertPerEdu)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    }
} //Delete Person Proffesional
elseif (isset($_POST['deleteNewPerProffesion'])) {

    $id = $_POST['id'];
    $prof_id = $_POST['prof_id'];
    $tab = $_POST['tab'];


    $insertPerEdu = $db->deletePersonProffesional($prof_id);
    if (isset($insertPerEdu)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    }
} //Add Person Employment
elseif (isset($_POST['addNewPerEmployDetails'])) {
    $employerType = $_POST['employerType'];
    $employerName = $_POST['employerName'];
    $position = $_POST['position'];
    $employType = $_POST['employType'];
    $socialFund = $_POST['socialFund'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $id = $_POST['id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];


    $insertPerP = $db->insertPerEmployment($employerType, $employerName, $position, $employType, $socialFund, $start, $end, $id, $userID);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    }
} //Edit Person Employment
elseif (isset($_POST['editNewPerEmployDetails'])) {
    $employerType = $_POST['employerType'];
    $employerName = $_POST['employerName'];
    $position = $_POST['position'];
    $employType = $_POST['employType'];
    $socialFund = $_POST['socialFund'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $id = $_POST['id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];
    $employ_id = $_POST['employ_id'];

    $insertPerP = $db->editPerEmployment($employerType, $employerName, $position, $employType, $socialFund, $start, $end, $id, $employ_id, $userID);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    }
} //Delete Person Employment
elseif (isset($_POST['deleteNewPerEmployDetails'])) {
    $id = $_POST['id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];
    $employ_id = $_POST['employ_id'];


    $insertPerP = $db->deletePerEmployment($employ_id);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $id . '&pDetails=' . $tab . '"';
        echo '</script>';
    }
}

////////////////////////////////////
///////////////////////////////////
////////MANAGE REGION//////////////
////////////////////////////////////
///////////////////////////////////

//Add New Region
elseif (isset($_POST['addNewRegion'])) {
    $regname = $_POST['region'];
    $code = $_POST['code'];

    $insertPerP = $db->addRegion($regname, $code);
    if (isset($insertPerP)) {
    
	   echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../page/RegionManage.php"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../page/RegionManage.php"';
        echo '</script>';
    }
} //Edit Region
elseif (isset($_POST['editRegion'])) {
    $regname = $_POST['region'];
    $userID = $_POST['userId'];
    $regid = $_POST['regid'];


    $insertPerP = $db->editRegion($regname, $userID, $regid);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngReg"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngReg"';
        echo '</script>';
    }
} //Delete Region
elseif (isset($_POST['deleteRegion'])) {
    $regid = $_POST['regid'];

    $insertPerP = $db->deleteRegion($regid);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngReg"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngReg"';
        echo '</script>';
    }
}

/////////////////////////////
/// MANAGE INSTITUTION
/// //////////////////////
//Add New Institution
elseif (isset($_POST['addNewInstitution'])) {
    $name = $_POST['name'];
    $userID = $_POST['userID'];
    $org_type = $_POST['org_type'];

    $insertPerP = $db->addInstitution($name, $org_type);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Added successfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngInstitution"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added successfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngInstitution"';
        echo '</script>';
    }
} // Edit Institution
elseif (isset($_POST['editInstitution'])) {
    $id = $_POST['inst_id'];
    $name = $_POST['name'];
    $org_type = $_POST['org_type'];

    $insertPerP = $db->editInstitution($id, $name, $org_type);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Updated successfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngInstitution"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not updated successfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngInstitution"';
        echo '</script>';
    }
} // delete institution
elseif (isset($_POST['deleteInstitution'])) {

    $id = $_POST['inst_id'];

    $insertPerP = $db->deleteInstitution($id);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Deleted successfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngInstitution"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not deleted successfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngInstitution"';
        echo '</script>';
    }
} elseif (isset($_POST['addInstitutionCourse'])) {

    $selected = $_POST['selectedValue'];
    $inst_id = $_POST['inst_id'];

    $insertPerP = $db->insertInstitutionProgram($inst_id, $selected);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Added successfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngInstitution"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not added successfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngInstitution"';
        echo '</script>';
    }
}

/////////////////////////////
/// MANAGE COURSE
/// //////////////////////
//Add New Course
elseif (isset($_POST['addNewCourse'])) {
    $id = $_POST['userID'];
    $name = $_POST['name'];
    $org_type = $_POST['org_type'];
    $abbreviation = $_POST['abbreviation'];

    $insertPerP = $db->addCourse($name, $abbreviation, $org_type);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Added successfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCourse"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added successfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCourse"';
        echo '</script>';
    }
} // Edit Course
elseif (isset($_POST['editCourse'])) {

    $id = $_POST['course_id'];
    $name = $_POST['name'];
    $org_type = $_POST['org_type'];
    $abbreviation = $_POST['abbreviation'];

    $insertPerP = $db->editCourse($id, $name, $abbreviation, $org_type);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Updated successfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCourse"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not updated successfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCourse"';
        echo '</script>';
    }
} // delete institution
elseif (isset($_POST['deleteCourse'])) {

    $id = $_POST['course_id'];

    $insertPerP = $db->deleteCourse($id);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Deleted successfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCourse"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not deleted successfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCourse"';
        echo '</script>';
    }
}

////////////////////////////////////
///////////////////////////////////
////////MANAGE MINISTRY////////////
////////////////////////////////////
///////////////////////////////////

//Add New Organization
elseif (isset($_POST['addOrganization'])) {
    $orgName = $_POST['orgName'];
    $region = $_POST['region'];

    $insertPerP = $db->addMinistry($orgName, $region);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngMin"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngMin"';
        echo '</script>';
    }
} //Edit Organization
elseif (isset($_POST['editOrganization'])) {
    $orgName = $_POST['orgName'];
    $region = $_POST['region'];
    $min_id = $_POST['min_id'];

    $insertPerP = $db->editOrganization($orgName, $region, $min_id);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngMin"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngMin"';
        echo '</script>';
    }
} //Delete Organization
elseif (isset($_POST['deleteOrganization'])) {
    $min_id = $_POST['min_id'];

    $insertPerP = $db->deleteOrganization($min_id);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngMin"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngMin"';
        echo '</script>';
    }
}





////////////////////////////////////
///////////////////////////////////
////////MANAGE DISTRICT////////////
////////////////////////////////////
///////////////////////////////////

//Add New District
elseif (isset($_POST['addDistrict'])) {
    $disName = $_POST['disName'];
    $region = $_POST['region'];

    $insertPerP = $db->addDistrict($disName, $region);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../page/DistrictManage.php"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../page/DistrictManage.php"';
        echo '</script>';
    }
} //Edit District
elseif (isset($_POST['editDistrict'])) {
    $disName = $_POST['disName'];
    $region = $_POST['region'];
    $disid = $_POST['disid'];

    $insertPerP = $db->editDistrict($disName, $region, $disid);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDis"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDis"';
        echo '</script>';
    }
} //Delete District
elseif (isset($_POST['deleteDistrict'])) {
    $disid = $_POST['disid'];


    $insertPerP = $db->deleteDistrict($disid);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDis"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDis"';
        echo '</script>';
    }
}

////////////////////////////////////
///////////////////////////////////
////////MANAGE RAS/////////////
////////////////////////////////////
///////////////////////////////////
//Add New RAS

elseif (isset($_POST['addRAS'])) {
    $rasName = $_POST['rasName'];
    $userID = $_POST['userID'];
    $region_id = $_POST['region_id'];

    $insertras = $db->addRAS($rasName, $userID, $region_id);
    if (isset($insertras)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRAS"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRAS"';
        echo '</script>';
    }
} //Edit Region
elseif (isset($_POST['editRAS'])) {
    $rasName = $_POST['rasName'];
    // $userID=$_POST['userId'];
    $ras_id = $_POST['ras_id'];
    $region_id = $_POST['region_id'];

    $insertras = $db->editRAS($rasName, $ras_id, $region_id);
    if (isset($insertras)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRAS"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRAS"';
        echo '</script>';
    }
} //Delete RAS
elseif (isset($_POST['deleteRAS'])) {
    $ras_id = $_POST['ras_id'];

    $insertras = $db->deleteRAS($ras_id);
    if (isset($insertras)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRAS"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRAS"';
        echo '</script>';
    }
}


////////////////////////////////////
///////////////////////////////////
////////MANAGE RRH/////////////
////////////////////////////////////
///////////////////////////////////
//Add New RRH

elseif (isset($_POST['addRRH'])) {
    $rrhName = $_POST['rrhName'];
    $userID = $_POST['userID'];
    $level = $_POST['level'];
    $region_id = $_POST['region_id'];

    $insertras = $db->addRRH($rrhName, $level, $region_id);
    if (isset($insertras)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRRH"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRRH"';
        echo '</script>';
    }
} //Edit Region
elseif (isset($_POST['editRRH'])) {
    $rrhName = $_POST['rrhName'];
    $level=$_POST['level'];
    $rrh_id = $_POST['rrh_id'];
    $region_id = $_POST['region_id'];

    $insertrrh = $db->editRRH($rrhName, $level, $rrh_id, $region_id);
    if (isset($insertrrh)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRRH"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRRH"';
        echo '</script>';
    }
} //Delete RAS
elseif (isset($_POST['deleteRRH'])) {
    $rrh_id = $_POST['rrh_id'];

    $insertrrh = $db->deleteRRH($rrh_id);
    if (isset($insertrrh)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRRH"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRRH"';
        echo '</script>';
    }
}



////////////////////////////////////
///////////////////////////////////
////////MANAGE Training Type/////////////
////////////////////////////////////
///////////////////////////////////
//Add New Training Type

elseif (isset($_POST['addTrainingType'])) {
    $trainingtypeName = $_POST['trainingtypeName'];
    $userID = $_POST['userID'];

    $insertTrainingType = $db->addTrainingType($trainingtypeName, $userID);
    if (isset($insertTrainingType)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=TrainingType"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=TrainingType"';
        echo '</script>';
    }
} //Edit Training Type
elseif (isset($_POST['editTrainingType'])) {
    $trainingtypeName = $_POST['trainingtypeName'];
    // $userID=$_POST['userId'];
    $trainingtype_id = $_POST['trainingtype_id'];

    $insertTrainingType = $db->editTrainingType($trainingtypeName, $trainingtype_id);
    if (isset($insertTrainingType)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=TrainingType"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=TrainingType"';
        echo '</script>';
    }
} //Delete Training Type
elseif (isset($_POST['deleteTrainingType'])) {
    $trainingtype_id = $_POST['trainingtype_id'];

    $insertTrainingType = $db->deleteTrainingType($trainingtype_id);
    if (isset($insertTrainingType)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=TrainingType"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=TrainingType"';
        echo '</script>';
    }
}




////////////////////////////////////
///////////////////////////////////
////////MANAGE Disability/////////////
////////////////////////////////////
///////////////////////////////////
//Add New Disability

elseif (isset($_POST['addDisability'])) {
    $disabilityName = $_POST['disabilityName'];
    $userID = $_POST['userID'];

    $insertDisability = $db->addDisability($disabilityName, $userID);
    if (isset($insertDisability)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDisiability"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDisiability"';
        echo '</script>';
    }
} //Edit Region
elseif (isset($_POST['editDisability'])) {
    $disabilityName = $_POST['disabilityName'];
    // $userID=$_POST['userId'];
    $disability_id = $_POST['disability_id'];

    $insertDisability = $db->editDisability($disabilityName, $disability_id);
    if (isset($insertDisability)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDisiability"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDisiability"';
        echo '</script>';
    }
} //Delete RAS
elseif (isset($_POST['deleteDisability'])) {
    $disability_id = $_POST['disability_id'];

    $insertDisability = $db->deleteDisability($disability_id);
    if (isset($insertDisability)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDisiability"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngDisiability"';
        echo '</script>';
    }
}



////////////////////////////////////
///////////////////////////////////
////////MANAGE FACILITY/////////////
////////////////////////////////////
///////////////////////////////////
//Add New Facility
elseif (isset($_POST['addFacility'])) {
    $facName = strtoupper($_POST['agencyName']);
    $facility_type_id = $_POST['facility_type_id'];
    $region = $_POST['region'];
    $district = $_POST['facName'];

    $insertPerP = $db->addFacility($facName, $facility_type_id, $region, $district);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFac"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFac"';
        echo '</script>';
    }
} //Edit Facility
elseif (isset($_POST['editFacilityDetails'])) {
    $facName = $_POST['facName'];
    $region = $_POST['region'];
    $district = $_POST['district'];
    $facid = $_POST['facid'];

    $insertPerP = $db->editFacilityDetails($facName, $region, $district, $facid);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFac"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFac"';
        echo '</script>';
    }
} //Delete Facility
elseif (isset($_POST['deleteFacilityDetails'])) {
    $facid = $_POST['facid'];

    $insertPerP = $db->deleteFacilityDetails($facid);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFac"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFac"';
        echo '</script>';
    }
}

elseif (isset($_POST['addFacilityType'])) {
    $name = $_POST['type'];

    $insertPerP = $db->addFacilityType($name);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFac"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFac"';
        echo '</script>';
    }
} 

elseif (isset($_POST['editFacilityType'])) {
    $name = $_POST['type'];
    $facility_type_id = $_POST['facility_type_id'];

    $insertPerP = $db->editFacilityType($name, $facility_type_id);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFac"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFac"';
        echo '</script>';
    }
}
elseif (isset($_POST['deleteFacilityType'])) {
    $facility_type_id = $_POST['facility_type_id'];

    $insertPerP = $db->deleteFacilityType($facility_type_id);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFac"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngFac"';
        echo '</script>';
    }
}
////////////////////////////////////
///////////////////////////////////
////////MANAGE HEALTH CADRE/////////
////////////////////////////////////
///////////////////////////////////
//Add New Health Cadre
elseif (isset($_POST['addHealthCadre'])) {
    $cadreName = strtoupper($_POST['cadreName']);
    $level = $_POST['level'];
    $trainType = $_POST['trainType'];
    $boardV = $_POST['boardV'];

    $insertPerP = $db->addHealthCadre($cadreName, $level, $trainType, $boardV);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCdre"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCdre"';
        echo '</script>';
    }
} //Edit Health Cadre
elseif (isset($_POST['editHealthCadre'])) {
    $cadreName = strtoupper($_POST['cadreName']);
    $level = $_POST['level'];
    $trainType = $_POST['trainType'];
    $boardV = $_POST['boardV'];
    $cadreid = $_POST['cadreid'];

    $insertPerP = $db->editHealthCadre($cadreName, $level, $trainType, $boardV, $cadreid);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCdre"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCdre"';
        echo '</script>';
    }
} //Delete Health Cadre
elseif (isset($_POST['deleteHealthCadre'])) {
    $cadreid = $_POST['cadreid'];

    $insertPerP = $db->deleteHealthCadre($cadreid);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCdre"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCdre"';
        echo '</script>';
    }
}


////////////////////////////////////
///////////////////////////////////
////////MANAGE CRITERIA/////////////
////////////////////////////////////
///////////////////////////////////
//Add New Criteria
elseif (isset($_POST['addCriteria'])) {
    $criteriaName = strtoupper($_POST['criteriaName']);
    $userID = $_POST['userID'];
    $standard_id = $_POST['standard_id'];
    // echo $standard_id;
    // exit();

    $insertPerP = $db->addCriteria($criteriaName, $userID, $standard_id);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCrS"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCrS"';
        echo '</script>';
    }
} //Edit Health Cadre
elseif (isset($_POST['editCriteria'])) {
    $criteriaName = strtoupper($_POST['criteriaName']);
    $criteriaid = $_POST['criteriaid'];

    $insertPerP = $db->editCriteria($criteriaName, $criteriaid);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCrS"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCrS"';
        echo '</script>';
    }
} //Delete Health Cadre
elseif (isset($_POST['deleteCriteria'])) {
    $criteriaid = $_POST['criteriaid'];

    $insertPerP = $db->deleteCriteria($criteriaid);
    if (isset($insertPerP)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCrS"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngCrS"';
        echo '</script>';
    }
}




//////////////////////////////////////////////
/////////////////////////////////////////////
/////////PERSONAL OCCUPATION //////////////
//////////////////////////////////////////////
/////////////////////////////////////////////
//------Add Mwanafunzi details----->
elseif (isset($_POST['addPersOccFormI'])) {
    $cat = $_POST['cat'];
    $status = $_POST['status'];
    $eduLvel = $_POST['eduLvel'];
    $college = $_POST['college'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $personal_id = $_POST['personal_id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];


    $insertSoc = $db->insertMwanafunzi($cat, $status, $eduLvel, $college, $start, $end, $personal_id, $userID);
    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    }
} //----->Edit Mwanafunzi-->
elseif (isset($_POST['editThis_Mwanafunzi'])) {
    $cat = $_POST['cat'];
    $status = $_POST['status'];
    $eduLvel = $_POST['eduLvel'];
    $college = $_POST['college'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $personal_id = $_POST['person_id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];
    $table_id = $_POST['table_id'];


    $editSoc = $db->editMwanafunziOcc($table_id, $cat, $status, $eduLvel, $college, $start, $end, $personal_id, $userID);
    if (isset($editSoc)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    }
} //------Add Biashara details----->
elseif (isset($_POST['addPersOccFormII'])) {
    $cat = $_POST['cat'];
    $status = $_POST['status'];
    $biasharaAina = $_POST['biasharaAina'];
    $biasharaKiwango = $_POST['biasharaKiwango'];
    $usajili = $_POST['usajili'];
    $usajiliNo = $_POST['usajiliNo'];
    $personal_id = $_POST['personal_id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];


    $insertSoc = $db->insertBiashara($cat, $status, $biasharaAina, $biasharaKiwango, $usajili, $usajiliNo, $personal_id, $userID);
    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    }
} //----->Edit Biashra-->
elseif (isset($_POST['editThis_Biashara'])) {
    $cat = $_POST['cat'];
    $status = $_POST['status'];
    $biasharaAina = $_POST['biasharaAina'];
    $biasharaKiwango = $_POST['biasharaKiwango'];
    $usajili = $_POST['usajili'];
    $usajiliNo = $_POST['usajiliNo'];
    $personal_id = $_POST['person_id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];
    $table_id = $_POST['table_id'];


    $editSoc = $db->editBiasharaOcc($table_id, $cat, $status, $biasharaAina, $biasharaKiwango, $usajili, $usajiliNo, $personal_id, $userID);
    if (isset($editSoc)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    }
} //------Add Mfanyakazi details----->
elseif (isset($_POST['addPersOccFormIII'])) {
    $cat = $_POST['cat'];
    $status = $_POST['status'];
    $employerType = $_POST['employerType'];
    $employerName = $_POST['employerName'];
    $position = $_POST['position'];
    $employType = $_POST['employType'];
    $socialFund = $_POST['socialFund'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $personal_id = $_POST['personal_id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];


    $insertSoc = $db->insertMfanyakazi($cat, $status, $employerType, $employerName, $position, $employType, $socialFund, $start, $end, $personal_id, $userID);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    }
} //----->Edit Mfanyakazi-->
elseif (isset($_POST['editThis_Mfanyakazi'])) {
    $cat = $_POST['cat'];
    $status = $_POST['status'];
    $employerType = $_POST['employerType'];
    $employerName = $_POST['employerName'];
    $position = $_POST['position'];
    $employType = $_POST['employType'];
    $socialFund = $_POST['socialFund'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $personal_id = $_POST['person_id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];
    $table_id = $_POST['table_id'];


    $editSoc = $db->editMfanyakaziOcc($table_id, $cat, $status, $employerType, $employerName, $position, $employType, $socialFund, $start, $end, $personal_id, $userID);
    if (isset($editSoc)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    }
} //------Add Mkulima details----->
elseif (isset($_POST['addPersOccFormIV'])) {
    $cat = $_POST['cat'];
    $status = $_POST['status'];
    $kilimoAina = $_POST['kilimoAina'];
    $zao = $_POST['zao'];
    $hekali = $_POST['hekali'];
    $wastani = $_POST['wastani'];
    $unit = $_POST['unit'];
    $mwezi = $_POST['mwezi'];
    $mwaka = $_POST['mwaka'];
    $kilimoKusudi = $_POST['kilimoKusudi'];
    $mkoa = $_POST['region'];
    $wilaya = $_POST['district'];
    $personal_id = $_POST['personal_id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];


    $insertSoc = $db->insertMkulima($cat, $status, $kilimoAina, $zao, $hekali, $wastani, $unit, $mwezi, $mwaka, $kilimoKusudi, $mkoa, $wilaya, $personal_id, $userID);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    }
} //------Edit Mkulima details----->
elseif (isset($_POST['editPersOccFormIV'])) {
    $cat = $_POST['cat'];
    $status = $_POST['status'];
    $kilimoAina = $_POST['kilimoAina'];
    $zao = $_POST['zao'];
    $hekali = $_POST['hekali'];
    $wastani = $_POST['wastani'];
    $unit = $_POST['unit'];
    $mwezi = $_POST['mwezi'];
    $mwaka = $_POST['mwaka'];
    $kilimoKusudi = $_POST['kilimoKusudi'];
    $mkoa = $_POST['region'];
    $wilaya = $_POST['district'];
    $personal_id = $_POST['personal_id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];
    $table_id = $_POST['table_id'];


    $insertSoc = $db->editMkulima($cat, $status, $kilimoAina, $zao, $hekali, $wastani, $unit, $mwezi, $mwaka, $kilimoKusudi, $mkoa, $wilaya, $personal_id, $userID, $table_id);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    }
} //------Delete Mkulima details----->
elseif (isset($_POST['deletePersOccFormIV'])) {
    $cat = $_POST['cat'];
    $status = $_POST['status'];
    $kilimoAina = $_POST['kilimoAina'];
    $zao = $_POST['zao'];
    $hekali = $_POST['hekali'];
    $wastani = $_POST['wastani'];
    $unit = $_POST['unit'];
    $mwezi = $_POST['mwezi'];
    $mwaka = $_POST['mwaka'];
    $kilimoKusudi = $_POST['kilimoKusudi'];
    $mkoa = $_POST['mkoa'];
    $wilaya = $_POST['wilaya'];
    $personal_id = $_POST['personal_id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];
    $table_id = $_POST['table_id'];

    $insertSoc = $db->deleteMkulima($table_id);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    }
} //------Add Mfugaji details----->
elseif (isset($_POST['addPersOccFormV'])) {
    $cat = $_POST['cat'];
    $status = $_POST['status'];
    $ufugajiAina = $_POST['ufugajiAina'];
    $mnyama = $_POST['mnyama'];
    $idadi = $_POST['idadi'];
    $kusudi = $_POST['kusudi'];
    $mkoa = $_POST['region'];
    $wilaya = $_POST['district'];
    $personal_id = $_POST['personal_id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];

    $insertSoc = $db->insertMfugaji($cat, $status, $ufugajiAina, $mnyama, $idadi, $kusudi, $mkoa, $wilaya, $personal_id, $userID);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    }
} //------Edit Mfugaji details----->
elseif (isset($_POST['editPersOccFormV'])) {
    $cat = $_POST['cat'];
    $status = $_POST['status'];
    $ufugajiAina = $_POST['ufugajiAina'];
    $mnyama = $_POST['mnyama'];
    $idadi = $_POST['idadi'];
    $kusudi = $_POST['kusudi'];
    $mkoa = $_POST['region'];
    $wilaya = $_POST['district'];
    $personal_id = $_POST['personal_id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];
    $table_id = $_POST['table_id'];


    $insertSoc = $db->editMfugaji($cat, $status, $ufugajiAina, $mnyama, $idadi, $kusudi, $mkoa, $wilaya, $personal_id, $userID, $table_id);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    }
} //------Delete Mfugaji details----->
elseif (isset($_POST['deletePersOccFormV'])) {
    $cat = $_POST['cat'];
    $status = $_POST['status'];
    $personal_id = $_POST['personal_id'];
    $userID = $_POST['userID'];
    $tab = $_POST['tab'];
    $table_id = $_POST['table_id'];

    $insertSoc = $db->deleteMfugaji($table_id);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=perDe&id=' . $personal_id . '&pDetails=occupation&tab=' . $tab . '"';
        echo '</script>';
    }
} //------Add new mazao----->
elseif (isset($_POST['addNewMazao'])) {
    $zao = $_POST['zao'];


    $insertSoc = $db->addMazao($zao);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mzo"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mzo"';
        echo '</script>';
    }
} //------Edit  mazao----->
elseif (isset($_POST['editThisMazao'])) {
    $zao = $_POST['zao'];
    $zaoID = $_POST['zaoID'];


    $insertSoc = $db->editMazao($zao, $zaoID);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mzo"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mzo"';
        echo '</script>';
    }
} //------Delete  mazao----->
elseif (isset($_POST['deleteThisMazao'])) {

    $zaoID = $_POST['zaoID'];

    $insertSoc = $db->deleteMazao($zaoID);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mzo"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mzo"';
        echo '</script>';
    }
} //------Add new Mfugo----->
elseif (isset($_POST['addNewMfugo'])) {
    $jina = $_POST['jina'];

    $insertSoc = $db->addMifugo($jina);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mfg"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mfg"';
        echo '</script>';
    }
} //------Edit  Mfugo----->
elseif (isset($_POST['editThisMfugo'])) {
    $jina = $_POST['jina'];
    $mifugoID = $_POST['mifugoID'];


    $insertSoc = $db->editMifugo($jina, $mifugoID);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mfg"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mfg"';
        echo '</script>';
    }
} //------Delete  Mfugo----->
elseif (isset($_POST['deleteThisMfugo'])) {

    $mifugoID = $_POST['mifugoID'];

    $insertSoc = $db->deleteMifugo($mifugoID);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mfg"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mfg"';
        echo '</script>';
    }
} //------Add new Access Level----->
elseif (isset($_POST['addNewAccLevel'])) {
    $jina = $_POST['jina'];

    $insertSoc = $db->addAccessLevel($jina);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=accLvl"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=accLvl"';
        echo '</script>';
    }
} //------Edit  Access Level----->
elseif (isset($_POST['editAccLevel'])) {
    $jina = $_POST['jina'];
    $accID = $_POST['accID'];


    $insertSoc = $db->editAccLevel($jina, $accID);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=accLvl"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=accLvl"';
        echo '</script>';
    }
} //------Delete  Access Level----->
elseif (isset($_POST['deleteAccLevel'])) {

    $accID = $_POST['accID'];

    $insertSoc = $db->deleteAccLevel($accID);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=accLvl"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=accLvl"';
        echo '</script>';
    }
} //------Add new Leader----->
elseif (isset($_POST['addNewLeader'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $placeBirth = $_POST['region'];
    $maritalStatus = $_POST['maritalStatus'];
    $position = $_POST['position'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $status = $_POST['status'];
    $userID = $_POST['userID'];
    $level = $_POST['level'];
    $levelID = $_POST['levelID'];

    $insertSoc = $db->addNewLeader($firstname, $lastname, $gender, $dob, $placeBirth, $maritalStatus, $position, $phone, $email, $start, $end, $status, $userID, $level, $levelID);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRL&regid=' . $levelID . '&level=' . $level . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRL&regid=' . $levelID . '&level=' . $level . '"';
        echo '</script>';
    }
} //------Delete Leader----->
elseif (isset($_POST['deleteLeader'])) {
    $table_id = $_POST['table_id'];
    $level = $_POST['level'];
    $levelID = $_POST['levelID'];

    $insertSoc = $db->deleteLeader($table_id);

    if (isset($insertSoc)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRL&regid=' . $levelID . '&level=' . $level . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngRL&regid=' . $levelID . '&level=' . $level . '"';
        echo '</script>';
    }
}



//////////////////////////////////////////////
/////////////////////////////////////////////
/////////PROCESSING INDUSTRY///////////
//////////////////////////////////////////////
/////////////////////////////////////////////
elseif (isset($_POST['addNewIndustry'])) {
    $reg_id = $_POST['region'];
    $disid = $_POST['district'];
    $cons_id = $_POST['consName'];
    $divName = $_POST['divName'];
    $ward_id = $_POST['wardName'];
    $street_id = $_POST['streetName'];
    $substreetName = $_POST['substreetName'];
    $plotNumber = $_POST['plotnumber'];

    $bussName = $_POST['bussName'];
    $busCategory = $_POST['busCategory'];
    $busType = $_POST['busType'];
    $income = $_POST['income'];
    $ownerName = $_POST['ownerName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $regNo = $_POST['regNo'];
    $userID = $_POST['userID'];


    $insertBus = $db->insertNewIndustry($bussName, $busCategory, $busType, $income, $ownerName, $phone, $email, $address, $plotNumber, $regNo, $userID, $street_id, $substreetName, $reg_id, $disid, $cons_id, $divName, $ward_id);
    if (isset($insertBus)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngVw"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngVw"';
        echo '</script>';
    }
} //---Delete
elseif (isset($_POST['delete_Industry'])) {
    $bus_id = $_POST['bus_id'];


    $deleteBus = $db->delete_Industry($bus_id);
    if (isset($deleteBus)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngVw"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngVw"';
        echo '</script>';
    }
}


////////////////////////////
////////////////////////////
////////EDUCATION Details////
/////////////////////////////
//////////////////////////////
elseif((isset($_POST['AddPicha'])))
{
	$aina = $_POST['aina'];
    $docname = $_FILES['certificate']['name'];
    $docsize = $_FILES['certificate']['size'];
    $extension = getExtension($docname); // Get extension
	$bunge_id = $_POST['idd'];
	if ($docsize > 1024000) 
	{//check type and size 1024kb
                echo '<script language="javascript">';
                echo "alert('Error: Not uploaded, Only file with max size of 1024KB/1MB allowed')";
                echo '</script>';
                echo '<script language="javascript">';
                echo 'location.href = "../?pg=PichaPost"';
                echo '</script>';
     }else
	 {
		 
		 $checkEd = $db->addPicha($extension, $docsize, $aina, $bunge_id);
		 echo '<script language="javascript">';
                echo "alert('Uploaded successfully')";
                echo '</script>';
                echo '<script language="javascript">';
                echo 'location.href = "../?pg=Picha"';
                echo '</script>';
	 }
	
}
elseif (isset($_POST['AddEducation'])) {
    $eduLevel = $_POST['eduLevel'];
    $school = addslashes($_POST['school']);
    $indexNo = strtoupper($_POST['indexNo']);
    $year = $_POST['year'];
    if (empty($_POST['division'])) {
        $division = "none";
    } else {
        $division = $_POST['division'];
    }

    if (empty($_POST['merit'])) {
        $merit = "none";
    } else {
        $merit = $_POST['merit'];
    }
    // $merit = $_POST['merit'];
    $applicant_id = $_POST['applicant_id'];

    //
    $docname = $_FILES['certificate']['name'];
    $docsize = $_FILES['certificate']['size'];
    $extension = getExtension($docname); // Get extension

    //get cetificate type
    $getDocTyp = $db->getDocType($eduLevel);
    $doctype = $getDocTyp->fetch();
    $docuType = $doctype['DocumentID'];


    //Check if education details is already addEducation
    $checkEd = $db->checkBasicEducationIfExit($eduLevel, $school, $indexNo, $applicant_id);
    if ($checkEd->rowCount() > 0) {
        echo '<script language="javascript">';
        echo "alert('Error: Education detail exist')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=bEd"';
        echo '</script>';
    } else {
        //Check if file uploaded
        $checkF = $db->checkIfFileExist($docuType, $applicant_id);
        if ($checkF->rowCount() > 0) {
            echo '<script language="javascript">';
            echo "alert('Error: Not uploaded sucessfully because this file exist')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=bEd"';
            echo '</script>';
        } else {
            if ($docsize > 1024000 || $extension != 'pdf') { //check type and size 1024kb
                echo '<script language="javascript">';
                echo "alert('Error: Not uploaded, Only PDF file with max size of 1024KB/1MB allowed')";
                echo '</script>';
                echo '<script language="javascript">';
                echo 'location.href = "../?pg=bEd"';
                echo '</script>';
            } else {
                $deleteBus = $db->addEducation($eduLevel, $school, $indexNo, $year, $division, $merit, $applicant_id, $docuType, $extension, $docname);
                if (isset($deleteBus)) {
                    echo '<script language="javascript">';
                    echo "alert('Added sucessfully')";
                    echo '</script>';
                    echo '<script language="javascript">';
                    echo 'location.href = "../?pg=bEd"';
                    echo '</script>';
                } else {
                    echo '<script language="javascript">';
                    echo "alert('Error: Not Added sucessfully')";
                    echo '</script>';
                    echo '<script language="javascript">';
                    echo 'location.href = "../?pg=bEd"';
                    echo '</script>';
                }
            }
        }
    }
} //Edit education
elseif (isset($_POST['editEducation'])) {
    $eduLevel = $_POST['eduLevel'];
    $school = strtoupper($_POST['school']);
    $indexNo = strtoupper($_POST['indexNo']);
    $year = $_POST['year'];
    if (empty($_POST['division'])) {
        $division = "none";
    } else {
        $division = $_POST['division'];
    }

    if (empty($_POST['merit'])) {
        $merit = "none";
    } else {
        $merit = $_POST['merit'];
    }
    //$division = $_POST['division'];
    //$merit = $_POST['merit'];
    $edu_id = $_POST['edu_id'];
    $applicant_id = $_POST['applicant_id'];

    if (isset($_FILES['certificate']['name']) && !empty($_FILES['certificate']['name'])){
        $docname = $_FILES['certificate']['name'];
        $docsize = $_FILES['certificate']['size'];
        $extension = getExtension($docname);
        $getDocTyp = $db->getDocType($eduLevel);
        $docData = $getDocTyp->fetch();
        $docTypeID = $docData['DocumentID'];
    }else{
        $docname = null;
        $extension = null;
        $docTypeID = null;
    }

    $deleteBus = $db->editEducation($eduLevel, $school, $indexNo, $year, $division,$merit,$edu_id, $applicant_id, $docTypeID,$docname,$extension);
    if (isset($deleteBus)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=bEd"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=bEd"';
        echo '</script>';
    }
} //Delete education
elseif (isset($_POST['deleteEducation'])) {
    //die(var_dump($_POST));
    $edu_id = $_POST['edu_id'];
    $doc_id = $_POST['doc_id'];
    $applicant_id = $_POST['applicant'];

    $deleteBus = $db->deleteEducation($edu_id, $doc_id, $applicant_id);
    if (isset($deleteBus)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=bEd"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=bEd"';
        echo '</script>';
    }
}


////////////////////////////
////////////////////////////
////////PROFESSIONAL Details////
/////////////////////////////
//////////////////////////////
elseif (isset($_POST['AddProfessional'])) {
    $level = $_POST['level'];
    $location = $_POST['location'];
    $college = $_POST['college'];
    $progName = strtoupper($_POST['progName']);
    $end = $_POST['end'];
    $applicant_id = $_POST['applicant_id'];
    $current = $_POST['is_current'];

    $certificateName = $_FILES['certificate']['name'];
    $certificateSize = $_FILES['certificate']['size'];
    $extensionCertificate = getExtension($certificateName);
    # get certificate type
    $getDocTypCertificate = $db->getDocType('Professional Certificate');
    $doctypeCertificate = $getDocTypCertificate->fetch();
    $doctypeCertificateID = $doctypeCertificate['DocumentID'];

    $transcriptName = $_FILES['transcript']['name'];
    $transcriptSize = $_FILES['transcript']['size'];
    $extensionTranscript = getExtension($transcriptName);
    # get Transcript
    $getDocTypTrans = $db->getDocType('Transcript');
    $doctypeTrans = $getDocTypTrans->fetch();
    $docTypeTransID = $doctypeTrans['DocumentID'];

    # get verification letter
    if (isset($_FILES['verification_letter'])) {
        $transcriptName = $_FILES['verification_letter']['name'];
        $transcriptSize = $_FILES['verification_letter']['size'];
        $extensionVerificationLetter = getExtension($transcriptName);
        # get Transcript
        $getDocTypVer = $db->getDocType('Verification Letter');
        $doctypeVer = $getDocTypTrans->fetch();
        $docTypeVerID = $doctypeTrans['DocumentID'];
    }

    if ($certificateSize > 1024000 || $extensionCertificate != 'pdf' || $extensionTranscript != 'pdf' || $transcriptSize > 1024000) {
        echo '<script language="javascript">';
        echo "alert('Error: Not uploaded, Only PDF file with max size of 1024KB/1MB allowed')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=proD"';
        echo '</script>';
    } else {
        $addData = $db->addProfessional(
            $level, $location, $college, $progName, $end, $applicant_id,
            $doctypeCertificateID, $extensionCertificate,
            $docTypeTransID,$extensionTranscript, $current, $extensionVerificationLetter, $docTypeVerID);
        if (isset($addData)) {
            echo '<script language="javascript">';
            echo "alert('Added sucessfully')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=proD"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo "alert('Error: Not Added sucessfully')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=proD"';
            echo '</script>';
        }
    }
} //EDIT PROFESSIONAL
elseif (isset($_POST['editProfessional'])) {

    $prof_id = $_POST['prof_id'];
    $level = $_POST['level'];
    $location = $_POST['location'];
    $college = $_POST['college'];
    $progName = strtoupper($_POST['progName']);
    $end = $_POST['end'];
    $applicant_id = $_POST['applicant_id'];
    $current = $_POST['is_current'];

    if(isset($_FILES['certificate']['name']) && !empty($_FILES['certificate']['name'])){
        $certificateName = $_FILES['certificate']['name'];
        $certificateSize = $_FILES['certificate']['size'];
        $extensionCertificate = getExtension($certificateName);
        # get certificate type
        $getDocTypCertificate = $db->getDocType('Professional Certificate');
        $doctypeCertificate = $getDocTypCertificate->fetch();
        $doctypeCertificateID = $doctypeCertificate['DocumentID'];
    }else{
        $doctypeCertificateID = null;
        $extensionCertificate = null;
    }

    if(isset($_FILES['transcript']['name']) && !empty($_FILES['transcript']['name'])){
        $transcriptName = $_FILES['transcript']['name'];
        $transcriptSize = $_FILES['transcript']['size'];
        $extensionTranscript = getExtension($transcriptName);
        # get Transcript
        $getDocTypTrans = $db->getDocType('Transcript');
        $doctypeTrans = $getDocTypTrans->fetch();
        $docTypeTransID = $doctypeTrans['DocumentID'];
    }else{
        $docTypeTransID = null;
        $extensionTranscript = null;
    }

    # get verification letter
    if (isset($_FILES['verification_letter'])) {
        $transcriptName = $_FILES['verification_letter']['name'];
        $transcriptSize = $_FILES['verification_letter']['size'];
        $extensionVerificationLetter = getExtension($transcriptName);
        # get Transcript
        $getDocTypVer = $db->getDocType('Verification Letter');
        $doctypeVer = $getDocTypTrans->fetch();
        $docTypeVerID = $doctypeTrans['DocumentID'];
    }else{
        $extensionVerificationLetter = null;
        $docTypeVerID = null;

    }


    $deleteBus = $db->editProfessional(
        $prof_id,$level, $location, $college, $progName, $end, $applicant_id,
        $doctypeCertificateID, $extensionCertificate,
        $docTypeTransID,$extensionTranscript, $current, $extensionVerificationLetter, $docTypeVerID);


    if (isset($deleteBus)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=proD"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=proD"';
        echo '</script>';
    }
} //Delete
elseif (isset($_POST['deleteProfessional'])) {
    $prof_id = $_POST['prof_id'];
    $applicant_id = $_POST['applicant_id'];

    $deleteBus = $db->deleteProfessional($prof_id, $applicant_id);
    if (isset($deleteBus)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=proD"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=proD"';
        echo '</script>';
    }
}


////////////////////////////
////////////////////////////
///////EXPERIENCE///////////
/////////////////////////////
//////////////////////////////
elseif (isset($_POST['AddExperience'])) {
    $employer = $_POST['employer'];
    $position = $_POST['position'];
    $employType = $_POST['employType'];
    $start = $_POST['start'];
    if ($_POST['currentEmployment'] == 'NO') {
        $end = $_POST['end'];
    } else {
        $end = '0';
    }
    $applicant_id = $_POST['applicant_id'];


    $addEx = $db->AddExperience($employer, $position, $employType, $start, $end, $applicant_id);
    if (isset($addEx)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=ExpD"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=ExpD"';
        echo '</script>';
    }
} //Edit
elseif (isset($_POST['editExperience'])) {
    $employer = $_POST['employer'];
    $position = $_POST['position'];
    $employType = $_POST['employType'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $applicant_id = $_POST['applicant_id'];
    $exp_id = $_POST['exp_id'];


    $editEx = $db->editExperience($employer, $position, $employType, $start, $end, $applicant_id, $exp_id);
    if (isset($editEx)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=ExpD"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=ExpD"';
        echo '</script>';
    }
} //Delete experince
elseif (isset($_POST['deleteExperience'])) {
    $exp_id = $_POST['exp_id'];

    $addEx = $db->deleteExperience($exp_id);
    if (isset($addEx)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=ExpD"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=ExpD"';
        echo '</script>';
    }
}



////////////////////////////
////////////////////////////
///////REGISTRATION///////////
/////////////////////////////
//////////////////////////////
//check if registration exist
elseif (isset($_POST['searchRegistration'])) {
    $council = $_POST['council'];
    $regType = $_POST['regType'];
    $regNo = $_POST['regNo'];
    $regYear = $_POST['regYear'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $applicant_id = $_POST['applicant_id'];

    //Check if user exist
    $checkR = $db->checkIfRegistrationExist($council, $regType, $regNo, $regYear, $firstname, $lastname);


    if (isset($addEx)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=regD"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=regD"';
        echo '</script>';
    }
} elseif (isset($_POST['AddRegistration'])) {
    $council = $_POST['council'];
    $regType = $_POST['regType'];
    $regNo = $_POST['regNo'];
    $regYear = $_POST['regYear'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $applicant_id = $_POST['applicant_id'];


    $addEx = $db->AddRegistration($council, $regType, $regNo, $regYear, $applicant_id);
    if (isset($addEx)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=regD"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=regD"';
        echo '</script>';
    }
} //DELETE
elseif (isset($_POST['deleteRegistration'])) {
    $reg_id = $_POST['reg_id'];

    $addEx = $db->deleteRegistration($reg_id);
    if (isset($addEx)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=regD"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=regD"';
        echo '</script>';
    }
}


////////////////////////////
////////////////////////////
///////DELETE DOCUMENT///////////
/////////////////////////////
//////////////////////////////
elseif (isset($_POST['delDocu'])) {
    $docuID = $_POST['docuID'];
    $deleteD = $db->deleteDocu($docuID);
	
    if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=Picha"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=Picha"';
        echo '</script>';
    }
}



////////////////////////////
////////////////////////////
///////APPLICATION///////////
/////////////////////////////
//////////////////////////////
elseif (isset($_POST['addApplication'])) {

    $fac1G = $_POST['fac1'];
    $cadre_id = $_POST['cadre_id'];

    $fac1G1 = explode("=", $fac1G);
    $fac1 = $fac1G1[0];
    $cat1 = $fac1G1[1];
    $wp_id1 = $fac1G1[2];

    $fac2G = $_POST['fac2'];

    $fac2G2 = explode("=", $fac2G);
    $fac2 = $fac2G2[0];
    $cat2 = $fac2G2[1];
    $wp_id2 = $fac2G2[2];

    $fac3G = $_POST['fac3'];

    $fac3G3 = explode("=", $fac3G);
    $fac3 = $fac3G3[0];
    $cat3 = $fac3G3[1];
    $wp_id3 = $fac3G3[2];

    $applicant_id = $_POST['applicant_id'];

    //Get Permit Year
    $getPY = $db->getWorkPermitYear();
    $rP = $getPY->fetch();
    $pmYear = $rP['year'];

    //Insert into application table
    $insert = $db->addApplication($fac1, $cat1, $cadre_id, $fac2, $cat2, $cadre_id, $fac3, $cat3, $cadre_id, $applicant_id, $wp_id1, $wp_id2, $wp_id3, $pmYear);

    //Insert into score table
    $insert1 = $db->insertCredit($cadre_id, $cadre_id, $cadre_id, $applicant_id, $fac1, $fac2, $fac3, $cat1, $cat2,
        $cat3, $wp_id1, $wp_id2, $wp_id3, $pmYear);


    if (isset($insert)) {
        echo '<script language="javascript">';
        echo "alert('Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngapp"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Added sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngapp"';
        echo '</script>';
    }
} //Edit Application
elseif (isset($_POST['editApplication'])) {
    $fac1G = $_POST['fac1'];
    $cadre1 = $_POST['cadre1'];
    $app_id = $_POST['app_id'];

    $fac1G1 = explode("=", $fac1G);
    $fac1 = $fac1G1[0];
    $cat1 = $fac1G1[1];
    $wp_id1 = $fac1G1[2];

    $editApp = $db->editApplication($fac1, $cat1, $cadre1, $app_id, $wp_id1);
    if (isset($editApp)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngapp"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngapp"';
        echo '</script>';
    }
}


////////////////////////////
////////////////////////////
///////ACCEPT APPLICATION//////
/////////////////////////////
//////////////////////////////
elseif (isset($_POST['acceptApp'])) {
    $app_id = $_POST['app_id'];
    $applicant_id = $_POST['applicant_id'];
    $email = $_POST['email'];
    $facName = $_POST['facName'];
    $cadName = $_POST['cadName'];
    $fullname = $_POST['fullname'];
    $remarks = $_POST['remarks'];

    $deleteD = $db->acceptApp($app_id, $email, $facName, $cadName, $fullname, $cadre3, $remarks);
    if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Accepted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngAppDetails&id=' . $applicant_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Accepted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngAppDetails&id=' . $applicant_id . '"';
        echo '</script>';
    }
}

///////////////////////////
////////////////////////////
///////APPROVE Allocation APPLICATION//////
/////////////////////////////
//////////////////////////////
// Budoya
elseif (isset($_POST['approveAllocateApp'])) {
    $applicant_id = $_POST['applicant_id'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $approveStatus = $_POST['approveStatus'];
    //$score = $_POST['score'];
    $facility1 = $_POST['facility'];
	$fac_id=null;
	
 //exit;
    $facilityG = explode("=", $facility1);
    $facility = $facilityG[0];

    if ($facility == "other") {
        $fac1 = $_POST['fac1']; //fac_id,category,wp_id
        $facG = explode("=", $fac1);
		$fac_id = $facG[0];
        $category = $facG[1];
        $wp_id = $facG[2];
        //$cadre_id = $_POST['cadre_id'];
        $app_id = "";
        $choiceNo = "";
    } else {
        //Get Category,wp_id,cadre_id
        $facG = explode("=", $facility1);
        $app_id = $facG[0];
        $choiceNo = $facG[1];
        $category = $facG[2];
        $wp_id = $facG[3];
        $cadre_id = $facG[4];
    }
    $remarks = $_POST['remarks'];


    //Get Permit Year
    $getPY = $db->getWorkPermitYear();
    $rP = $getPY->fetch();
    $pmYear = $rP['year'];
	
		$app_id ="";
		$cadre_id="";
		$credit="";
         //Get application
        $getA = $db->ApplicationAll($applicant_id);
		while ($rw2 = $getA->fetch()) {
		$app_id = $rw2['app_id']; 
		$cadre_id = $rw2['cadre_id'];
		$credit = $rw2['credit'];
	    }
			//$getPY = $db->getActiveCadreByFacId($fac_id, $pmYear)
   //echo  "approveAllocateApplication($applicant_id, $category, $wp_id, $remarks, $choiceNo, $pmYear, $facility,$app_id,$cadre_id,$credit)";
	//exit;
  
    //$deleteD = $db->approveApplication($applicant_id, $email, $approveStatus, $fullname, $category, $wp_id, $remarks, $cadre_id, $app_id, $choiceNo, $score, $pmYear, $facility);
    $deleteD = $db->approveAllocateApplication($approveStatus,$applicant_id, $category, $wp_id, $remarks, $choiceNo, $pmYear, $facility,$app_id,$cadre_id,$credit);
	
	if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Accepted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=shortListedB"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Accepted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=shortListedB"';
        echo '</script>';
    }
}


////////////////////////////
////////////////////////////
///////APPROVE APPLICATION//////
/////////////////////////////
//////////////////////////////
elseif (isset($_POST['approveApp'])) {
    $applicant_id = $_POST['applicant_id'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $approveStatus = $_POST['approveStatus'];
    $score = $_POST['score'];
    $facility1 = $_POST['facility'];

    $facilityG = explode("=", $facility1);
    $facility = $facilityG[0];

    if ($facility == "other") {
        $fac1 = $_POST['fac1']; //fac_id,category,wp_id
        $facG = explode("=", $fac1);
        $category = $facG[1];
        $wp_id = $facG[2];
        $cadre_id = $_POST['cadre_id'];
        $app_id = "";
        $choiceNo = "";
    } else {
        //Get Category,wp_id,cadre_id
        $facG = explode("=", $facility1);
        $app_id = $facG[0];
        $choiceNo = $facG[1];
        $category = $facG[2];
        $wp_id = $facG[3];
        $cadre_id = $facG[4];
    }
    $remarks = $_POST['remarks'];


    //Get Permit Year
    $getPY = $db->getWorkPermitYear();
    $rP = $getPY->fetch();
    $pmYear = $rP['year'];

    $deleteD = $db->approveApplication($applicant_id, $email, $approveStatus, $fullname, $category, $wp_id, $remarks, $cadre_id, $app_id, $choiceNo, $score, $pmYear, $facility);
    if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Accepted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=application"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Accepted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=application"';
        echo '</script>';
    }
}



////////////////////////////
////////////////////////////
///////CHANGE FACILITY//////
/////////////////////////////
//////////////////////////////
elseif (isset($_POST['changeFacility'])) {
    $applicant_id = $_POST['applicant_id'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $approveStatus = $_POST['approveStatus'];
    $facility = $_POST['facility'];
    $otherFacility = $_POST['otherFacility'];
    $cadre2 = $_POST['cadre2'];
    $remarks = $_POST['remarks'];
    $table_id = $_POST['table_id'];

    $deleteD = $db->changeFacility($applicant_id, $email, $approveStatus, $facility, $fullname, $otherFacility, $remarks, $cadre2, $table_id);
    if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Accepted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=selected"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Accepted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=selected"';
        echo '</script>';
    }
}



////////////////////////////
////////////////////////////
///////ASSIGN FACILITY//////
/////////////////////////////
//////////////////////////////
elseif (isset($_POST['assignFacility'])) {
    $applicant_id = $_POST['applicant_id'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $approveStatus = $_POST['approveStatus'];
    $facility = $_POST['facility'];
    $otherFacility = $_POST['otherFacility'];
    $cadre2 = $_POST['cadre2'];
    $remarks = $_POST['remarks'];
    $table_id = $_POST['table_id'];

    $deleteD = $db->changeFacility($applicant_id, $email, $approveStatus, $facility, $fullname, $otherFacility, $remarks, $cadre2, $table_id);
    if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Accepted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=shortListed"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Accepted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=shortListed"';
        echo '</script>';
    }
} elseif (isset($_GET['acceptAgenceyApplicant'])) {
    $allocation_id = $_GET['allocation_id'];
    $applicant_id = $_GET['applicant_id'];

    $acceptAgenceyApp = $db->acceptAgenciesApplicant($applicant_id, $allocation_id);
    if (isset($acceptAgenceyApp)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=agenciesApp"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=agenciesApp"';
        echo '</script>';
    }
} elseif (isset($_POST['rejectAgenciesApplicant'])) {
    $allocation_id = $_POST['allocation_id'];
    $rejection_reason = $_POST['rejection_reason'];

    $rejectAgenceyApp = $db->rejectAgenciesApplicant($rejection_reason, $allocation_id);
    if (isset($rejectAgenceyApp)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=agenciesApp"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=agenciesApp"';
        echo '</script>';
    }
}

////////////////////////////
////////////////////////////
///////CHANGE REJECTED APP//////
/////////////////////////////
//////////////////////////////
elseif (isset($_POST['changeRejectedApp'])) {
    $applicant_id = $_POST['applicant_id'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $approveStatus = $_POST['approveStatus'];
    $facility = $_POST['facility'];
    $otherFacility = $_POST['otherFacility'];
    $cadre2 = $_POST['cadre2'];
    $remarks = $_POST['remarks'];
    $table_id = $_POST['table_id'];

    $deleteD = $db->changeFacility($applicant_id, $email, $approveStatus, $facility, $fullname, $otherFacility, $remarks, $cadre2, $table_id);
    if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=rejected"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=rejected"';
        echo '</script>';
    }
}


////////////////////////////
////////////////////////////
///////DELETE REJECTED APP//////
/////////////////////////////
//////////////////////////////
elseif (isset($_POST['deleteRejectedApp'])) {
    $applicant_id = $_POST['applicant_id'];
    $table_id = $_POST['table_id'];

    $deleteD = $db->deleteRejectedApp($applicant_id, $table_id);
    if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=rejected"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=rejected"';
        echo '</script>';
    }
}


////////////////////////////
////////////////////////////
///////DELETE APPLICANTS//////
/////////////////////////////
//////////////////////////////
elseif (isset($_POST['deleteApplicants'])) {
    $applicant_id = $_POST['applicant_id'];

    $deleteD = $db->deleteApplicants($applicant_id);
    if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Deleted sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=applicant"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Deleted applicant')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=rejected"';
        echo '</script>';
    }
}





////////////////////////////
////////////////////////////
///////REJECT APPLICATION//////
/////////////////////////////
//////////////////////////////
elseif (isset($_POST['rejectApp'])) {
    $app_id = $_POST['app_id'];
    $applicant_id = $_POST['applicant_id'];
    $email = $_POST['email'];
    $facName = $_POST['facName'];
    $cadName = $_POST['cadName'];
    $fullname = $_POST['fullname'];
    $remarks = $_POST['remarks'];

    $deleteD = $db->rejectApp($app_id, $email, $facName, $cadName, $fullname, $cadre3, $remarks);
    if (isset($deleteD)) {
        echo '<script language="javascript">';
        echo "alert('Rejected sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngAppDetails&id=' . $applicant_id . '"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Rejected sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngAppDetails&id=' . $applicant_id . '"';
        echo '</script>';
    }
}


////////////////////////////
////////////////////////////
///////EDIT APPLICANTS//////
/////////////////////////////
//////////////////////////////
elseif (isset($_POST['editApplicant'])) {
    $firstname = $_POST['firstname'];
    $middle = $_POST['middle'];
    $lastname = $_POST['lastname'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $gender = $_POST['gender'];
    $maritalStatus = $_POST['maritalStatus'];
    $national = $_POST['national'];
    $country = $_POST['country'];
    $nida = $_POST['nida'];
    $cadreType = $_POST['cadreType'];
    $councilTypeID = $_POST['councilTypeID'];
    $councilRegistrationID = $_POST['councilRegistrationID'];
    $disiability = $_POST['disiability'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $applicant_id = $_POST['applicant_id'];

    $editAp = $db->editApplicantsDetails($firstname, $middle, $lastname, $year, $month, $day, $gender, $maritalStatus, $national, $country, $nida, $cadreType, $councilTypeID, $councilRegistrationID, $disiability, $address, $phone, $email, $applicant_id);
    if (isset($editAp)) {
        // var_dump($editAp); exit();
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=dash"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=dash"';
        echo '</script>';
    }
}


////////////////////////////
////////////////////////////
///////ALLOCATIO TOOL//////
/////////////////////////////
//////////////////////////////
elseif (isset($_POST['allocationTool'])) {
    $year = $_POST['year'];
    $get = $db->getSelectedApplicantsByYear($year);
    if (isset($get)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngAll"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=mngAll"';
        echo '</script>';
    }
}



////////////////////////////////
////////////////////////////////
///////SHORTLIST APPLICANTS//////
////////////////////////////////
////////////////////////////////
elseif (isset($_POST['shortlistTool'])) {
    $year = $_POST['year'];
    $get = $db->getWPCadreByYearShortListGstar($year);
    //  $get=$db->getWPCadreByYearToshortList($year);

    // print_r($get);
    // exit;

    if (isset($get)) {
        echo '<script language="javascript">';
        echo "alert('Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=shortListed"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo "alert('Error: Not Updated sucessfully')";
        echo '</script>';
        echo '<script language="javascript">';
        echo 'location.href = "../?pg=shortListed"';
        echo '</script>';
    }
} else {
}
?>
<!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>