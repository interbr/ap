<?php 
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/../php/question.php'); // a functions file
require_once(__ROOT__.'/../php/configuration.php'); //a file with configurations
$dbhandle = new mysqli('localhost', 'ap-db-client', $GLOBALS["dbpw"], 'amored-police');

$timenowm12c = mktime(gmdate("H")-12, 0, 0, 0, 0, 0);
$timenowm12 = gmdate("H", $timenowm12c);
if($timenowm12 >= 0 && $timenowm12 < 6) { $timenowm12q = '0-6'; } else if($timenowm12 >= 6 && $timenowm12 < 10) { $timenowm12q = '6-10'; } else if($timenowm12 >= 10 && $timenowm12 < 12) { $timenowm12q = '10-12'; } else if($timenowm12 >= 12 && $timenowm12 < 15) { $timenowm12q = '12-15'; } else if($timenowm12 >= 15 && $timenowm12 < 18) { $timenowm12q = '15-18'; } else if($timenowm12 >= 18 && $timenowm12 < 20) { $timenowm12q = '18-20'; } else if($timenowm12 >= 20 && $timenowm12 < 22) { $timenowm12q = '20-22'; } else if($timenowm12 >= 22 && $timenowm12 < 24) { $timenowm12q = '22-24'; } ;
$timenowm11c = mktime(gmdate("H")-11, 0, 0, 0, 0, 0);
$timenowm11 = gmdate("H", $timenowm11c);
if($timenowm11 >= 0 && $timenowm11 < 6) { $timenowm11q = '0-6'; } else if($timenowm11 >= 6 && $timenowm11 < 10) { $timenowm11q = '6-10'; } else if($timenowm11 >= 10 && $timenowm11 < 12) { $timenowm11q = '10-12'; } else if($timenowm11 >= 12 && $timenowm11 < 15) { $timenowm11q = '12-15'; } else if($timenowm11 >= 15 && $timenowm11 < 18) { $timenowm11q = '15-18'; } else if($timenowm11 >= 18 && $timenowm11 < 20) { $timenowm11q = '18-20'; } else if($timenowm11 >= 20 && $timenowm11 < 22) { $timenowm11q = '20-22'; } else if($timenowm11 >= 22 && $timenowm11 < 24) { $timenowm11q = '22-24'; } ;
$timenowm10c = mktime(gmdate("H")-10, 0, 0, 0, 0, 0);
$timenowm10 = gmdate("H", $timenowm10c);
if($timenowm10 >= 0 && $timenowm10 < 6) { $timenowm10q = '0-6'; } else if($timenowm10 >= 6 && $timenowm10 < 10) { $timenowm10q = '6-10'; } else if($timenowm10 >= 10 && $timenowm10 < 12) { $timenowm10q = '10-12'; } else if($timenowm10 >= 12 && $timenowm10 < 15) { $timenowm10q = '12-15'; } else if($timenowm10 >= 15 && $timenowm10 < 18) { $timenowm10q = '15-18'; } else if($timenowm10 >= 18 && $timenowm10 < 20) { $timenowm10q = '18-20'; } else if($timenowm10 >= 20 && $timenowm10 < 22) { $timenowm10q = '20-22'; } else if($timenowm10 >= 22 && $timenowm10 < 24) { $timenowm10q = '22-24'; } ;
$timenowm9c = mktime(gmdate("H")-9, 0, 0, 0, 0, 0);
$timenowm9 = gmdate("H", $timenowm9c);
if($timenowm9 >= 0 && $timenowm9 < 6) { $timenowm9q = '0-6'; } else if($timenowm9 >= 6 && $timenowm9 < 10) { $timenowm9q = '6-10'; } else if($timenowm9 >= 10 && $timenowm9 < 12) { $timenowm9q = '10-12'; } else if($timenowm9 >= 12 && $timenowm9 < 15) { $timenowm9q = '12-15'; } else if($timenowm9 >= 15 && $timenowm9 < 18) { $timenowm9q = '15-18'; } else if($timenowm9 >= 18 && $timenowm9 < 20) { $timenowm9q = '18-20'; } else if($timenowm9 >= 20 && $timenowm9 < 22) { $timenowm9q = '20-22'; } else if($timenowm9 >= 22 && $timenowm9 < 24) { $timenowm9q = '22-24'; } ;
$timenowm8c = mktime(gmdate("H")-8, 0, 0, 0, 0, 0);
$timenowm8 = gmdate("H", $timenowm8c);
if($timenowm8 >= 0 && $timenowm8 < 6) { $timenowm8q = '0-6'; } else if($timenowm8 >= 6 && $timenowm8 < 10) { $timenowm8q = '6-10'; } else if($timenowm8 >= 10 && $timenowm8 < 12) { $timenowm8q = '10-12'; } else if($timenowm8 >= 12 && $timenowm8 < 15) { $timenowm8q = '12-15'; } else if($timenowm8 >= 15 && $timenowm8 < 18) { $timenowm8q = '15-18'; } else if($timenowm8 >= 18 && $timenowm8 < 20) { $timenowm8q = '18-20'; } else if($timenowm8 >= 20 && $timenowm8 < 22) { $timenowm8q = '20-22'; } else if($timenowm8 >= 22 && $timenowm8 < 24) { $timenowm8q = '22-24'; } ;
$timenowm7c = mktime(gmdate("H")-7, 0, 0, 0, 0, 0);
$timenowm7 = gmdate("H", $timenowm7c);
if($timenowm7 >= 0 && $timenowm7 < 6) { $timenowm7q = '0-6'; } else if($timenowm7 >= 6 && $timenowm7 < 10) { $timenowm7q = '6-10'; } else if($timenowm7 >= 10 && $timenowm7 < 12) { $timenowm7q = '10-12'; } else if($timenowm7 >= 12 && $timenowm7 < 15) { $timenowm7q = '12-15'; } else if($timenowm7 >= 15 && $timenowm7 < 18) { $timenowm7q = '15-18'; } else if($timenowm7 >= 18 && $timenowm7 < 20) { $timenowm7q = '18-20'; } else if($timenowm7 >= 20 && $timenowm7 < 22) { $timenowm7q = '20-22'; } else if($timenowm7 >= 22 && $timenowm7 < 24) { $timenowm7q = '22-24'; } ;
$timenowm6c = mktime(gmdate("H")-6, 0, 0, 0, 0, 0);
$timenowm6 = gmdate("H", $timenowm6c);
if($timenowm6 >= 0 && $timenowm6 < 6) { $timenowm6q = '0-6'; } else if($timenowm6 >= 6 && $timenowm6 < 10) { $timenowm6q = '6-10'; } else if($timenowm6 >= 10 && $timenowm6 < 12) { $timenowm6q = '10-12'; } else if($timenowm6 >= 12 && $timenowm6 < 15) { $timenowm6q = '12-15'; } else if($timenowm6 >= 15 && $timenowm6 < 18) { $timenowm6q = '15-18'; } else if($timenowm6 >= 18 && $timenowm6 < 20) { $timenowm6q = '18-20'; } else if($timenowm6 >= 20 && $timenowm6 < 22) { $timenowm6q = '20-22'; } else if($timenowm6 >= 22 && $timenowm6 < 24) { $timenowm6q = '22-24'; } ;
$timenowm5c = mktime(gmdate("H")-5, 0, 0, 0, 0, 0);
$timenowm5 = gmdate("H", $timenowm5c);
if($timenowm5 >= 0 && $timenowm5 < 6) { $timenowm5q = '0-6'; } else if($timenowm5 >= 6 && $timenowm5 < 10) { $timenowm5q = '6-10'; } else if($timenowm5 >= 10 && $timenowm5 < 12) { $timenowm5q = '10-12'; } else if($timenowm5 >= 12 && $timenowm5 < 15) { $timenowm5q = '12-15'; } else if($timenowm5 >= 15 && $timenowm5 < 18) { $timenowm5q = '15-18'; } else if($timenowm5 >= 18 && $timenowm5 < 20) { $timenowm5q = '18-20'; } else if($timenowm5 >= 20 && $timenowm5 < 22) { $timenowm5q = '20-22'; } else if($timenowm5 >= 22 && $timenowm5 < 24) { $timenowm5q = '22-24'; } ;
$timenowm4c = mktime(gmdate("H")-4, 0, 0, 0, 0, 0);
$timenowm4 = gmdate("H", $timenowm4c);
if($timenowm4 >= 0 && $timenowm4 < 6) { $timenowm4q = '0-6'; } else if($timenowm4 >= 6 && $timenowm4 < 10) { $timenowm4q = '6-10'; } else if($timenowm4 >= 10 && $timenowm4 < 12) { $timenowm4q = '10-12'; } else if($timenowm4 >= 12 && $timenowm4 < 15) { $timenowm4q = '12-15'; } else if($timenowm4 >= 15 && $timenowm4 < 18) { $timenowm4q = '15-18'; } else if($timenowm4 >= 18 && $timenowm4 < 20) { $timenowm4q = '18-20'; } else if($timenowm4 >= 20 && $timenowm4 < 22) { $timenowm4q = '20-22'; } else if($timenowm4 >= 22 && $timenowm4 < 24) { $timenowm4q = '22-24'; } ;
$timenowm3c = mktime(gmdate("H")-3, 0, 0, 0, 0, 0);
$timenowm3 = gmdate("H", $timenowm3c);
if($timenowm3 >= 0 && $timenowm3 < 6) { $timenowm3q = '0-6'; } else if($timenowm3 >= 6 && $timenowm3 < 10) { $timenowm3q = '6-10'; } else if($timenowm3 >= 10 && $timenowm3 < 12) { $timenowm3q = '10-12'; } else if($timenowm3 >= 12 && $timenowm3 < 15) { $timenowm3q = '12-15'; } else if($timenowm3 >= 15 && $timenowm3 < 18) { $timenowm3q = '15-18'; } else if($timenowm3 >= 18 && $timenowm3 < 20) { $timenowm3q = '18-20'; } else if($timenowm3 >= 20 && $timenowm3 < 22) { $timenowm3q = '20-22'; } else if($timenowm3 >= 22 && $timenowm3 < 24) { $timenowm3q = '22-24'; } ;
$timenowm2c = mktime(gmdate("H")-2, 0, 0, 0, 0, 0);
$timenowm2 = gmdate("H", $timenowm2c);
if($timenowm2 >= 0 && $timenowm2 < 6) { $timenowm2q = '0-6'; } else if($timenowm2 >= 6 && $timenowm2 < 10) { $timenowm2q = '6-10'; } else if($timenowm2 >= 10 && $timenowm2 < 12) { $timenowm2q = '10-12'; } else if($timenowm2 >= 12 && $timenowm2 < 15) { $timenowm2q = '12-15'; } else if($timenowm2 >= 15 && $timenowm2 < 18) { $timenowm2q = '15-18'; } else if($timenowm2 >= 18 && $timenowm2 < 20) { $timenowm2q = '18-20'; } else if($timenowm2 >= 20 && $timenowm2 < 22) { $timenowm2q = '20-22'; } else if($timenowm2 >= 22 && $timenowm2 < 24) { $timenowm2q = '22-24'; } ;
$timenowm1c = mktime(gmdate("H")-1, 0, 0, 0, 0, 0);
$timenowm1 = gmdate("H", $timenowm1c);
if($timenowm1 >= 0 && $timenowm1 < 6) { $timenowm1q = '0-6'; } else if($timenowm1 >= 6 && $timenowm1 < 10) { $timenowm1q = '6-10'; } else if($timenowm1 >= 10 && $timenowm1 < 12) { $timenowm1q = '10-12'; } else if($timenowm1 >= 12 && $timenowm1 < 15) { $timenowm1q = '12-15'; } else if($timenowm1 >= 15 && $timenowm1 < 18) { $timenowm1q = '15-18'; } else if($timenowm1 >= 18 && $timenowm1 < 20) { $timenowm1q = '18-20'; } else if($timenowm1 >= 20 && $timenowm1 < 22) { $timenowm1q = '20-22'; } else if($timenowm1 >= 22 && $timenowm1 < 24) { $timenowm1q = '22-24'; } ;
$timenow0c = mktime(gmdate("H"), 0, 0, 0, 0, 0);
$timenow0 = gmdate("H", $timenow0c);
if($timenow0 >= 0 && $timenow0 < 6) { $timenow0q = '0-6'; } else if($timenow0 >= 6 && $timenow0 < 10) { $timenow0q = '6-10'; } else if($timenow0 >= 10 && $timenow0 < 12) { $timenow0q = '10-12'; } else if($timenow0 >= 12 && $timenow0 < 15) { $timenow0q = '12-15'; } else if($timenow0 >= 15 && $timenow0 < 18) { $timenow0q = '15-18'; } else if($timenow0 >= 18 && $timenow0 < 20) { $timenow0q = '18-20'; } else if($timenow0 >= 20 && $timenow0 < 22) { $timenow0q = '20-22'; } else if($timenow0 >= 22 && $timenow0 < 24) { $timenow0q = '22-24'; } ;
$timenowp1c = mktime(gmdate("H")+1, 0, 0, 0, 0, 0);
$timenowp1 = gmdate("H", $timenowp1c);
if($timenowp1 >= 0 && $timenowp1 < 6) { $timenowp1q = '0-6'; } else if($timenowp1 >= 6 && $timenowp1 < 10) { $timenowp1q = '6-10'; } else if($timenowp1 >= 10 && $timenowp1 < 12) { $timenowp1q = '10-12'; } else if($timenowp1 >= 12 && $timenowp1 < 15) { $timenowp1q = '12-15'; } else if($timenowp1 >= 15 && $timenowp1 < 18) { $timenowp1q = '15-18'; } else if($timenowp1 >= 18 && $timenowp1 < 20) { $timenowp1q = '18-20'; } else if($timenowp1 >= 20 && $timenowp1 < 22) { $timenowp1q = '20-22'; } else if($timenowp1 >= 22 && $timenowp1 < 24) { $timenowp1q = '22-24'; } ;
$timenowp2c = mktime(gmdate("H")+2, 0, 0, 0, 0, 0);
$timenowp2 = gmdate("H", $timenowp2c);
if($timenowp2 >= 0 && $timenowp2 < 6) { $timenowp2q = '0-6'; } else if($timenowp2 >= 6 && $timenowp2 < 10) { $timenowp2q = '6-10'; } else if($timenowp2 >= 10 && $timenowp2 < 12) { $timenowp2q = '10-12'; } else if($timenowp2 >= 12 && $timenowp2 < 15) { $timenowp2q = '12-15'; } else if($timenowp2 >= 15 && $timenowp2 < 18) { $timenowp2q = '15-18'; } else if($timenowp2 >= 18 && $timenowp2 < 20) { $timenowp2q = '18-20'; } else if($timenowp2 >= 20 && $timenowp2 < 22) { $timenowp2q = '20-22'; } else if($timenowp2 >= 22 && $timenowp2 < 24) { $timenowp2q = '22-24'; } ;
$timenowp3c = mktime(gmdate("H")+3, 0, 0, 0, 0, 0);
$timenowp3 = gmdate("H", $timenowp3c);
if($timenowp3 >= 0 && $timenowp3 < 6) { $timenowp3q = '0-6'; } else if($timenowp3 >= 6 && $timenowp3 < 10) { $timenowp3q = '6-10'; } else if($timenowp3 >= 10 && $timenowp3 < 12) { $timenowp3q = '10-12'; } else if($timenowp3 >= 12 && $timenowp3 < 15) { $timenowp3q = '12-15'; } else if($timenowp3 >= 15 && $timenowp3 < 18) { $timenowp3q = '15-18'; } else if($timenowp3 >= 18 && $timenowp3 < 20) { $timenowp3q = '18-20'; } else if($timenowp3 >= 20 && $timenowp3 < 22) { $timenowp3q = '20-22'; } else if($timenowp3 >= 22 && $timenowp3 < 24) { $timenowp3q = '22-24'; } ;
$timenowp4c = mktime(gmdate("H")+4, 0, 0, 0, 0, 0);
$timenowp4 = gmdate("H", $timenowp4c);
if($timenowp4 >= 0 && $timenowp4 < 6) { $timenowp4q = '0-6'; } else if($timenowp4 >= 6 && $timenowp4 < 10) { $timenowp4q = '6-10'; } else if($timenowp4 >= 10 && $timenowp4 < 12) { $timenowp4q = '10-12'; } else if($timenowp4 >= 12 && $timenowp4 < 15) { $timenowp4q = '12-15'; } else if($timenowp4 >= 15 && $timenowp4 < 18) { $timenowp4q = '15-18'; } else if($timenowp4 >= 18 && $timenowp4 < 20) { $timenowp4q = '18-20'; } else if($timenowp4 >= 20 && $timenowp4 < 22) { $timenowp4q = '20-22'; } else if($timenowp4 >= 22 && $timenowp4 < 24) { $timenowp4q = '22-24'; } ;
$timenowp5c = mktime(gmdate("H")+5, 0, 0, 0, 0, 0);
$timenowp5 = gmdate("H", $timenowp5c);
if($timenowp5 >= 0 && $timenowp5 < 6) { $timenowp5q = '0-6'; } else if($timenowp5 >= 6 && $timenowp5 < 10) { $timenowp5q = '6-10'; } else if($timenowp5 >= 10 && $timenowp5 < 12) { $timenowp5q = '10-12'; } else if($timenowp5 >= 12 && $timenowp5 < 15) { $timenowp5q = '12-15'; } else if($timenowp5 >= 15 && $timenowp5 < 18) { $timenowp5q = '15-18'; } else if($timenowp5 >= 18 && $timenowp5 < 20) { $timenowp5q = '18-20'; } else if($timenowp5 >= 20 && $timenowp5 < 22) { $timenowp5q = '20-22'; } else if($timenowp5 >= 22 && $timenowp5 < 24) { $timenowp5q = '22-24'; } ;
$timenowp6c = mktime(gmdate("H")+6, 0, 0, 0, 0, 0);
$timenowp6 = gmdate("H", $timenowp6c);
if($timenowp6 >= 0 && $timenowp6 < 6) { $timenowp6q = '0-6'; } else if($timenowp6 >= 6 && $timenowp6 < 10) { $timenowp6q = '6-10'; } else if($timenowp6 >= 10 && $timenowp6 < 12) { $timenowp6q = '10-12'; } else if($timenowp6 >= 12 && $timenowp6 < 15) { $timenowp6q = '12-15'; } else if($timenowp6 >= 15 && $timenowp6 < 18) { $timenowp6q = '15-18'; } else if($timenowp6 >= 18 && $timenowp6 < 20) { $timenowp6q = '18-20'; } else if($timenowp6 >= 20 && $timenowp6 < 22) { $timenowp6q = '20-22'; } else if($timenowp6 >= 22 && $timenowp6 < 24) { $timenowp6q = '22-24'; } ;
$timenowp7c = mktime(gmdate("H")+7, 0, 0, 0, 0, 0);
$timenowp7 = gmdate("H", $timenowp7c);
if($timenowp7 >= 0 && $timenowp7 < 6) { $timenowp7q = '0-6'; } else if($timenowp7 >= 6 && $timenowp7 < 10) { $timenowp7q = '6-10'; } else if($timenowp7 >= 10 && $timenowp7 < 12) { $timenowp7q = '10-12'; } else if($timenowp7 >= 12 && $timenowp7 < 15) { $timenowp7q = '12-15'; } else if($timenowp7 >= 15 && $timenowp7 < 18) { $timenowp7q = '15-18'; } else if($timenowp7 >= 18 && $timenowp7 < 20) { $timenowp7q = '18-20'; } else if($timenowp7 >= 20 && $timenowp7 < 22) { $timenowp7q = '20-22'; } else if($timenowp7 >= 22 && $timenowp7 < 24) { $timenowp7q = '22-24'; } ;
$timenowp8c = mktime(gmdate("H")+8, 0, 0, 0, 0, 0);
$timenowp8 = gmdate("H", $timenowp8c);
if($timenowp8 >= 0 && $timenowp8 < 6) { $timenowp8q = '0-6'; } else if($timenowp8 >= 6 && $timenowp8 < 10) { $timenowp8q = '6-10'; } else if($timenowp8 >= 10 && $timenowp8 < 12) { $timenowp8q = '10-12'; } else if($timenowp8 >= 12 && $timenowp8 < 15) { $timenowp8q = '12-15'; } else if($timenowp8 >= 15 && $timenowp8 < 18) { $timenowp8q = '15-18'; } else if($timenowp8 >= 18 && $timenowp8 < 20) { $timenowp8q = '18-20'; } else if($timenowp8 >= 20 && $timenowp8 < 22) { $timenowp8q = '20-22'; } else if($timenowp8 >= 22 && $timenowp8 < 24) { $timenowp8q = '22-24'; } ;
$timenowp9c = mktime(gmdate("H")+9, 0, 0, 0, 0, 0);
$timenowp9 = gmdate("H", $timenowp9c);
if($timenowp9 >= 0 && $timenowp9 < 6) { $timenowp9q = '0-6'; } else if($timenowp9 >= 6 && $timenowp9 < 10) { $timenowp9q = '6-10'; } else if($timenowp9 >= 10 && $timenowp9 < 12) { $timenowp9q = '10-12'; } else if($timenowp9 >= 12 && $timenowp9 < 15) { $timenowp9q = '12-15'; } else if($timenowp9 >= 15 && $timenowp9 < 18) { $timenowp9q = '15-18'; } else if($timenowp9 >= 18 && $timenowp9 < 20) { $timenowp9q = '18-20'; } else if($timenowp9 >= 20 && $timenowp9 < 22) { $timenowp9q = '20-22'; } else if($timenowp9 >= 22 && $timenowp9 < 24) { $timenowp9q = '22-24'; } ;
$timenowp10c = mktime(gmdate("H")+10, 0, 0, 0, 0, 0);
$timenowp10 = gmdate("H", $timenowp10c);
if($timenowp10 >= 0 && $timenowp10 < 6) { $timenowp10q = '0-6'; } else if($timenowp10 >= 6 && $timenowp10 < 10) { $timenowp10q = '6-10'; } else if($timenowp10 >= 10 && $timenowp10 < 12) { $timenowp10q = '10-12'; } else if($timenowp10 >= 12 && $timenowp10 < 15) { $timenowp10q = '12-15'; } else if($timenowp10 >= 15 && $timenowp10 < 18) { $timenowp10q = '15-18'; } else if($timenowp10 >= 18 && $timenowp10 < 20) { $timenowp10q = '18-20'; } else if($timenowp10 >= 20 && $timenowp10 < 22) { $timenowp10q = '20-22'; } else if($timenowp10 >= 22 && $timenowp10 < 24) { $timenowp10q = '22-24'; } ;
$timenowp11c = mktime(gmdate("H")+11, 0, 0, 0, 0, 0);
$timenowp11 = gmdate("H", $timenowp11c);
if($timenowp11 >= 0 && $timenowp11 < 6) { $timenowp11q = '0-6'; } else if($timenowp11 >= 6 && $timenowp11 < 10) { $timenowp11q = '6-10'; } else if($timenowp11 >= 10 && $timenowp11 < 12) { $timenowp11q = '10-12'; } else if($timenowp11 >= 12 && $timenowp11 < 15) { $timenowp11q = '12-15'; } else if($timenowp11 >= 15 && $timenowp11 < 18) { $timenowp11q = '15-18'; } else if($timenowp11 >= 18 && $timenowp11 < 20) { $timenowp11q = '18-20'; } else if($timenowp11 >= 20 && $timenowp11 < 22) { $timenowp11q = '20-22'; } else if($timenowp11 >= 22 && $timenowp11 < 24) { $timenowp11q = '22-24'; } ;

