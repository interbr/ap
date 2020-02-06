<!-- It works with etherpad Version 1.5.7 and nodejs 0.12.18 and nginx with the addition to a common php-site below. "sendmail" is set to be used and needed. Working with php7. Mysql-initialation with /content/sql.txt. Databasename set to be used is amored-police, database-user ap-db-client, don't you try to find someone who translates this and then read it? READ? You are a computerspecialist!  https://twitter.com/Weltpolizei/status/1222995546820030479 -->

<?php
$dbpw = '';
$aphost = ''; //for example 'https://www.amored-police.org
$etherpadhost = ''; //for example https://www.amored-police.org/pad this and the following two datas are for cookies and subdomains (I don't remember if another domain can work).
$etherpadapihost = ''; //for example https://www.amored-police.org/pad
$etherpadcookiehost = ''; //for example www.amored-police.org (no http:// or https://
$etherpadapikey = ''; //this is set in /etherpad-lite/APIKEY.txt. The Author of this software (Amored Police) is not the most qualified coder = in line 12 in file /php/answering-system.php this value has to be set manually

$activeAgentsReq = '9';
$sitetitle = 'Amored Police Hilfsorganisationen, Journalistische Medien und Nachrichtendienste/Sicherheitsbehörden staawüdigrntse - freier Kommunikationsbereich, Weiterleitbare Frage mit fünf Beantwortern thematisch und nach Qualitäten der Beantwortenden vorsortiert, Arbeitszeitenankündigung, gemeinsam einen Text schreiben können, in dem bereits eine Frage steht, in einer E-Mail mit der Antwort kann die Frage mit Antwort zur Verfügung für eine Datenbank gestellt werden. Zeitpunkt: Der Autor hat keinen blassen Schimmer als dass die Software eventuell global mit gemeinsamer Datenbank genutzt wird und es eine staatswürdige Nutzung einer Datenbank von Möglichkeiten das Leben zu verbessern entstand und hier entsteht wie es gäbe das Notrufsystem für alle Probleme des Menschen entsteht. Das wäre schon gut.'; //Please change this
$titleslogan = 'Amored Police';
$bodyslogan = 'Help-Desk for Earth\' Peoples Problems (except IT)';
$contactemail = ''; //Email in footer
$siteemail = ''; //Email in Emails by the system
?>

<!--

location ^~ /pad {
		proxy_pass             http://localhost:9001/;
		proxy_set_header       Host $host;
		proxy_pass_header Server;
		proxy_buffering off;
		proxy_set_header X-Real-IP $remote_addr;  
		proxy_set_header Host $host;  	
		proxy_http_version 1.1;  
		proxy_set_header Upgrade $http_upgrade;
		rewrite /pad/(.*) /$1 break;
		rewrite ^/pad$ /pad/ permanent; 
		proxy_redirect / /pad/;
        }
	location /pad/admin {
		proxy_pass	http://localhost:9001/admin;
                }

https://github.com/ether/etherpad-lite/wiki/How-to-deploy-Etherpad-Lite-as-a-service

https://www.deezer.com/de/album/935820
https://www.deezer.com/de/profile/217026135

-->
