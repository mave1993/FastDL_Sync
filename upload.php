<?php
include("config.php");
?> Neue Map hochladen auf <b><?php echo $gameserver['user']."@".$gameserver['host'].":".$gameserver['port']; ?></b> und <b><?php echo $webserver['user']."@".$webserver['host'].":".$webserver['port']; ?></b><br /><br />

<form name="form1" enctype="multipart/form-data" method="post" action="">
  <label>
  <input type="file" name="datei">
  </label>
  <br>
  <label>
  <input type="submit" name="uploadm" value="Hochladen">
  </label>
</form>

<?php
if($_POST['uploadm'])
{
if(move_uploaded_file($_FILES['datei']['tmp_name'], "temp/".$_FILES['datei']['name']))
{
echo "Hochgeladen: temp<br />";
$gameserver_ftp = ftp_connect ( $gameserver['host'], $gameserver['port'] );
$gameserver_ftp_login = ftp_login ( $gameserver_ftp, $gameserver['user'], $gameserver['passwort'] );
$gameserver_ftp_list = ftp_rawlist ( $gameserver_ftp, $gameserver['pfad'] );
$webserver_ftp = ftp_connect ( $webserver['host'], $webserver['port'] );
$webserver_ftp_login = ftp_login ( $webserver_ftp, $webserver['user'], $webserver['passwort'] );
$webserver_ftp_list = ftp_rawlist ( $webserver_ftp, $webserver['pfad'] );
ftp_put ( $gameserver_ftp , $gameserver['pfad']."/".$_FILES['datei']['name'] , $webserver['root_pfad'].$_FILES['datei']['name'] , FTP_ASCII );
echo "Hochgeladen: FTP Gameserver<br />";
shell_exec("cd ".$webserver['root_pfad']." && bzip2 ".$_FILES['datei']['name']);
echo "Hochgeladen: bzip2 verpackt<br />";
ftp_put ( $webserver_ftp , $webserver['pfad']."/".$_FILES['datei']['name'].".bz2" , $webserver['root_pfad'].$_FILES['datei']['name'].".bz2" , FTP_ASCII );
echo "Hochgeladen: FTP Webserver<br />";
@unlink("temp/".$_FILES['datei']['name'].".bz2");
echo "Hochgeladen: L&ouml;schen temp Datei<br />";
echo "Info: Eine Synchronisation ist nicht mehr Notwendig!<br />";
}
}
?>
