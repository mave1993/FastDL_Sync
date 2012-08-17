<?php
include("config.php");
?>
Achtung, Sollten die Dateien Synchronisiert werden und eine Fehlermeldung angezeigt werden, ist die m&ouml;glichkeit sehr hoch, das ein Ordner nicht Synchronisiert wurde, diese sind von diesem Script ausgeschlossen!
<br /><br />
Synchronieren von <b><?php echo $gameserver['user']."@".$gameserver['host'].":".$gameserver['port']; ?></b> auf <b><?php echo $webserver['user']."@".$webserver['host'].":".$webserver['port']; ?></b><br /><br />
<table width="100%" border="0">
  <tr>
    <td><p class="text7"><h3>M&ouml;chtest du die Dateien Synchronisieren?</h3>Dies kann je nach Verbindung und anzahl und gr&ouml;&szlig;e der Dateien bis zu 3+ Minuten dauern!</p>
      <form id="form1" name="form1" method="post" action="">
        <label>
          <input type="submit" name="ja" value="Synchronisieren!" />
        </label>
    </form>      <p>&nbsp; </p></td>
  </tr>
</table>


<?php
if($_POST['ja'])
{
//FTP Verbindungen herstellen
$gameserver_ftp = ftp_connect ( $gameserver['host'], $gameserver['port'] );
$gameserver_ftp_login = ftp_login ( $gameserver_ftp, $gameserver['user'], $gameserver['passwort'] );
$gameserver_ftp_list = ftp_rawlist ( $gameserver_ftp, $gameserver['pfad'] );

$webserver_ftp = ftp_connect ( $webserver['host'], $webserver['port'] );
$webserver_ftp_login = ftp_login ( $webserver_ftp, $webserver['user'], $webserver['passwort'] );
$webserver_ftp_list = ftp_rawlist ( $webserver_ftp, $webserver['pfad'] );

//Daten Laden und verpacken
foreach($gameserver_ftp_list as $datei){
$dateieinzel=preg_split ('°[\s]+°', $datei);
$gameserver_dateien = $dateieinzel[count($dateieinzel)-1];
ftp_get ( $gameserver_ftp, "temp/".$gameserver_dateien , $gameserver['pfad']."/".$gameserver_dateien , FTP_ASCII );
shell_exec("cd ".$webserver['root_pfad']." && bzip2 ".$gameserver_dateien);
ftp_put ( $webserver_ftp , $webserver['pfad']."/".$gameserver_dateien.".bz2" , $webserver['root_pfad'].$gameserver_dateien.".bz2" , FTP_ASCII );
@unlink("temp/".$gameserver_dateien.".bz2");
}
echo "<br /><br /><h2>Erfolgreich Synchronisiert!</h2>";
}
?>