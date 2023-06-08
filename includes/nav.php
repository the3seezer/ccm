<?php 
if (!isset($_GET['pg'])) {
    $pg = 'dash';
}else{
    $pg = $_GET['pg'];
}
?>
<div class="sidebar-nav navbar-collapse">
    <ul class="nav" id="side-menu">
        <li class="sidebar-search"><strong>Menu</strong></li>
       

            <li><a href="?pg=dash"><i class="fa fa-home fa-fw"></i>Nyumbani</a></li>

           <?php if($_SESSION['aina']=="Tehama")
		   {?>
             
            <li><a href="#"><i class="fa fa-gear fa-fw"></i>Utawala<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
			    <li><a href="?pg=regUser">Watumiaji</a></li>
                
               
				
               i 
           </ul> </li>
		   <li><a href="#"><i class="fa fa-wrench fa-fw"></i>Ngazi za CCM<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
			   
                <li><a href="?pg=mngReg">Mkoa</a></li>
                <li><a href="?pg=mngDis">Wilaya</a></li>
                <li><a href="?pg=mngJimbo">Jimbo</a></li>
                <li><a href="?pg=mngTarafa">Tarafa</a></li>
				<li><a href="?pg=mngKata">Kata</a></li>
                <li><a href="?pg=mngMtaa">Mtaa/Kijiji</a></li>
                
                <li><a href="?pg=mngTawi">Tawi</a></li>
				
                
           </ul> </li>
		   <?php 
		   } 
		   if($_SESSION['aina']=="Mgombea")
		   {?>
		   
		   <li><a href="?pg=pDetailUtambulisho" class="active"><i class="fa fa-user fa-fw"></i>Utambulisho</a></li>
            <li><a href="?pg=bEd"><i class="fa fa-book fa-fw"></i> Elimu</a></li>
			
            <li><a href="?pg=bUchama"><i class="fa fa-graduation-cap fa-fw"></i> Uwanachama</a></li>
            <li><a href="?pg=Picha"><i class="fa fa-files-o fa-fw"></i> Vyeti</a></li>
			<li><a href="pages/manageProfileFull.php" target="_blank"><i class="fa fa-file-text-o fa-fw"></i> Profile</a></li>
		   <?php 
		   }
		   
		  if($_SESSION['aina']=="Tehama")
		  {
			  if($_SESSION['kazi']=="Super")
			  {
			  ?>
		<!-- <li><a href="?pg=bthibitisha"><i class="fa fa-thumbs-o-up fa-fw"></i>Uthibitisho wa Mgombea</a></li> -->
			<li><a href="#"><i class="fa fa-comments fa-fw"></i>Maoni na Uteuzi<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
		    
            <li><a href="?pg=bMaoni"><i class="fa fa-comment-o fa-fw"></i>Maoni ya Vikao Awali</a></li>
			<li><a href="?pg=bKurajumla"><i class="fa fa-hashtag fa-fw"></i>Jumla ya Kura</a></li>
			<li><a href="?pg=bKuramgombea"><i class="fa fa-edit fa-fw"></i>Kura za Wagombea</a></li>
			<li><a href="?pg=bUteuzi"><i class="fa fa-odnoklassniki fa-fw"></i>Uteuzi</a></li>
            
             </ul> </li> 
         <?php
			 }		 
		  }	  
		  if($_SESSION['aina']=="Kiongozi")
		   {
			   if($_SESSION['kazi']=="kuingiza")
			  {
			   ?>
      
		   <!-- <li><a href="?pg=bthibitisha"><i class="fa fa-thumbs-o-up fa-fw"></i>Uthibitisho wa Mgombea</a></li> -->
			<li><a href="#"><i class="fa fa-comments fa-fw"></i>Maoni na Uteuzi<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
		    <?php if(($_SESSION['kikawali']=="Yes")||($_SESSION['kikpili']=="Yes")||($_SESSION['kiktatu']=="Yes")||($_SESSION['kamatikz']=="Yes")||($_SESSION['kikuteuzi']=="Yes"))
			{?>    
            <li><a href="?pg=bMaoni"><i class="fa fa-comment-o fa-fw"></i>Maoni ya Vikao Awali</a></li>
			<?php} if($_SESSION['matokeo']=="Yes") {?>
			<li><a href="?pg=bKurajumla"><i class="fa fa-hashtag fa-fw"></i>Jumla ya Kura</a></li>
			<li><a href="?pg=bKuramgombea"><i class="fa fa-edit fa-fw"></i>Kura za Wagombea</a></li>
			<?php } 
			
			if(($_SESSION['kibawali']=="Yes")||($_SESSION['kibpili']=="Yes")||($_SESSION['kibtatu']=="Yes")||($_SESSION['kamatibz']=="Yes")||($_SESSION['kamatibtaifa']=="Yes")||($_SESSION['kibuteuzi']=="Yes"))  {?>
			<li><a href="?pg=bUteuzi"><i class="fa fa-odnoklassniki fa-fw"></i>Uteuzi</a></li>
            <?php 
		    } 
			?>
             </ul> </li>
		   <?php 
		    } 
		   }
            if($_SESSION['aina']=="Mgombea")
		   {
		   }
		   else{
           ?>
		   <li><a href="#"><i class="fa fa-sitemap fa-fw"></i>Report<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
			<li><a href="?pg=wago"><i class="fa fa-user fa-fw"></i>Wagombea</a></li>
			<li><a href="?pg=mato"><i class="fa fa-table fa-fw"></i>Matokeo</a></li>
			<li><a href="?pg=teuliwa"><i class="fa fa-check-square-o fa-fw"></i>Walioteuliwa</a></li>
			<li><a href="?pg=mapato"><i class="fa fa-dollar fa-fw"></i>Mapato</a></li>
			</ul>
			</li>
		   <?php
		   }
		   ?>
        
        
    </ul>
</div>