Dieses Script bietet die m�glichkeit die Maps von einem CS: Source Gameserver mit einem FastDL Server zu synchroniesieren und auch direkt BZIP2 zu verpacken. Durch einfaches anpassen der config.php sind keine weiteren Kentnisse in Sachen Programmierung erforderlich!

Nach neuem Update besteht nun auch die m�glichkeit eine neue Map hochzuladen. Diese wird auf den Gameserver und auf den Webserver (bzip2) geladen!

Installation:
-Config.php anpassen
-temp Ordner CHMod 0777
-maps Ordner auf FastDL Server CHMod 0777
-Das Script Mittels .htacces und .htpasswd sichern!

Bei Problemen mit eintragen vom root Pfad gibt es eine Abhilfe f�r die config.php

$doc_root = $_SERVER['DOCUMENT_ROOT']."/temp/";
$webserver['root_pfad'] = "$doc_root"; // Wo der Temp Ordner liegt (Muss CHMod 0777)

Vorraussetzungen:
Der Server auf dem das Script l�uft muss Shell_exec erlauben und bzip2 unterst�tzen!