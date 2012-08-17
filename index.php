<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Adverts Webinterface</title>
<meta http-equiv="Content-Language" content="English" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
</head>
<body>

<div id="wrap">

<div id="header">
<h1><a href="#">Synchron Webinterface</a></h1>
<h2>Synchronisiere hier dein FastDL</h2>
</div>

<div id="top"> </div>
<div id="menu">
<ul>
<li><a href="index.php">Synchron</a></li>
<li><a href="index.php?page=upload">Neue Map uploaden</a></li>
</ul>
</div>

<div id="content">
<div class="left"> 
<?php
              if(empty($_GET['page']))
			  {
				  include('sync.php');
			  }else{
				  if(file_exists($_GET['page'].'.php'))
				  {
					  include($_GET['page'].'.php');
				  }else{
					  include('sync.php');
				  }
			  }
?>
</div>

<div class="right"> 
<h2>Links</h2>
<a href="http://mave1993.de">Webinterface coded by Mave1993.de</a>
</div>
<div style="clear: both;"> </div>
</div>

<div id="bottom"> </div>
<div id="footer">
Designed by <a href="http://www.free-css-templates.com/">Free CSS Templates</a>, Thanks to <a href="http://www.openwebdesign.org/">Custom Web Design</a>
</div>
</div>

</body>
</html>