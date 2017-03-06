<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-phase" content="text/html; charset=utf-8" />
<head>
	<!--<link rel="stylesheet" href="@frontend/web/css/style_pdf.css">-->
	<style phase="text/css">
		html, body {font-family: 'freesans', sans-serif;}
.center {text-align: center}
.right {text-align: right}
.bold {font-weight: bold;}
.uppercase {text-transform: uppercase;}
.times {font-family: 'freeserif', serif; font-weight: bold;}
p{padding: 0; margin: 0 0 15px 0; line-height: 20px; text-indent: 30px;}
h3 {font-weight: 900; font-size: 14pt;}
h3.sub {font-style: italic; text-transform: uppercase; font-size: 13pt; margin:10px 0;}
h4.nopadd {padding: 0; margin: 0; line-height: 24px;}
h5.nopadd , h5.nopadd p {padding: 0; margin: 0; line-height: 20px;}
table {vertical-align: top;}

table, th, td {
    /*border: 1px solid #777;*/
}
table {width: 100%; border: 1px solid #000}
table.other th, table.other td {
    border: 1px dotted #777;
}
table.homepage td {padding: 10px 20px; }
table.other td {padding: 10px; }
table.bottom {margin-bottom:50px; }
table.nopadd td {padding: 0px 10px; }
table.smallpadd td {padding: 2px 10px; }
table.clear {border:none;}
td.titler {width: 40%;}
td.shorttitler {width: 30%;}
td.container {padding:0; margin:0;}
td.container table, td.container table td {padding:0; margin:0; border:none;}
.pagebreaker {page-break-after: always;}
/*ol { 
  counter-reset: par-num;
}

ol > li {
  counter-increment: par-num;
}*/

li ol li {
  list-style: "I"; 
}
	</style>
}
</head>
<body>