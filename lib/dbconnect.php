<?php if (session_status() == PHP_SESSION_NONE) {
session_start();
}
// include("fix_mysql_to_msqli.error.php");
//error_reporting(0);
include("config.php");
include("functions.php");

class dbClass
{
    //////////////////////////////
    /*
	 DATABASE CONNECTION
	*/
    ////////////////////////////////
    private $hostname = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db = DB_NAME;
    private $connection;
    public $msg;

    function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->connection = new PDO(
            "mysql:host={$this->hostname};dbname={$this->db}",
            $this->user,
            $this->pass
        );
        // set the PDO error mode to exception
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return true;
    }
	public function selectUbunge()
	{
	$sel = $this->connection->prepare("SELECT * FROM `ubunge`");
        $sel->execute();
        return $sel;	
	}
	public function selectUbungeUser($id)
	{
	$sel = $this->connection->prepare("SELECT * FROM ubunge WHERE user_id='$id'");
        $sel->execute();
        return $sel;	
	}
	
	public function selectChanga()
	{
	$sel = $this->connection->prepare("SELECT `ngazi`, `ngazi_id`, `aina`, `maelezo`, `mwaka`, `hali`, `id` FROM `changamoto`");
        $sel->execute();
        return $sel;	
	}
	public function selectIlani()
	{
	$sel = $this->connection->prepare("SELECT `mwaka`, `aina`, `maelezo`, `hali`, `changa_id`, `ilani_id` FROM `ilani` ");
        $sel->execute();
        return $sel;	
	}
	public function selectAhadi()
	{
	$sel = $this->connection->prepare("SELECT `ngazi`, `ngazi_id`, `aina`, `maelezo`, `mwaka`, `hali`, `changa_id`, `ahadi_id` FROM `ahadi`");
        $sel->execute();
        return $sel;	
	}
	
	
	public function selectMikaIlani()
	{
	$sel = $this->connection->prepare("SELECT `ilani_id`, `mwakafedha`, `chakufanya`, `kipimo`, `mafanikio`, `gharama_tshs`, `mkati_id` FROM `mikakati_ilani`");
        $sel->execute();
        return $sel;	
	}
	
	public function selectMikaAhadi()
	{
	$sel = $this->connection->prepare("SELECT `ahadi_id`, `mwakafedha`, `chakufanya`, `kipimo`, `mafanikio`, `gharama_tshs`, `mkatiahad_id` FROM `mikakati_ahadi`");
        $sel->execute();
        return $sel;	
	}
	public function selectUtekeilani()
	{
	$sel = $this->connection->prepare("SELECT `mikailani_id`, `shughuli`, `tarehe`, `kiasimafanikio`, `haliutekelezaji`, `utekeilani_id` FROM `utekeilani`");
        $sel->execute();
        return $sel;	
	}
	public function selectUtekeahadi()
	{
	$sel = $this->connection->prepare("SELECT `mikaahadi_id`, `shughuli`, `tarehe`, `kiasimafanikio`, `haliutekelezaji`, `utekeahadi_id` FROM `utekeahadi`");
        $sel->execute();
        return $sel;	
	}
	public function singleUdiwaniAll()
	{
	$sel = $this->connection->prepare("SELECT * FROM `ubunge` WHERE nafasi='Udiwani'");
        $sel->execute();
        return $sel;	
	}
	public function singleUdiwaniWilayaOnly($id)
	{
	$sel = $this->connection->prepare("SELECT * FROM `ubunge` WHERE gwilaya_id='$id' AND nafasi='Udiwani'");
        $sel->execute();
        return $sel;	
	}
	public function singleUdiwaniMkoaOnly($id)
	{
	$sel = $this->connection->prepare("SELECT * FROM `ubunge` WHERE gmkoa_id='$id' AND nafasi='Udiwani'");
        $sel->execute();
        return $sel;	
	}
	
	public function singleUdiwani($id)
	{
	$sel = $this->connection->prepare("SELECT * FROM `ubunge` WHERE gjimbo_id='$id'");
        $sel->execute();
        return $sel;	
	}
	public function singleUteuzii($id)
	{
	$sel = $this->connection->prepare("SELECT `ainavikao`, `amekubalika`, `maelezoyamaoni`, `jinalakatibu`, `ngaziyakatibu`, `tareheyakikao`, `ubunge_id`, `uteuzi_id` FROM 
	`ubunge_uteuzi` WHERE `ubunge_id`='$id' and ainavikao='VI'");
        $sel-uteuzi>execute();
        return $sel;	
	}
	public function singleUteuziiOnly()
	{
	$sel = $this->connection->prepare("SELECT `ainavikao`, `amekubalika`, `maelezoyamaoni`, `jinalakatibu`, `ngaziyakatibu`, `tareheyakikao`, ubunge_uteuzi.ubunge_id, `uteuzi_id` FROM 
	ubunge_uteuzi, ubunge WHERE ubunge_uteuzi.ubunge_id = ubunge.ubunge_id and nafasi='Ubunge' and ainavikao='VI' and amekubalika='Ameteuliwa'");
        $sel->execute();
        return $sel;	
	}
	 // Add ubunge-elimu
	public function addUbungeEdu($aina, $kiwango,$chuo,$mwaka,$maelezo,$ubunge_id){
	//SELECT `ainaelimu`, `kiwango`, `chuo`, `mwaka`, `maelezo`, `elimu_id`, 
	//`ubunge_id` FROM `ubunge_elimu` WHERE 1
	//
$select = $this->connection->prepare("SELECT * FROM `ubunge_elimu` WHERE `ainaelimu`='$aina' AND `kiwango`='$kiwango' AND `chuo`='$chuo' AND mwaka='$mwaka' AND ubunge_id='$ubunge_id'");
       
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
		$insert = $this->connection->prepare("INSERT INTO 
        `ubunge_elimu`(`ainaelimu`, `kiwango`, `chuo`, `mwaka`, `maelezo`, `ubunge_id`) 
	   VALUES('$aina', '$kiwango','$chuo','$mwaka','$maelezo','$ubunge_id')");		
        $insert->execute();
		}
	return $insert;	
	}
	
 public function EditUbungeEdu($aina, $kiwango,$chuo,$mwaka,$maelezo,$idd)
 {
	
		$insert = $this->connection->prepare("UPDATE  
        `ubunge_elimu` SET `ainaelimu`='$aina', `kiwango`='$kiwango', `chuo`='$chuo', `mwaka`='$mwaka', `maelezo`='$maelezo' 
		WHERE `elimu_id`='$idd'");		
        $insert->execute();
		
 return $insert;	
}
	
  public function addMtumia($email,$password,$ngazi,$ngazi_id,$kadi,$aina,
   $jina,$kazi,$kithibitisha,$kikaokawali,$kikaokpili,$kikaoktatu,$kamatizanziba,$kikaoutezi,
   $kuramaoni,$kikaobawali,$kikaobpili,$kikaobtatu,$kamatimaalumza,$kamatitaifa,$kamatimwisho,
   $tarehe)
   {
	//SELECT `user_id`, `email`, `username`, `password`, `level`, `levelName`,
	//`name` FROM `db_users` WHERE 1
    $select = $this->connection->prepare("SELECT `user_id`, `email`, `username`, `password`, `ngazi`, `ainamtumia`, `name` FROM `db_users` WHERE email='$email'");
       
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
		$insert = $this->connection->prepare("INSERT INTO `db_users`
		(`email`, `username`, `password`, `ngazi`, `ngazi_id`, `kadi`, `ainamtumia`, `name`,
	`kazi_mfumo`, `thibitisha`, `kikaokablaawali`, `kikaokablapili`, `kikaokablatatu`, 
	`kamatikablazanzibar`, `kikaokablauteuzi`, `matokeouchaguzi`, `kikaobaadaawali`, 
	`Kikaobaadapili`, `kikaobaadatatu`, `kamatibaadazanzibar`, `kamatibaadataifa`, 
	`kikaobaadauteuzi`, tarehe) 
	   VALUES('$email','$email','$password','$ngazi','$ngazi_id','$kadi','$aina',
   '$jina','$kazi','$kithibitisha','$kikaokawali','$kikaokpili','$kikaoktatu','$kamatizanziba','$kikaoutezi',
   '$kuramaoni','$kikaobawali','$kikaobpili','$kikaobtatu','$kamatimaalumza','$kamatitaifa','$kamatimwisho',
   '$tarehe')");		
        $insert->execute();
		}
	return $insert;	
	}
	//SELECT `ainavikao`, `amekubalika`, `maelezoyamaoni`, `jinalakatibu`, `ngaziyakatibu`, `tareheyakikao`, `ubunge_id`, `uteuzi_id` FROM `ubunge_uteuzi` WHERE `ubunge_id`
    // Add ubunge
	public function addUbunge($first, $middle,$last,$nafasi,$maojimbo,$maowilaya,
	$maomkoa,$date,$zmgmkoa,$zmgwilaya,$zmgmtaa,$baba, 
	$kuzaliwababa, $mkoababa, $wilayababa, $mtaababa,$mama,$mkoamama,$wilayamama,
	$mtaamama,$kuzaliwamama, $mkoaishi, $wilayaishi, $mtaaishi, $uraia,$ainauraia,
	$hati,$userid,$simu,$email,$fedha,$control,$nida)    {
        /* SELECT * FROM `ubunge` WHERE `jinamwanzo`, `jinakati`, `jinamwisho`
       `jinamwanzo`, `jinakati`, `jinamwisho`, `nafasi`, `gjimbo_id`, `gwilaya_id`,
	   `gmkoa_id`, `dob`, `zmkoa_id`, `zwilaya_id`, `zmtaa`, `jinababa`, `babadob`, 
	   `bzmkoa_id`, `bzwilaya_id`, `bzmtaa`, `jinamama`, `mzmkoa_id`, `mzwilaya_id`, 
	   `mzmtaa`, `mamadob`, `ishimkoa`, `ishiwilaya`, `ishimtaa`,`uraia`, `ainayauraia`, `nambayahati`, `ubunge_id` */
	   
        $select = $this->connection->prepare("SELECT * FROM `ubunge` WHERE `jinamwanzo`='$first' AND `jinakati`='$middle' AND `jinamwisho`='$last' AND dob='$date'");
       
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
			$tarehe = date("Y-m-d"); //`mobile`, `email`, `amount`, `control`,`NIDA`
        $insert = $this->connection->prepare("INSERT INTO 
	   `ubunge`(`jinamwanzo`, `jinakati`, `jinamwisho`, `nafasi`, `gjimbo_id`, `gwilaya_id`,
	   `gmkoa_id`, `dob`, `zmkoa_id`, `zwilaya_id`, `zmtaa`, `jinababa`, `babadob`, 
	   `bzmkoa_id`, `bzwilaya_id`, `bzmtaa`, `jinamama`, `mzmkoa_id`, `mzwilaya_id`, 
	   `mzmtaa`, `mamadob`, `ishimkoa`, `ishiwilaya`, `ishimtaa`,`uraia`, `ainayauraia`, `nambayahati`, 
	   user_id, tarehe, `mobile`, `email`, `amount`, `control`,`NIDA`) 
	   VALUES('$first', '$middle','$last','$nafasi','$maojimbo','$maowilaya',
	   '$maomkoa','$date','$zmgmkoa','$zmgwilaya','$zmgmtaa','$baba', '$kuzaliwababa',
	   '$mkoababa', '$wilayababa', '$mtaababa','$mama','$mkoamama','$wilayamama',
	   '$mtaamama','$kuzaliwamama', '$mkoaishi', '$wilayaishi', '$mtaaishi', '$uraia',
	   '$ainauraia','$hati','$userid','$tarehe','$simu','$email','$fedha','$control','$nida')");
             
            $insert->execute();
			$last_id = $this->connection->lastInsertId();
			$_SESSION['ubunge_id']= $last_id;
        }
        return $insert;
    }
	
	public function EditUbunge($idd,$first, $middle,$last,$nafasi,$maojimbo,$maowilaya,
	$maomkoa,$date,$zmgmkoa,$zmgwilaya,$zmgmtaa,$baba, 
	$kuzaliwababa, $mkoababa, $wilayababa, $mtaababa,$mama,$mkoamama,$wilayamama,
	$mtaamama,$kuzaliwamama, $mkoaishi, $wilayaishi, $mtaaishi, $uraia,$ainauraia,
	$hati,$userid,$simu,$email,$fedha,$control,$nida)    {
        /* SELECT * FROM `ubunge` WHERE `jinamwanzo`, `jinakati`, `jinamwisho`
       `jinamwanzo`, `jinakati`, `jinamwisho`, `nafasi`, `gjimbo_id`, `gwilaya_id`,
	   `gmkoa_id`, `dob`, `zmkoa_id`, `zwilaya_id`, `zmtaa`, `jinababa`, `babadob`, 
	   `bzmkoa_id`, `bzwilaya_id`, `bzmtaa`, `jinamama`, `mzmkoa_id`, `mzwilaya_id`, 
	   `mzmtaa`, `mamadob`, `ishimkoa`, `ishiwilaya`, `ishimtaa`,`uraia`, `ainayauraia`, `nambayahati`, `ubunge_id` */
	   
         
		$tarehe = date("Y-m-d"); //`mobile`, `email`, `amount`, `control`,`NIDA`
        $insert = $this->connection->prepare("UPDATE `ubunge` SET `jinamwanzo`='$first',
		`jinakati`='$middle', `jinamwisho`='$last', `nafasi`='$nafasi', `gjimbo_id`='$maojimbo'
		, `gwilaya_id`='$maowilaya',`gmkoa_id`='$maomkoa', `dob`='$date', `zmkoa_id`='$zmgmkoa', 
		`zwilaya_id`='$zmgwilaya', `zmtaa`='$zmgmtaa', `jinababa`='$baba', `babadob`= '$kuzaliwababa', 
	   `bzmkoa_id`='$mkoababa', `bzwilaya_id`='$wilayababa', `bzmtaa`='$mtaababa', 
	   `jinamama`='$mama', `mzmkoa_id`='$mkoamama', `mzwilaya_id`='$wilayamama', 
	   `mzmtaa`='$mtaamama', `mamadob`='$kuzaliwamama', `ishimkoa`='$mkoaishi', `ishiwilaya`='$wilayaishi', 
	   `ishimtaa`='$mtaaishi',`uraia`='$uraia', `ainayauraia`='$ainauraia', `nambayahati`='$hati', 
	   user_id='$userid', tarehe='$tarehe', `mobile`='$simu', `email`='$email', `amount`='$fedha', 
	   `control` = '$control',`NIDA`='$nida' WHERE `ubunge_id`='$idd'");
             
            $insert->execute();
			
        
        return $insert;
    }
    //////////////////////////////////////////////////////////
    ////LOGIN FUNCTION///////////////////////////////////////
    /////////////////////////////////////////////////////////
    public function login($username, $password)
    {
        //Check if username exist
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
        $select = $this->connection->prepare("SELECT * FROM `db_users` WHERE `email`= '$username'");
       
		
        $select->execute();
        $result = $select->fetchAll();
        if ($select->rowCount() > 0) {
		
            //List values
            foreach ($result as $row) {
                $userid = $row['user_id'];
                $pwd = $row['password'];
                
      
                $pwd1 = md5($password);

                
                if ($pwd == $pwd1) {

                   $_SESSION['userid']=$userid;
                   $_SESSION['fullname']= $row['name'];
				   $_SESSION['level']="All";
    //`email`, `username`, `password`, `ngazi`, `ngazi_id`, `kadi`, `ainamtumia`, `name`,
	//`kazi_mfumo`, `thibitisha`, `kikaokablaawali`, `kikaokablapili`, `kikaokablatatu`, 
	//`kamatikablazanzibar`, `kikaokablauteuzi`, `matokeouchaguzi`, `kikaobaadaawali`, 
	//`Kikaobaadapili`, `kikaobaadatatu`, `kamatibaadazanzibar`, `kamatibaadataifa`, 
	//`kikaobaadauteuzi`, tarehe
	
	               $_SESSION['ngazi'] = $row['ngazi'];
                   $_SESSION['ngazi_id'] = $row['ngazi_id'];
				   $_SESSION['kadi'] = $row['kadi'];
				   $_SESSION['aina'] = $row['ainamtumia'];
				   $_SESSION['kazi'] = $row['kazi_mfumo'];
                   $_SESSION['kazi_mfumo'] = $row['kazi_mfumo']; 
				   $_SESSION['thibitisha'] = $row['thibitisha'];
                   $_SESSION['kikawali'] = $row['kikaokablaawali'];
				   $_SESSION['kikpili'] = $row['kikaokablapili'];
				   $_SESSION['kiktatu'] = $row['kikaokablatatu'];
                   $_SESSION['kamatikz'] = $row['kamatikablazanzibar']; 
				   $_SESSION['kikuteuzi'] = $row['kikaokablauteuzi']; 
				   $_SESSION['matokeo'] = $row['matokeouchaguzi'];
				   $_SESSION['kibawali'] = $row['kikaobaadaawali'];
				   $_SESSION['kibpili'] = $row['Kikaobaadapili'];
				   $_SESSION['kibtatu'] = $row['kikaobaadatatu'];
                   $_SESSION['kamatibz'] = $row['kamatibaadazanzibar'];
                   $_SESSION['kamatibtaifa'] = $row['kamatibaadataifa']; 
                   $_SESSION['kibuteuzi'] = $row['kikaobaadauteuzi'];
                   $_SESSION['tarehe'] = $row['tarehe'];  				   
				   
                    // header("Location:../?pg=dash");
                    echo '<script language="javascript">';
					//echo "alert('Correct username or password')";
                    echo 'location.href = "../?pg=dash"';
                    echo '</script>';
                } else {
                    echo '<script language="javascript">';
                    echo "alert('Error. Incorrect username or password')";
                    echo '</script>';
                    echo '<script language="javascript">';
                    echo 'location.href = "../login/"';
                    echo '</script>';
                }
            }
        } 
		else {
            echo '<script language="javascript">';
            echo "alert('Error. Incorrect username or password')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../login/"';
            echo '</script>';
        }
    }
	//$last_id = $this->connection->lastInsertId();
	/* SELECT``zamanikadi`, `zamakadimkoa_id`, `zamakadiwilaya_id`, `zamakaditawi`,
	`zamatarehe`, `mpyamkoa_id`, `mpyawilaya_id`, `mpyatarehe`, `mpyahadilini`, 
	`jumuiyakadi`, `jumuiyamkoa_id`, `jumuiyawilaya_id`, `jumuiyahadilini`, `tawijina`, 
	`tawimwkjina`, `chamakingine`, `chamamaelezo`, `kwepakodi`, `kwepakodimaelezo`, 
	`chamauongozi`, `chamamchango`, `kazikipato`, `kosajinai`, `kosajinaimaelezo`, 
	`kosamaadiliccm`, `kosamaadilimaelezo`, `muombajithibitisha`, `muombajithibitishatarehe`, 
	 `ubunge_id`,`mpyakadi` FROM `ubunge_uanachama` WHERE 1 */
	 //`uanachama_id`,
	public function uanachamaMgombea($kadimpya)
    {
	  //Check if exist
      $select = $this->connection->prepare("SELECT * FROM ubunge_uanachama WHERE mpyakadi='$kadimpya'");
      $select->execute();
	  return $select;
	}
	
	public function uanachama($id)
    {
	  //Check if exist
      $select = $this->connection->prepare("SELECT * FROM ubunge_uanachama WHERE ubunge_id='$id'");
      $select->execute();
	  return $select;
	}
    public function insertuanachama($insert, $kadimpya)
    {
	//Check if exist
        $select = $this->connection->prepare("SELECT * FROM ubunge_uanachama WHERE mpyakadi='$kadimpya'");
      $select->execute();
	  //echo $insert;
	  //exit;
        
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `ubunge_uanachama`(`zamanikadi`, `zamakadimkoa_id`, `zamakadiwilaya_id`, `zamakaditawi`,`zamatarehe`,
	  mpyakadi,`mpyamkoa_id`, `mpyawilaya_id`,mpyatawi,`mpyatarehe`, `mpyahadilini`, 
	`jumuiyakadi`, `jumuiyamkoa_id`, `jumuiyawilaya_id`, `jumuiatarehe`,`jumuiyahadilini`,  
	`tawijina`,`tawimwkjina`, `chamakingine`, `chamamaelezo`, 
	`kwepakodi`, `kwepakodimaelezo`, `chamauongozi`, `chamamchango`, `kazikipato`, 
	`kosajinai`, `kosajinaimaelezo`, `kosamaadiliccm`, `kosamaadilimaelezo`, 
	`muombajithibitisha`, `muombajithibitishatarehe`, 
	`katibuthibitisha`, `jinalakatibu`, `ngaziyakatibu`, `katibutarehethibitisha`, `ubunge_id`) VALUES($insert)");
            
            $insert->execute();
        }
        return $insert;	
	}
	
	public function Edituanachama($kadizamani,$mkoazama,$wilayazama,$tawizama,$datezama,
	 $kadimpya,$mkoampya,$wilayampya,$tawimpya,$datempya,$hadi,
	 $kadijumuia,$mkoaju,$wilayavc,$datevc,$hadilini,
	 $tawilako,$mwk,$chamakingine,$tajachama,
	 $kodi,$adhabu,$uzoefu,$mchango,$kazi,
	 $jinai,$jinaiadhabu,$nidhamu,$nidhamuadhabu,
	 $muothibitisha,$muombajithibitarehe,$ubunge_id)
    {
	
     $insert = $this->connection->prepare("UPDATE `ubunge_uanachama` SET 
	 `zamanikadi`='$kadizamani', `zamakadimkoa_id`='$mkoazama', `zamakadiwilaya_id`='$wilayazama', 
	 `zamakaditawi`='$tawizama',`zamatarehe`='$datezama',mpyakadi='$kadimpya',
	 `mpyamkoa_id`='$mkoampya', `mpyawilaya_id`='$wilayampya',mpyatawi='$tawimpya',
	 `mpyatarehe`='$datempya', `mpyahadilini`='$hadi', `jumuiyakadi`='$kadijumuia', 
	 `jumuiyamkoa_id`='$mkoaju', `jumuiyawilaya_id`='$wilayavc', `jumuiatarehe`='$datevc',
	 `jumuiyahadilini`='$hadilini',`tawijina`='$tawilako',`tawimwkjina`='$mwk', 
	 `chamakingine`='$chamakingine', `chamamaelezo`='$tajachama', `kwepakodi`='$kodi', 
	 `kwepakodimaelezo`='$adhabu', `chamauongozi`='$uzoefu', `chamamchango`='$mchango',
	 `kazikipato`='$kazi',`kosajinai`='$jinai', `kosajinaimaelezo`='$jinaiadhabu', 
	 `kosamaadiliccm`='$nidhamu', `kosamaadilimaelezo`='$nidhamuadhabu', 
	`muombajithibitisha`='$muothibitisha', `muombajithibitishatarehe`='$muombajithibitarehe' 
	WHERE `ubunge_id`='$ubunge_id'");         
     $insert->execute();
     return $insert;	
	}
	
	
    public function selectUser($ngazi, $ngazi_id, $aina, $kazi)
    {
        
		if(($ngazi=="Mkoa") or ($ngazi=="Mkoa") or ($ngazi=="Mkoa"))
		{
		   $sql="SELECT * FROM `db_users` WHERE ngazi_id = '$ngazi_id'";
		}
		else {
			$sql="SELECT * FROM `db_users`";
		}
		
        $select = $this->connection->prepare($sql);
        $select->execute();
        return $select;
	}
   //budoya B
	public function getReportsAllocateB($year, $category, $fac_type)
    {
		
       if(!empty($fac_type))
        {			
		  $facility_type = $fac_type;
		}
	   else
	   {
	     $facility_type = 'All';
	   }
        
        
		if ($category != 'All') {
            $where_category = " AND `category`='$category' ";
        } else {
            $where_category = "";
        }
        if ($facility_type != 'All') {
            $where_facility_type = " AND `fac_id`='$facility_type' ";
        } else {
            $where_facility_type = "";
        }

				
            $table = "application";
            $where_status = " AND `status`='Shortlisted' ";
				  
            $applicant_id = " applicant_id,";
            $group_by = " GROUP BY applicant_id";
            $where_year = " AND `year`='$year' ";
            $join_where = " applicants.id = $table . applicant_id ";
            $from = " $table ,`applicants` ";
        
        $where = $join_where . $where_year . $where_category . $where_facility_type. $where_status;

        $sql = "SELECT $applicant_id YEAR(CURDATE()) - YEAR(dob) AS age, applicants.* FROM $from WHERE $where $group_by ";
        
        $select = $this->connection->prepare($sql);
        $select->execute();
        return $select;
    }


    ////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////
    ////LOGOUT FUNCTION/////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////
    public function logout()
    {
        unset($_SESSION['userid']);
        unset($_SESSION['username']);
        unset($_SESSION['level']);
        unset($_SESSION['lastLogindate']);
        unset($_SESSION['regDate']);
        unset($_SESSION['fullname']);
        session_unset();
        if (session_destroy()) {
            /* Delete the cookies*******************/
            setcookie("user_id", '', time() - 60 * 60 * 24 * COOKIE_TIME_OUT, "/");
            setcookie("user_name", '', time() - 60 * 60 * 24 * COOKIE_TIME_OUT, "/");
            setcookie("user_key", '', time() - 60 * 60 * 24 * COOKIE_TIME_OUT, "/");
            // header("Location:../login/");
            echo '<script language="javascript">';
            echo 'location.href = "../login/"';
            echo '</script>';
        }
    }



    //////////////////////////////
    //////////////////////////////
    ////MANAGE REGIONS///////////
    /////////////////////////////
    /////////////////////////////
    //Add New REGION////////
	//SELECT `ngazi`, `ngazi_id`, `idadi`, `zilizoharibika`,
	//`halali` FROM `ubunge_jumlakura` WHERE 1
	public function addJumlaKura($ngazi, $ngaziid,$idadi, $haribika,$halali)
    {
        //Check if exist
        $select = $this->connection->prepare("SELECT * FROM ubunge_jumlakura WHERE ngazi='$ngazi' AND ngazi_id='$ngaziid'");
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `ubunge_jumlakura`(`ngazi`, 
			`ngazi_id`, `idadi`, `zilizoharibika`,
  `halali`) VALUES('$ngazi','$ngaziid','$idadi','$haribika','$halali')");
            
            $insert->execute();
        }
		return $insert;
	}
	//SELECT `kura`, `ubunge_id`, `nafasi`, `mwaka` FROM `ubunge_kura` WHERE 1
	public function addMgKura($kura,$idd,$nafasi,$mwaka)
    {
        //Check if exist
        $select = $this->connection->prepare("SELECT * FROM ubunge_kura
		WHERE ubunge_id='$idd' AND mwaka='$mwaka'");
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `ubunge_kura`(`kura`, 
			`ubunge_id`, `nafasi`, `mwaka`) VALUES('$kura','$idd','$nafasi','$mwaka')");
            
            $insert->execute();
        }
		return $insert;
	}
	//
	public function addUteuzi($aina, $amekubali,$maoni, $jina,$ngazi, $tarehe,$id)
    {
        //Check if exist
        $select = $this->connection->prepare("SELECT * FROM ubunge_uteuzi WHERE ainavikao='$aina' AND ubunge_id='$id'");
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `ubunge_uteuzi`(`ainavikao`, 
			`amekubalika`, `maelezoyamaoni`, `jinalakatibu`,
	       `ngaziyakatibu`, `tareheyakikao`, 
	       `ubunge_id`) VALUES('$aina','$amekubali','$maoni','$jina','$ngazi','$tarehe','$id')");
            
            $insert->execute();
        }
        return $insert;
    }
	public function addMaoni($aina, $amekubali,$maoni, $jina,$ngazi, $tarehe,$id)
    {
        //Check if exist
        $select = $this->connection->prepare("SELECT * FROM ubunge_maoni WHERE ainavikao='$aina' AND ubunge_id='$id'");
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `ubunge_maoni`(`ainavikao`, 
			`amekubalika`, `maelezoyamaoni`, `jinalakatibu`,
	       `ngaziyakatibu`, `tareheyakikao`, 
	       `ubunge_id`) VALUES('$aina','$amekubali','$maoni','$jina','$ngazi','$tarehe','$id')");
            
            $insert->execute();
        }
        return $insert;
    }
    public function addRegion($regname, $userID)
    {
        //Check if exist
        $select = $this->connection->prepare("SELECT * FROM tzregions WHERE RegName=:regname");
        $select->bindParam(':regname', $regname);
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `tzregions`(`RegName`) VALUES(:regname)");
            $insert->bindParam(':regname', $regname);
            $insert->execute();
        }
        return $insert;
    }

    //Edit REGION////////
    public function editRegion($regname, $userID, $regid)
    {
        $insert = $this->connection->prepare("UPDATE `tzregions` SET `RegName`=:regname WHERE Reg_Id='$regid'");
        $insert->bindParam(':regname', $regname);
        $insert->execute();
        return $insert;
    }

    //Delete REGION////////
    public function deleteRegion($regid)
    {
        $delete = $this->connection->exec("DELETE FROM tzregions WHERE Reg_Id='$regid'");

        return $delete;
    }

    //Function to get regNameById
    public function getRegionName($regid)
    {
        $sel = $this->connection->prepare("SELECT * FROM `tzregions` WHERE `Reg_Id`='$regid'");
        $sel->execute();
        return $sel;
    }

    //Function to get all Region Name
    public function getAllRegionName()
    {
        $selRegion = $this->connection->prepare("SELECT * FROM `tzregions` ORDER BY RegName ASC");
        $selRegion->execute();
        return $selRegion;
    }


    //////////////////////////////
    //////////////////////////////
    ////MANAGE MINISTRY///////////
    /////////////////////////////
    /////////////////////////////
    //Add district
    public function addMinistry($orgName, $region)
    {
        $insert = $this->connection->prepare("INSERT INTO `ministry`(`name`,`reg_id`) VALUES(:orgName,:region)");
        $insert->bindParam(':orgName', $orgName);
        $insert->bindParam(':region', $region);
        $insert->execute();
        return $insert;
    }


    //Get all Organization name
    public function getOrganizationName()
    {
        $selName = $this->connection->prepare("SELECT * FROM `ministry`,`tzregions`
		  WHERE 
		  ministry.reg_id=tzregions.Reg_Id ORDER BY name ASC");
        $selName->execute();
        return $selName;
    }


    //Get all Organization by Id
    public function getOrganizationById($min_id)
    {
        $selName = $this->connection->prepare("SELECT * FROM `ministry`,`tzregions`
		  WHERE 
		  ministry.reg_id=tzregions.Reg_Id AND
		  ministry.min_id='$min_id'");
        $selName->execute();
        return $selName;
    }

    //Edit Organization
    public function editOrganization($orgName, $region, $min_id)
    {
        $insert = $this->connection->prepare("UPDATE `ministry` SET `name`=:orgName, `reg_id`=:region WHERE min_id='$min_id'");
        $insert->bindParam(':orgName', $orgName);
        $insert->bindParam(':region', $region);
        $insert->execute();
        return $insert;
    }


    //Delete Organization
    public function deleteOrganization($min_id)
    {
        $delete = $this->connection->exec("DELETE FROM ministry WHERE min_id='$min_id'");
        return $delete;
    }


    //////////////////////////////F
    //////////////////////////////
    ////MANAGE DISTRICT///////////
    /////////////////////////////
    /////////////////////////////
    //Add district
    public function addDistrict($disName, $region)
    {
        $insert = $this->connection->prepare("INSERT INTO `tzdistrict`(`DistrictName`,`Reg_Id`) VALUES(:disName,:region)");
        $insert->bindParam(':disName', $disName);
        $insert->bindParam(':region', $region);
        $insert->execute();
        return $insert;
    }

    //Edit district
    public function editDistrict($disName, $region, $disid)
    {
        $insert = $this->connection->prepare("UPDATE `tzdistrict` SET `DistrictName`=:disName, `Reg_Id`=:region WHERE District_Id='$disid'");
        $insert->bindParam(':disName', $disName);
        $insert->bindParam(':region', $region);
        $insert->execute();
        return $insert;
    }
//get district
    public function gettDistrict($disid)
    {
        $sel = $this->connection->prepare("SELECT * FROM tzdistrict WHERE District_Id='$disid'");
        $sel->execute();
		return $sel;
    }

    //Delete district
    public function deleteDistrict($disid)
    {
        $delete = $this->connection->exec("DELETE FROM tzdistrict WHERE District_Id='$disid'");
        return $delete;
    }


    //Get all district and region
    public function getListofDistrictRegion()
    {
        $seD = $this->connection->prepare("SELECT * FROM `tzdistrict`,`tzregions` WHERE tzdistrict.Reg_Id=tzregions.Reg_Id");
        $seD->execute();
        return $seD;
    }
	// budoya
	public function ApplicationAll($applicant_id)
    {
        $getA = $this->connection->prepare("SELECT * FROM `application` 
			  WHERE  `applicant_id`='$applicant_id' AND status = 'Shortlisted'");
              $getA->execute();
        
        return $getA;
    }
	
    //Budoya
	//Function to Approve manually Allocation
    public function approveAllocateApplication($approveStatus,$applicant_id, $category, $wp_id, $remarks, $choiceNo, $pmYear, $facility,$app_id,$cadre_id,$credit)
    {
          $statusG = explode("=", $approveStatus);
          $status = $statusG[0];
          //SELECT `fac_id`, `category`, `wp_id`  FROM `facility` WHERE 1
		  //SELECT `cadre_Id`, `number`, `used`, `year`, `fac_id` FROM `faccadreyear` WHERE 1
          $get = $this->connection->prepare("SELECT faccadreyear.fac_id, `number`, `used` FROM faccadreyear,facility WHERE wp_id ='$wp_id' AND year='$pmYear' AND cadre_Id='$cadre_id' AND faccadreyear.fac_id=facility.fac_id" );
          $get->execute();
          $rowN = $get->fetch();
          $numUsed = $rowN['used'];
		  $numNumber = $rowN['number'];
		  $fac_id = $rowN['fac_id'];
		  
		  $available = $numNumber - $numUsed;
		  
         if ($facility == "other") 
		 {
            //Insert new row
            $choiceNo = 4;
			$choice = 4;
                
			if($available>0)
			{
			 $seDoc1 = $this->connection->prepare("UPDATE `application` SET category='$category',`status`='Accepted',cadre_id='$cadre_id', fac_id='$wp_id',choiceNo='$choice'  WHERE `applicant_id`='$applicant_id' AND year='$pmYear'");
			 $seDoc1->execute();
					
			 $insert = $this->connection->prepare("INSERT INTO allocation(`app_id`, `applicant_id`, `category`, `wp_id`, `cadre_id`, `choiceNo`, `score`, `typeAllocation`, `year`, `selfChoice`)
			 VALUES('$app_id','$applicant_id','$category','$wp_id','$cadre_id','$choiceNo',
			 '$credit','Manual','$pmYear','No')");
			 $insert->execute();

			 //Get used number
			 $newNum = $numUsed + 1;
			 //Update Used number
			 $up = $this->connection->prepare("UPDATE faccadreyear SET 
				   used='$newNum' WHERE fac_id='$fac_id' AND year='$pmYear' AND cadre_Id='$cadre_id'");
			 $up->execute();
			 }
        } 
        elseif ($status == 1) //Selected
        {
			if($available>0)
			{
            $insert = $this->connection->prepare("INSERT INTO allocation(`app_id`, `applicant_id`, `category`, `wp_id`, `cadre_id`, `choiceNo`, `score`, `typeAllocation`, `year`, `selfChoice`)
		    VALUES('$app_id','$applicant_id','$category','$wp_id','$cadre_id','$choiceNo',
		    '$credit','Manual','$pmYear','No')");
         
            $insert->execute();

            $seDoc = $this->connection->prepare("UPDATE `application` SET `status`='Accepted' WHERE `applicant_id`='$applicant_id'");
            $seDoc->execute();
			
			 //Get used number
			 $newNum = $numUsed + 1;
			 //Update Used number
			 $up = $this->connection->prepare("UPDATE faccadreyear SET 
				   used='$newNum' WHERE fac_id='$fac_id' AND year='$pmYear' AND cadre_Id='$cadre_id'");
			 $up->execute();
			}
        } 
		else 
		{
        }

        return $insert;
    }



    //Get all district by regId`
    public function getListofDistrictByRegId($regid)
    {
        $selD = $this->connection->prepare("SELECT * FROM `tzdistrict` WHERE `Reg_Id`='$regid'");
        $selD->execute();
        return $selD;
    }

    //Get all district name
    public function getDistrictNameByDisId($disid)
    {
        $selDName = $this->connection->prepare("SELECT * FROM `tzdistrict`,`tzregions`
		WHERE 
		tzdistrict.Reg_Id=tzregions.Reg_Id AND 
		tzdistrict.District_Id='$disid'");
        $selDName->execute();
        return $selDName;
    }

    //Get Region Detail By dis Id
    public function getRegionDetailsByDisId($disid)
    {
        $getReg = $this->connection->prepare("SELECT * FROM tzdistrict,tzregions 
		WHERE
		tzdistrict.Reg_Id=tzregions.Reg_Id AND
		tzdistrict.District_Id='$disid'");
        $getReg->execute();
        return $getReg;
    }

    //get only district
    public function getOnlyDistrict()
    {
        $insert = $this->connection->prepare("SELECT * FROM tzdistrict ORDER By DistrictName ASC");
        $insert->execute();
        return $insert;
    }
//get only district
    public function getOnlyDistrictByRegID($District_Id)
    {
        $insert = $this->connection->prepare("SELECT * FROM tzdistrict,tzregions  WHERE tzdistrict.Reg_Id=tzregions.Reg_Id AND tzdistrict.Reg_Id='$District_Id'");
        $insert->execute();
        return $insert;
    }
    //get only district
    public function getOnlyDistrictByID($District_Id)
    {
        $insert = $this->connection->prepare("SELECT * FROM tzdistrict,tzregions  WHERE tzdistrict.Reg_Id=tzregions.Reg_Id AND tzdistrict.District_Id='$District_Id'");
        $insert->execute();
        return $insert;
    }





    //////////////////////////////
    //////////////////////////////
    ////MANAGE Training type ///////////
    /////////////////////////////
    /////////////////////////////
    //Add trainingtypeName
    public function addTrainingType($trainingtypeName, $userID)
    {
        //Check if exist
        $select = $this->connection->prepare("SELECT * FROM training_type WHERE trainingtypeName=:trainingtypeName");
        $select->bindParam(':trainingtypeName', $trainingtypeName);
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `training_type`(`trainingtypeName`) VALUES(:trainingtypeName)");
            $insert->bindParam(':trainingtypeName', $trainingtypeName);
            $insert->execute();
        }
        return $insert;
    }

    //Edit trainingtypeName////////
    public function editTrainingType($trainingtypeName, $trainingtype_id)
    {
        $insert = $this->connection->prepare("UPDATE `training_type` SET `trainingtypeName`=:trainingtypeName WHERE trainingtype_id='$trainingtype_id'");
        $insert->bindParam(':trainingtypeName', $trainingtypeName);
        $insert->execute();
        return $insert;
    }

    //Delete trainingtypeName////////
    public function deleteTrainingType($trainingtype_id)
    {
        $delete = $this->connection->exec("DELETE FROM `training_type` WHERE trainingtype_id='$trainingtype_id'");
        return $delete;
    }

    //Function to get trainingtype_id
    public function getTrainigTypeById($trainingtype_id)
    {
        $sel = $this->connection->prepare("SELECT * FROM `training_type` WHERE `trainingtype_id`='$trainingtype_id'");
        $sel->execute();
        return $sel;
    }

    //Function to get all trainingtypeName
    public function getAllTrainingType()
    {
        $selRas = $this->connection->prepare("SELECT * FROM `training_type` ORDER BY trainingtypeName ASC");
        $selRas->execute();
        return $selRas;
    }

    //////////////////////////////
    //////////////////////////////
    ////MANAGE DOCUMENTS//////////
    /////////////////////////////
    /////////////////////////////

    public function getAllDocuments($type = null)
    {
        if ($type != '') {
            $where = " WHERE type='$type' ";
        } else {
            $where = '';
        }
        $selDoc = $this->connection->prepare("SELECT * FROM `documenttypes` $where ORDER BY documenttypes.type ASC");
        $selDoc->execute();
        return $selDoc;
    }

    public function getOtherDocuments()
    {
        $selDoc = $this->connection->prepare("SELECT * FROM `documenttypes` WHERE type<>'Mandatory' ORDER BY documenttypes.type ASC");
        $selDoc->execute();
        return $selDoc;
    }

    public function getCarderDocuments($cadreId)
    {
        $selDoc = $this->connection->prepare("SELECT * FROM `documenttypes`,document_cadre_merge WHERE `documenttypes`.`DocumentID`=document_cadre_merge.document_id AND document_cadre_merge.cadre_id='$cadreId' ORDER BY documenttypes.type ASC");
        $selDoc->execute();
        return $selDoc;
    }

    public function mergeDocs($cadre_id, $document_id)
    {
        $sel = $this->connection->prepare("SELECT * FROM `document_cadre_merge` WHERE `cadre_id`='$cadre_id' AND `document_id`='$document_id'");
        $sel->execute();
        $sel->fetchAll();
        if ($sel->rowCount() < 1) {
            $insert = $this->connection->prepare("INSERT INTO `document_cadre_merge`(`cadre_id`,`document_id`) VALUES(:cadre_id,:document_id)");
            $insert->bindParam(':cadre_id', $cadre_id);
            $insert->bindParam(':document_id', $document_id);
            $insert->execute();
        }
        return $insert;
    }

    public function deleteMergeDoc($merge_id)
    {
        $delete = $this->connection->exec("DELETE FROM `document_cadre_merge` WHERE merge_id='$merge_id'");
        return $delete;
    }

    public function addDocumentName($documentName, $type)
    {
        $insert = $this->connection->prepare("INSERT INTO `documenttypes`(`DocumentType`,`type`) VALUES(:documentName,:type)");
        $insert->bindParam(':documentName', $documentName);
        $insert->bindParam(':type', $type);
        $insert->execute();
        return $insert;
    }

    public function editDocumentName($documentName, $type, $DocumentID)
    {
        $insert = $this->connection->prepare("UPDATE `documenttypes` SET `DocumentType`=:documentName,`type`=:type WHERE DocumentID='$DocumentID'");
        $insert->bindParam(':documentName', $documentName);
        $insert->bindParam(':type', $type);
        $insert->execute();
        return $insert;
    }
    //////////////////////////////
    //////////////////////////////
    ////MANAGE JIMBO ///////////
    /////////////////////////////
    /////////////////////////////
    //Add JIMBO
    public function addJIMBO($jimboName, $RegID, $WilID)
    {
        //Check if exist
        $select = $this->connection->prepare("SELECT `JimboName`, `Region_Id`, `District_Id` FROM `tzjimbo` WHERE JimboName=:JName AND Region_Id=:RegID AND District_Id=:DistID");
        $select->bindParam(':JName', $jimboName);
		$select->bindParam(':RegID', $RegID);
		$select->bindParam(':DistID', $WilID);
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `tzjimbo`(`JimboName`, `Region_Id`, `District_Id`) VALUES(:JName,:RegID,:DistID)");
            $insert->bindParam(':JName', $jimboName);
            $insert->bindParam(':RegID', $RegID);
			$insert->bindParam(':DistID', $WilID);
            $insert->execute();
        }
        return $insert;
    }

    //Edit Jimbo////////
    public function editJIMBO($jimboName, $RegID, $WilID,$ras_id)
    {
        $insert = $this->connection->prepare("UPDATE `tzjimbo` SET `JimboName`=:JName, `Region_Id`=:RegID, `District_Id`=:DistID WHERE Jimbo_Id='$ras_id'");
        $insert->bindParam(':JName', $jimboName);
        $insert->bindParam(':RegID', $RegID);
		$insert->bindParam(':DistID', $WilID);
        $insert->execute();
        return $insert;
    }

    //Delete JIMBO////////
	//SELECT `ainaelimu`, `kiwango`, `chuo`, `mwaka`, `maelezo`, `elimu_id`, 
	//`ubunge_id` FROM `ubunge_elimu` WHERE 1
	public function mgombeaElimu($id)
    {
       $sele = $this->connection->prepare("SELECT `ainaelimu`, `kiwango`, `chuo`, 
	  `mwaka`, `maelezo`, ubunge_id, `elimu_id` FROM `ubunge_elimu` WHERE ubunge_id ='$id'");
       $sele->execute();
	 return $sele;
    }
	
	public function mgombeaElimuSingle($id)
    {
       $sele = $this->connection->prepare("SELECT `ainaelimu`, `kiwango`, `chuo`, 
	  `mwaka`, `maelezo`, ubunge_id, `elimu_id` FROM `ubunge_elimu` WHERE elimu_id ='$id'");
       $sele->execute();
	 return $sele;
    }
	//SELECT * FROM `ubunge_uanachama` WHERE ubunge_id=''
	public function mgombeaUanachama($id)
    {
       $sele = $this->connection->prepare("SELECT * FROM `ubunge_uanachama` WHERE ubunge_id ='$id'");
       $sele->execute();
	 return $sele;
    }
    public function deleteJIMBO($ras_id)
    {
        $delete = $this->connection->exec("DELETE FROM `tzjimbo` WHERE Jimbo_Id='$ras_id'");
        return $delete;
    }
    //Delete List JIMBO MKOA WILAYA////////
    public function select_JI_DI_RE()
    {
        $sele = $this->connection->prepare("SELECT * FROM `tzjimbo`, `tzregions`, `tzdistrict` WHERE tzjimbo.District_Id=tzdistrict.District_Id AND tzdistrict.Reg_Id=tzregions.Reg_Id");
        $sele->execute();
		return $sele;
    }
	
	public function select_JI_DI_REE($id)
    {
        $sele = $this->connection->prepare("SELECT * FROM `tzjimbo`, `tzregions`, `tzdistrict` WHERE tzjimbo.District_Id=tzdistrict.District_Id AND tzdistrict.Reg_Id=tzregions.Reg_Id AND tzdistrict.District_Id = '$id'");
        $sele->execute();
		return $sele;
    }
	public function select_JI_DI_REEJ($id)
    {
        $sele = $this->connection->prepare("SELECT * FROM `tzjimbo`, `tzregions`, `tzdistrict` WHERE tzjimbo.District_Id=tzdistrict.District_Id AND tzdistrict.Reg_Id=tzregions.Reg_Id AND tzjimbo.Jimbo_Id = '$id'");
        $sele->execute();
		return $sele;
    }
	public function selectKuraJumla($id)
    {
        $sele = $this->connection->prepare("SELECT `ngazi`, `ngazi_id`, `idadi`, `zilizoharibika`, `halali`, 
		`jumla_id` FROM `ubunge_jumlakura` WHERE ngazi_id = '$id'");
        $sele->execute();
		return $sele;
    }
    //Delete List JIMBO ////////
    public function select_JI($id)
    {
        $sele = $this->connection->prepare("SELECT * FROM `tzjimbo` WHERE Jimbo_Id='$id'");
        $sele->execute();
		return $sele;
    }
	
	//////////////////////////////
    //////////////////////////////
    ////MANAGE TARAFA ///////////
    /////////////////////////////
    /////////////////////////////
    //Add TARAFA
    public function addTARAFA($tarafaName,$RegID,$WilID,$JimID)
    {
        //Check if exist `TarafaName`, `Region_Id`, `District_Id`, `Jimbo_Id`, `Tarafa_Id`
        $select = $this->connection->prepare("SELECT * FROM `tztarafa` WHERE TarafaName='$tarafaName' AND Region_Id='$RegID' AND District_Id='$WilID' AND Jimbo_Id='$JimID'");
       
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `tztarafa`(`TarafaName`, `Region_Id`, `District_Id`, `Jimbo_Id`) VALUES(:TName,:RegID,:DistID,:JimID)");
            $insert->bindParam(':TName', $tarafaName);
            $insert->bindParam(':RegID', $RegID);
			$insert->bindParam(':DistID', $WilID);
			$insert->bindParam(':JimID', $JimID);
            $insert->execute();
        }
        return $insert;
    }

    //Edit Jimbo////////
    public function editTARAFA($tarafaName,$RegID, $WilID,$JimID,$ras_id)
    {
        $insert = $this->connection->prepare("UPDATE `tztarafa` SET `TarafaName`=:JName, `Jimbo_Id`=:JimID,`Region_Id`=:RegID, `District_Id`=:DistID WHERE Tarafa_Id='$ras_id'");
        $insert->bindParam(':JName', $jimboName);
        $insert->bindParam(':RegID', $RegID);
		$insert->bindParam(':DistID', $WilID);
        $insert->execute();
        return $insert;
    }

    //Delete Tarafa////////
    public function deleteTARAFA($ras_id)
    {
        $delete = $this->connection->exec("DELETE FROM `tztarafa` WHERE Tarafa_Id='$ras_id'");
        return $delete;
    }
    //List TARAFA JIMBO MKOA WILAYA////////
    public function select_TARA_JI_DI_RE()
    {
        $sele = $this->connection->prepare("SELECT * FROM tztarafa,`tzjimbo`, `tzregions`, `tzdistrict` WHERE tztarafa.Jimbo_Id = tzjimbo.Jimbo_Id AND tzjimbo.District_Id=tzdistrict.District_Id AND tzdistrict.Reg_Id=tzregions.Reg_Id");
        $sele->execute();
		return $sele;
    }
    //Delete List JIMBO ////////
    public function select_TARA($id)
    {
        $sele = $this->connection->prepare("SELECT * FROM `tztarafa` WHERE Tarafa_Id='$id'");
        $sele->execute();
		return $sele;
    }
	
	//////////////////////////////
    //////////////////////////////
    ////MANAGE KATA ///////////
    /////////////////////////////
    /////////////////////////////
    //Add KATA
    public function addKATA($kataName,$RegID,$WilID,$JimID,$TaraID)
    {
        //Check if exist `TarafaName`, `Region_Id`, `District_Id`, `Jimbo_Id`, `Tarafa_Id`
        $select = $this->connection->prepare("SELECT * FROM `tzkata` WHERE KataName='$kataName' AND Region_Id='$RegID' AND District_Id='$WilID' AND Jimbo_Id='$JimID' AND Tarafa_Id='$TaraID'");
       
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `tzkata`(`KataName`, `Region_Id`, `District_Id`, `Jimbo_Id`,`Tarafa_Id`) VALUES(:KName,:RegID,:DistID,:JimID,:TaraID)");
            $insert->bindParam(':KName', $kataName);
            $insert->bindParam(':RegID', $RegID);
			$insert->bindParam(':DistID', $WilID);
			$insert->bindParam(':JimID', $JimID);
			$insert->bindParam(':TaraID', $TaraID);
            $insert->execute();
        }
        return $insert;
    }

    //Edit Jimbo////////
    public function editKATA($tarafaName,$RegID, $WilID,$JimID,$ras_id)
    {
        $insert = $this->connection->prepare("UPDATE `tztarafa` SET `TarafaName`=:JName, `Jimbo_Id`=:JimID,`Region_Id`=:RegID, `District_Id`=:DistID WHERE Tarafa_Id='$ras_id'");
        $insert->bindParam(':JName', $jimboName);
        $insert->bindParam(':RegID', $RegID);
		$insert->bindParam(':DistID', $WilID);
        $insert->execute();
        return $insert;
    }

    //Delete Tarafa////////
    public function deleteKATA($ras_id)
    {
        $delete = $this->connection->exec("DELETE FROM `tztarafa` WHERE Tarafa_Id='$ras_id'");
        return $delete;
    }
    //List TARAFA JIMBO MKOA WILAYA////////
    public function select_KA_TARA_JI_DI_RE()
    {
        $sele = $this->connection->prepare("SELECT * FROM tzkata, tztarafa,`tzjimbo`, `tzregions`, `tzdistrict` WHERE tzkata.Tarafa_Id = tztarafa.Tarafa_Id AND tztarafa.Jimbo_Id = tzjimbo.Jimbo_Id AND tzjimbo.District_Id=tzdistrict.District_Id AND tzdistrict.Reg_Id=tzregions.Reg_Id");
        $sele->execute();
		return $sele;
    }
	
	public function select_KATAONLY($id)
    {
        $sele = $this->connection->prepare("SELECT * FROM tzkata WHERE tzkata.District_Id = '$id'");
        $sele->execute();
		return $sele;
    }
	
	public function select_KATABYID($id)
    {
        $sele = $this->connection->prepare("SELECT * FROM tzkata WHERE Kata_Id = '$id'");
        $sele->execute();
		return $sele;
    }
	
	/////////////////////////////
    //////////////////////////////
    ////MANAGE Mtaa ///////////
    /////////////////////////////
     //Add Mtaa
    /////////////////////////////
    public function addMTAA($MtaaName,$RegID,$WilID,$JimID,$TaraID,$KataID)
    {
        //Check if exist `TarafaName`, `Region_Id`, `District_Id`, `Jimbo_Id`, `Tarafa_Id`
        $select = $this->connection->prepare("SELECT * FROM `tzmtaa` WHERE MtaaName='$MtaaName' AND Region_Id='$RegID' AND District_Id='$WilID' AND Jimbo_Id='$JimID' AND Tarafa_Id='$TaraID' AND Kata_Id='$KataID'");
       
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `tzmtaa`(`MtaaName`, `Region_Id`, `District_Id`, `Jimbo_Id`,`Tarafa_Id`,`Kata_Id`) VALUES(:MTName,:RegID,:DistID,:JimID,:TaraID,:KataID)");
            $insert->bindParam(':MTName', $MtaaName);
            $insert->bindParam(':RegID', $RegID);
			$insert->bindParam(':DistID', $WilID);
			$insert->bindParam(':JimID', $JimID);
			$insert->bindParam(':TaraID', $TaraID);
			$insert->bindParam(':KataID', $KataID);
            $insert->execute();
        }
        return $insert;
    }

    //Edit Mtaa////////
    public function editMtaa($tarafaName,$RegID, $WilID,$JimID,$ras_id)
    {
        $insert = $this->connection->prepare("UPDATE `tztarafa` SET `TarafaName`=:JName, `Jimbo_Id`=:JimID,`Region_Id`=:RegID, `District_Id`=:DistID WHERE Tarafa_Id='$ras_id'");
        $insert->bindParam(':JName', $jimboName);
        $insert->bindParam(':RegID', $RegID);
		$insert->bindParam(':DistID', $WilID);
        $insert->execute();
        return $insert;
    }

    //Delete Mtaa////////
    public function deleteMtaa($ras_id)
    {
        $delete = $this->connection->exec("DELETE FROM `tztarafa` WHERE Tarafa_Id='$ras_id'");
        return $delete;
    }
    //List TARAFA JIMBO MKOA WILAYA////////
    public function select_MTA_KA_TARA_JI_DI_RE()
    {
        $sele = $this->connection->prepare("SELECT * FROM tzmtaa, tzkata, tztarafa,`tzjimbo`, `tzregions`, `tzdistrict` WHERE tzmtaa.Kata_Id = tzkata.Kata_Id AND tzkata.Tarafa_Id = tztarafa.Tarafa_Id AND tztarafa.Jimbo_Id = tzjimbo.Jimbo_Id AND tzjimbo.District_Id=tzdistrict.District_Id AND tzdistrict.Reg_Id=tzregions.Reg_Id");
        $sele->execute();
		return $sele;
    }
	
	
	/////////////////////////////
    //////////////////////////////
    ////MANAGE Mtaa ///////////
    /////////////////////////////
 
    //Add Mtaa
    /////////////////////////////
    public function addTAWI($TawiName,$RegID,$WilID,$JimID,$TaraID,$KataID,$MtaaID)
    {
        //Check if exist `TarafaName`, `Region_Id`, `District_Id`, `Jimbo_Id`, `Tarafa_Id`
        $select = $this->connection->prepare("SELECT * FROM `tztawi` WHERE TawiName='$TawiName' AND Region_Id='$RegID' AND District_Id='$WilID' AND Jimbo_Id='$JimID' AND Tarafa_Id='$TaraID' AND Kata_Id='$KataID' AND Mtaa_Id='$MtaaID'");
       
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `tztawi`(`TawiName`, `Region_Id`, `District_Id`, `Jimbo_Id`,`Tarafa_Id`,`Kata_Id`,`Mtaa_Id`) VALUES(:TawiName,:RegID,:DistID,:JimID,:TaraID,:KataID,:MtaaID)");
            $insert->bindParam(':TawiName', $TawiName);
            $insert->bindParam(':RegID', $RegID);
			$insert->bindParam(':DistID', $WilID);
			$insert->bindParam(':JimID', $JimID);
			$insert->bindParam(':TaraID', $TaraID);
			$insert->bindParam(':KataID', $KataID);
			$insert->bindParam(':MtaaID', $MtaaID);
            $insert->execute();
        }
        return $insert;
    }

    //Edit Tawi////////
    public function editTawi($tarafaName,$RegID, $WilID,$JimID,$ras_id)
    {
        $insert = $this->connection->prepare("UPDATE `tztarafa` SET `TarafaName`=:JName, `Jimbo_Id`=:JimID,`Region_Id`=:RegID, `District_Id`=:DistID WHERE Tarafa_Id='$ras_id'");
        $insert->bindParam(':JName', $jimboName);
        $insert->bindParam(':RegID', $RegID);
		$insert->bindParam(':DistID', $WilID);
        $insert->execute();
        return $insert;
    }

    //Delete Tawi////////
    public function deleteTawi($ras_id)
    {
        $delete = $this->connection->exec("DELETE FROM `tztarafa` WHERE Tarafa_Id='$ras_id'");
        return $delete;
    }
    //List Tawi TARAFA JIMBO MKOA WILAYA////////
    public function select_TA_KA_TARA_JI_DI_RE()
    {
        $sele = $this->connection->prepare("SELECT * FROM tztawi, tzmtaa, tzkata, tztarafa,`tzjimbo`, `tzregions`, `tzdistrict` WHERE tztawi.Mtaa_Id = tzmtaa.Mtaa_Id AND tzmtaa.Kata_Id = tzkata.Kata_Id AND tzkata.Tarafa_Id = tztarafa.Tarafa_Id AND tztarafa.Jimbo_Id = tzjimbo.Jimbo_Id AND tzjimbo.District_Id=tzdistrict.District_Id AND tzdistrict.Reg_Id=tzregions.Reg_Id");
        $sele->execute();
		return $sele;
    }
    //Delete List JIMBO ////////
    public function select_KATA($id)
    {
        $sele = $this->connection->prepare("SELECT * FROM `tztarafa` WHERE Tarafa_Id='$id'");
        $sele->execute();
		return $sele;
    }
	
	
    public function select_AllJI()
    {
        $sele = $this->connection->prepare("SELECT * FROM `tzjimbo` ");
        $sele->execute();
		return $sele;
    }
	public function selectJI($id)
    {
        $sele = $this->connection->prepare("SELECT * FROM `tzjimbo` WHERE District_Id='$id'");
        $sele->execute();
		return $sele;
    }
	public function selectJI_TA($id)
    {
        $sele = $this->connection->prepare("SELECT * FROM `tztarafa` WHERE Jimbo_Id='$id'");
        $sele->execute();
		return $sele;
    }
	public function selectJI_TA_KA($id)
    {
        $sele = $this->connection->prepare("SELECT * FROM `tzkata` WHERE Tarafa_Id='$id'");
        $sele->execute();
		return $sele;
    }
	//SELECT `ainavikao`, `amekubalika`, `maelezoyamaoni`, `jinalakatibu`, `ngaziyakatibu`, `tareheyakikao`, `ubunge_id`, 
	//`uteuzi_id` FROM `ubunge_uteuzi` WHERE 1
	public function selectJI_TA_KA_MTA($id)
    {
        $sele = $this->connection->prepare("SELECT * FROM `tzmtaa` WHERE Kata_Id='$id'");
        $sele->execute();
		return $sele;
    }
	public function UteuziMgombea($id)
    {
        $sele = $this->connection->prepare("SELECT `ainavikao`, `amekubalika`, `maelezoyamaoni`, 
		jinalakatibu, `ngaziyakatibu`, `tareheyakikao`, `ubunge_id`, `uteuzi_id` FROM `ubunge_uteuzi` WHERE ubunge_id='$id'");
        $sele->execute();
		return $sele;
    }
	public function select_AllRE()
    {
        $sele = $this->connection->prepare("SELECT * FROM `tzregions` ");
        $sele->execute();
		return $sele;
    }
	 public function select_AllDI()
    {
        $sele = $this->connection->prepare("SELECT * FROM `tzdistrict` ");
        $sele->execute();
		return $sele;
    }
    //////////////////////////////$this->connection->prepare
    //////////////////////////////
    ////MANAGE RAS ///////////
    /////////////////////////////
    /////////////////////////////
    //Add Ras
    public function addRAS($rasName, $userID, $region_id)
    {
        //Check if exist
        $select = $this->connection->prepare("SELECT * FROM ras WHERE rasName=:rasName");
        $select->bindParam(':rasName', $rasName);
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `ras`(`rasName`,`region_id`) VALUES(:rasName,:region_id)");
            $insert->bindParam(':rasName', $rasName);
            $insert->bindParam(':region_id', $region_id);
            $insert->execute();
        }
        return $insert;
    }

    //Edit Ras////////
    public function editRAS($rasName, $ras_id, $region_id)
    {
        $insert = $this->connection->prepare("UPDATE `ras` SET `rasName`=:rasName, `region_id`=:region_id WHERE ras_id='$ras_id'");
        $insert->bindParam(':rasName', $rasName);
        $insert->bindParam(':region_id', $region_id);
        $insert->execute();
        return $insert;
    }

    //Delete RAS////////
    public function deleteRAS($ras_id)
    {
        $delete = $this->connection->exec("DELETE FROM `ras` WHERE ras_id='$ras_id'");
        return $delete;
    }

    //Function to get rasNameById
    public function getRASNameById($ras_id)
    {
        $sel = $this->connection->prepare("SELECT * FROM `ras` WHERE `ras_id`='$ras_id'");
        $sel->execute();
        return $sel;
    }

    //Function to get all RAS Name
    public function getAllRASName()
    {
        $selRas = $this->connection->prepare("SELECT * FROM `ras`,`tzregions` WHERE ras.region_id=tzregions.Reg_Id ORDER BY rasName ASC");
        $selRas->execute();
        return $selRas;
    }


    ////////////////////////////////////
    ///////////unshortlisted///////////
    //////////////////////////////////
    /////////////////////////////////
    //Get list of Shortisted applicant Id
    public function getListofUnshortlistedApplicantsByYear($pmYear)
    {
        $select = $this->connection->prepare("SELECT DISTINCT(applicant_id) AS applicant_id FROM `application` WHERE `year`='$pmYear'  AND `status`='Unshortlisted'");
        $select->execute();
        return $select;
    }


    //Get list of Shortisted applicant Id
    public function getListofUnshortlistedApplicantsByYearWPCat($pmYear, $cat1, $wp_id1, $cadre1)
    {
        $select = $this->connection->prepare("SELECT DISTINCT(applicant_id) AS applicant_id 
        FROM 
        `application` 
        WHERE 
        `year`='$pmYear' AND
        `category`='$cat1' AND
        `fac_id`='$wp_id1' AND
        `cadre_id`='$cadre1' AND
        `status`='Unshortlisted'");
        $select->execute();
        return $select;
    }


    //Get list of unShortisted by cadre Id
    public function getListofUnshortlistedApplicantsByCadreId($cadre1, $pmYear)
    {
        $select = $this->connection->prepare("SELECT DISTINCT(applicant_id) AS applicant_id 
        FROM 
        `application` 
        WHERE 
        `year`='$pmYear' AND
        `cadre_id`='$cadre1' AND
        `status`='Unshortlisted'");
        $select->execute();
        return $select;
    }

    //Get list of Unshortlisted Location
    public function getListofUnshortlistedApplicantsByLocation($pmYear, $cat1, $wp_id1, $cadre1)
    {
        $select = $this->connection->prepare("SELECT DISTINCT(applicant_id) AS applicant_id 
        FROM 
        `application` 
        WHERE 
        `year`='$pmYear' AND
        `category`='$cat1' AND
        `fac_id`='$wp_id1' AND
        `status`='Unshortlisted'");
        $select->execute();
        return $select;
    }


    //Get list of Unshortlisted applicants
    public function getUnshortlistedWPByApplicantIdYearWPCATBy($applicant_id, $pmYear, $cat1, $wp_id1, $cadre1)
    {
        $select = $this->connection->prepare("SELECT * FROM `application` 
        WHERE
        `applicant_id`='$applicant_id' AND
        `year`='$pmYear' AND
        `category`='$cat1' AND
        `fac_id`='$wp_id1' AND
        `cadre_id`='$cadre1' AND
        `status`='Unshortlisted' ORDER BY choiceNo ASC");
        $select->execute();
        return $select;
    }


    //Get list of Unshortlisted applicants
    public function getUnshortlistedWPByApplicantIdYear($applicant_id, $pmYear)
    {
        $select = $this->connection->prepare("SELECT * FROM `application` 
        WHERE
        `applicant_id`='$applicant_id' AND
        `year`='$pmYear' AND 
        `status`='Unshortlisted' ORDER BY choiceNo ASC");
        $select->execute();
        return $select;
    }

    ///////////////////////////////
    //////////End Unshortlisted////
    //////////////////////////////
    ////////////////////////////


    //////////////////////////////
    //////////////////////////////
    ////MANAGE RRH ///////////
    /////////////////////////////
    /////////////////////////////
    //Add
    public function addRRH($rrhName, $level, $region_id)
    {
        //Check if exist
        $select = $this->connection->prepare("SELECT * FROM rrh WHERE rrhName=:rrhName");
        $select->bindParam(':rrhName', $rrhName);
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `rrh`(`rrhName`,`level`,`region_id`) VALUES(:rrhName,:level,:region_id)");
            $insert->bindParam(':rrhName', $rrhName);
            $insert->bindParam(':level', $level);
            $insert->bindParam(':region_id', $region_id);
            $insert->execute();
        }
        return $insert;
    }

    //Edit
    public function editRRH($rrhName, $level, $rrh_id, $region_id)
    {
        $insert = $this->connection->prepare("UPDATE `rrh` SET `rrhName`=:rrhName, `level`=:level, `region_id`=:region_id WHERE id='$rrh_id'");
        $insert->bindParam(':rrhName', $rrhName);
        $insert->bindParam(':level', $level);
        $insert->bindParam(':region_id', $region_id);
        $insert->execute();
        return $insert;
    }

    //Delete
    public function deleteRRH($rrh_id)
    {
        $delete = $this->connection->exec("DELETE FROM `rrh` WHERE id='$rrh_id'");
        return $delete;
    }

    public function getRRHNameById($rrh_id)
    {
        $sel = $this->connection->prepare("SELECT * FROM `rrh` WHERE `id`='$rrh_id'");
        $sel->execute();
        return $sel;
    }

    public function getAllRRHName()
    {
        $selRas = $this->connection->prepare("SELECT * FROM `rrh`,`tzregions` WHERE rrh.region_id=tzregions.Reg_Id ORDER BY rrhName ASC");
        $selRas->execute();
        return $selRas;
    }








    //////////////////////////////
    //////////////////////////////
    ////MANAGE Disability ///////////
    /////////////////////////////
    /////////////////////////////
    //Add Disability
    public function addDisability($disabilityName, $userID)
    {
        //Check if exist
        $select = $this->connection->prepare("SELECT * FROM disability WHERE disabilityName=:disabilityName");
        $select->bindParam(':disabilityName', $disabilityName);
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `disability`(`disabilityName`) VALUES(:disabilityName)");
            $insert->bindParam(':disabilityName', $disabilityName);
            $insert->execute();
        }
        return $insert;
    }

    //Edit Ras////////
    public function editDisability($disabilityName, $disability_id)
    {
        $insert = $this->connection->prepare("UPDATE `disability` SET `disabilityName`=:disabilityName WHERE disability_id='$disability_id'");
        $insert->bindParam(':disabilityName', $disabilityName);
        $insert->execute();
        return $insert;
    }

    //Delete RAS////////
    public function deleteDisability($disability_id)
    {
        $delete = $this->connection->exec("DELETE FROM `disability` WHERE disability_id='$disability_id'");
        return $delete;
    }

    //Function to get rasNameById
    public function getDisabilityNameById($disability_id)
    {
        $sel = $this->connection->prepare("SELECT * FROM `disability` WHERE `disability_id`='$disability_id'");
        $sel->execute();
        return $sel;
    }

    //Function to get all RAS Name
    public function getAllDisabilityName()
    {
        $selRas = $this->connection->prepare("SELECT * FROM `disability` ORDER BY disability_id ASC");
        $selRas->execute();
        return $selRas;
    }




    //////////////////////////////
    //////////////////////////////
    ////MANAGE FACILITY///////////
    /////////////////////////////
    /////////////////////////////
    //Add Facility
    public function addFacility($facName, $facility_type_id, $region, $district)
    {
        //Check if exist
        $select = $this->connection->prepare("SELECT * FROM facility_details WHERE facName=:facName");
        $select->bindParam(':facName', $facName);
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `facility_details`(`facname`, `facility_type_id`, `disid`, `regid`) VALUES(:facName,:facility_type_id,:district,:region)");
            $insert->bindParam(':facName', $facName);
            $insert->bindParam(':facility_type_id', $facility_type_id);
            $insert->bindParam(':district', $district);
            $insert->bindParam(':region', $region);
            // var_dump($insert); exit();
            $insert->execute();
        }

        return $insert;
    }

    public function addFacilityType($name)
    {
        $user_id = $_SESSION['userid'];
        //Check if exist
        $select = $this->connection->prepare("SELECT * FROM facility_type WHERE `name`=:name");
        $select->bindParam(':name', $name);
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `facility_type`(`name`, `user_id`) VALUES(:name,:user_id)");
            $insert->bindParam(':name', $name);
            $insert->bindParam(':user_id', $user_id);
            $insert->execute();
        }

        return $insert;
    }

    //Get list of facility
    public function getFacility()
    {
        $select = $this->connection->prepare("SELECT * FROM facility_details,tzregions,tzdistrict
		  WHERE
		  facility_details.regid=tzregions.Reg_Id AND
		  facility_details.disid=tzdistrict.District_Id");
        $select->execute();
        return $select;
    }

    //Get list of facility by id
    public function getFacilityById($facid)
    {
        $select = $this->connection->prepare("SELECT * FROM facility_details,tzregions,tzdistrict
		  WHERE
		  facility_details.regid=tzregions.Reg_Id AND
		  facility_details.disid=tzdistrict.District_Id AND
		  facility_details.facId='$facid'");
        $select->execute();
        return $select;
    }


    //Edit Facility
    public function editFacilityDetails($facName, $region, $district, $facid)
    {
        $insert = $this->connection->prepare("UPDATE `facility_details`
		  SET
		  `facname`=:facName,
		  `disid`=:district,
		  `regid`=:region
		  WHERE facId='$facid'");

        $insert->bindParam(':facName', $facName);
        $insert->bindParam(':district', $district);
        $insert->bindParam(':region', $region);
        $insert->execute();
        return $insert;
    }

    public function editFacilityType($name, $facility_type_id)
    {
        $insert = $this->connection->prepare("UPDATE `facility_type` SET `name`=:name WHERE facility_type_id='$facility_type_id'");
        $insert->bindParam(':name', $name);
        $insert->execute();
        return $insert;
    }

    //Delete Facility
    public function deleteFacilityDetails($facid)
    {
        $insert = $this->connection->prepare("DELETE FROM facility_details 
		  WHERE facId='$facid'");
        $insert->execute();
        return $insert;
    }

    public function deleteFacilityType($facility_type_id)
    {
        $insert = $this->connection->prepare("DELETE FROM facility_type 
		  WHERE facility_type_id='$facility_type_id'");
        $insert->execute();
        return $insert;
    }

    public function activateFacilityDetails($facid, $status)
    {
        $insert = $this->connection->prepare("UPDATE `facility`
		  SET
		  `status`=:status
		  WHERE fac_id='$facid'");

        $insert->bindParam(':status', $status);
        $insert->execute();
        return $insert;
    }


    //Get facility by disid
    public function getFacilityByDisId($disid)
    {
        $insert = $this->connection->prepare("SELECT * FROM `facility_details` WHERE `disid`='$disid'");
        $insert->execute();
        return $insert;
    }

    ///get only facility
    public function getOnlyFacility()
    {
        $insert = $this->connection->prepare("SELECT * FROM `facility_details`  ORDER BY facname ASC");
        $insert->execute();
        return $insert;
    }

    //get only facility by id
    public function getOnlyFacilityById($facid)
    {
        $insert = $this->connection->prepare("SELECT * FROM `facility_details` WHERE facId='$facid'  ORDER BY facname ASC");
        $insert->execute();
        return $insert;
    }


    public function getFacilityTypes()
    {
        $sel = $this->connection->prepare("SELECT * FROM `facility_type`");
        $sel->execute();
        return $sel;
    }

    public function getFacilityTypeName($ftid)
    {
        $sel = $this->connection->prepare("SELECT * FROM `facility_type` WHERE `facility_type_id`='$ftid'");
        $sel->execute();
        return $sel;
    }



    //////////////////////////////
    //////////////////////////////
    ////MANAGE HEALTH CADRE////////
    /////////////////////////////
    /////////////////////////////
    //Add HEALTH CADRE
    public function addHealthCadre($cadreName, $level, $trainType, $boardV)
    {
        //Check if exist
        $select = $this->connection->prepare("SELECT * FROM cadres WHERE cadreName=:cadreName");
        $select->bindParam(':cadreName', $cadreName);
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `cadres`(`cadreName`, `level`, `trainType`,`boardV`) VALUES(:cadreName,:level,:trainType,:boardV)");
            $insert->bindParam(':cadreName', $cadreName);
            $insert->bindParam(':level', $level);
            $insert->bindParam(':trainType', $trainType);
            $insert->bindParam(':boardV', $boardV);
            $insert->execute();
        }
        return $insert;
    }

    //Get list of healthh cadres
    public function getHealthCadres()
    {
        $select = $this->connection->prepare("SELECT * FROM cadres ORDER BY cadreName ASC");
        $select->execute();
        return $select;
    }

    //Get list of health cadres by id
    public function getHealthCadresById($cadreid)
    {
        $select = $this->connection->prepare("SELECT * FROM cadres WHERE cadreId='$cadreid'");
        $select->execute();
        return $select;
    }

    //Edit health cadres
    public function editHealthCadre($cadreName, $level, $trainType, $boardV, $cadreid)
    {
        $insert = $this->connection->prepare("UPDATE `cadres`
		  SET
		  `cadreName`=:cadreName,
		  `level`=:level,
		  `trainType`=:trainType,
		  `boardV`=:boardV
		  WHERE cadreId='$cadreid'");

        $insert->bindParam(':cadreName', $cadreName);
        $insert->bindParam(':level', $level);
        $insert->bindParam(':trainType', $trainType);
        $insert->bindParam(':boardV', $boardV);
        $insert->execute();
        return $insert;
    }

    //Delete Health Cadre
    public function deleteHealthCadre($cadreid)
    {
        $insert = $this->connection->prepare("DELETE FROM cadres 
		  WHERE cadreId='$cadreid'");
        $insert->execute();
        return $insert;
    }


    //////////////////////////////
    //////////////////////////////
    ////MANAGE CRITERIA///////////
    /////////////////////////////
    /////////////////////////////
    //Add Criteria
    public function addCriteria($criteriaName, $userID, $standard_id)
    {
        //Check if exist
        $select = $this->connection->prepare("SELECT * FROM criteria WHERE criteriaName=:criteriaName");
        $select->bindParam(':criteriaName', $criteriaName);
        $select->execute();
        if ($select->rowCount() > 0) {
            echo '<script language="javascript">';
            echo "alert('Criteria already existed')";
            echo '</script>';
            echo '<script language="javascript">';
            echo 'location.href = "../?pg=mngCrS"';
            echo '</script>';
        } else {
            $insert = $this->connection->prepare("INSERT INTO `criteria`(`criteriaName`, `userid`,`standard_id`) VALUES(:criteriaName,:userID,:standard_id)");
            $insert->bindParam(':criteriaName', $criteriaName);
            $insert->bindParam(':userID', $userID);
            $insert->bindParam(':standard_id', $standard_id);
            $insert->execute();
        }
        return $insert;
    }


    //Get list of criteria
    public function getListCriteria()
    {
        $select = $this->connection->prepare("SELECT * FROM criteria,standard_criteria WHERE standard_criteria.id=criteria.standard_id ORDER BY criteriaName ASC");
        $select->execute();
        return $select;
    }


    //Get list of Criteria by id
    public function getCriteriaById($criteriaid)
    {
        $select = $this->connection->prepare("SELECT * FROM criteria WHERE criteriaId='$criteriaid'");
        $select->execute();
        return $select;
    }

    //Edit Criteria
    public function editCriteria($criteriaName, $criteriaid)
    {
        $insert = $this->connection->prepare("UPDATE `criteria`
		  SET
		  `criteriaName`=:criteriaName
		  WHERE criteriaId='$criteriaid'");
        $insert->bindParam(':criteriaName', $criteriaName);
        $insert->execute();
        return $insert;
    }

    //Delete Criteria
    public function deleteCriteria($criteriaid)
    {
        $insert = $this->connection->prepare("DELETE FROM criteria 
		  WHERE criteriaId='$criteriaid'");
        $insert->execute();
        return $insert;
    }


    //Get list of Standard
    public function getStandard()
    {
        $select = $this->connection->prepare("SELECT * FROM standard_criteria WHERE status='Active' ORDER BY name ASC");
        $select->execute();
        return $select;
    }

    //Get list of Standard
    public function getStandardNames($a)
    {
        $select = $this->connection->prepare("SELECT `standard_id` FROM `criteria` WHERE `criteriaId` ='$a'");
        $select->execute();
        return $select;
    }


    ////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    ///MODULE 1: MANAGE SYSTEM USERS/////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////
    //---->Part 1: Check if username exist
    public function checkUsername($username)
    {
        $checkUser = $this->connection->prepare("SELECT * FROM `db_users` WHERE `username`=:user");
        $checkUser->bindValue(':user', $username);
        $checkUser->execute();
        return $checkUser;
    }

    //---->Part 2: Check if email exist
    public function checkEmailIfExist($email)
    {
        $checkEmail = $this->connection->prepare("SELECT * FROM `db_users` WHERE `email`=:email");
        $checkEmail->bindValue(':email', $email);
        $checkEmail->execute();
        return $checkEmail;
    }


    //--->Part 3: Insert new system user
    public function insertNewSystemUser($facility, $firstname, $lastname, $gender, $username, $password, $email, $userlevel, $phone, $member_id, $wp_category_id, $wp_id)
    {
        $name = $firstname . " " . $lastname;

        //$pwd= password_hash($password,PASSWORD_BCRYPT);
        //$pwd =PwdHash($password);

        $pwd = md5($password);

        //Insert into Members
        $insertM = $this->connection->prepare("INSERT INTO `members`(`firstname`, `lastname`, `gender`, `phone`, `email`,`user_id`) 
		 VALUES (:firstname,:lastname,:gender,:phone,:email,'$member_id')");
        $insertM->bindParam(':firstname', $firstname);
        $insertM->bindParam(':lastname', $lastname);
        $insertM->bindParam(':gender', $gender);
        $insertM->bindParam(':phone', $phone);
        $insertM->bindParam(':email', $email);
        $insertM->execute();
        $member_id = $this->connection->lastInsertId();


        $insetUser = $this->connection->prepare("INSERT INTO `db_users`(`email`, `username`, `password`,`level`, `member_id`,wp_category_id,wp_id,`regDate`) 
		 VALUES (:email,:username,:password,:level,'$member_id','$wp_category_id','$wp_id',CURDATE())");
        $insetUser->bindParam(':email', $email);
        $insetUser->bindParam(':username', $username);
        $insetUser->bindParam(':password', $pwd);
        $insetUser->bindParam(':level', $userlevel);
        $insetUser->execute();
        $user_id = $this->connection->lastInsertId();

        // $insetUserInAgenciesFacility = $this->connection->prepare("INSERT INTO `agencies_facility`(`user_id`, `facility_id`) VALUES (:user_id,:facility_id)");
        // $insetUserInAgenciesFacility->bindParam(':user_id', $user_id);
        // $insetUserInAgenciesFacility->bindParam(':facility_id', $facility);
        // $insetUserInAgenciesFacility->execute();

        return $insetUser;
    }

    //Change Password
    public function changePassword($password, $key)
    {
        $pwd = md5($password);
        $update = $this->connection->prepare("UPDATE db_users SET password=:pass
		WHERE 
		keyGen='$key'");
        $update->bindParam(':pass', $pwd);
        $update->execute();
        return $update;
    }


    //Applicant Change Password
    public function ApplicantChangePassword($password, $user)
    {
        // $pwd=md5($password);
        // $newpwd=md5($NewPassword);
        $sql = $this->connection->prepare("SELECT password FROM db_users WHERE password='$password' AND user_id='$user'");
        // $sql->bindValue(':password',$password);
        // $sql->bindValue(':user',$user);
        $sql->execute();
        return $sql;
    }

    public function ApplicantUpdatePassword($NewPassword, $user)
    {
        $update = $this->connection->prepare("UPDATE db_users SET password='$NewPassword'
        WHERE 
        user_id='$user'");
        // $update->bindParam(':NewPassword',$NewPassword);
        $update->execute();
        return $update;
    }

    //Get username by key
    public function getUsernameByKey($key)
    {
        $select = $this->connection->prepare("SELECT `user_id`, `username` FROM `db_users` WHERE `keyGen`='$key'");
        $select->execute();
        return $select;
    }

    //--->Part 4: Get all users
    public function getsystemUsers()
    {
        $getUser = $this->connection->prepare("SELECT * FROM `db_users`");
        $getUser->execute();
        return $getUser;
    }

    public function getMembers()
    {
        $getUser = $this->connection->prepare("SELECT members.*,`db_users`.`user_id`, `username`, `level`, `wp_category_id`, `wp_id` FROM members,db_users where db_users.member_id=members.member_id ORDER BY firstname ASC");
        $getUser->execute();
        return $getUser;
    }


    public function getMembersById($member_id)
    {
        $getUser = $this->connection->prepare("SELECT * FROM `members` WHERE 
		 member_id='$member_id'
		 ");
        $getUser->execute();
        return $getUser;
    }

    //--->Part 5: Get user by id
    public function getsystemUsersById($tableid)
    {
        $getU = $this->connection->prepare("SELECT * FROM `db_users` WHERE `user_id`='$tableid'");
        $getU->execute();
        return $getU;
    }

    //--->Part 5: Get project Updated User by id
    public function getProjectUpdatedUsersById($user_updateID)
    {
        $getUp = $this->connection->prepare("SELECT * FROM `db_users` WHERE `user_id`='$user_updateID'");
        $getUp->execute();
        return $getUp;
    }

    ///--->Part 6: Edit user details
    public function editSystemUser($level, $email, $userID, $firstname, $lastname, $gender, $phone)
    {
        $name = $firstname . " " . $lastname;
        $update = $this->connection->exec("UPDATE `polc_users` 
		                            SET 
                                   `name`='$name',
                                   `gender`='$gender',
                                   `phone`='$phone',
                                   `email`='$email',
								   `level`='$level'
                                    WHERE `user_id`='$userID'");
        return $update;
    }

    ///--->Part 7: Delete user details
    public function deleteThisUser($userID)
    {
        $deleteUser = $this->connection->exec("DELETE FROM `polc_users` WHERE `user_id`='$userID'");
        return $deleteUser;
    }

    public function getUserPermisions($user_id, $user_level)
    {
        if ($user_level == 'All') {
            $table = 'db_users_permissions_admin';
        } else {
            $table = 'db_users_permissions_facilities';
        }
        $select = $this->connection->prepare("SELECT * FROM $table WHERE user_id=:user_id");
        $select->bindParam(':user_id', $user_id);
        $select->execute();
        return $select;
    }

    public function updateUserPermision($GET)
    {
        $user_id = $GET['user_id'];
        $user_level = $GET['user_level'];
        if ($user_level == 'All') {
            $table = '`db_users_permissions_admin`';
        } else {
            $table = '`db_users_permissions_facilities`';
        }
        // unset old user permisions
        $columns = $this->getPermisions($user_level);
        $counts = count($columns);
        $sets = '';
        foreach ($columns as $key => $col) {
            $j = ($key + 1);
            if ($counts != $j) {
                $sets .= "`$col`='NO',";
            } else {
                $sets .= "`$col`='NO'";
            }
            $update = "UPDATE $table SET $sets WHERE user_id='$user_id'";
        }
        $stmt = $this->connection->prepare($update);
        $stmt->execute();

        // update to new user permisions
        if (isset($GET['permision'])) {
            $permisions = $GET['permision'];
            $count = count($permisions);

            $set = '';
            foreach ($permisions as $key => $permision) {
                $i = ($key + 1);
                if ($count != $i) {
                    $set .= "`$permision`='YES',";
                } else {
                    $set .= "`$permision`='YES'";
                }
                $updateSQL = "UPDATE $table SET $set WHERE user_id='$user_id'";
            }
            $stmt = $this->connection->prepare($updateSQL);
            $stmt->execute();

            //update session
            unset($_SESSION['permissions']);
            $pers = $this->connection->prepare("SELECT * FROM $table WHERE user_id='$user_id'");
            $pers->execute();
            $persrw = $pers->fetch();
            $_SESSION['permissions'] = $persrw;
        }
        return $stmt;
    }

    public function addUserPermision($GET)
    {
        $user_id = $GET['user_id'];
        $user_level = $GET['user_level'];
        if ($user_level == 'All') {
            $table = '`db_users_permissions_admin`';
        } else {
            $table = '`db_users_permissions_facilities`';
        }
        $permisions = $GET['permision'];
        if (isset($GET['permision'])) {
            $count = count($permisions);
            $columns = '';
            $values = '';
            foreach ($permisions as $key => $permision) {
                $i = ($key + 1);
                if ($count != $i) {
                    $columns .= "`$permision`,";
                    $values .= "'YES',";
                } else {
                    $columns .= "`$permision`";
                    $values .= "'YES'";
                }
                $insertSQL = "INSERT INTO $table (`user_id`, $columns) VALUES ('$user_id',$values)";
            }
            $stmt = $this->connection->prepare($insertSQL);
            $stmt->execute();

            //update session
            unset($_SESSION['permissions']);
            $pers = $this->connection->prepare("SELECT * FROM $table WHERE user_id='$user_id'");
            $pers->execute();
            $persrw = $pers->fetch();
            $_SESSION['permissions'] = $persrw;
        }
        return $stmt;
    }

    public function getPermisions($user_level)
    {

        if ($user_level == 'All') {
            $table = 'db_users_permissions_admin';
        } else {
            $table = 'db_users_permissions_facilities';
        }
        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = :table";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':table', $table, PDO::PARAM_STR);
            $stmt->execute();
            $output = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $column_name = $row['COLUMN_NAME'];
                if ($column_name != 'permission_id' && $column_name != 'user_id' && $column_name != 'date_time') {
                    $output[] = $column_name;
                }
            }
            return $output;
        } catch (PDOException $pe) {
            trigger_error('Could not connect to MySQL database. ' . $pe->getMessage(), E_USER_ERROR);
        }
    }

    /////////////////////////////////////
    /////////////////////////////////////
    ////////////WORK PERMIT CATEGORY////
    ////////////////////////////////////
    ////////////////////////////////////
    //Insert New WP Category/
    public function addWPCategory($category, $userID)
    {
        //Check if it exit
        $select = $this->connection->prepare("SELECT * FROM wp_category WHERE name=:category");
        $select->bindParam(':category', $category);
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insertF = $this->connection->prepare("INSERT INTO `wp_category`(`name`,`userid`) 
		 VALUES (:category,:userID)");
            $insertF->bindParam(':category', $category);
            $insertF->bindParam(':userID', $userID);
            $insertF->execute();
        }
        return $insertF;
    }

    //Get All WPC list
    public function getWPCategory()
    {
        $getC = $this->connection->prepare("SELECT * FROM `wp_category` ORDER BY name ASC");
        $getC->execute();
        return $getC;
    }

    //Get All WPC list by id
    public function getWPCategorybyId($wpc_id)
    {
        $getC = $this->connection->prepare("SELECT * FROM `wp_category` WHERE wpc_id='$wpc_id'");
        $getC->execute();
        return $getC;
    }

    //Update  WP Category/
    public function updateWPCategory($category, $wpc_id)
    {
        $insertF = $this->connection->prepare("UPDATE `wp_category` SET
		 name=:category
		  WHERE 
		  wpc_id='$wpc_id'");
        $insertF->bindParam(':category', $category);
        $insertF->execute();
        return $insertF;
    }

    //Delete WPC list by id
    public function deleteWPCategory($wpc_id)
    {
        $deleteC = $this->connection->prepare("DELETE FROM `wp_category` WHERE wpc_id='$wpc_id'");
        $deleteC->execute();
        return $deleteC;
    }


    //////////////////////////////
    /////////////////////////////
    ///////CADRE CRITERIA////////
    /////////////////////////////
    public function insertCadreCriteria($cadre_id, $criteria_id, $credit, $lower_age, $higher_age, $gender)
    {
        if ($criteria_id == "") {
        } else {
            $insertC = $this->connection->prepare("INSERT INTO `cadre_criteria`(`cadre_id`, `criteria_id`, `credit`,`lower_age`, `higher_age`, `gender`) 
		 VALUES (:cadre_id,:criteria_id,:credit,:lower_age,:higher_age,:gender)");
            $insertC->bindParam(':cadre_id', $cadre_id);
            $insertC->bindParam(':criteria_id', $criteria_id);
            $insertC->bindParam(':credit', $credit);
            $insertC->bindParam(':lower_age', $lower_age);
            $insertC->bindParam(':higher_age', $higher_age);
            $insertC->bindParam(':gender', $gender);
            $insertC->execute();
            return $insertC;
        }
    }


    //Get list of cadres from cadre_criteria table
    public function getListofCadreCriteria()
    {
        $select = $this->connection->prepare("SELECT DISTINCT(cadre_id) FROM cadre_criteria");
        $select->execute();
        return $select;
    }


    //Get list of criteria by cadre id
    public function getListofCadreCriteriaById($cadreid)
    {
        $select = $this->connection->prepare("SELECT * FROM cadre_criteria,criteria
		WHERE
		cadre_criteria.criteria_id=criteria.criteriaId AND 
		cadre_criteria.cadre_id='$cadreid'");
        $select->execute();
        return $select;
    }

    //Get list of CADRE from cadre criteria by cadre id
    public function getListofCadreFromCCById($cadreid)
    {
        $select = $this->connection->prepare("SELECT * FROM cadre_criteria,criteria
		WHERE
		cadre_criteria.criteria_id=criteria.criteriaId AND 
		cadre_criteria.cadre_id='$cadreid'");
        $select->execute();
        return $select;
    }


    //Get list of CADRE CRITERIAfrom cadre criteria by cc_id
    public function getListofCadreCriteriaFromCCById($cc_id)
    {
        $select = $this->connection->prepare("SELECT * FROM cadre_criteria,criteria
		WHERE
		cadre_criteria.criteria_id=criteria.criteriaId AND 
		cadre_criteria.cc_id='$cc_id'");
        $select->execute();
        return $select;
    }

    //Function to Edit Cadre Criteria
    public function editCadreCriteria($criteria, $credit, $cc_id)
    {
        $insert = $this->connection->prepare("UPDATE cadre_criteria SET
      criteria_id=:criteria,
	  credit=:credit
		   
	  WHERE cc_id='$cc_id'");

        $insert->bindParam(':criteria', $criteria);
        $insert->bindParam(':credit', $credit);
        $insert->execute();
        return $insert;
    }

    //Delete Cadre Criteria
    public function deleteCadreCriteria($cc_id)
    {
        $deleteC = $this->connection->prepare("DELETE FROM `cadre_criteria` WHERE cc_id='$cc_id'");
        $deleteC->execute();
        return $deleteC;
    }

    public function deleteCadreCriteriaByCadre($cc_id)
    {
        $deleteC = $this->connection->prepare("DELETE FROM `cadre_criteria` WHERE cadre_id='$cc_id'");
        $deleteC->execute();
        return $deleteC;
    }


    //////////////////////////////
    //////////////////////////////
    ////MANAGE Mabaraza ///////////
    /////////////////////////////
    /////////////////////////////
    //Add Ras
    public function addMabaraza($name, $userID)
    {
        //Check if exist
        $select = $this->connection->prepare("SELECT * FROM council WHERE name=:name");
        $select->bindParam(':name', $name);
        $select->execute();
        if ($select->rowCount() > 0) {
        } else {
            $insert = $this->connection->prepare("INSERT INTO `council`(`name`) VALUES(:name)");
            $insert->bindParam(':name', $name);
            $insert->execute();
        }
        return $insert;
    }

    //Edit Mabaraza////////
    public function editMabaraza($name, $id)
    {
        $insert = $this->connection->prepare("UPDATE `council` SET `name`=:name WHERE id='$id'");
        $insert->bindParam(':name', $name);
        $insert->execute();
        return $insert;
    }

    //Delete Mabaraza////////
    public function deleteMabaraza($id)
    {
        $delete = $this->connection->exec("DELETE FROM `council` WHERE id='$id'");
        return $delete;
    }

    //Function to get rasNameById
    public function getMabarazaNameById($id)
    {
        $sel = $this->connection->prepare("SELECT * FROM `council` WHERE `id`='$id'");
        $sel->execute();
        return $sel;
    }

    //Function to get all mabaraza Name
    public function getAllMabarazaName()
    {
        $selMabaraza = $this->connection->prepare("SELECT * FROM `council` ORDER BY id ASC");
        $selMabaraza->execute();
        return $selMabaraza;
    }
    //////////////////////////////
    //////////////////////////////
    ////End MANAGE Mabaraza ///////////
    /////////////////////////////
    /////////////////////////////


    /////////////////////////////
    //edit $ delete manageusers//
    ////////////////////////////
    ///////////////////////////

    //Edit Ras////////
    public function editUser($firstname, $lastname, $gender, $email, $phone, $member_id)
    {
        $insert = $this->connection->prepare("UPDATE `members` SET `firstname`=:firstname, `lastname`=:lastname, `gender`=:gender, `email`=:email, `phone`=:phone WHERE member_id='$member_id'");
        $insert->bindParam(':firstname', $firstname);
        $insert->bindParam(':lastname', $lastname);
        $insert->bindParam(':gender', $gender);
        $insert->bindParam(':email', $email);
        $insert->bindParam(':phone', $phone);
        $insert->execute();
        return $insert;
    }

    //Delete RAS////////
    public function deleteUserEdited($member_id)
    {
        $delete = $this->connection->prepare("DELETE FROM `members` WHERE member_id='$member_id'");
        // var_dump($delete);exit();
        $delete->execute();
        return $delete;
    }
    /////////////////////////////////
    //END edit $ delete manageusers//
    ////////////////////////////////
    ///////////////////////////////


    ///////////////////////////
    /////WORK PERMIT///////////
    //////////////////////////

    //Get Facility by fac_id
    public function getfacilityByfacid($fac_id)
    {
        $getC = $this->connection->prepare("SELECT * FROM facility WHERE fac_id='$fac_id'");
        $getC->execute();
        return $getC;
    }

    //Get all Facility/////////
    public function getAllFacility()
    {
        $getF = $this->connection->prepare("SELECT * FROM facility");
        $getF->execute();
        return $getF;
    }

    //Insert Facility/
    public function insertFacility($category, $facName, $member_id, $startdate, $enddate, $workpstatus)
    {
        $insertF = $this->connection->prepare("INSERT INTO `facility`(`category`, `wp_id`,`startdate`, `enddate`, `status`, `user_id`) 
		 VALUES (:category,:facName,:startdate,:enddate,:workpstatus,'$member_id')");
        $insertF->bindParam(':category', $category);
        $insertF->bindParam(':facName', $facName);
        $insertF->bindParam(':startdate', $startdate);
        $insertF->bindParam(':enddate', $enddate);
        $insertF->bindParam(':workpstatus', $workpstatus);
        $insertF->execute();
        return $insertF;
    }

    //Get last id
    public function lastId($insertF)
    {
        return $this->connection->lastInsertId();
    }

    //Insert Facility Cadre/
    public function insertCadre($cadre, $number, $year, $fac_id)
    {
        if ($cadre == "") {
        } else {
            $this->connection->beginTransaction();

            //Check if exit
            $select = $this->connection->prepare("SELECT * FROM `faccadre` WHERE `cadreName`='$cadre' AND `fac_id`='$fac_id'");
            $select->execute();
            if ($select->rowCount() > 0) {
                //Update Record
                $insertC = $this->connection->prepare("UPDATE `faccadre` 
		 SET 
		 `cadreName`=:cadre,
		 `fac_id`='$fac_id'
		 WHERE 
		 `cadreName`='$cadre' AND 
		 `fac_id`='$fac_id'");
                $insertC->bindParam(':cadre', $cadre);
                $insertC->execute();
            } else {
                $insertC = $this->connection->prepare("INSERT INTO `faccadre`(`cadreName`,`fac_id`) 
		 VALUES (:cadre,'$fac_id')");
                $insertC->bindParam(':cadre', $cadre);
                $insertC->execute();
            }


            //Check if exit
            $select = $this->connection->prepare("SELECT * FROM `faccadreyear` WHERE `cadre_Id`='$cadre' AND `fac_id`='$fac_id'");
            $select->execute();
            if ($select->rowCount() > 0) {
                //UPDATE RECORD
                $insertCY = $this->connection->prepare("UPDATE `faccadreyear` SET
			 `cadre_Id`=:cadre,
			 `number`=:number,
			 `year`=:year,
			 `fac_id`='$fac_id'
			 WHERE `cadre_Id`='$cadre' AND `fac_id`='$fac_id'");
                $insertCY->bindParam(':cadre', $cadre);
                $insertCY->bindParam(':number', $number);
                $insertCY->bindParam(':year', $year);
                $insertCY->execute();
            } else {
                //Insert Into Cadre Year
                $insertCY = $this->connection->prepare("INSERT INTO `faccadreyear`(`cadre_Id`, `number`, `year`, `fac_id`) 
		  VALUES (:cadre,:number,:year,'$fac_id')");
                $insertCY->bindParam(':cadre', $cadre);
                $insertCY->bindParam(':number', $number);
                $insertCY->bindParam(':year', $year);
                $insertCY->execute();
            }
            $this->connection->commit();
            return $insertCY;
        }
    }

    //Edit Facility/
    public function editFacility($facname, $region, $district, $status, $startdate, $enddate, $fac_id)
    {

        $insertF = $this->connection->prepare("UPDATE `facility`
		   SET
		   facname=:facname,
		   reg_id=:region,
		   dis_id=:district,
		   startdate=:startdate,
		   enddate=:enddate,
		   status=:status
		   
		   WHERE fac_id='$fac_id'");

        $insertF->bindParam(':facname', $facname);
        $insertF->bindParam(':region', $region);
        $insertF->bindParam(':district', $district);
        $insertF->bindParam(':startdate', $startdate);
        $insertF->bindParam(':enddate', $enddate);
        $insertF->bindParam(':status', $status);
        $insertF->execute();


        if ($status == 'Passive') {
            $update = $this->connection->prepare("UPDATE `faccadre` SET `status`='$status' WHERE `fac_id`='$fac_id'");
            $update->execute();
        } else {
        }

        return $insertF;
    }


    //Get Cadre by cadre id
    public function getCadreByCardeId($cadre_id)
    {
        $getC = $this->connection->prepare("SELECT * FROM faccadre,cadres 
		WHERE 
		faccadre.cadreName=cadres.cadreId AND
		faccadre.cadre_id='$cadre_id'");
        $getC->execute();
        return $getC;
    }


    //Get Cadre by cadre id
    public function getCadreByCardeIdApplication($cadre_id)
    {
        $getC = $this->connection->prepare("SELECT * FROM faccadre,cadres 
		WHERE 
		faccadre.cadreName=cadres.cadreId AND
		faccadre.cadre_id='$cadre_id'");
        $getC->execute();
        return $getC;
    }

    //Get Cadre by cadre id FROM cadre table
    public function getCadreByCardeIdFromCadreTable($cadre_id)
    {
        $getC = $this->connection->prepare("SELECT * FROM cadres 
		WHERE
		cadreId='$cadre_id'");
        $getC->execute();
        return $getC;
    }

    //Edit Constituency/
    public function editConstituency($consName, $region, $district, $userID, $cos_id)
    {
        $insertC = $this->connection->prepare("UPDATE `costituency` SET `name`=:consName,`reg_id`=:region, `dis_id`=:district,`userid`='$userID' WHERE cons_id='$cos_id'");
        $insertC->bindParam(':consName', $consName);
        $insertC->bindParam(':region', $region);
        $insertC->bindParam(':district', $district);
        $insertC->execute();
        return $insertC;
    }


    //Delete Facility/
    public function deleteFacility($fac_id)
    {
        $del = $this->connection->exec("DELETE FROM `facility` WHERE `fac_id`='$fac_id'");
        $delete = $this->connection->exec("DELETE FROM `faccadre` WHERE `fac_id`='$fac_id'");
        return $delete;
    }

    //Get cadre by fac_Id
    public function getCadreByFacId($fac_id)
    {
        $getC = $this->connection->prepare("SELECT * FROM `faccadre`,`cadres`
		WHERE 
		faccadre.cadreName=cadres.cadreId AND
		faccadre.fac_id='$fac_id'");
        $getC->execute();
        return $getC;
    }


    //Get cadre by Year and id
    public function getListNumbersPerCadre($cadreId, $fac_id)
    {
        $getC = $this->connection->prepare("SELECT * FROM `faccadreyear` WHERE `cadre_Id`='$cadreId' AND `fac_id`='$fac_id'");
        $getC->execute();
        return $getC;
    }

    //Get All Active cadre
    public function getAllActiveCadreBy($pmYear)
    {
        $getC = $this->connection->prepare("SELECT DISTINCT(faccadreyear.cadre_Id) AS cadre_Id FROM `faccadre`,`faccadreyear`
		WHERE 
		faccadre.cadreName=faccadreyear.cadre_Id AND
		faccadre.fac_id=faccadreyear.fac_id AND 
		faccadreyear.year='$pmYear'");
        $getC->execute();
        return $getC;
    }


    //Get Active cadre by fac_Id
    public function getActiveCadreByFacId($fac_id, $pmYear)
    {
        $getC = $this->connection->prepare("SELECT * FROM `faccadre`,`faccadreyear`
		WHERE 
		faccadre.cadreName=faccadreyear.cadre_Id AND
		faccadre.fac_id=faccadreyear.fac_id AND
		faccadre.fac_id='$fac_id' AND 
		faccadreyear.year='$pmYear'");
        $getC->execute();
        return $getC;
    }


    //Get All Active Cadre/
    public function getAllActiveFacility($pmYear)
    {
        $getC = $this->connection->prepare("SELECT DISTINCT(faccadreyear.fac_id) as fac_id,facility.category as category,facility.wp_id as wp_id FROM `facility`,faccadreyear
		WHERE facility.fac_id=faccadreyear.fac_id AND faccadreyear.year='$pmYear'");
        $getC->execute();
        return $getC;
    }
	
	//Get All Active Cadre budoya/
    public function getAllActiveFacilityBudoya($pmYear)
    {
        $getC = $this->connection->prepare("SELECT DISTINCT(faccadreyear.fac_id) as fac_id,facility.category as category,facility.wp_id as wp_id,number,used FROM `facility`,faccadreyear
		WHERE facility.fac_id=faccadreyear.fac_id AND faccadreyear.year='$pmYear'");
        $getC->execute();
        return $getC;
    }


    //Get All Active Cadre/
    public function getAllActiveFacilityByCadre($pmYear, $cadre_id)
    {
        $getC = $this->connection->prepare("SELECT DISTINCT(faccadreyear.fac_id) as fac_id,facility.category as category,facility.wp_id as wp_id FROM `facility`,faccadreyear
		WHERE facility.fac_id=faccadreyear.fac_id AND faccadreyear.year='$pmYear' AND faccadreyear.cadre_Id='$cadre_id' ");
        $getC->execute();
        return $getC;
    }


    //Function to get all national names
    public function getnationalList()
    {
        $query1 = $this->connection->prepare("SELECT DISTINCT(value),id FROM `country` ORDER BY `value` ASC");
        $query1->execute();
        return $query1;
    }

    //get Council List
    public function getCouncilList()
    {
        $query2 = $this->connection->prepare("SELECT DISTINCT(name),id FROM `council` ORDER BY `name` ASC");
        $query2->execute();
        return $query2;
    }

    //Get all Applicants
    public function getAllApplicants()
    {
        $getBusine = $this->connection->prepare("SELECT * FROM `applicants` ORDER BY `firstname` ASC");
        $getBusine->execute();
        return $getBusine;
    }

    public function acceptAgenciesApplicant($applicant_id, $allocation_id)
    {
        $allocation_status = 'Accepted';
        $accepted_rejected_by = $_SESSION['userid'];
        $accepted_rejected_date = date('Y-m-d H:m:s');

        $insertSt = $this->connection->prepare("UPDATE  `allocation` SET 
												allocation_status=:allocation_status,
												accepted_rejected_by=:accepted_rejected_by,
												accepted_rejected_date=:accepted_rejected_date
												WHERE allocate_id='$allocation_id' AND applicant_id='$applicant_id'");

        $insertSt->bindParam(':allocation_status', $allocation_status);
        $insertSt->bindParam(':accepted_rejected_by', $accepted_rejected_by);
        $insertSt->bindParam(':accepted_rejected_date', $accepted_rejected_date);
        $insertSt->execute();
        return $insertSt;
    }

    public function rejectAgenciesApplicant($rejection_reason, $allocation_id)
    {
        $allocation_status = 'Rejected';
        $accepted_rejected_by = $_SESSION['userid'];
        $accepted_rejected_date = date('Y-m-d H:m:s');

        $insertSt = $this->connection->prepare("UPDATE  `allocation` SET 
												allocation_status=:allocation_status,
												accepted_rejected_by=:accepted_rejected_by,
												rejection_reason = :rejection_reason,
												accepted_rejected_date=:accepted_rejected_date
												WHERE allocate_id='$allocation_id'");

        $insertSt->bindParam(':allocation_status', $allocation_status);
        $insertSt->bindParam(':rejection_reason', $rejection_reason);
        $insertSt->bindParam(':accepted_rejected_by', $accepted_rejected_by);
        $insertSt->bindParam(':accepted_rejected_date', $accepted_rejected_date);
        $insertSt->execute();
        return $insertSt;
    }

    //// start mwajiri ////

    public function getAllPostedApplicants($status = null)
    {
        $userID = $_SESSION['userid'];
        $selUser = $this->connection->prepare("SELECT `wp_category_id`, `wp_id` FROM `db_users` WHERE `user_id`='$userID'");
        $selUser->execute();
        $rowUser = $selUser->fetch();
        $category = $rowUser['wp_category_id'];
        $wp_id = $rowUser['wp_id'];
        if ($status != '') {
            $whereStatus = " AND allocation.allocation_status='$status' ";
        } else {
            $whereStatus = ' ';
        }
        $getBusine = $this->connection->prepare("SELECT * FROM allocation,applicants 
									WHERE applicants.id=allocation.applicant_id $whereStatus AND allocation.category='$category' AND allocation.wp_id='$wp_id' ORDER BY `firstname` ASC");
        $getBusine->execute();
        return $getBusine;
    }

    //// end mwajiri ////

    //Get all Agencies Applicants
    public function getAllAgenciesApplicants()
    {
        $agencUserID = $_SESSION['userid'];
        $getBusine = $this->connection->prepare("SELECT * FROM agencies_facility,facility,allocation,applicants 
									WHERE agencies_facility.user_id='$agencUserID' AND facility.fac_id=agencies_facility.facility_id 
									AND allocation.category = facility.category AND allocation.wp_id = facility.wp_id 
									AND  applicants.id=allocation.applicant_id AND allocation.allocation_status='Pending' ORDER BY `firstname` ASC");
        $getBusine->execute();
        return $getBusine;
    }

    //Get all Accepted Agencies Applicants
    public function getAcceptedAgenciesApplicants()
    {
        $agencUserID = $_SESSION['userid'];
        $getBusine = $this->connection->prepare("SELECT * FROM agencies_facility,facility,allocation,applicants 
									WHERE agencies_facility.user_id='$agencUserID' AND facility.fac_id=agencies_facility.facility_id 
									AND allocation.category = facility.category AND allocation.wp_id = facility.wp_id 
									AND  applicants.id=allocation.applicant_id AND allocation.allocation_status='Accepted' ORDER BY `firstname` ASC");
        $getBusine->execute();
        return $getBusine;
    }

    //Get all Rejected Agencies Applicants
    public function getRejectedAgenciesApplicants()
    {
        $agencUserID = $_SESSION['userid'];
        $getBusine = $this->connection->prepare("SELECT * FROM agencies_facility,facility,allocation,applicants 
									WHERE agencies_facility.user_id='$agencUserID' AND facility.fac_id=agencies_facility.facility_id 
									AND allocation.category = facility.category AND allocation.wp_id = facility.wp_id 
									AND  applicants.id=allocation.applicant_id AND allocation.allocation_status='Rejected' ORDER BY `firstname` ASC");
        $getBusine->execute();
        return $getBusine;
    }


    //Function to insert data applicants table
    public function insertDataIntoapplicantsTable($firstname2, $middle2, $lastname2, $dob, $gender, $maritalStatus, $national, $nida, $cadreType, $councilType, $councilRegistrationID, $employed, $checkNumber, $country, $disiability, $disiability_type, $other_disiability, $address1, $phone, $email, $userlevel, $username, $password)
    {

        $inertContact = $this->connection->prepare("insert into applicants(`firstname`, `middlename`, `lastname`,`gender`,`dob`, `maritalStatus`,`nationality`,nida,cadreType,councilTypeID,councilRegistrationID,`employed`,`checkNumber`,`country`,`disiability`,`disiability_type`, `other_disiability`, `address`, `phone`,`email`,`regdate`)
         values(:firstname2, :middle2, :lastname2, :gender, :dob,:maritalStatus, :national, :nida,:cadreType,:councilType,:councilRegistrationID,:employed,:checkNumber,:country,:disiability,:disiability_type,:other_disiability,:address1, :phone, :email1,CURDATE())");
        $inertContact->bindParam(':firstname2', $firstname2);
        $inertContact->bindParam(':middle2', $middle2);
        $inertContact->bindParam(':lastname2', $lastname2);
        $inertContact->bindParam(':gender', $gender);
        $inertContact->bindParam(':dob', $dob);
        $inertContact->bindParam(':maritalStatus', $maritalStatus);
        $inertContact->bindParam(':national', $national);
        $inertContact->bindParam(':nida', $nida);
        $inertContact->bindParam(':cadreType', $cadreType);
        $inertContact->bindParam(':councilType', $councilType);
        $inertContact->bindParam(':councilRegistrationID', $councilRegistrationID);
        $inertContact->bindParam(':employed', $employed);
        $inertContact->bindParam(':checkNumber', $checkNumber);
        $inertContact->bindParam(':country', $country);
        $inertContact->bindParam(':disiability', $disiability);
        $inertContact->bindParam(':disiability_type', $disiability_type);
        $inertContact->bindParam(':other_disiability', $other_disiability);
        $inertContact->bindParam(':address1', $address1);
        $inertContact->bindParam(':phone', $phone);
        $inertContact->bindParam(':email1', $email);
        $inertContact->execute();

        $applicant_id = $this->connection->lastInsertId();

        //$pwd= password_hash($password,PASSWORD_BCRYPT);
        //$pwd =PwdHash($password);

        //$pwd = PwdHash($password, PASSWORD_DEFAULT);

        $pwd = md5($password);

        $insetUser = $this->connection->prepare("INSERT INTO `db_users`(`email`, `username`, `password`,`level`, `applicant_id`,`regDate`) 
		 VALUES (:email,:username,:password,:level,'$applicant_id',CURDATE())");
        $insetUser->bindParam(':email', $email);
        $insetUser->bindParam(':username', $username);
        $insetUser->bindParam(':password', $pwd);
        $insetUser->bindParam(':level', $userlevel);
        $insetUser->execute();

        return $insetUser;
    }

    //Get Applicants by Id
    public function getApplicantsById($applicant_id)
    {
        $getA = $this->connection->prepare("SELECT * FROM `applicants`,`country`
		 
		 WHERE 
		 applicants.nationality=country.id AND
		 
		 applicants.id='$applicant_id'");
        $getA->execute();
        return $getA;
    }

    public function getBarazaById($baraza_id)
    {
        $getA = $this->connection->prepare("SELECT * FROM council WHERE id='$baraza_id'");
        $getA->execute();
        return $getA;
    }

    //Get Education by edu_Id
    public function getEducationById($edu_id)
    {
        $getA = $this->connection->prepare("SELECT * FROM `education` WHERE `edu_id`='$edu_id'");
        $getA->execute();
        return $getA;
    }

    //Check if education details is already added
    public function checkBasicEducationIfExit($eduLevel, $school, $indexNo, $applicant_id)
    {
        $select = $this->connection->prepare("SELECT * FROM `education` 
		 WHERE 
		 `level`='$eduLevel' AND 
		 `school`='$school' AND 
		 `indexNo`='$indexNo' AND 
		 `applicant_id`='$applicant_id'");
        $select->execute();
        return $select;
    }

    //Check if level for applicant exit
    public function checkIfLevelExit($applicant_id, $checkALevel = null)
    {
        if ($checkALevel == 'A-Level') {
            $where = " level='" . $checkALevel . "' and ";
        } else {
            $where = "";
        }

        $select = $this->connection->prepare("SELECT * FROM `education` WHERE $where `applicant_id`='$applicant_id'");

        $select->execute();
        return $select;
    }
    //SELECT `extension`, `size`, `type`, `ubunge_id`, `picha_id` FROM `picha` WHERE 1
	public function seachPicha($bunge_id)
    {
		$insertSt = $this->connection->prepare("SELECT `extension`, `size`, `type`, `ubunge_id`, 
		`picha_id` FROM `picha` WHERE ubunge_id='$bunge_id'");
		 $insertSt->execute();
		 
		 return $insertSt;
	}
	public function addPicha($ext, $size, $type, $bunge_id)
    {
		$insertSt = $this->connection->prepare("INSERT INTO `picha`(`extension`, `size`, `type`, `ubunge_id`) 
         VALUES ('$ext','$size', '$type','$bunge_id')");
		 $insertSt->execute();
		 if($insertSt)
		 {
		 
		    $last_id = $this->connection->lastInsertId();

            $name1 = "ccm".$last_id;
            $name2 = $name1.".".$ext;

            move_uploaded_file($_FILES['certificate']['tmp_name'], "../documents/" . $name2);

            return true;
		 }
		 return false;
	}
    //Add Education Details
    public function addEducation($eduLevel, $school, $indexNo, $year, $division, $merit, $applicant_id, $docuType, $extension, $docname)
    {
        $insertSt = $this->connection->prepare("INSERT INTO `education`( `level`, `school`,`indexNo`,`year`, `division`,`merit`, `applicant_id`) 
		
         VALUES (:eduLevel,:school,:indexNo,:year,:division,:merit,:applicant_id)");
        $insertSt->bindParam(':eduLevel', $eduLevel);
        $insertSt->bindParam(':school', $school);
        $insertSt->bindParam(':indexNo', $indexNo);
        $insertSt->bindParam(':year', $year);
        $insertSt->bindParam(':division', $division);
        $insertSt->bindParam(':merit', $merit);
        $insertSt->bindParam(':applicant_id', $applicant_id);
        $insertSt->execute();
        //  return $insertSt;
        if ($insertSt) {
            $insert = $this->connection->prepare("insert into document_detail(applicant_id, document_id, extension, date) 
				values (:id, :docu, :extensional, CURDATE())");
            $insert->bindParam(':id', $applicant_id);
            $insert->bindParam(':docu', $docuType);
            $insert->bindParam(':extensional', $extension);
            $insert->execute();

            $last_id = $this->connection->lastInsertId();

            $name1 = $last_id . 'doc';
            $name2 = $last_id . 'doc' . "." . $extension;

            $update = $this->connection->prepare("UPDATE `document_detail` SET `docName`='$name1' WHERE `id`='$last_id'");
            $update->execute();

            move_uploaded_file($_FILES['certificate']['tmp_name'], "../documents/" . $name2);

            return true;
        } else {
            return false;
        }
    }

    //Edit Education Details
    public function editEducation($eduLevel, $school, $indexNo, $year, $division, $merit, $edu_id, $applicant_id, $document_id = null, $docName = null, $extension = null)
    {

        if (isset($document_id)) {
            $query = $this->checkIfFileExist($document_id, $applicant_id);
            $data = $query->fetch();
            $this->deleteDocumentDetails($data['id']);

            $insertTranscript = $this->connection->prepare("insert into document_detail(applicant_id, document_id, extension, date) 
			values (:id, :docu, :extensional, CURDATE())");
            $insertTranscript->bindParam(':id', $applicant_id);
            $insertTranscript->bindParam(':docu', $document_id);
            $insertTranscript->bindParam(':extensional', $extension);
            $insertTranscript->execute();

            $last_id_transcript = $this->connection->lastInsertId();

            $name3 = $last_id_transcript . 'education';
            $name4 = $last_id_transcript . 'education' . "." . $extension;

            $update = $this->connection->prepare("UPDATE `document_detail` SET `docName`='$name3' WHERE `id`='$last_id_transcript'");
            $update->execute();

            move_uploaded_file($_FILES['certificate']['tmp_name'], "../documents/" . $name4);
        }

        $insertSt = $this->connection->prepare("UPDATE  `education` SET 
		 level=:eduLevel,
		 school=:school,
		 indexNo=:indexNo,
		 year=:year,
		 division=:division,
         merit=:merit
		 WHERE edu_id='$edu_id'");

        $insertSt->bindParam(':eduLevel', $eduLevel);
        $insertSt->bindParam(':school', $school);
        $insertSt->bindParam(':indexNo', $indexNo);
        $insertSt->bindParam(':year', $year);
        $insertSt->bindParam(':division', $division);
        $insertSt->bindParam(':merit', $merit);
        $insertSt->execute();
        return $insertSt;
    }

    //Delete Education details
    public function deleteEducation($edu_id, $doc_id = null, $applicant_id)
    {
        if (isset($doc_id)) {
            $query = $this->checkIfFileExist($doc_id, $applicant_id);
            $data = $query->fetch();
            $document_id = $data['id'];
            $this->deleteDocumentDetails($document_id);
        }
        $delete = $this->connection->exec("DELETE FROM `education` WHERE `edu_id`='$edu_id'");

        return $delete;
    }


    //Get Education Details by applicantId
    public function getEducationByAppId($applicant_id)
    {
        $getA = $this->connection->prepare("SELECT * FROM `education` WHERE `applicant_id`='$applicant_id'");
        $getA->execute();
        return $getA;
    }

    //Get Council Registration ID
    public function getCouncilRegID($applicant_id)
    {
        $getCID = $this->connection->prepare("SELECT councilRegistrationID FROM `applicants` WHERE `id`='$applicant_id'");
        $getCID->execute();
        return $getCID;
    }

    //Function to get courses when education level is selected
    public function getCourseEducation($q)
    {
        $sql1 = $this->connection->prepare("SELECT * FROM `cours_name` WHERE `award`='$q'");
        $sql1->execute();
        return $sql1;
    }

    //Function to get list of institution
    public function getInstitution()
    {
        $query = $this->connection->prepare("SELECT * FROM `institutions` ORDER BY InstitutionName ASC");
        $query->execute();
        return $query;
    }

    public function getInstitutionByID($id)
    {
        $query = $this->connection->prepare("SELECT * FROM `institutions` WHERE `id`='$id'");
        $query->execute();
        return $query;
    }


    public function insertInstitutionProgram($id, $values)
    {
        $sql1 = $this->connection->prepare("DELETE FROM `institution_course` WHERE `inst_id`='$id'");
        $sql1->execute();

        foreach ($values as $v) {
            $insert = $this->connection->prepare("insert into institution_course(inst_id, course_id) values (:inst_id, :course_id)");
            $insert->bindParam(':inst_id', $id);
            $insert->bindParam(':course_id', $v);
            $insert->execute();
        }

        return true;
    }

    public function addInstitution($name, $type)
    {
        $insert = $this->connection->prepare("insert into institutions(InstitutionName, type) values (:name, :type)");
        $insert->bindParam(':name', $name);
        $insert->bindParam(':type', $type);
        $insert->execute();

        return $insert;
    }


    public function getInstitutionName($id)
    {
        $sql1 = $this->connection->prepare("SELECT * FROM `institutions` WHERE `id`='$id'");
        $sql1->execute();
        return $sql1;
    }

    public function getInstitutionProgram($id)
    {
        $query = $this->connection->prepare("SELECT * FROM `institution_course`, cours_name WHERE institution_course.course_id=cours_name.id AND `inst_id`='$id'");
        $query->execute();
        return $query;
    }

    public function editInstitution($id, $name, $type)
    {
        $insertSt = $this->connection->prepare("UPDATE  `institutions` SET InstitutionName=:name, type=:type WHERE id='$id'");
        $insertSt->bindParam(':name', $name);
        $insertSt->bindParam(':type', $type);
        $insertSt->execute();
        return $insertSt;
    }

    public function deleteInstitution($id)
    {
        $sql1 = $this->connection->prepare("DELETE FROM `institutions` WHERE `id`='$id'");
        $sql1->execute();
        return $sql1;
    }

    public function getCourses()
    {
        $query = $this->connection->prepare("SELECT * FROM `cours_name` ORDER BY name ASC");
        $query->execute();
        return $query;
    }

    public function addCourse($name, $abb, $type)
    {
        $insert = $this->connection->prepare("insert into cours_name(name, abbreviation,from_server) values (:name,:abbreviation, :type)");
        $insert->bindParam(':name', $name);
        $insert->bindParam(':abbreviation', $abb);
        $insert->bindParam(':type', $type);
        $insert->execute();

        return $insert;
    }

    public function editCourse($id, $name, $abb, $type)
    {
        $insert = $this->connection->prepare("UPDATE  `cours_name` SET 
		 name=:name,
		 abbreviation=:abbreviation,
		 from_server=:from_server
		 WHERE id='$id'");
        $insert->bindParam(':name', $name);
        $insert->bindParam(':abbreviation', $abb);
        $insert->bindParam(':from_server', $type);
        $insert->execute();

        return $insert;
    }

    public function deleteCourse($id)
    {
        $sql1 = $this->connection->prepare("DELETE FROM `cours_name` WHERE `id`='$id'");
        $sql1->execute();
        return $sql1;
    }


    //Add Professional Details
    public function addProfessional($level, $location, $college, $progName, $end, $applicant_id, $doctypeCertificateID, $extensionCertificate, $docTypeIDTranscript, $transcriptExtension, $current, $verificationLetter = null, $docTypeVerID = null)
    {

        $insert = $this->connection->prepare("insert into document_detail(applicant_id, document_id, extension, date) 
			values (:id, :docu, :extensional, CURDATE())");
        $insert->bindParam(':id', $applicant_id);
        $insert->bindParam(':docu', $doctypeCertificateID);
        $insert->bindParam(':extensional', $extensionCertificate);
        $insert->execute();

        $last_id_certificate = $this->connection->lastInsertId();

        $name1 = $last_id_certificate . 'doc';
        $name2 = $last_id_certificate . 'doc' . "." . $extensionCertificate;

        $update = $this->connection->prepare("UPDATE `document_detail` SET `docName`='$name1' WHERE `id`='$last_id_certificate'");
        $update->execute();

        $insertTranscript = $this->connection->prepare("insert into document_detail(applicant_id, document_id, extension, date) 
			values (:id, :docu, :extensional, CURDATE())");
        $insertTranscript->bindParam(':id', $applicant_id);
        $insertTranscript->bindParam(':docu', $docTypeIDTranscript);
        $insertTranscript->bindParam(':extensional', $transcriptExtension);
        $insertTranscript->execute();

        $last_id_transcript = $this->connection->lastInsertId();

        $name3 = $last_id_transcript . 'trans';
        $name4 = $last_id_transcript . 'trans' . "." . $transcriptExtension;

        $update = $this->connection->prepare("UPDATE `document_detail` SET `docName`='$name3' WHERE `id`='$last_id_transcript'");
        $update->execute();

        move_uploaded_file($_FILES['certificate']['tmp_name'], "../documents/" . $name2);
        move_uploaded_file($_FILES['transcript']['tmp_name'], "../documents/" . $name4);

        if ($location == 'Tanzania, United Rep') {

            $insertSt = $this->connection->prepare("INSERT INTO `proffesional`(`level`, `location`, `college`, `programme_id`, `year`,`status`,`applicant_id`,`document_type_id`,`trans_doc`,`is_current`) 
		                VALUES (:level,:location,:college,:progName,:end,'Yes',:applicant_id,:document_type_id,:trans_doc,:is_current)");
            $insertSt->bindParam(':level', $level);
            $insertSt->bindParam(':location', $location);
            $insertSt->bindParam(':college', $college);
            $insertSt->bindParam(':progName', $progName);
            $insertSt->bindParam(':end', $end);
            $insertSt->bindParam(':applicant_id', $applicant_id);
            $insertSt->bindParam(':document_type_id', $last_id_certificate);
            $insertSt->bindParam(':trans_doc', $last_id_transcript);
            $insertSt->bindParam(':is_current', $current);
            $insertSt->execute();
        } else {
            $ext = 'pdf';
            $verificationLetterInsert = $this->connection->prepare("insert into document_detail(applicant_id, document_id, extension, date) 
			values (:id, :docu, :extensional, CURDATE())");
            $verificationLetterInsert->bindParam(':id', $applicant_id);
            $verificationLetterInsert->bindParam(':docu', $docTypeVerID);
            $verificationLetterInsert->bindParam(':extensional', $verificationLetter);
            $verificationLetterInsert->execute();

            $verificationLetter_id = $this->connection->lastInsertId();

            $name3 = $verificationLetter_id . 'verification_letter';
            $name4 = $verificationLetter_id . 'verification_letter' . "." . $verificationLetter;

            $update = $this->connection->prepare("UPDATE `document_detail` SET `docName`='$name3' WHERE `id`='$verificationLetter_id'");
            $update->execute();

            move_uploaded_file($_FILES['verification_letter']['tmp_name'], "../documents/" . $name4);


            $insertSt = $this->connection->prepare("INSERT INTO `proffesional`(`level`, `location`, `college`, `programme_id`, `year`,`status`,`applicant_id`,`document_type_id`,`trans_doc`,`is_current`,`verification_letter`) 
		                VALUES (:level,:location,:college,:progName,:end,'No',:applicant_id,:document_type_id,:trans_doc,:is_current,:verification_letter)");
            $insertSt->bindParam(':level', $level);
            $insertSt->bindParam(':location', $location);
            $insertSt->bindParam(':college', $college);
            $insertSt->bindParam(':progName', $progName);
            $insertSt->bindParam(':end', $end);
            $insertSt->bindParam(':applicant_id', $applicant_id);
            $insertSt->bindParam(':document_type_id', $last_id_certificate);
            $insertSt->bindParam(':trans_doc', $last_id_transcript);
            $insertSt->bindParam(':is_current', $current);
            $insertSt->bindParam(':verification_letter', $verificationLetter_id);
            $insertSt->execute();
        }
        return $insertSt;
    }


    //Edit Professional Details
    public function editProfessional($prof_id, $level, $location, $college, $progName, $end, $applicant_id, $doctypeCertificateID = null, $extensionCertificate = null, $docTypeIDTranscript = null, $transcriptExtension = null, $current, $verificationLetter = null, $docTypeVerID = null)
    {

        $query = $this->getProfessionalByProfId($prof_id);
        $proff = $query->fetch();
        #new certificate is uploaded
        if (!empty($doctypeCertificateID) && isset($doctypeCertificateID)) {

            $this->deleteDocumentDetails($proff['document_type_id']);
            $insert = $this->connection->prepare("insert into document_detail(applicant_id, document_id, extension, date) 
			values (:id, :docu, :extensional, CURDATE())");
            $insert->bindParam(':id', $applicant_id);
            $insert->bindParam(':docu', $doctypeCertificateID);
            $insert->bindParam(':extensional', $extensionCertificate);
            $insert->execute();
            $last_id_certificate = $this->connection->lastInsertId();
            $name1 = $last_id_certificate . 'doc';
            $name2 = $last_id_certificate . 'doc' . "." . $extensionCertificate;
            $update = $this->connection->prepare("UPDATE `document_detail` SET `docName`='$name1' WHERE `id`='$last_id_certificate'");
            $update->execute();
            move_uploaded_file($_FILES['certificate']['tmp_name'], "../documents/" . $name2);
        } else {
            $last_id_certificate = $proff['document_type_id'];
        }


        if (!empty($docTypeIDTranscript) && isset($docTypeIDTranscript)) {
            $this->deleteDocumentDetails($proff['trans_doc']);
            $insertTranscript = $this->connection->prepare("insert into document_detail(applicant_id, document_id, extension, date) 
			values (:id, :docu, :extensional, CURDATE())");
            $insertTranscript->bindParam(':id', $applicant_id);
            $insertTranscript->bindParam(':docu', $docTypeIDTranscript);
            $insertTranscript->bindParam(':extensional', $transcriptExtension);
            $insertTranscript->execute();

            $last_id_transcript = $this->connection->lastInsertId();

            $name3 = $last_id_transcript . 'trans';
            $name4 = $last_id_transcript . 'trans' . "." . $transcriptExtension;

            $update = $this->connection->prepare("UPDATE `document_detail` SET `docName`='$name3' WHERE `id`='$last_id_transcript'");
            $update->execute();

            move_uploaded_file($_FILES['transcript']['tmp_name'], "../documents/" . $name4);
        } else {
            $last_id_transcript = $proff['trans_doc'];
        }

        if ($location == 'Tanzania, United Rep') {
            $insertSt = $this->connection->prepare("UPDATE proffesional 
		   SET 
		   level=:level,
		   location=:location,
		   college=:college,
		   programme_id=:progName,
		   year=:end,
		   applicant_id=:applicant_id,
		   document_type_id=:document_type_id,
		   trans_doc=:trans_doc,
		   is_current=:is_current
		   WHERE
		   prof_id='$prof_id'");

            $insertSt->bindParam(':level', $level);
            $insertSt->bindParam(':location', $location);
            $insertSt->bindParam(':college', $college);
            $insertSt->bindParam(':progName', $progName);
            $insertSt->bindParam(':end', $end);
            $insertSt->bindParam(':applicant_id', $applicant_id);
            $insertSt->bindParam(':document_type_id', $last_id_certificate);
            $insertSt->bindParam(':trans_doc', $last_id_transcript);
            $insertSt->bindParam(':is_current', $current);
            $insertSt->execute();
        } else {
            if (!empty($verificationLetter_id) && isset($verificationLetter_id)) {
                $this->deleteDocumentDetails($proff['verification_letter']);
                $verificationLetterInsert = $this->connection->prepare("insert into document_detail(applicant_id, document_id, extension, date) 
			values (:id, :docu, :extensional, CURDATE())");
                $verificationLetterInsert->bindParam(':id', $applicant_id);
                $verificationLetterInsert->bindParam(':docu', $docTypeVerID);
                $verificationLetterInsert->bindParam(':extensional', $verificationLetter);
                $verificationLetterInsert->execute();

                $verificationLetter_id = $this->connection->lastInsertId();

                $name3 = $verificationLetter_id . 'verification_letter';
                $name4 = $verificationLetter_id . 'verification_letter' . "." . $verificationLetter;

                $update = $this->connection->prepare("UPDATE `document_detail` SET `docName`='$name3' WHERE `id`='$verificationLetter_id'");
                $update->execute();

                move_uploaded_file($_FILES['verification_letter']['tmp_name'], "../documents/" . $name4);
            } else {
                $verificationLetter_id = $proff['verification_letter'];
            }

            $insertSt = $this->connection->prepare("UPDATE proffesional 
		   SET 
		   level=:level,
		   location=:location,
		   college=:college,
		   programme_id=:progName,
		   year=:end,
		   applicant_id=:applicant_id,
		   document_type_id=:document_type_id,
		   trans_doc=:trans_doc,
		   is_current=:is_current,
		   verification_letter=:verification_letter
		   WHERE
           prof_id='$prof_id'");
            $insertSt->bindParam(':level', $level);
            $insertSt->bindParam(':location', $location);
            $insertSt->bindParam(':college', $college);
            $insertSt->bindParam(':progName', $progName);
            $insertSt->bindParam(':end', $end);
            $insertSt->bindParam(':applicant_id', $applicant_id);
            $insertSt->bindParam(':document_type_id', $last_id_certificate);
            $insertSt->bindParam(':trans_doc', $last_id_transcript);
            $insertSt->bindParam(':is_current', $current);
            $insertSt->bindParam(':verification_letter', $verificationLetter_id);
            $insertSt->execute();
        }
        return $insertSt;
    }

    //Delete Professional details
    public function deleteProfessional($prof_id, $applicant_id = null)
    {
        if (isset($applicant_id)) {
            $stmt = $this->connection->prepare("SELECT * FROM `proffesional` WHERE `prof_id`='$prof_id'");
            $query = $stmt->execute();
            if ($query) {
                while ($row = $stmt->fetch()) {
                    $document_type_id = $row['document_type_id'];
                    $trans_doc = $row['trans_doc'];
                    $verification_letter = $row['verification_letter'];
                    $this->deleteDocumentDetails($document_type_id);
                    $this->deleteDocumentDetails($trans_doc);
                    $this->deleteDocumentDetails($verification_letter);
                }
            }
        }

        $delete = $this->connection->exec("DELETE FROM `proffesional` WHERE `prof_id`='$prof_id'");
        return $delete;
    }


    //Update Professional Status
    public function updateProfessionalStatus($prof_id)
    {
        $update = $this->connection->prepare("UPDATE  `proffesional` 
		 SET status ='Yes' 
		 WHERE 
		`prof_id`='$prof_id'");
        $update->execute();
        return $update;
    }


    //Get Proffesional Details by applicantId
    public function getProfessionalByAppId($applicant_id, $is_current = null)
    {
        if ($is_current != '') {
            $where = " is_current='Yes' AND ";
        } else {
            $where = '';
        }
        $getA = $this->connection->prepare("SELECT * FROM `proffesional` WHERE $where `applicant_id`='$applicant_id'");
        $getA->execute();
        //        die(var_dump($getA));
        return $getA;
    }


    //Get Proffesional Details by prof_id
    public function getProfessionalByProfId($prof_id)
    {
        $getA = $this->connection->prepare("SELECT * FROM `proffesional` WHERE `prof_id`='$prof_id'");
        $getA->execute();
        return $getA;
    }

    //Function to get course name if course_id=$courseid
    public function getCourseName($course_id)
    {
        $query4 = $this->connection->prepare("SELECT * FROM `cours_name` WHERE `id`='$course_id'");
        $query4->execute();
        return $query4;
    }


    //Add Experience Details
    public function AddExperience($employer, $position, $employType, $start, $end, $applicant_id)
    {
        $insertSt = $this->connection->prepare("INSERT INTO `experience`(`employer`, `duty`, `employType`, `start`, `end`, `applicant_id`) 
		
         VALUES (:employer,:position,:employType,:start,:end,:applicant_id)");
        $insertSt->bindParam(':employer', $employer);
        $insertSt->bindParam(':position', $position);
        $insertSt->bindParam(':employType', $employType);
        $insertSt->bindParam(':start', $start);
        $insertSt->bindParam(':end', $end);
        $insertSt->bindParam(':applicant_id', $applicant_id);
        $insertSt->execute();
        return $insertSt;
    }


    //EDIT experience
    public function editExperience($employer, $position, $employType, $start, $end, $applicant_id, $exp_id)
    {
        //Delete existing value
        $delete = $this->connection->exec("DELETE FROM experience WHERE exp_id='$exp_id'");

        $insertSt = $this->connection->prepare("INSERT INTO `experience`(`exp_id`,`employer`, `duty`, `employType`, `start`, `end`, `applicant_id`) 
		
         VALUES ('$exp_id',:employer,:position,:employType,:start,:end,:applicant_id)");
        $insertSt->bindParam(':employer', $employer);
        $insertSt->bindParam(':position', $position);
        $insertSt->bindParam(':employType', $employType);
        $insertSt->bindParam(':start', $start);
        $insertSt->bindParam(':end', $end);
        $insertSt->bindParam(':applicant_id', $applicant_id);
        $insertSt->execute();
        return $insertSt;
    }


    //Get Experience Details by applicantId
    public function getExperienceByAppId($applicant_id)
    {
        $getA = $this->connection->prepare("SELECT * FROM `experience` WHERE `applicant_id`='$applicant_id'");
        $getA->execute();
        return $getA;
    }

    //Get Experience Details by exp_id
    public function getExperienceByExId($exp_id)
    {
        $getE = $this->connection->prepare("SELECT * FROM `experience` WHERE `exp_id`='$exp_id'");
        $getE->execute();
        return $getE;
    }


    //Delete Experience details
    public function deleteExperience($exp_id)
    {
        $delete = $this->connection->exec("DELETE FROM `experience` WHERE `exp_id`='$exp_id'");
        return $delete;
    }


    //Add Registration Details
    public function AddRegistration($council, $regType, $regNo, $regYear, $applicant_id)
    {
        $insertSt = $this->connection->prepare("INSERT INTO `registration`(`council`, `regType`, `regNo`, `regYear`, `applicant_id`) 
		
         VALUES (:council,:regType,:regNo,:regYear,:applicant_id)");
        $insertSt->bindParam(':council', $council);
        $insertSt->bindParam(':regType', $regType);
        $insertSt->bindParam(':regNo', $regNo);
        $insertSt->bindParam(':regYear', $regYear);
        $insertSt->bindParam(':applicant_id', $applicant_id);
        $insertSt->execute();
        return $insertSt;
    }


    //Get Registration Details by applicantId
    public function getRegistrationByAppId($applicant_id)
    {
        $getA = $this->connection->prepare("SELECT * FROM `registration` WHERE `applicant_id`='$applicant_id'");
        $getA->execute();
        return $getA;
    }

    //Delete Registration details
    public function deleteRegistration($reg_id)
    {
        $delete = $this->connection->exec("DELETE FROM `registration` WHERE `reg_id`='$reg_id'");
        return $delete;
    }


    //Function to get document types
    public function selectDocumentTypes()
    {
        $querry = $this->connection->prepare("SELECT DocumentID, DocumentType FROM documenttypes ORDER BY DocumentType ASC");
        $querry->execute();
        return $querry;
    }

    //get doc type
    public function getDocType($attachmentType)
    {
        $querry = $this->connection->prepare("SELECT DocumentID FROM documenttypes WHERE attachmentFor='$attachmentType'");
        $querry->execute();
        return $querry;
    }

    //Function to check if file exist
    public function checkIfFileExist($docuType, $applicant_id)
    {
        $query = $this->connection->prepare("SELECT * FROM `document_detail` 
                              WHERE 
							  `applicant_id`='$applicant_id' AND `document_id`='$docuType'");
        $query->execute();
        return $query;
    }

    //Function to insert file
    public function updateFile($docuType, $applicant_id, $extensional, $name)
    {
        $update0 = $this->connection->prepare("select `id` from document_detail WHERE `applicant_id`='$applicant_id' AND `document_id`='$docuType'");
        $id = $update0->execute();
        $row = $update0->fetch();
        $last_id = $row['id'];
        $name1 = $last_id . 'doc_updated';
        $name2 = $last_id . 'doc_updated' . "." . $extensional;

        $update = $this->connection->prepare("UPDATE `document_detail` SET `docName`='$name1',`extension`='$extensional' WHERE `applicant_id`='$applicant_id' AND `document_id`='$docuType'");
        $update->execute();

        move_uploaded_file($_FILES['photo']['tmp_name'], "../documents/" . $name2);

        return $update;
    }

    //Function to insert file
    public function insertFile($docuType, $applicant_id, $extensional, $name = null)
    {

        // var_dump($_POST);
        // echo "inside the function";

        $insert = $this->connection->prepare("insert into document_detail(applicant_id, docName,document_id, extension, date) 
                         values (:id,:docName, :docu, :extensional, CURDATE())");
        $insert->bindParam(':id', $applicant_id);
        $insert->bindParam(':docName', $name);
        $insert->bindParam(':docu', $docuType);
        $insert->bindParam(':extensional', $extensional);
        $insert->execute();

        $last_id = $this->connection->lastInsertId();

        $name1 = $last_id . 'doc';
        $name2 = $last_id . 'doc' . "." . $extensional;

        $update = $this->connection->prepare("UPDATE `document_detail` SET `docName`='$name1' WHERE `id`='$last_id'");
        $update->execute();

        move_uploaded_file($_FILES['photo']['tmp_name'], "../documents/" . $name2);

        // var_dump($_POST);
        // die();

        return $update;
    }

    //Function to get list of documents
    public function getDocuments($applicant_id)
    {
        $seDoc = $this->connection->prepare("SELECT * FROM `document_detail` WHERE `applicant_id`='$applicant_id'");
        $seDoc->execute();
        return $seDoc;
    }

    //Function to get list of documents when docId=$doc_name
    public function getDocumentName($doc_name)
    {
        $quD = $this->connection->prepare("SELECT `DocumentType` FROM `documenttypes` WHERE `DocumentID`='$doc_name'");
        $quD->execute();
        return $quD;
    }

    //Function to get list of documents Name and Extension when docuID=$docuID;
    public function getDocumentNameExtension($docuID)
    {
        $seDoc1 = $this->connection->prepare("SELECT * FROM `document_detail` WHERE `id`='$docuID'");
        $seDoc1->execute();
        return $seDoc1;
    }

    //Function to delete Docuement
    public function deleteDocumentDetails($docuID)
    {

        //Get document_detail
        $seDoc1 = $this->connection->prepare("SELECT * FROM `document_detail` WHERE `id`='$docuID'");
        $seDoc1->execute();
        $rD = $seDoc1->fetch();
        $dName = $rD['docName'];
        $ext = $rD['extension'];

        if (isset($dName)) {
            //Delete file from folder
            unlink("../documents/" . $dName . "." . $ext);
        }
        //Delete from table
        $de = $this->connection->exec("DELETE FROM `document_detail` WHERE `id`='$docuID'");

        return $de;
    }
    public function deleteDocu($docuID)
    {

        //Get document_detail
        $seDoc1 = $this->connection->prepare("SELECT `extension`, `size`, `type`,
		`ubunge_id`, `picha_id` FROM `picha` WHERE `picha_id`='$docuID'");
        $seDoc1->execute();
        $rD = $seDoc1->fetch();
        $de="";
        $ext = $rD['extension'];

        if (isset($ext)) {
            //Delete file from folder
			$filepath="../documents/ccm" .$docuID. ".".$ext;
			if(file_exists($filepath))
			{
            unlink($filepath);
			$de = $this->connection->exec("DELETE FROM `picha` WHERE `picha_id`='$docuID'");
			}
        }
        //Delete from table
        

        return $de;
    }
	
	public function ViewDocu($docuID)
    {

        //Get document_detail
        $seDoc1 = $this->connection->prepare("SELECT `extension`, `size`, `type`,
		`ubunge_id`, `picha_id` FROM `picha` WHERE `picha_id`='$docuID'");
        $seDoc1->execute();
        $rD = $seDoc1->fetch();
        $de="";
        $ext = $rD['extension'];
            //Delete file from folder
			$filepath="../documents/ccm".$docuID.".".$ext;
        if (isset($ext)) {
            
			if(file_exists($filepath))
			{
			$filepath="documents/ccm".$docuID.".".$ext;
			$de = $filepath;
			}
        }
        //Delete from table
        return $de;
    }
    //Add Application Details
    public function addApplication($fac1, $cat1, $cadre1, $fac2, $cat2, $cadre2, $fac3, $cat3, $cadre3, $applicant_id, $wp_id1, $wp_id2, $wp_id3, $pmYear)
    {

        $this->connection->beginTransaction();
        //Choice 1
        //Check if cadre of choice1 require verification
        $selC1 = $this->connection->prepare("SELECT * FROM faccadre,cadres 
		 WHERE 
		   faccadre.cadreName=cadres.cadreId AND
		 faccadre.cadreName='$cadre1'");
        $selC1->execute();
        $rw = $selC1->fetch();
        $boardV1 = $rw['boardV'];
        if ($boardV1 == "Yes") {
            $boardV11 = "No";
        } elseif ($boardV1 == "No") {
            $boardV11 = "Yes";
        } else {
        }

        $insertSt = $this->connection->prepare("INSERT INTO `application`(`choiceNo`,`category`,`fac_id`, `cadre_id`, `date`,`year`,`required_verification`, `verified`,`applicant_id`, `status`) 
		
         VALUES ('1',:cat1,:fac1,:cadre1,CURDATE(),'$pmYear','$boardV1','$boardV11',:applicant_id,'Pending')");
        $insertSt->bindParam(':cat1', $cat1);
        $insertSt->bindParam(':fac1', $wp_id1);
        $insertSt->bindParam(':cadre1', $cadre1);
        $insertSt->bindParam(':applicant_id', $applicant_id);
        $insertSt->execute();

        //Choice 2
        //Check if cadre of choice2 require verification
        $selC2 = $this->connection->prepare("SELECT * FROM faccadre,cadres 
		 WHERE 
		 faccadre.cadreName=cadres.cadreId AND
		 faccadre.cadreName='$cadre2'");
        $selC2->execute();
        $rw2 = $selC2->fetch();
        $boardV2 = $rw2['boardV'];
        if ($boardV2 == "Yes") {
            $boardV22 = "No";
        } elseif ($boardV2 == "No") {
            $boardV22 = "Yes";
        } else {
        }

        $insertSt2 = $this->connection->prepare("INSERT INTO `application`(`choiceNo`,`category`,`fac_id`, `cadre_id`, `date`,`year`,`required_verification`, `verified`,`applicant_id`, `status`) 
		  
		  VALUES ('2',:cat2,:fac2,:cadre2,CURDATE(),'$pmYear','$boardV2','$boardV22',:applicant_id,'Pending')");
        $insertSt2->bindParam(':cat2', $cat2);
        $insertSt2->bindParam(':fac2', $wp_id2);
        $insertSt2->bindParam(':cadre2', $cadre2);
        $insertSt2->bindParam(':applicant_id', $applicant_id);
        $insertSt2->execute();

        //Choice 3

        //Check if cadre of choice2 require verification
        $selC3 = $this->connection->prepare("SELECT * FROM faccadre,cadres 
		 WHERE 
		 faccadre.cadreName=cadres.cadreId AND
		 faccadre.cadreName='$cadre3'");
        $selC3->execute();
        $rw3 = $selC3->fetch();
        $boardV3 = $rw3['boardV'];
        if ($boardV3 == "Yes") {
            $boardV33 = "No";
        } elseif ($boardV3 == "No") {
            $boardV33 = "Yes";
        } else {
        }
        $insertSt3 = $this->connection->prepare("INSERT INTO `application`(`choiceNo`,`category`,`fac_id`, `cadre_id`, `date`,`year`,`required_verification`, `verified`,`applicant_id`,`status`) 
		
         VALUES ('3',:cat3,:fac3,:cadre3,CURDATE(),'$pmYear','$boardV3','$boardV33',:applicant_id,'Pending')");
        $insertSt3->bindParam(':cat3', $cat3);
        $insertSt3->bindParam(':fac3', $wp_id3);
        $insertSt3->bindParam(':cadre3', $cadre3);
        $insertSt3->bindParam(':applicant_id', $applicant_id);
        $insertSt3->execute();

        $this->connection->commit();

        return $insertSt3;
    }


    //INSERT Credit Details
    public function insertCredit($cadre1, $cadre2, $cadre3, $applicant_id, $fac1, $fac2, $fac3, $cat1, $cat2, $cat3, $wp_id1, $wp_id2, $wp_id3, $pmYear)
    {
        //Inserting credit of cadre one first choice
        //Get experience`
        $selC1 = $this->connection->prepare("SELECT * FROM cadre_criteria,criteria 
		 WHERE
		 cadre_criteria.criteria_id=criteria.criteriaId AND
		 cadre_criteria.cadre_id='$cadre1'");
        $selC1->execute();
        while ($rw = $selC1->fetch()) {
            $criteria_id = $rw['criteria_id'];
            $credit = $rw['credit'];
            $cName = $rw['criteriaName'];
            $criteriaId = $rw['criteriaId'];

            if ($criteriaId == 4) //EXPERIENCE
            {
                $getE = $this->connection->prepare("SELECT MIN(year) as year FROM `proffesional` WHERE `applicant_id`='$applicant_id' AND status='Yes'");
                $getE->execute();

                //If no value found set credit = 0
                if ($getE->rowCount() < 1) {
                    $credit1 = 0;
                } else {
                    $row = $getE->fetch();
                    $year2 = $row['year'];
                    $year2 = explode("/", $year2);
                    $year3 = $year2[1];
                    if ($year3 != "") {
                        $cYear = date('Y');
                        $year = $year3;
                        $score = $cYear - $year;
                        $credit1 = $credit * $score;
                    } elseif ($year3 == "") {
                        $year = 0;
                        $credit1 = $year;
                    } else {
                    }
                }
            } elseif ($criteriaId == 2) //GRADUATE VERIFICATION
            {
                $getG = $this->connection->prepare("SELECT * FROM `graduate` WHERE `applicant_id`='$applicant_id'");
                $getG->execute();
                $countR = $getG->rowCount();
                $credit1 = $countR * $credit;
            } else {
            }

            if ($criteriaId == 2 || $criteriaId == 4) {
                //INSERT DATA INTO credit table
                $insert = $this->connection->prepare("INSERT INTO `credit`(`category`,`wp_id`,`cadre_id`, `criteria_id`,`credit`,`choiceNo`,`year`,`applicant_id`) 
		
          VALUES(:cat1,:wp_id1,:cadre1,'$criteriaId',:credit1,1,:year,:applicant_id)");
                $insert->bindParam(':cat1', $cat1);
                $insert->bindParam(':wp_id1', $wp_id1);
                $insert->bindParam(':cadre1', $cadre1);
                $insert->bindParam(':credit1', $credit1);
                $insert->bindParam(':year', $pmYear);
                $insert->bindParam(':applicant_id', $applicant_id);
                $insert->execute();
            } else {
            }
        }


        //Inserting credit of cadre TWO second choice
        //Get experience`
        $selC11 = $this->connection->prepare("SELECT * FROM cadre_criteria,criteria 
		 WHERE
		 cadre_criteria.criteria_id=criteria.criteriaId AND
		 cadre_criteria.cadre_id='$cadre2'");
        $selC11->execute();
        while ($rw11 = $selC11->fetch()) {
            $criteria_id = $rw11['criteria_id'];
            $credit = $rw11['credit'];
            $cName = $rw11['criteriaName'];
            $criteriaId = $rw11['criteriaId'];

            if ($criteriaId == 4) //EXPERIENCE
            {
                $getE = $this->connection->prepare("SELECT MIN(year) as year FROM `proffesional` WHERE `applicant_id`='$applicant_id' AND status='Yes'");
                $getE->execute();
                $row = $getE->fetch();
                $year2 = $row['year'];
                $year2 = explode("/", $year2);
                $year3 = $year2[1];


                if ($year3 != "") {
                    $cYear = date('Y');
                    $year = $year3;
                    $score = $cYear - $year;
                    $credit1 = $credit * $score;
                } elseif ($year3 == "") {
                    $year = 0;
                    $credit1 = $year;
                } else {
                }
            } elseif ($criteriaId == 2) //GRADUATE VERIFICATION
            {
                $getG = $this->connection->prepare("SELECT * FROM `graduate` WHERE `applicant_id`='$applicant_id'");
                $getG->execute();
                $countR = $getG->rowCount();
                $credit1 = $countR * $credit;
            } else {
            }

            if ($criteriaId == 2 || $criteriaId == 4) {
                //INSERT DATA INTO credit table
                $insert = $this->connection->prepare("INSERT INTO `credit`(`category`,`wp_id`,`cadre_id`, `criteria_id`,`credit`,`choiceNo`,`year`,`applicant_id`) 
		
          VALUES(:cat2,:wp_id2,:cadre2,'$criteriaId',:credit1,2,:year,:applicant_id)");
                $insert->bindParam(':cat2', $cat2);
                $insert->bindParam(':wp_id2', $wp_id2);
                $insert->bindParam(':cadre2', $cadre2);
                $insert->bindParam(':credit1', $credit1);
                $insert->bindParam(':year', $pmYear);
                $insert->bindParam(':applicant_id', $applicant_id);
                $insert->execute();
            } else {
            }
        }


        //Inserting credit of cadre THREE, THIRD choice
        //Get experience`
        $selC12 = $this->connection->prepare("SELECT * FROM cadre_criteria,criteria 
		 WHERE
		 cadre_criteria.criteria_id=criteria.criteriaId AND
		 cadre_criteria.cadre_id='$cadre3'");
        $selC12->execute();
        while ($rw12 = $selC12->fetch()) {
            $criteria_id = $rw12['criteria_id'];
            $credit = $rw12['credit'];
            $cName = $rw12['criteriaName'];
            $criteriaId = $rw12['criteriaId'];

            if ($criteriaId == 4) //EXPERIENCE
            {
                $getE = $this->connection->prepare("SELECT MIN(year) as year FROM `proffesional` WHERE `applicant_id`='$applicant_id' AND status='Yes'");
                $getE->execute();
                $row = $getE->fetch();
                $year2 = $row['year'];
                $year2 = explode("/", $year2);
                $year3 = $year2[1];


                if ($year3 != "") {
                    $cYear = date('Y');
                    $year = $year3;
                    $score = $cYear - $year;
                    $credit1 = $credit * $score;
                } elseif ($year3 == "") {
                    $year = 0;
                    $credit1 = $year;
                } else {
                }
            } elseif ($criteriaId == 2) //GRADUATE VERIFICATION
            {
                $getG = $this->connection->prepare("SELECT * FROM `graduate` WHERE `applicant_id`='$applicant_id'");
                $getG->execute();
                $countR = $getG->rowCount();
                $credit1 = $countR * $credit;
            } else {
            }

            if ($criteriaId == 2 || $criteriaId == 4) {
                //INSERT DATA INTO credit table
                $insert = $this->connection->prepare("INSERT INTO `credit`(`category`,`wp_id`,`cadre_id`, `criteria_id`,`credit`,`choiceNo`,`year`,`applicant_id`) 
		
          VALUES(:cat3,:wp_id3,:cadre3,'$criteriaId',:credit1,3,:year,:applicant_id)");
                $insert->bindParam(':cat3', $cat3);
                $insert->bindParam(':wp_id3', $wp_id3);
                $insert->bindParam(':cadre3', $cadre3);
                $insert->bindParam(':credit1', $credit1);
                $insert->bindParam(':year', $pmYear);
                $insert->bindParam(':applicant_id', $applicant_id);
                $insert->execute();
            } else {
            }
        }

        return $insert;
    }


    //Edit Application Details
    public function editApplication($fac1, $cat1, $cadre1, $app_id, $wp_id1)
    {
        $select = $this->connection->prepare("UPDATE  application 
		   SET 
		   category=:category,
		   fac_id=:fac_id,
		   verified='No',
		   cadre_id=:cadre_id
		   WHERE
		   app_id='$app_id'");
        $select->bindParam(':category', $cat1);
        $select->bindParam(':fac_id', $wp_id1);
        $select->bindParam(':cadre_id', $cadre1);
        $select->execute();
        return $select;
    }


    //Function to get application by applicant_id
    public function getApplicationByAppId($applicant_id)
    {
        $seDoc = $this->connection->prepare("SELECT * FROM `application`,`cadres`
		 WHERE 
		 application.cadre_id=cadres.cadreId AND
		 application.applicant_id='$applicant_id' ORDER BY choiceNo ASC");
        $seDoc->execute();
        return $seDoc;
    }

    //get application by status=accepted
    public function getApplicationByStatus()
    {
        $query = $this->connection->prepare("SELECT * FROM application WHERE status='Accepted' ");
        $query->execute();
        return $query;
    }

    //Function to get application by applicant_id
    public function getApplicationByAppIdToApprove($applicant_id)
    {
        $seDoc = $this->connection->prepare("SELECT * FROM `application` WHERE `applicant_id`='$applicant_id' AND status='Pending' ORDER BY choiceNo ASC");
        $seDoc->execute();
        return $seDoc;
    }


    //Function to get application status by applicant_id
    public function getApplicationStatusByAppIdToApprove($applicant_id, $pmYear)
    {
        $seDoc = $this->connection->prepare("SELECT * FROM `allocation` WHERE `applicant_id`='$applicant_id' AND year='$pmYear'");
        $seDoc->execute();
        return $seDoc;
    }

    //Get application status by year and application id
    public function getApplicationStatus($applicant_id, $pmYear)
    {
        $seDoc = $this->connection->prepare("SELECT * FROM `application` WHERE `applicant_id`='$applicant_id' AND year='$pmYear'");
        $seDoc->execute();
        return $seDoc;
    }


    //Function to get application by app_id
    public function getApplicationById($app_id)
    {
        $seDoc = $this->connection->prepare("SELECT * FROM `application` WHERE `app_id`='$app_id'");
        $seDoc->execute();
        return $seDoc;
    }

    //Update application by app_id
    public function updateVerifiedRegistration($app_id)
    {
        //Get application details
        $select = $this->connection->prepare("SELECT * FROM `application` WHERE `app_id`='$app_id'");
        $select->execute();
        $row = $select->fetch();
        $choiceNo = $row['choiceNo'];
        $cat = $row['category'];
        $fac_id = $row['fac_id'];
        $cadre_id = $row['cadre_id'];
        $applicant_id = $row['applicant_id'];


        //Inserting credit of cadre one first choice
        //Get experience`
        $selC1 = $this->connection->prepare("SELECT * FROM cadre_criteria,criteria 
		 WHERE
		 cadre_criteria.criteria_id=criteria.criteriaId AND
		 cadre_criteria.cadre_id='$cadre_id' AND
		 criteria.criteriaId=6");
        $selC1->execute();
        while ($rw = $selC1->fetch()) {
            $criteria_id = $rw['criteria_id'];
            $credit = $rw['credit'];
            $cName = $rw['criteriaName'];
            $criteriaId = $rw['criteriaId'];

            //Check if exit
            $check = $this->connection->prepare("SELECT * FROM credit 
		  WHERE
		  category='$cat' AND
		  wp_id='$fac_id' AND
		  cadre_id='$cadre_id' AND
		  criteria_id='$criteriaId' AND
		  credit='$credit' AND
		  choiceNo='$choiceNo' AND
		  year='$fac_id' AND
		  applicant_id='$applicant_id'");
            $check->execute();
            if ($check->rowCount() > 0) {
            } else {
                //INSERT DATA INTO credit table
                $insert = $this->connection->prepare("INSERT INTO `credit`(`category`,`wp_id`,`cadre_id`, `criteria_id`,`credit`,`choiceNo`,`year`,`applicant_id`) 
		
          VALUES(:cat,:fac_id,:cadre_id,'$criteriaId',:credit,'$choiceNo',:year,:applicant_id)");
                $insert->bindParam(':cat', $cat);
                $insert->bindParam(':fac_id', $fac_id);
                $insert->bindParam(':cadre_id', $cadre_id);
                $insert->bindParam(':credit', $credit);
                $insert->bindParam(':year', $fac_id);
                $insert->bindParam(':applicant_id', $applicant_id);
                $insert->execute();
            }
        }

        $upR = $this->connection->prepare("UPDATE `application` SET verified='Yes' 
		  WHERE `app_id`='$app_id'");
        $upR->execute();
        return $upR;
    }


    //Function to get pending application
    public function getApplicantsWithPendingApplication()
    {
        $seDoc = $this->connection->prepare("SELECT DISTINCT(applicant_id),date FROM `application` WHERE `status`='Pending'");
        $seDoc->execute();
        return $seDoc;
    }


    //Function to Accept application
    public function acceptApp($app_id, $email, $facName, $cadName, $fullname, $cadre3, $remarks)
    {

        $seDoc = $this->connection->prepare("UPDATE `application` SET `status`='Accepted' WHERE `app_id`='$app_id'");
        $seDoc->execute();
        return $seDoc;
    }

    //Function to Approve application
    public function approveApplication($applicant_id, $email, $approveStatus, $fullname, $category, $wp_id, $remarks, $cadre_id, $app_id, $choiceNo, $score, $pmYear, $facility)
    {
        $statusG = explode("=", $approveStatus);
        $status = $statusG[0];

        if ($status == 1) //Selected
        {
            $insert = $this->connection->prepare("INSERT INTO allocation(`app_id`, `applicant_id`, `category`, `wp_id`, `cadre_id`, `choiceNo`, `score`, `typeAllocation`, `year`, `selfChoice`)
		
         VALUES('$app_id','$applicant_id','$category','$wp_id','$cadre_id','$choiceNo',
		 '$score','Manual','$pmYear','No')");

            $insert->execute();

            $seDoc = $this->connection->prepare("UPDATE `application` SET `status`='Accepted' WHERE `applicant_id`='$applicant_id'");
            $seDoc->execute();
        } elseif ($status == 2) //Short Listed
        {
            if ($facility == "other") {
                //Insert new row
                $choice = 4;
                $insert = $this->connection->prepare("INSERT INTO `application`(`choiceNo`, `category`,`fac_id`,`cadre_id`,`date`,`year`,`required_verification`, `verified`, `applicant_id`, `status`,`credit`)
			  
			  VALUES ('$choice','$category','$wp_id','$cadre_id',CURDATE(),'$pmYear','Yes','Yes','$applicant_id','Shortlisted','$score')");
                $insert->execute();

                $seDoc1 = $this->connection->prepare("UPDATE `application` SET `status`='Unshortlisted' WHERE `applicant_id`='$applicant_id' AND status='Pending' AND year='$pmYear'");
                $seDoc1->execute();
            } else {
                $insert = $this->connection->prepare("UPDATE `application` SET `status`='Shortlisted',`credit`='$score' WHERE `app_id`='$app_id'");
                $insert->execute();

                $seDoc1 = $this->connection->prepare("UPDATE `application` SET `status`='Unshortlisted' WHERE `applicant_id`='$applicant_id' AND status='Pending' AND year='$pmYear'");
                $seDoc1->execute();
            }
        } elseif ($status == 3) //Rejected
        {

            $insert = $this->connection->prepare("UPDATE `application` SET `status`='Rejected' WHERE `applicant_id`='$applicant_id' AND year='$pmYear'");
            $insert->execute();
        } else {
        }

        return $insert;
    }


    //Function to Change Facility
    public function changeFacility($applicant_id, $email, $approveStatus, $facility, $fullname, $otherFacility, $remarks, $cadre2, $table_id)
    {
        $statusG = explode("=", $approveStatus);
        $status = $statusG[0];

        if ($status == 1) //Selected
        {
            if ($facility == 'other') {
                $fac_id = $otherFacility;
                $cadre_id = $cadre2;
            } elseif ($facility != 'other') {
                $facG = explode("=", $facility);
                $fac_id = $facG[0];
                $cadre_id = $facG[1];
            } else {
            }

            $de = $this->connection->exec("DELETE FROM `application_status` WHERE `id`='$table_id'");

            $insert = $this->connection->prepare("INSERT INTO `application_status`(`id`,`status`, `fac_id`, `carde_id`, `date`, `applicant_id`) 
		
             VALUES('$table_id','Selected',:fac_id,:cadre_id,CURDATE(),:applicant_id)");
            $insert->bindParam(':fac_id', $fac_id);
            $insert->bindParam(':cadre_id', $cadre_id);
            $insert->bindParam(':applicant_id', $applicant_id);
            $insert->execute();

            $seDoc = $this->connection->prepare("UPDATE `application` SET `status`='Accepted' WHERE `applicant_id`='$applicant_id'");
            $seDoc->execute();
        } elseif ($status == 2) //Short Listed
        {
            $de = $this->connection->exec("DELETE FROM `application_status` WHERE `id`='$table_id'");

            $insert = $this->connection->prepare("INSERT INTO `application_status`(`id`,`status`,`date`, `applicant_id`) 
		
             VALUES ('$table_id','ShortListed',CURDATE(),:applicant_id)");
            $insert->bindParam(':applicant_id', $applicant_id);
            $insert->execute();

            $seDoc = $this->connection->prepare("UPDATE `application` SET `status`='ShortListed' WHERE `applicant_id`='$applicant_id'");
            $seDoc->execute();
        } elseif ($status == 3) //Rejected
        {
            $de = $this->connection->exec("DELETE FROM `application_status` WHERE `id`='$table_id'");

            $insert = $this->connection->prepare("INSERT INTO `application_status`(`id`,`status`,`date`, `applicant_id`) 
		
             VALUES ('$table_id','Rejected',CURDATE(),:applicant_id)");
            $insert->bindParam(':applicant_id', $applicant_id);
            $insert->execute();

            $seDoc = $this->connection->prepare("UPDATE `application` SET `status`='Rejected' WHERE `applicant_id`='$applicant_id'");
            $seDoc->execute();
        } else {
        }

        return $insert;
    }

    //Function to Reject application
    public function rejectApp($app_id, $email, $facName, $cadName, $fullname, $cadre3, $remarks)
    {

        $seDoc = $this->connection->prepare("UPDATE `application` SET `status`='Rejected' WHERE `app_id`='$app_id'");
        $seDoc->execute();
        return $seDoc;
    }


    //Function to applicants by status
    public function getApplicantsByStatus($status)
    {
        $seDoc = $this->connection->prepare("SELECT * FROM `application_status` WHERE `status`='$status'");
        $seDoc->execute();
        return $seDoc;
    }


    //Function to delete rejected application
    public function deleteRejectedApp($applicant_id, $table_id)
    {
        $de = $this->connection->exec("DELETE FROM `application_status` WHERE `id`='$table_id'");

        $de1 = $this->connection->exec("DELETE FROM `application` WHERE `applicant_id`='$applicant_id'");

        return $de1;
    }


    //Function to delete applicants
    public function deleteApplicants($applicant_id)
    {
        $de = $this->connection->exec("DELETE FROM `application_status` WHERE `applicant_id`='$applicant_id'");

        $de1 = $this->connection->exec("DELETE FROM `application` WHERE 
	   `applicant_id`='$applicant_id'");

        $de12 = $this->connection->exec("DELETE FROM `applicants` WHERE `id`='$applicant_id'");

        $de13 = $this->connection->exec("DELETE FROM `registration` WHERE 
	   `applicant_id`='$applicant_id'");

        $de14 = $this->connection->exec("DELETE FROM `proffesional` WHERE 
	   `applicant_id`='$applicant_id'");

        $de15 = $this->connection->exec("DELETE FROM `experience` WHERE 
	   `applicant_id`='$applicant_id'");

        $de16 = $this->connection->exec("DELETE FROM `education` WHERE 
	   `applicant_id`='$applicant_id'");

        $de17 = $this->connection->exec("DELETE FROM `document_detail` WHERE 
	   `applicant_id`='$applicant_id'");

        $de18 = $this->connection->exec("DELETE FROM `document_detail` WHERE 
	   `applicant_id`='$applicant_id'");

        $de19 = $this->connection->exec("DELETE FROM `db_users` WHERE 
		`applicant_id`='$applicant_id'");

        return $de;
    }

    //Function to insert Cadre
    public function addCadre($cadre, $number, $status, $fac_id)
    {
        $insert = $this->connection->prepare("INSERT INTO faccadre(`cadreName`,`number`, `status`,`fac_id`) 
           values (:cadre, :number,:status,'$fac_id')");

        $insert->bindParam(':cadre', $cadre);
        $insert->bindParam(':number', $number);
        $insert->bindParam(':status', $status);
        $insert->execute();

        return $insert;
    }


    //Function to Edit Cadre
    public function editCadre($cadre, $number, $status, $cadre_id)
    {
        $insert = $this->connection->prepare("UPDATE faccadre SET
		   cadreName=:cadre,
		   number=:number,
		   status=:status
		   
		   WHERE cadre_id='$cadre_id'");

        $insert->bindParam(':cadre', $cadre);
        $insert->bindParam(':number', $number);
        $insert->bindParam(':status', $status);
        $insert->execute();

        return $insert;
    }

    //Function to Delete Cadre
    public function deleteCadre($cadre_id)
    {
        $delete = $this->connection->exec("DELETE FROM `faccadre` WHERE 
	   `cadre_id`='$cadre_id'");;

        return $delete;
    }


    //Get cadre by cadre_id
    public function getCadreByCadreId($cadre_id)
    {

        $getC = $this->connection->prepare("SELECT * FROM `faccadre`,`cadres` 
		WHERE
		faccadre.cadreName=cadres.cadreId AND
		faccadre.cadre_id='$cadre_id'");
        $getC->execute();
        return $getC;
    }


    //Get regNumber
    public function getRegNumberByNamesReg($firstname, $lastname, $q)
    {

        $getC = $this->connection->prepare("SELECT DISTINCT(`Reg_No`) as regNo FROM registration_details,contact_contact 
        WHERE 
        contact_contact.id=registration_details.contact_Id AND
        contact_contact.first_name='$firstname' AND
        contact_contact.last_name='$lastname' AND 
        registration_details.Status='Accepted' AND
        registration_details.Request='$q'");
        $getC->execute();
        return $getC;
    }


    //Get regNumber
    public function updateNames()
    {

        $getC = $this->connection->prepare("SELECT `id`, `first_name`, `middle_name`, `last_name` FROM `contact_contact` ORDER BY id ASC");
        $getC->execute();

        while ($row = $getC->fetch()) {

            $id = $row['id'];
            $firstname = ucwords(strtolower($row['first_name']));
            $middle = ucwords(strtolower($row['middle_name']));
            $lastname = ucwords(strtolower($row['last_name']));

            $getU = $this->connection->prepare("UPDATE contact_contact 
			SET 
			first_name=:firstname,
			middle_name=:middle,
			last_name=:lastname
			
			WHERE id='$id'");

            $getU->bindParam(':firstname', $firstname);
            $getU->bindParam(':middle', $middle);
            $getU->bindParam(':lastname', $lastname);
            $getU->execute();
        }

        return $getC;
    }


    //Get regYear
    public function getRegYearByNamesReg($firstname, $lastname, $regNo, $regType)
    {

        $getC = $this->connection->prepare("SELECT DISTINCT(`regYear`) as regYear FROM registration_details,contact_contact 
        WHERE 
        contact_contact.id=registration_details.contact_Id AND
        contact_contact.first_name='$firstname' AND
        contact_contact.last_name='$lastname' AND 
        registration_details.Status='Accepted' AND
        registration_details.Request='$regType' AND
		registration_details.Reg_No='$regNo'
		
		");
        $getC->execute();
        return $getC;
    }


    //Check if registration exist
    public function checkIfRegistrationForWaoExist($council, $regType, $regNo, $regYear, $firstname, $lastname)
    {

        $getC = $this->connection->prepare("SELECT `first_name`, `last_name`,`Reg_No`, `Request`, `regYear` FROM registration_details,contact_contact 
        WHERE 
        contact_contact.id=registration_details.contact_Id AND
        registration_details.Status='Accepted' AND
        registration_details.Request='$regType' AND
		registration_details.Reg_No='$regNo' AND
		registration_details.regYear=$regYear ");
        $getC->execute();
        return $getC;
    }


    //Get graduates Details by applicantId
    public function getGraduatesByAppId($applicant_id)
    {
        $getA = $this->connection->prepare("SELECT * FROM `graduate` WHERE `applicant_id`='$applicant_id'");
        $getA->execute();
        return $getA;
    }

    //Insert Graduate Details
    public function insertGraduatesDetails($prof_id, $instID, $progID, $acYear, $eduLevel, $gpa, $applicant_id)
    {
        //Check if exist
        $check = $this->connection->prepare("SELECT * FROM graduate 
		 WHERE programme_id='$progID' AND prof_id='$prof_id' AND applicant_id='$applicant_id' AND academic_year='$acYear' AND level='$eduLevel'");
        $check->execute();

        if ($check->rowCount() > 0) {
        } else {
            $insertSt = $this->connection->prepare("INSERT INTO `graduate`(`college_id`, `programme_id`, `level`, `academic_year`, `GPA`, `applicant_id`, `prof_id`) 
		
         VALUES (:instID,:progID,:eduLevel,:acYear,:gpa,:applicant_id,'$prof_id')");
            $insertSt->bindParam(':instID', $instID);
            $insertSt->bindParam(':progID', $progID);
            $insertSt->bindParam(':eduLevel', $eduLevel);
            $insertSt->bindParam(':acYear', $acYear);
            $insertSt->bindParam(':gpa', $gpa);
            $insertSt->bindParam(':applicant_id', $applicant_id);
            $insertSt->execute();
            return $insertSt;
        }
    }

    //Get ministry
    public function getMinistry()
    {
        $getM = $this->connection->prepare("SELECT * FROM ministry");
        $getM->execute();
        return $getM;
    }

    //Get ministry by Id
    public function getMinistryById($min_id)
    {
        $getM = $this->connection->prepare("SELECT * FROM ministry WHERE min_id='$min_id'");
        $getM->execute();
        return $getM;
    }

    //Edit applicants details
    public function editApplicantsDetails($firstname, $middle, $lastname, $year, $month, $day, $gender, $maritalStatus, $national, $country, $nida, $cadreType, $councilTypeID, $councilRegistrationID, $disiability, $address, $phone, $email, $applicant_id)
    {
        $dob = $year . "-" . $month . "-" . $day;

        $update = $this->connection->prepare("UPDATE applicants
		 SET
		 firstname=:firstname,
		 middlename=:middle,
		 lastname=:lastname,
		 gender=:gender,
		 dob=:dob,
		 maritalStatus=:maritalStatus,
		 nationality=:national,
		 country=:country,
		 nida=:nida,
         cadreType=:cadreType,
		 councilTypeID=:councilTypeID,
		 councilRegistrationID=:councilRegistrationID,
		 disiability=:disiability,
		 address=:address,
		 phone=:phone,
		 email=:email
		 WHERE id='$applicant_id'");
        $update->bindParam(':firstname', $firstname);
        $update->bindParam(':middle', $middle);
        $update->bindParam(':lastname', $lastname);
        $update->bindParam(':gender', $gender);
        $update->bindParam(':dob', $dob);
        $update->bindParam(':maritalStatus', $maritalStatus);
        $update->bindParam(':national', $national);
        $update->bindParam(':country', $country);
        $update->bindParam(':nida', $nida);
        $update->bindParam(':cadreType', $cadreType);
        $update->bindParam(':councilTypeID', $councilTypeID);
        $update->bindParam(':councilRegistrationID', $councilRegistrationID);
        $update->bindParam(':disiability', $disiability);
        $update->bindParam(':address', $address);
        $update->bindParam(':phone', $phone);
        $update->bindParam(':email', $email);
        $update->execute();

        // var_dump($update);exit();

        return $update;
    }
	
	//used space available space
	public function getWPchances($wp_id,$cadre_id,$pmYear)
    {
	 $getCa = $this->connection->prepare("SELECT faccadreyear.fac_id, `number`, `used` FROM faccadreyear,facility WHERE wp_id ='$wp_id' AND year='$pmYear' AND cadre_Id='$cadre_id' AND faccadreyear.fac_id=facility.fac_id");
     $getCa->execute();
     return $getCa;	 
	}
	
	//wp-ip
	public function getWP($fac_id,$category)
    {
	 $getCa = $this->connection->prepare("SELECT `wp_id` FROM `facility` WHERE `fac_id`='$fac_id' AND`category`='$category' AND `status`='Active'");
     $getCa->execute();
     return $getCa;	 
	}
   //SELECT `number`, `used` FROM `faccadreyear` WHERE `cadre_Id` `year``fac_id`
    //wp-ip
	public function getSpaceUsed($fac_id,$cadre_id, $pmYear)
    {
	 $getCa = $this->connection->prepare("SELECT `number`, `used` FROM `faccadreyear` WHERE `cadre_Id`='$cadre_id' AND `year`='$pmYear' AND `fac_id`='$fac_id'");
     $getCa->execute();
     return $getCa;	 
	}
    //Get Facility/Cadres by Year
    public function getWPCadreByYear($year)
    {
        ///////GET Facility FOR CHOICE 1
        $select = $this->connection->prepare("SELECT DISTINCT(faccadreyear.fac_id) as fac_id,facility.category as category,facility.wp_id as wp_id FROM `facility`,faccadreyear
		WHERE
		facility.fac_id=faccadreyear.fac_id AND
		faccadreyear.year='$year'");
        $select->execute();
        //List values
        while ($row = $select->fetch()) {
            $fac_id = $row['fac_id']; //Table Id
            $cat = $row['category'];  //Category of WP, either Ministry, Region, District, Facility
            $wp_id = $row['wp_id'];   //WP Id
            //$startdate=$row['startdate']; //Start date of application
            //$enddate=$row['enddate']; // End date of application

            //echo "Fac_id=".$fac_id."=Category=".$cat."=WP=".$wp_id."<br/>";

            //Get Cadres of WP
            $getCa = $this->connection->prepare("SELECT * FROM `faccadreyear` WHERE `fac_id`='$fac_id' AND year='$year'");
            $getCa->execute();
            while ($rw = $getCa->fetch()) {
                $cadre_id = $rw['cadre_Id'];
                $number = $rw['number'];

                //echo "Cadre=".$cadre_id."<br/>";

                //Get Credit of cadre1 and choice 1
                $getCredit = $this->connection->prepare("SELECT SUM(credit) as sumScore,applicant_id
			 FROM `credit` 
			 WHERE
			 category='$cat' AND
			 wp_id='$wp_id'  AND
			 choiceNo=1 AND
			 cadre_id='$cadre_id' AND
			 year='$year' GROUP BY applicant_id ORDER BY SUM(credit) DESC");
                $getCredit->execute();
                while ($rw1 = $getCredit->fetch()) {
                    $score = $rw1['sumScore'];
                    $applicant_id = $rw1['applicant_id'];

                    //echo "Cadre=".$cadre_id."=Score=".$score."=ApplicantId=".$applicant_id."<br/>";

                    //Get application
                    $getA = $this->connection->prepare("SELECT * FROM `application` 
			  WHERE 
			  `category`='$cat' AND 
			  `fac_id`='$wp_id' AND 
			  `cadre_id`='$cadre_id' AND 
			  `choiceNo`=1 AND 
			  `applicant_id`='$applicant_id' AND
			   status='Pending'");
                    $getA->execute();

                    $i = 1;
                    while ($rw2 = $getA->fetch()) {
                        $app_id = $rw2['app_id'];

                        if ($number >= $i) {
                            //Insert into allocation table

                            $insert = $this->connection->prepare("INSERT INTO allocation(`app_id`,`applicant_id`, `category`,`wp_id`,`cadre_id`,`choiceNo`,`score`,`typeAllocation`,`year`,`selfChoice`)
			   
			   VALUES('$app_id','$applicant_id','$cat','$wp_id','$cadre_id',1,'$score','Online','$year','Yes')
			   ");
                            $insert->execute();


                            //Get used number
                            $get = $this->connection->prepare("SELECT `used` FROM `faccadreyear` WHERE `cadre_Id`='$cadre_id' AND `fac_id` ='$fac_id' AND year='$year'");
                            $get->execute();
                            $rowN = $get->fetch();
                            $numUsed = $rowN['used'];
                            $newNum = $numUsed + 1;

                            //Update Used number
                            $up = $this->connection->prepare("UPDATE 
			   faccadreyear 
			   SET 
			   used='$newNum' 
			   WHERE 
			   cadre_Id='$cadre_id' AND
			   fac_id='$fac_id' AND
			   year='$year'");
                            $up->execute();

                            //Update application
                            $seDoc = $this->connection->prepare("UPDATE `application` SET `status`='Accepted' WHERE `applicant_id`='$applicant_id'");
                            $seDoc->execute();

                            $i++;
                        }
                    }
                }
            }
        } ///END OF INSERTING CHOICE ONE


        //echo "Choice 2 = Fac_id=".$fac_id."=Category=".$cat."=WP=".$wp_id."=Cadre_id=".$cadre_id."<br/>";
        ///STARTING INSERING CHOICE 2
        //Get Credit of cadre and choice 2
        //Get Cadres of WP

        $getCa2 = $this->connection->prepare("SELECT DISTINCT(faccadreyear.fac_id) as fac_id,facility.category as category,facility.wp_id as wp_id,faccadreyear.number as number ,faccadreyear.cadre_Id as cadre_Id FROM `facility`,faccadreyear
		 WHERE
		 facility.fac_id=faccadreyear.fac_id AND
		 faccadreyear.year='$year' AND
         (faccadreyear.number>faccadreyear.used)");
        $getCa2->execute();
        while ($rw = $getCa2->fetch()) {
            $fac_id = $row['fac_id'];
            $cat = $rw['category'];
            $wp_id = $rw['wp_id'];
            $cadre_id = $rw['cadre_Id'];
            $number = $rw['number'];


            //echo $cadre_id."<br/>";
            $getCredit2 = $this->connection->prepare("SELECT SUM(credit) as sumScore,applicant_id
			 FROM `credit` 
			 WHERE 
			 category='$cat' AND
			 wp_id='$wp_id'  AND
			 choiceNo=2 AND
			 cadre_id='$cadre_id' AND
			 year='$year' GROUP BY applicant_id ORDER BY SUM(credit) DESC");
            $getCredit2->execute();
            while ($rw12 = $getCredit2->fetch()) {
                $score = $rw12['sumScore'];
                $applicant_id = $rw12['applicant_id'];

                //echo "Score=".$score."=ApplicantId=".$applicant_id."<br/>";

                //Get application
                $getA2 = $this->connection->prepare("SELECT * FROM `application` 
			  WHERE 
			  `category`='$cat' AND 
			  `fac_id`='$wp_id' AND 
			  `cadre_id`='$cadre_id' AND 
			  `choiceNo`=2 AND 
			  `applicant_id`='$applicant_id' AND
			   status='Pending'");
                $getA2->execute();

                $j = 1;
                while ($rw22 = $getA2->fetch()) {
                    $app_id = $rw22['app_id'];

                    if ($number >= $j) {
                        //Insert into allocation table

                        $insert = $this->connection->prepare("INSERT INTO allocation(`app_id`, `applicant_id`,`category`,`wp_id`,`cadre_id`, `choiceNo`, `score`, `typeAllocation`, `year`, `selfChoice`)
			   
			   VALUES('$app_id','$applicant_id','$cat','$wp_id','$cadre_id',2,'$score','Online',
			   '$year','Yes')");
                        $insert->execute();


                        //Get used number
                        $get = $this->connection->prepare("SELECT `used` FROM `faccadreyear` WHERE `cadre_Id`='$cadre_id'   AND `fac_id` ='$fac_id' AND year='$year'");
                        $get->execute();
                        $rowN = $get->fetch();
                        $numUsed = $rowN['used'];
                        $newNum = $numUsed + 1;

                        //Update Used number
                        $up = $this->connection->prepare("UPDATE 
			   faccadreyear 
			   SET 
			   used='$newNum' 
			   WHERE 
			   cadre_Id='$cadre_id' AND
			   fac_id='$fac_id' AND year='$year'");
                        $up->execute();


                        //Update application
                        $seDoc = $this->connection->prepare("UPDATE `application` SET `status`='Accepted' WHERE `applicant_id`='$applicant_id'");
                        $seDoc->execute();

                        $j++;
                    }
                }
            } ///END OF INSERTING CHOICE TWO
        }


        //echo "Choice 3 = Fac_id=".$fac_id."=Category=".$cat."=WP=".$wp_id."=Cadre_id=".$cadre_id."<br/>";

        ///STARTING INSRTING CHOICE 3
        //Get Credit of cadre and choice 3
        //Get Cadres of WP
        $getCa3 = $this->connection->prepare("SELECT DISTINCT(faccadreyear.fac_id) as fac_id,facility.category as category,facility.wp_id as wp_id,faccadreyear.number as number ,faccadreyear.cadre_Id as cadre_Id FROM `facility`,faccadreyear
		 WHERE
		 facility.fac_id=faccadreyear.fac_id AND
		 faccadreyear.year='$year' AND
         (faccadreyear.number>faccadreyear.used)");
        $getCa3->execute();
        while ($rw = $getCa3->fetch()) {
            $fac_id = $row['fac_id'];
            $cat = $rw['category'];
            $wp_id = $rw['wp_id'];
            $cadre_id = $rw['cadre_Id'];
            $number = $rw['number'];


            //echo $cadre_id."<br/>";
            $getCredit2 = $this->connection->prepare("SELECT SUM(credit) as sumScore,applicant_id
			 FROM `credit` 
			 WHERE 
			 category='$cat' AND
			 wp_id='$wp_id'  AND
			 choiceNo=3 AND
			 cadre_id='$cadre_id' AND
			 year='$year' GROUP BY applicant_id ORDER BY SUM(credit) DESC");
            $getCredit2->execute();
            while ($rw12 = $getCredit2->fetch()) {
                $score = $rw12['sumScore'];
                $applicant_id = $rw12['applicant_id'];

                //echo "Score=".$score."=ApplicantId=".$applicant_id."<br/>";

                //Get application
                $getA2 = $this->connection->prepare("SELECT * FROM `application` 
			  WHERE 
			  `category`='$cat' AND 
			  `fac_id`='$wp_id' AND 
			  `cadre_id`='$cadre_id' AND 
			  `choiceNo`=3 AND 
			  `applicant_id`='$applicant_id' AND
			   status='Pending'");
                $getA2->execute();

                $j = 1;
                while ($rw22 = $getA2->fetch()) {
                    $app_id = $rw22['app_id'];

                    if ($number >= $j) {
                        //Insert into allocation table

                        $insert = $this->connection->prepare("INSERT INTO allocation(`app_id`, `applicant_id`,`category`,`wp_id`,`cadre_id`, `choiceNo`, `score`, `typeAllocation`, `year`, `selfChoice`)
			   
			   VALUES('$app_id','$applicant_id','$cat','$wp_id','$cadre_id',3,'$score','Online',
			   '$year','Yes')");
                        $insert->execute();


                        //Get used number
                        $get = $this->connection->prepare("SELECT `used` FROM `faccadreyear` WHERE `cadreName`='$cadre_id'   AND `fac_id` ='$fac_id' AND year='$year'");
                        $get->execute();
                        $rowN = $get->fetch();
                        $numUsed = $rowN['used'];
                        $newNum = $numUsed + 1;

                        //Update Used number
                        $up = $this->connection->prepare("UPDATE 
			   faccadreyear 
			   SET 
			   used='$newNum' 
			   WHERE 
			   cadreName='$cadre_id' AND
			   fac_id='$fac_id' AND year='$year'");
                        $up->execute();


                        //Update application
                        $seDoc = $this->connection->prepare("UPDATE `application` SET `status`='Accepted' WHERE `applicant_id`='$applicant_id'");
                        $seDoc->execute();

                        $j++;
                    }
                }
            } ///END OF INSERTING CHOICE THREE
        }


        //INSERT APPLICANTS AFTER INSERTING ALL APPLICANTS OF ALL CHOICES
        //Get Cadres of WP
        $getCa4 = $this->connection->prepare("SELECT DISTINCT(faccadreyear.fac_id) as fac_id,facility.category as category,facility.wp_id as wp_id,faccadreyear.number as number ,faccadreyear.cadre_Id as cadre_Id FROM `facility`,faccadreyear
		 WHERE
		 facility.fac_id=faccadreyear.fac_id AND
		 faccadreyear.year='$year' AND
         (faccadreyear.number>faccadreyear.used)");
        $getCa4->execute();
        while ($rw = $getCa4->fetch()) {
            $fac_id = $row['fac_id'];
            $cat = $rw['category'];
            $wp_id = $rw['wp_id'];
            $cadre_id = $rw['cadre_Id'];
            $number = $rw['number'];


            //echo $cadre_id."<br/>";
            $getCredit2 = $this->connection->prepare("SELECT 
			 SUM(credit) as sumScore,
			 application.applicant_id AS applicant_id,
			 application.app_id AS app_id
			 FROM credit,application
			 WHERE 
			 credit.applicant_id=application.applicant_id AND
			 credit.category='$cat' AND
			 credit.wp_id='$wp_id'  AND
			 credit.cadre_id='$cadre_id' AND
			 application.status='Pending' AND
			 credit.year='$year' GROUP BY applicant_id ORDER BY SUM(credit) DESC");
            $getCredit2->execute();
            while ($rw12 = $getCredit2->fetch()) {
                $score = $rw12['sumScore'];
                $applicant_id = $rw12['applicant_id'];
                $app_id = $rw12['app_id'];

                $h = 1;
                while ($rw22 = $getA2->fetch()) {
                    $app_id = $rw22['app_id'];

                    if ($number >= $h) {
                        //Insert into allocation table

                        $insert = $this->connection->prepare("INSERT INTO allocation(`app_id`, `applicant_id`,`category`,`wp_id`,`cadre_id`, `choiceNo`, `score`, `typeAllocation`, `year`, `selfChoice`)
			   
			   VALUES('$app_id','$applicant_id','$cat','$wp_id','$cadre_id',3,'$score','Online',
			   '$year','Yes')");
                        $insert->execute();


                        //Get used number
                        $get = $this->connection->prepare("SELECT `used` FROM `faccadreyear` WHERE `cadreName`='$cadre_id'   AND `fac_id` ='$fac_id' AND year='$year'");
                        $get->execute();
                        $rowN = $get->fetch();
                        $numUsed = $rowN['used'];
                        $newNum = $numUsed + 1;

                        //Update Used number
                        $up = $this->connection->prepare("UPDATE 
			   faccadreyear 
			   SET 
			   used='$newNum' 
			   WHERE 
			   cadreName='$cadre_id' AND
			   fac_id='$fac_id' AND year='$year'");
                        $up->execute();


                        //Update application
                        $seDoc = $this->connection->prepare("UPDATE `application` SET `status`='Accepted' WHERE `applicant_id`='$applicant_id'");
                        $seDoc->execute();

                        $h++;
                    }
                }
            } ///END OF INSERTING CHOICE TWO
        }

        //exit();
        return $insert;
    }


    //INSERTING VALUES INTO faccadreyear
    public function insertDataIntofaccYear($number, $year, $cadreId, $fac_id)
    {
        $insert = $this->connection->prepare("INSERT INTO faccadreyear(`cadre_Id`,`number`, `year`,`fac_id`)
			   
		VALUES('$cadreId','$number','$year','$fac_id')");
        $insert->execute();
        return $insert;
    }

    //Get values by table id
    public function getfacYearById($tableId)
    {
        $getY = $this->connection->prepare("SELECT * FROM `faccadreyear` WHERE id='$tableId'");
        $getY->execute();
        return $getY;
    }

    //UPdate VALUES INTO faccadreyear
    public function updateDataIntofaccYear($number, $year, $tableId, $fac_id)
    {
        $update = $this->connection->prepare("UPDATE faccadreyear  
		SET
		number='$number',
		year='$year'
		WHERE id='$tableId'");
        $update->execute();
        return $update;
    }

    //Delete VALUES INTO faccadreyear
    public function deleteDataIntofaccYear($tableId)
    {
        $delete = $this->connection->prepare("DELETE FROM faccadreyear WHERE id='$tableId'");
        $delete->execute();
        return $delete;
    }

    

    public function getActiveWorkPermitYearWithCadre($pmYear)
    {
        $getC = $this->connection->prepare("SELECT DISTINCT(cadres.cadreId) as cadreId, cadres.cadreName FROM faccadre, cadres, facility, faccadreyear WHERE faccadre.cadreName = cadres.cadreId AND facility.fac_id =faccadre.fac_id AND facility.status='Active' AND faccadreyear.year=$pmYear");
        $getC->execute();
        return $getC;
    }

    //Get list of allocated applicants
    public function getListofAllocatedApplicants($pmYear)
    {
        $select = $this->connection->prepare("SELECT * FROM `allocation` WHERE `year`='$pmYear'");
        $select->execute();
        return $select;
    }


    //Get list of Allocated by cadre id
    public function getListofAllocatedApplicantsByCadreId($cadre1, $pmYear)
    {
        $select = $this->connection->prepare("SELECT * 
		FROM 
		`allocation` 
		WHERE 
		`year`='$pmYear' AND
		`cadre_id`='$cadre1'
		");
        $select->execute();
        return $select;
    }

    //Get list of Allocated by cadre id
    public function getListofAllocatedApplicantsByLocation($pmYear, $cat1, $wp_id1, $cadre1)
    {
        $select = $this->connection->prepare("SELECT * 
		FROM 
		`allocation` 
		WHERE 
		`year`='$pmYear' AND
		`category`='$cat1' AND
		`wp_id`='$wp_id1'
		");
        $select->execute();
        return $select;
    }


    //Get list of Allocated applicant Id
    public function getListofAllocatedApplicantsByYearWPCat($pmYear, $cat1, $wp_id1, $cadre1)
    {
        $select = $this->connection->prepare("SELECT * 
		FROM 
		`allocation` 
		WHERE 
		`year`='$pmYear' AND
		`category`='$cat1' AND
		`wp_id`='$wp_id1' AND
		`cadre_id`='$cadre1'
		");
        $select->execute();
        return $select;
    }


    //Get list of Shortisted applicant Id
    public function getListofShortlistedApplicantsByYear($pmYear)
    {
        $select = $this->connection->prepare("SELECT DISTINCT(applicant_id) AS applicant_id FROM `application` WHERE `year`='$pmYear'  AND `status`='Shortlisted'");
        $select->execute();
        return $select;
    }


    //Get list of Shortisted applicant Id
    public function getListofShortlistedApplicantsByYearWPCat($pmYear, $cat1, $wp_id1, $cadre1)
    {
        $select = $this->connection->prepare("SELECT DISTINCT(applicant_id) AS applicant_id 
		FROM 
		`application` 
		WHERE 
		`year`='$pmYear' AND
		`category`='$cat1' AND
		`fac_id`='$wp_id1' AND
		`cadre_id`='$cadre1' AND
		`status`='Shortlisted'");
        $select->execute();
        return $select;
    }


    //Get list of Shortisted by cadre Id
    public function getListofShortlistedApplicantsByCadreId($cadre1, $pmYear)
    {
        $select = $this->connection->prepare("SELECT DISTINCT(applicant_id) AS applicant_id 
		FROM 
		`application` 
		WHERE 
		`year`='$pmYear' AND
		`cadre_id`='$cadre1' AND
		`status`='Shortlisted'");
        $select->execute();
        return $select;
    }

    //Get list of Shortisted Location
    public function getListofShortlistedApplicantsByLocation($pmYear, $cat1, $wp_id1, $cadre1)
    {
        $select = $this->connection->prepare("SELECT DISTINCT(applicant_id) AS applicant_id 
		FROM 
		`application` 
		WHERE 
		`year`='$pmYear' AND
		`category`='$cat1' AND
		`fac_id`='$wp_id1' AND
		`status`='Shortlisted'");
        $select->execute();
        return $select;
    }


    //Get list of Shortisted applicants
    public function getShortlistedWPByApplicantIdYearWPCATBy($applicant_id, $pmYear, $cat1, $wp_id1, $cadre1)
    {
        $select = $this->connection->prepare("SELECT * FROM `application` 
		WHERE
		`applicant_id`='$applicant_id' AND
		`year`='$pmYear' AND
		`category`='$cat1' AND
		`fac_id`='$wp_id1' AND
		`cadre_id`='$cadre1' AND
		`status`='Shortlisted' ORDER BY choiceNo ASC");
        $select->execute();
        return $select;
    }


    //Get list of Shortisted applicants
    public function getShortlistedWPByApplicantIdYear($applicant_id, $pmYear)
    {
        $select = $this->connection->prepare("SELECT * FROM `application` 
		WHERE
		`applicant_id`='$applicant_id' AND
		`year`='$pmYear' AND 
		`status`='Shortlisted' ORDER BY choiceNo ASC");
        $select->execute();
        return $select;
    }

    //Get list of shotlisted applicants
    public function getApplicantsFromCredit($pmYear)
    {
        $select = $this->connection->prepare("SELECT DISTINCT(`applicant_id`) AS applicant_id
		FROM `credit` WHERE `year`='$pmYear'");
        $select->execute();
        return $select;
    }

    //Get list getCadreByApplicantIdByYear
    public function getCadreByApplicantIdByYear($applicant_id, $pmYear)
    {
        $select = $this->connection->prepare("SELECT DISTINCT(`cadre_id`) AS cadre_id FROM `credit` WHERE `applicant_id`='$applicant_id' AND `year`='$pmYear'");
        $select->execute();
        return $select;
    }

    //Get Facility/Cadres by Year
    public function getWPCadreByYearToshortList_($year)
    {

        //Get applicant_id
        $getAID = $this->connection->prepare("SELECT DISTINCT(applicant_id) as applicant_id,gender,dob,nationality FROM application WHERE year='$year' AND status='Pending'");
        $getAID->execute();
        while ($row = $getAID->fetch()) {
            $applicant_id = $row['applicant_id'];
            $gender = $row['gender'];
            $dob = $row['dob'];
            $nationality = $row['nationality'];

            //Get cadres applied
            $getCadre = $this->connection->prepare("SELECT * FROM `application` WHERE `applicant_id`='$applicant_id' AND year='$year' AND status='Pending' ORDER BY choiceNo ASC");
            $getCadre->execute();
            while ($row1 = $getCadre->fetch()) {
                $ex = "No";
                $grad = "No";
                $boardReg = "Yes";

                $exC = "No";
                $gradC = "No";
                $boardRegC = "No";

                $totalCredit = 0;
                $creditE = 0;
                $creditGrad = 0;
                $creditReg = 0;

                $app_id = $row1['app_id'];
                $cadre_id = $row1['cadre_id'];
                $choiceNo = $row1['choiceNo'];
                // echo '$applicant_id='.$applicant_id.'<br> $application_id='.$app_id.'<br> $cadre_id='.$cadre_id.'<br> $choiceNo='.$choiceNo.'<br><br>';

                //Get criteria of that cadre
                $getCr = $this->connection->prepare("SELECT * FROM `cadre_criteria`,`criteria`,`standard_criteria` WHERE `cadre_criteria`.`criteria_id`=`criteria`.`criteriaId` AND `standard_criteria`.`id`=`criteria`.`standard_id` AND `cadre_id`='$cadre_id'");
                $getCr->execute();
                while ($row11 = $getCr->fetch()) {
                    echo '$applicant_id=' . $applicant_id . '<br> $application_id=' . $app_id . '<br> $cadre_id=' . $cadre_id . '<br> $choiceNo=' . $choiceNo . '<br><br>';

                    $standard_id = $row11['standard_id'];
                    $criteriaId = $row11['criteria_id'];
                    $cadre_id = $row11['cadre_id'];
                    $credit = $row11['credit'];

                    print_r($row11);
                    echo '<br><br><br>';

                    if ($standard_id == 1) { //verify Nationality

                    } elseif ($standard_id == 2) { //verify O-level Education
                        # code...
                    } elseif ($standard_id == 3) { //verify Professionalism Education
                        # code...
                    } else {
                    }

                    //Get standard criterias
                    $standardCriterias = $this->connection->prepare("SELECT * FROM standard_criteria ORDER BY is_compulsory DESC");
                    $standardCriterias->execute();
                    while ($row = $standardCriterias->fetch()) {


                        // print_r($row);
                        // `id`, `name`, `status`, `description`, `is_compulsory`


                    } // end standard criterias


                }
            } //End cadre loop

        } //End applicantId loop

        //  return $update;
        exit;
    }

    //Get Facility/Cadres by Year
    public function getWPCadreByYearShortListGstar($year)
    {
        //Get applicant_id
        $getAID = $this->connection->prepare("SELECT DISTINCT(applicant_id) as applicant_id,gender,dob,nationality FROM application,applicants WHERE applicants.id=application.applicant_id AND year='$year' AND status='Pending'");
        $getAID->execute();
        $update = '';
        while ($row = $getAID->fetch()) {
            $applicant_id = $row['applicant_id'];
            $gender = $row['gender'];
            $dob = $row['dob'];
            $nationality = $row['nationality'];

            //Get cadres applied
            $getCadre = $this->connection->prepare("SELECT * FROM `application` WHERE `applicant_id`='$applicant_id' AND year='$year' AND status='Pending' ORDER BY choiceNo ASC");
            $getCadre->execute();
            while ($row1 = $getCadre->fetch()) {
                $app_id = $row1['app_id'];
                $cadre_id = $row1['cadre_id'];
                $choiceNo = $row1['choiceNo'];

                //Get criteria of that cadre
                $getCr = $this->connection->prepare("SELECT * FROM `cadre_criteria`,`criteria`,`standard_criteria` WHERE `cadre_criteria`.`criteria_id`=`criteria`.`criteriaId` AND `standard_criteria`.`id`=`criteria`.`standard_id` AND `cadre_id`='$cadre_id'");
                $getCr->execute();

                $data = array();
                while ($row11 = $getCr->fetch()) {
                    $data[] = $this->shortListSwitchCase($applicant_id, $row11);
                }

                $totalCredits = 0;
                foreach ($data as $value) {
                    $totalCredits += $value['credit'];
                    if ((isset($value['age']) && $value['age'] == 'No') || (isset($value['gender']) && $value['gender'] == 'No') || (isset($value['nationality']) && $value['nationality'] == 'No') || (isset($value['olevel-certificate']) && $value['olevel-certificate'] == 'No') || (isset($value['professionalism-education']) && $value['professionalism-education'] == 'No') || (isset($value['council-registration']) && $value['council-registration'] == 'No') || (isset($value['work-experience']) && $value['work-experience'] == 'No')) {
                        $status = 'Unshortlisted';
                        $age_ = @$value['age'];
                        $gender_ = @$value['gender'];
                        $nationality_ = @$value['nationality'];
                        $olevel_certificate_ = @$value['olevel-certificate'];
                        $professionalism_education_ = @$value['professionalism-education'];
                        $council_registration_ = @$value['council-registration'];
                        $work_experience_ = @$value['work-experience'];
                        break;
                    } else {
                        $status = 'Shortlisted';
                    }
                }

                if ($status == 'Unshortlisted') {
                    $insert = $this->connection->prepare("INSERT INTO unshortlisted_reason(`applicant_id`, `nationality`, `o_level`, `professionalism`, `council_registration`, `work_experience`, `age_limit`, `gender`)
			        VALUES('$applicant_id','$nationality_','$olevel_certificate_','$professionalism_education_','$council_registration_','$work_experience_','$age_','$gender_')");
                    $insert->execute();
                }

                $update = $this->connection->prepare("UPDATE application SET `status`='$status', `credit`='$totalCredits'  WHERE `app_id`='$app_id'");
                $update->execute();
            } //End cadre loop


        } //End applicantId loop
        return $update;
    }


    function shortListSwitchCase($applicant_id, $row)
    {
        /*
            BASIC CRITERIAS ARE:
            1 	Nationality
                    => Should be Tanzanian Verfied by birth certificate
            2 	O-level Education
                    => verified by Record Available in basic education
            3 	Professionalism Education
                    => Verified by Record Available, Copy of certificate
            4 	Council Registration
                    => 	Verified by Reg No from contact field, Upload Cer...
            5 	Work Experience
                    => 	Verified by End year minus Start year
            6 	Age Limit
                    => 	Verified by Date of birth, Age between
            7 	Gender
                    => Verified by  Female or Male
            */

        # Case refers to the ID in the Standard Criteria Table
        $response = array();
        $credit = $row['credit'];

        $getAp = $this->getApplicantsById($applicant_id);
        $row_applicant = $getAp->fetch();

        switch ($row['standard_id']) {
            case 1:
                $getBirthCertificate = $this->getDocType('Birth Certificate');
                $birthCert = $getBirthCertificate->fetch();
                $birthCertificate = $birthCert['DocumentID'];
                $checkCertificate = $this->checkIfFileExist($birthCertificate, $applicant_id);

                if ($checkCertificate->rowCount() > 0) {
                    $response['nationality'] = 'Yes';
                } else {
                    $response['nationality'] = 'No';
                }


                if ($row_applicant['nationality'] == '1375') {
                    $response['nationality'] = 'Yes';
                } else {
                    $response['nationality'] = 'No';
                }

                $response['credit'] = $credit;

                return $response;

                break;
            case 2:
                $getOlevelCertificate = $this->getDocType('O-Level');
                $olevelCert = $getOlevelCertificate->fetch();
                $olevelCertificate = $olevelCert['DocumentID'];
                $checkCertificate = $this->checkIfFileExist($olevelCertificate, $applicant_id);

                if ($checkCertificate->rowCount() > 0) {
                    $response['olevel-certificate'] = 'Yes';
                } else {
                    $response['olevel-certificate'] = 'No';
                }

                $response['credit'] = $credit;

                return $response;
                break;
            case 3:
                $proDetails = $this->getProfessionalByAppId($applicant_id, 'Yes');
                if ($proDetails->rowCount() > 0) {
                    $response['professionalism-education'] = 'Yes';
                } else {
                    $response['professionalism-education'] = 'No';
                }

                $response['credit'] = $credit;

                return $response;
                break;
            case 4:
                if ($row_applicant['councilRegistrationID'] != '') {
                    $response['council-registration'] = 'Yes';
                } else {
                    $response['council-registration'] = 'No';
                }

                $response['credit'] = $credit;

                return $response;
                break;
            case 5:
                $getExperience = $this->getExperienceByAppId($applicant_id);
                if ($getExperience->rowCount() > 0) {
                    $response['work-experience'] = 'Yes';
                } else {
                    $response['work-experience'] = 'No';
                }

                $response['credit'] = $credit;

                return $response;
                break;
            case 6:
                $dob = $row_applicant['dob'];
                if (!empty($dob)) {
                    $date = explode('-', $dob);
                    $byear = $date[0];
                    $cyear = date('Y');
                    $age = $cyear - $byear;

                    if ($age >= $row['lower_age'] && $age <= $row['higher_age']) {
                        $response['age'] = 'Yes';
                    } else {
                        $response['age'] = 'No';
                    }
                } else {
                    $response['age'] = 'No';
                }

                $response['credit'] = $credit;

                return $response;
                break;
            case 7:
                if (empty($row['gender'])) return;
                if (strtolower($row_applicant['gender']) == strtolower($row['gender'])) {
                    $response['gender'] = 'Yes';
                } else {
                    $response['gender'] = 'No';
                }

                $response['credit'] = $credit;

                return $response;
                break;

            default:
                break;
        }
    }

    public function getWPCadreByYearToshortList($year)
    {
        //Get applicant_id
        $getAID = $this->connection->prepare("SELECT DISTINCT(applicant_id) as applicant_id
			FROM application
			WHERE
			year='$year' AND status='Pending'");
        $getAID->execute();
        while ($row = $getAID->fetch()) {
            $applicant_id = $row['applicant_id'];


            //Get cadres applied
            $getCadre = $this->connection->prepare("SELECT * FROM `application` WHERE `applicant_id`='$applicant_id' AND year='$year' AND status='Pending' ORDER BY choiceNo ASC");
            $getCadre->execute();
            while ($row1 = $getCadre->fetch()) {
                $ex = "No";
                $grad = "No";
                $boardReg = "Yes";

                $exC = "No";
                $gradC = "No";
                $boardRegC = "No";

                $totalCredit = 0;
                $creditE = 0;
                $creditGrad = 0;
                $creditReg = 0;

                $app_id = $row1['app_id'];
                $cadre_id = $row1['cadre_id'];
                $choiceNo = $row1['choiceNo'];

                //Get criteria of that cadre
                $getCr = $this->connection->prepare("SELECT * FROM `cadre_criteria` WHERE `cadre_id`='$cadre_id'");
                $getCr->execute();
                while ($row11 = $getCr->fetch()) {
                    $criteriaId = $row11['criteria_id'];
                    $credit = $row11['credit'];

                    if ($criteriaId == 4) //Cadre has Experience
                    {
                        $exC = "Yes";
                        //Find its experience`
                        $getE = $this->connection->prepare("SELECT MIN(year) as year FROM `proffesional` WHERE `applicant_id`='$applicant_id' AND status='Yes'");
                        $getE->execute();


                        if ($getE->rowCount() < 1) //Applicant for this cadre has no experience
                        {                       //So he/she is not shortlisted under this cadre.
                            $creditEx = 0;
                            $ex = "No";
                        } else {
                            $row = $getE->fetch();
                            $year2 = $row['year'];
                            $year2 = explode("/", $year2);
                            $year3 = $year2[1];
                            if ($year3 != "") {
                                $cYear = date('Y');
                                $year1 = $year3;
                                $score = $cYear - $year1;
                                $creditEx = $credit * $score;
                                $ex = "Yes";
                            } elseif ($year3 == "" || $year3 == 0) {
                                $year1 = 0;
                                $creditEx = $year1;
                                $ex = "No";
                            } else {
                            }
                        }

                        //echo "ChoiceNo".$choiceNo." CadreID=".$cadre_id." criteriaId=".$criteriaId." ExperinceStatus".$ex."<br/>";

                    } //#END OF EXPERIENCE IF


                    elseif ($criteriaId == 2) //Cadre has criteria of graduate verification
                    {
                        //Find if applicant has verified his/her graduate details
                        $gradC = "Yes";
                        $getG = $this->connection->prepare("SELECT * FROM `graduate` WHERE `applicant_id`='$applicant_id'");
                        $getG->execute();
                        $countR = $getG->rowCount();
                        if ($countR < 1) {
                            $grad = "No";
                        } else {
                            $creditGrad = $countR * $credit;
                            $grad = "Yes";
                        }

                        //echo "ChoiceNo".$choiceNo." CadreID=".$cadre_id." criteriaId=".$criteriaId." GraduVerificationStatus".$grad."<br/>";

                    } //#END OF GRADUATE VERIFICATION IF


                    elseif ($criteriaId == 6) //Cadre has criteria of board Registration
                    {
                        $boardRegC = "Yes";
                        //Check if this cadre is registered to board
                        $getR = $this->connection->prepare("SELECT * FROM `application` WHERE `applicant_id`='$applicant_id' AND cadre_id='$cadre_id' AND year='$year' AND choiceNo='$choiceNo'");
                        $getR->execute();
                        while ($rowR = $getR->fetch()) {
                            $veryRequ = $rowR['required_verification'];
                            $veryStatus = $rowR['verified'];


                            if ($veryRequ == "No" and $veryStatus == "Yes") {
                                $boardReg = "Yes";
                                $creditReg = $credit;
                            } elseif ($veryRequ == "Yes" and $veryStatus == 'Yes') {
                                $boardReg = "Yes";
                                $creditReg = $credit;
                                //$boardReg="No";
                            } elseif ($veryRequ == "Yes" and $veryStatus == 'No') {
                                $boardReg = "No";
                            } else {
                            }
                        }

                        //echo "ChoiceNo".$choiceNo." CadreID=".$cadre_id." criteriaId=".$criteriaId." BoardStatus=".$boardRegC."==BoardVerified Status".$boardReg."<br/>";
                    } //#END OF BOARD REGISTRATION VERIFICATION IF


                } //End Criteria loop
                //echo "Applicant ID=".$applicant_id."  ChoiceNo".$choiceNo." CadreID=".$cadre_id." Need Experice?=".$exC." Has Experience=".$ex ." Must be verified?=".$gradC." Has Verified?=".$grad." Board Registration?=".$boardRegC." Board Verified?=".$boardReg."<br/>";

                $totalCredit = $creditEx + $creditGrad + $creditReg;

                if ($exC == "Yes" and $gradC == "Yes" and $boardRegC == "Yes") //If all are yes
                {
                    if ($ex == "Yes" and $grad == "Yes" and $boardReg == "Yes") {
                        //ShortList
                        $update = $this->connection->prepare("UPDATE application
				 SET
				 `status`='Shortlisted',
				 `credit`='$totalCredit' 
				 WHERE `app_id`='$app_id'");
                        $update->execute();
                    } else {
                        //No shortlisted
                        $update = $this->connection->prepare("UPDATE application
				 SET
				 `status`='Unshortlisted'
				 WHERE `app_id`='$app_id'");
                        $update->execute();
                    }
                } elseif ($exC == "Yes" and $gradC == "Yes" and $boardRegC == "No") //If boardRegC is NO
                {
                    if ($ex == "Yes" and $grad == "Yes") {
                        //ShortList
                        $update = $this->connection->prepare("UPDATE application
				 SET
				 `status`='Shortlisted',
				 `credit`='$totalCredit' 
				 WHERE `app_id`='$app_id'");
                        $update->execute();
                    } else {
                        //UnshortList
                        $update = $this->connection->prepare("UPDATE application
				 SET
				 `status`='Unshortlisted'
				 WHERE `app_id`='$app_id'");
                        $update->execute();
                    }
                } elseif ($exC == "Yes" and $gradC == "No" and $boardRegC == "Yes") //
                {
                    if ($ex == "Yes" and $boardRegC == "Yes") {
                        //ShortList
                        $update = $this->connection->prepare("UPDATE application
				 SET
				 `status`='Shortlisted',
				 `credit`='$totalCredit' 
				 WHERE `app_id`='$app_id'");
                        $update->execute();
                    } else {
                        //UnshortList
                        $update = $this->connection->prepare("UPDATE application
				 SET
				 `status`='Unshortlisted'
				 WHERE `app_id`='$app_id'");
                        $update->execute();
                    }
                } elseif ($exC == "No" and $gradC == "Yes" and $boardRegC == "Yes") //
                {
                    if ($gradC == "Yes" and $boardRegC == "Yes") {
                        //ShortList
                        $update = $this->connection->prepare("UPDATE application
				 SET
				 `status`='Shortlisted',
				 `credit`='$totalCredit' 
				 WHERE `app_id`='$app_id'");
                        $update->execute();
                    } else {
                        //UnshortList
                        $update = $this->connection->prepare("UPDATE application
				 SET
				 `status`='Unshortlisted'
				 WHERE `app_id`='$app_id'");
                        $update->execute();
                    }
                } elseif ($exC == "No" and $gradC == "No" and $boardRegC == "Yes") //
                {
                    if ($boardRegC = "Yes") {
                        //ShortList
                        $update = $this->connection->prepare("UPDATE application
				 SET
				 `status`='Shortlisted',
				 `credit`='$totalCredit' 
				 WHERE `app_id`='$app_id'");
                        $update->execute();
                    } else {
                        //UnshortList
                        $update = $this->connection->prepare("UPDATE application
				 SET
				 `status`='Unshortlisted'
				 WHERE `app_id`='$app_id'");
                        $update->execute();
                    }
                } elseif ($exC == "Yes" and $gradC == "No" and $boardRegC == "No") //
                {
                    if ($exC = "Yes") {
                        //ShortList
                        $update = $this->connection->prepare("UPDATE application
				 SET
				 `status`='Shortlisted',
				 `credit`='$totalCredit' 
				 WHERE `app_id`='$app_id'");
                        $update->execute();
                    } else {
                        //UnshortList
                        $update = $this->connection->prepare("UPDATE application
				 SET
				 `status`='Unshortlisted'
				 WHERE `app_id`='$app_id'");
                        $update->execute();
                    }
                } elseif ($exC == "No" and $gradC == "Yes" and $boardRegC == "No") //
                {
                    if ($gradC = "Yes") {
                        //ShortList
                        $update = $this->connection->prepare("UPDATE application
				 SET
				 `status`='Shortlisted',
				 `credit`='$totalCredit' 
				 WHERE `app_id`='$app_id'");
                        $update->execute();
                    } else {
                        //UnshortList
                        $update = $this->connection->prepare("UPDATE application
				 SET
				 `status`='Unshortlisted' 
				 WHERE `app_id`='$app_id'");
                        $update->execute();
                    }
                } elseif ($exC == "No" and $gradC == "No" and $boardRegC == "No") //
                {
                    //ShortList
                    $update = $this->connection->prepare("UPDATE application
				 SET
				 `status`='Shortlisted',
				 `credit`='$totalCredit' 
				 WHERE `app_id`='$app_id'");
                    $update->execute();
                } else {
                }
            } //End cadre loop


        } //End applicantId loop

        // return $update;
        return true;
    }


    //Get Facility/Cadres by Year
    public function getSelectedApplicantsByYear($year)
    {
        ///////GET Facility FOR CHOICE 1
        $select = $this->connection->prepare("SELECT DISTINCT(faccadreyear.fac_id) as fac_id,facility.category as category,facility.wp_id as wp_id FROM `facility`,faccadreyear
		WHERE
		facility.fac_id=faccadreyear.fac_id AND
		faccadreyear.year='$year'");
        $select->execute();
        //List values
        while ($row = $select->fetch()) {
            $fac_id = $row['fac_id']; //Table Id
            $cat = $row['category'];  //Category of WP, either Ministry, Region, District, Facility
            $wp_id = $row['wp_id'];   //WP Id
            //$startdate=$row['startdate']; //Start date of application
            //$enddate=$row['enddate']; // End date of application

            //echo "Fac_id=".$fac_id."=Category=".$cat."=WP=".$wp_id."<br/>";

            //Get Cadres of WP
            $getCa = $this->connection->prepare("SELECT * FROM `faccadreyear` WHERE `fac_id`='$fac_id' AND year='$year'");
            $getCa->execute();
            while ($rw = $getCa->fetch()) {
                $cadre_id = $rw['cadre_Id'];
                $number = $rw['number'];


                //Get Credit of cadre1 and choice 1
                $getCredit = $this->connection->prepare("SELECT SUM(credit) as sumScore,applicant_id
			 FROM `application` 
			 WHERE
			 category='$cat' AND
			 fac_id='$wp_id'  AND
			 choiceNo=1 AND
			 cadre_id='$cadre_id' AND
			 year='$year' AND
             status='Shortlisted' GROUP BY applicant_id ORDER BY SUM(credit) DESC");
                $getCredit->execute();
                while ($rw1 = $getCredit->fetch()) {
                    $score = $rw1['sumScore'];
                    $applicant_id = $rw1['applicant_id'];


                    //Get application
                    $getA = $this->connection->prepare("SELECT * FROM `application` 
			  WHERE 
			  `category`='$cat' AND 
			  `fac_id`='$wp_id' AND 
			  `cadre_id`='$cadre_id' AND 
			  `choiceNo`=1 AND 
			  `applicant_id`='$applicant_id' AND
			   status='Shortlisted'");
                    $getA->execute();

                    $i = 1;
                    while ($rw2 = $getA->fetch()) {
                        $app_id = $rw2['app_id'];

                        //Get used number
                        $get = $this->connection->prepare("SELECT `number`,`used` FROM `faccadreyear` WHERE `cadre_Id`='$cadre_id' AND `fac_id` ='$fac_id' AND year='$year'");
                        $get->execute();
                        $rowN = $get->fetch();
                        $numVacanc = $rowN['number'];
                        $numUsed = $rowN['used'];

                        if ($numVacanc > $numUsed) {
                            // if ($number >= $i) {
                            //Insert into allocation table
                            $insert = $this->connection->prepare("INSERT INTO allocation(`app_id`,`applicant_id`, `category`,`wp_id`,`cadre_id`,`choiceNo`,`score`,`typeAllocation`,`year`,`selfChoice`)
			   
			   VALUES('$app_id','$applicant_id','$cat','$wp_id','$cadre_id',1,'$score','Online','$year','Yes')
			   ");
                            $insert->execute();

                            $newNum = $numUsed + 1;

                            //Update Used number
                            $up = $this->connection->prepare("UPDATE 
			   faccadreyear 
			   SET 
			   used='$newNum' 
			   WHERE 
			   cadre_Id='$cadre_id' AND
			   fac_id='$fac_id' AND
			   year='$year'");
                            $up->execute();

                            //Update application
                            $seDoc = $this->connection->prepare("UPDATE `application` SET `status`='Accepted' WHERE `applicant_id`='$applicant_id'");
                            $seDoc->execute();

                            $i++;
                        } 
                    }
                }
            }
        } ///END OF INSERTING CHOICE ONE

        // exit;

        //echo "Choice 2 = Fac_id=".$fac_id."=Category=".$cat."=WP=".$wp_id."=Cadre_id=".$cadre_id."<br/>";
        ///STARTING INSERING CHOICE 2
        //Get Credit of cadre and choice 2
        //Get Cadres of WP

        $getCa2 = $this->connection->prepare("SELECT DISTINCT(faccadreyear.fac_id) as fac_id,facility.category as category,facility.wp_id as wp_id,faccadreyear.number as number ,faccadreyear.cadre_Id as cadre_Id FROM `facility`,faccadreyear
		 WHERE
		 facility.fac_id=faccadreyear.fac_id AND
		 faccadreyear.year='$year' AND
         (faccadreyear.number>faccadreyear.used)");
        $getCa2->execute();
        while ($rw = $getCa2->fetch()) {
            $fac_id = $rw['fac_id'];
            $cat = $rw['category'];
            $wp_id = $rw['wp_id'];
            $cadre_id = $rw['cadre_Id'];
            $number = $rw['number'];


            //echo $cadre_id."<br/>";
            $getCredit2 = $this->connection->prepare("SELECT SUM(credit) as sumScore,applicant_id
			 FROM `application` 
			 WHERE
			 category='$cat' AND
			 fac_id='$wp_id'  AND
			 choiceNo=2 AND
			 cadre_id='$cadre_id' AND
			 year='$year' AND
             status='Shortlisted' GROUP BY applicant_id ORDER BY SUM(credit) DESC");
            $getCredit2->execute();
            while ($rw12 = $getCredit2->fetch()) {
                $score = $rw12['sumScore'];
                $applicant_id = $rw12['applicant_id'];

                //echo "Score=".$score."=ApplicantId=".$applicant_id."<br/>";

                //Get application
                $getA2 = $this->connection->prepare("SELECT * FROM `application` 
			  WHERE 
			  `category`='$cat' AND 
			  `fac_id`='$wp_id' AND 
			  `cadre_id`='$cadre_id' AND 
			  `choiceNo`=2 AND 
			  `applicant_id`='$applicant_id' AND
			   status='Shortlisted'");
                $getA2->execute();

                $j = 1;
                while ($rw22 = $getA2->fetch()) {
                    $app_id = $rw22['app_id'];

                    //Get used number
                    $get = $this->connection->prepare("SELECT `number`,`used` FROM `faccadreyear` WHERE `cadre_Id`='$cadre_id' AND `fac_id` ='$fac_id' AND year='$year'");
                    $get->execute();
                    $rowN = $get->fetch();
                    $numVacanc = $rowN['number'];
                    $numUsed = $rowN['used'];

                    if ($numVacanc > $numUsed) {
                        // if ($number >= $j) {
                        //Insert into allocation table

                        $insert = $this->connection->prepare("INSERT INTO allocation(`app_id`, `applicant_id`,`category`,`wp_id`,`cadre_id`, `choiceNo`, `score`, `typeAllocation`, `year`, `selfChoice`)
			   
			   VALUES('$app_id','$applicant_id','$cat','$wp_id','$cadre_id',2,'$score','Online',
			   '$year','Yes')");
                        $insert->execute();

                        $newNum = $numUsed + 1;

                        //Update Used number
                        $up = $this->connection->prepare("UPDATE 
			   faccadreyear 
			   SET 
			   used='$newNum' 
			   WHERE 
			   cadre_Id='$cadre_id' AND
			   fac_id='$fac_id' AND year='$year'");
                        $up->execute();


                        //Update application
                        $seDoc = $this->connection->prepare("UPDATE `application` SET `status`='Accepted' WHERE `applicant_id`='$applicant_id'");
                        $seDoc->execute();

                        $j++;
                    }
                }
            } ///END OF INSERTING CHOICE TWO
        }


        //echo "Choice 3 = Fac_id=".$fac_id."=Category=".$cat."=WP=".$wp_id."=Cadre_id=".$cadre_id."<br/>";

        ///STARTING INSRTING CHOICE 3
        //Get Credit of cadre and choice 3
        //Get Cadres of WP
        $getCa3 = $this->connection->prepare("SELECT DISTINCT(faccadreyear.fac_id) as fac_id,facility.category as category,facility.wp_id as wp_id,faccadreyear.number as number ,faccadreyear.cadre_Id as cadre_Id FROM `facility`,faccadreyear
		 WHERE
		 facility.fac_id=faccadreyear.fac_id AND
		 faccadreyear.year='$year' AND
         (faccadreyear.number>faccadreyear.used)");
        $getCa3->execute();
        while ($rw = $getCa3->fetch()) {
            $fac_id = $rw['fac_id'];
            $cat = $rw['category'];
            $wp_id = $rw['wp_id'];
            $cadre_id = $rw['cadre_Id'];
            $number = $rw['number'];


            //echo $cadre_id."<br/>";
            $getCredit3 = $this->connection->prepare("SELECT SUM(credit) as sumScore,applicant_id
			 FROM `application` 
			 WHERE
			 category='$cat' AND
			 fac_id='$wp_id'  AND
			 choiceNo=3 AND
			 cadre_id='$cadre_id' AND
			 year='$year' AND
             status='Shortlisted' GROUP BY applicant_id ORDER BY SUM(credit) DESC");
            $getCredit3->execute();
            while ($rw12 = $getCredit3->fetch()) {
                $score = $rw12['sumScore'];
                $applicant_id = $rw12['applicant_id'];

                //echo "Score=".$score."=ApplicantId=".$applicant_id."<br/>";

                //Get application
                $getA2 = $this->connection->prepare("SELECT * FROM `application` 
			  WHERE 
			  `category`='$cat' AND 
			  `fac_id`='$wp_id' AND 
			  `cadre_id`='$cadre_id' AND 
			  `choiceNo`=3 AND 
			  `applicant_id`='$applicant_id' AND
			   status='Shortlisted'");
                $getA2->execute();

                $j = 1;
                while ($rw22 = $getA2->fetch()) {
                    $app_id = $rw22['app_id'];
                    //Get used number
                    $get = $this->connection->prepare("SELECT `number`,`used` FROM `faccadreyear` WHERE `cadre_Id`='$cadre_id' AND `fac_id` ='$fac_id' AND year='$year'");
                    $get->execute();
                    $rowN = $get->fetch();
                    $numVacanc = $rowN['number'];
                    $numUsed = $rowN['used'];

                    if ($numVacanc > $numUsed) {
                        // if ($number >= $j) {
                        //Insert into allocation table

                        $insert = $this->connection->prepare("INSERT INTO allocation(`app_id`, `applicant_id`,`category`,`wp_id`,`cadre_id`, `choiceNo`, `score`, `typeAllocation`, `year`, `selfChoice`)
			   
			   VALUES('$app_id','$applicant_id','$cat','$wp_id','$cadre_id',3,'$score','Online',
			   '$year','Yes')");
                        $insert->execute();

                        $newNum = $numUsed + 1;

                        //Update Used number
                        $up = $this->connection->prepare("UPDATE 
			   faccadreyear 
			   SET 
			   used='$newNum' 
			   WHERE 
			   cadre_Id='$cadre_id' AND
			   fac_id='$fac_id' AND year='$year'");
                        $up->execute();


                        //Update application
                        $seDoc = $this->connection->prepare("UPDATE `application` SET `status`='Accepted' WHERE `applicant_id`='$applicant_id'");
                        $seDoc->execute();

                        $j++;
                    }
                }
            } ///END OF INSERTING CHOICE THREE
        }


        //INSERT APPLICANTS AFTER INSERTING ALL APPLICANTS OF ALL CHOICES
        //Get Cadres of WP
        $getCa3 = $this->connection->prepare("SELECT DISTINCT(faccadreyear.fac_id) as fac_id,facility.category as category,facility.wp_id as wp_id,faccadreyear.number as number ,faccadreyear.cadre_Id as cadre_Id FROM `facility`,faccadreyear
		 WHERE
		 facility.fac_id=faccadreyear.fac_id AND
		 faccadreyear.year='$year' AND
         (faccadreyear.number > faccadreyear.used)");
        $getCa3->execute();
        while ($rw = $getCa3->fetch()) {
            $fac_id = $rw['fac_id'];
            $cat = $rw['category'];
            $wp_id = $rw['wp_id'];
            $cadre_id = $rw['cadre_Id'];
            
            $getCredit3 = $this->connection->prepare("SELECT SUM(credit) as sumScore,applicant_id
			 FROM `application` 
			 WHERE
			 category='$cat' AND
			 fac_id='$wp_id'  AND
			 cadre_id='$cadre_id' AND
			 year='$year' AND
             status='Shortlisted' GROUP BY applicant_id ORDER BY SUM(credit) DESC");
            $getCredit3->execute();
            while ($rw12 = $getCredit3->fetch()) {
                $score = $rw12['sumScore'];
                $applicant_id = $rw12['applicant_id'];

                //Get application
                $getA2 = $this->connection->prepare("SELECT * FROM `application` 
			  WHERE 
			  `category`='$cat' AND 
			  `fac_id`='$wp_id' AND 
			  `cadre_id`='$cadre_id' AND 
			  `applicant_id`='$applicant_id' AND
			   status='Shortlisted'");
                $getA2->execute();

                $j = 1;
                while ($rw22 = $getA2->fetch()) {
                    $app_id = $rw22['app_id'];
                    $choiceNo = $rw22['choiceNo'];
                    //Get used number
                    $sqli="SELECT `number`,`used` FROM `faccadreyear` WHERE `cadre_Id`='$cadre_id' AND `fac_id` ='$fac_id' AND year='$year'";
                    $get = $this->connection->prepare($sqli);
                    $get->execute();
                    $rowN = $get->fetch();
                    $numVacanc = $rowN['number'];
                    $numUsed = $rowN['used'];
                    
                    if ($numVacanc > $numUsed) {
                        // if ($number >= $j) {
                        //Insert into allocation table

                        $insert = $this->connection->prepare("INSERT INTO allocation(`app_id`, `applicant_id`,`category`,`wp_id`,`cadre_id`, `choiceNo`, `score`, `typeAllocation`, `year`, `selfChoice`)
			   
			   VALUES('$app_id','$applicant_id','$cat','$wp_id','$cadre_id','$choiceNo','$score','Online',
			   '$year','Yes')");
                        $insert->execute();

                        $newNum = $numUsed + 1;

                        //Update Used number
                        $up = $this->connection->prepare("UPDATE 
			   faccadreyear 
			   SET 
			   used='$newNum' 
			   WHERE 
			   cadre_Id='$cadre_id' AND
			   fac_id='$fac_id' AND year='$year'");
                        $up->execute();


                        //Update application
                        $seDoc = $this->connection->prepare("UPDATE `application` SET `status`='Accepted' WHERE `applicant_id`='$applicant_id'");
                        $seDoc->execute();

                        $j++;
                    }
                }
            } ///END OF INSERTING CHOICE 
            
        }

        return $insert;
    }

    public function getReports($post)
    {
        $year = $post['year'];
        $category = $post['category'];
        isset($post['facility_type']) ? $facility_type = $post['facility_type'] : $facility_type = 'All';
        $cadres = $post['cadres'];
        $application_status = $post['application_status'];
        $allocation_status = $post['allocation_status'];
        $gender = $post['gender'];
        $disability = $post['disability'];
        $disability_type = $post['disability_type'];
        $age_from = $post['age_from'];
        $age_to = $post['age_to'];
        $citizenship = $post['citizenship'];
        $citizenship_type = $post['citizenship_type'];

        if ($category != 'All') {
            $where_category = " AND `category`='$category' ";
        } else {
            $where_category = "";
        }
        if ($facility_type != 'All') {
            $where_facility_type = " AND `fac_id`='$facility_type' ";
        } else {
            $where_facility_type = "";
        }
        if ($cadres != 'All') {
            $where_cadre = " AND `cadre_id`='$cadres' ";
        } else {
            $where_cadre = "";
        }

        if ($gender != 'All') {
            $where_gender = " AND `gender`='$gender' ";
        } else {
            $where_gender = "";
        }
        if ($citizenship != 'All') {
            if ($citizenship == 'Tanzanian') {
                if ($citizenship_type == 'All') {
                    $where_citizenship = " AND `nationality` = '1375' ";
                } else {
                    $where_citizenship = " AND `nationality` = '1375' AND `country` = '$citizenship_type' ";
                }
            } else {
                $where_citizenship = " AND `nationality` <> '1375' ";
            }
        } else {
            $where_citizenship = "";
        }

        if ($disability != 'ignore') {
            if ($disability == 'yes') {
                if ($disability_type == 'All') {
                    $where_disability = " AND `disiability` = 'YES' ";
                } else {
                    $where_disability = " AND `disiability` = 'YES' AND disiability_type = '$disability_type' ";
                }
            } else {
                $where_disability = " AND `disiability` = 'NO' ";
            }
        } else {
            $where_disability = "";
        }


        if ($age_from != '' && $age_to != '') {
            $where_age = "AND YEAR(CURDATE()) - YEAR(dob) BETWEEN '$age_from' AND '$age_to' ";
        } else {
            $where_age = "";
        }

        if ($application_status == 'All') {
            $table = "";
            $applicant_id = "";
            $join_where = "";
            $where_status = "";
            $group_by = "";
            $where_category = "";
            $where_facility_type = "";
            $where_cadre = "";
            $where_year = " YEAR(regdate)='$year' ";
            $from = " applicants ";
        } elseif ($application_status == 'Inprogress') {
            $where_category = "";
            $where_facility_type = "";
            $where_cadre = "";
            $table = "application";
            $applicant_id = "applicant_id,";
            $from = " $table ,`applicants` ";
            $where_year = " AND YEAR(regdate)='$year' ";
            $join_where = "";
            $where_status = "";
            $group_by = "";
        } else {
            if ($application_status != 'Allocated') {
                $table = "application";
                $where_status = " AND `status`='$application_status' ";
            } else {
                $table = "allocation";
                if ($allocation_status != 'All') {
                    $where_status = " AND `allocation_status`='$allocation_status' ";
                } else {
                    $where_status = "";
                }

                // in allocation table we use wp_id instead of fac_id
                if ($facility_type != 'All') {
                    $where_facility_type = " AND `wp_id`='$facility_type' ";
                } else {
                    $where_facility_type = "";
                }
            }
            $applicant_id = " applicant_id,";
            $group_by = " GROUP BY applicant_id";
            $where_year = " AND `year`='$year' ";
            $join_where = " applicants.id = $table . applicant_id ";
            $from = " $table ,`applicants` ";
        }

        $where = $join_where . $where_year . $where_citizenship . $where_category . $where_gender . $where_disability . $where_facility_type . $where_cadre . $where_status . $where_age;

        if ($application_status != 'Inprogress') {
            $sql = "SELECT $applicant_id YEAR(CURDATE()) - YEAR(dob) AS age, applicants.* FROM $from WHERE $where $group_by ";
        } else {
            $sql = "SELECT * from applicants WHERE id NOT IN (SELECT DISTINCT(application.applicant_id) FROM applicants INNER JOIN application ON applicants.id = application.applicant_id) $where";
        }
        // echo $sql;
        $select = $this->connection->prepare($sql);
        $select->execute();
        return $select;
    }

    //Get applicant application
    public function getApplicantAplication($applicant_id, $pmYear, $status)
    {
        if ($status != 'All') {
            $where_status =  " AND `status`='$status' ";
        } else {
            $where_status = "";
        }

        $sql = "SELECT * FROM `application` WHERE `applicant_id`='$applicant_id' AND `year`='$pmYear' $where_status ORDER BY choiceNo ASC";
        $select = $this->connection->prepare($sql);
        $select->execute();
        return $select;
    }

    //Get applicant application
    public function getApplicantAllocation($applicant_id, $pmYear)
    {
        $sql = "SELECT * FROM `allocation` WHERE `applicant_id`='$applicant_id' AND `year`='$pmYear' ";
        $select = $this->connection->prepare($sql);
        $select->execute();
        return $select;
    }

    public function countInProgressApplicants($year, $gender)
    {
        if ($gender != '') {
            $where_gender = " AND `gender`='$gender' ";
        } else {
            $where_gender = "";
        }

        $where_year = " AND YEAR(regdate)='$year' ";
        $where = $where_gender . $where_year;
        $sql = "SELECT * from applicants WHERE id NOT IN (SELECT DISTINCT(application.applicant_id) FROM applicants INNER JOIN application ON applicants.id = application.applicant_id) $where";

        $select = $this->connection->prepare($sql);
        $select->execute();
        return $select;
    }

    public function countComplitedApplicants($year, $gender)
    {
        if ($gender != '') {
            $where_gender = " AND `gender`='$gender' ";
        } else {
            $where_gender = "";
        }

        $where_year = " AND year='$year' ";
        $where = $where_gender . $where_year;
        $sql = "SELECT DISTINCT(applicant_id) FROM application ,`applicants` WHERE applicants.id = application.applicant_id $where";

        $select = $this->connection->prepare($sql);
        $select->execute();
        return $select;
    }

    public function countApplicationsByCadre($cadreId, $year, $gender)
    {
        if ($gender != '') {
            $where_gender = " AND `gender`='$gender' ";
        } else {
            $where_gender = "";
        }

        $where_year = " AND year='$year' ";
        $where_cadre = " AND cadre_id='$cadreId' ";

        $where = $where_gender . $where_year . $where_cadre;
        $sql = "SELECT DISTINCT(applicant_id) FROM application ,`applicants` WHERE applicants.id = application.applicant_id $where";

        $select = $this->connection->prepare($sql);
        $select->execute();
        return $select;
    }
}