$activeAgentsCount = $dbhandle->query("SELECT * FROM agents WHERE active='1' AND busy='0' AND 
agenttime LIKE CASE WHEN agenttzone = 'none' THEN '%never%'
WHEN agenttzone = 'Europe/London' THEN '%{$timenow0q}%'
WHEN agenttzone = 'Pacific/Wake' THEN '%{$timenowm12q}%'
WHEN agenttzone = 'Pacific/Apia' THEN '%{$timenowm11q}%'
WHEN agenttzone = 'Pacific/Honolulu' THEN '%{$timenowm10q}%'
WHEN agenttzone = 'America/Anchorage' THEN '%{$timenowm9q}%'
WHEN agenttzone = 'America/Los_Angeles' THEN '%{$timenowm8q}%'
WHEN agenttzone = 'America/Chihuahua' THEN '%{$timenowm7q}%'
WHEN agenttzone = 'America/Chicago' THEN '%{$timenowm6q}%'
WHEN agenttzone = 'America/Bogota' THEN '%{$timenowm5q}%'
WHEN agenttzone = 'America/Caracas' THEN '%{$timenowm4q}%'
WHEN agenttzone = 'America/Sao_Paulo' THEN '%{$timenowm3q}%'
WHEN agenttzone = 'America/Noronha' THEN '%{$timenowm2q}%'
WHEN agenttzone = 'Atlantic/Azores' THEN '%{$timenowm1q}%'
WHEN agenttzone = 'Europe/Berlin' THEN '%{$timenowp1q}%'
WHEN agenttzone = 'Europe/Istanbul' THEN '%{$timenowp2q}%'
WHEN agenttzone = 'Europe/Moscow' THEN '%{$timenowp3q}%'
WHEN agenttzone = 'Asia/Tbilisi' THEN '%{$timenowp4q}%'
WHEN agenttzone = 'Asia/Karachi' THEN '%{$timenowp5q}%'
WHEN agenttzone = 'Asia/Novosibirsk' THEN '%{$timenowp6q}%'
WHEN agenttzone = 'Asia/Bangkok' THEN '%{$timenowp7q}%'
WHEN agenttzone = 'Asia/Hong_Kong' THEN '%{$timenowp8q}%'
WHEN agenttzone = 'Asia/Seoul' THEN '%{$timenowp9q}%'
WHEN agenttzone = 'Australia/Sydney' THEN '%{$timenowp10q}%'
WHEN agenttzone = 'Asia/Magadan' THEN '%{$timenowp11q}%'
 END");
$activeNumber = $activeAgentsCount->num_rows;
$dbhandle->close();
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<head>
		<title><?php echo $GLOBALS["sitetitle"] ?></title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="Platform for people to write to and get questions answered by other people.">
		<link rel="stylesheet" href="/css/styles.css">
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script type="text/javascript" src="/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="/js/jquery.blockUI.js"></script>
		<script type="text/javascript" src="/js/custom.js"></script>
		<script type="text/javascript">
		$(function(){
		$('#clickOpenquestion').click(function(){
		$('#start').slideUp('slow');
		$('#openQuestion').load('openquestion.php?id=<?php echo $GLOBALS["idNum"]; ?>').hide().fadeIn(1000);
		return false; });
		});
		</script>
		</head>
		<body> 
		<span class="aptitle"><a href="/"><?php echo $GLOBALS["titleslogan"] ?></a></span><br /><br />
        <div class="page">
		<div class="textdiv"><?php echo $GLOBALS["bodyslogan"] ?></div>
		<div id="start" class="textdiv"><?php if ($activeNumber >= $activeAgentsReq ) {
		echo '<button id="clickOpenquestion">Open Question</button></div>'; }
		else {
		echo 'Please excuse the system! There are only '.$activeNumber.' agents available.<br /><br />We need at least '.$activeAgentsReq.' to offer answers<br /><br />Think about making someone</div><div class="textdiv"><a href="/signup"><button>Sign up to be an Agent</button></a></div><div class="textdiv">to make this system work again</div>'; }; ?>
		<div id="openQuestion"></div>
		<div id="writeQuestion"></div>
		<div id="previewQuestion"></div>
		<div id="categorizeQuestionDiv"></div>
		<div id="savedQuestionPrepare"></div>
		<div id="createActivationResult"></div>
        </div>
    </body>
</html>
<?php
session_start();
$_SESSION['questionID'] = $idNum;
?>
