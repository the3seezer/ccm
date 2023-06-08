<li class="dropdown">
   <a class="dropdown-toggle" data-toggle="dropdown" href="#">
    <i class="fa fa-user fa-fw"></i><?php echo stripslashes($_SESSION['fullname']); ?><b class="caret"></b>
   </a>
   <ul class="dropdown-menu dropdown-user">
    <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i>User Profile</a></li> -->
    <li><a href="?pg=changePassword"><i class="fa fa-gear fa-fw"></i>Change Password</a></li>
    <li class="divider"></li>
    <li><a href="includes/logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a></li>
  </ul>
</li>