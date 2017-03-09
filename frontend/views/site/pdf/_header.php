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
.middle {vertical-align: middle;}
.uppercase {text-transform: uppercase;}
.times {font-family: 'freeserif', serif; font-weight: bold;}
h3 {font-weight: bold; font-size: 14pt;}
table {vertical-align: top;}
.hint {font-size: 8pt;}

table, th, td {
    border: 1px solid #777;
    border-collapse: collapse;
    padding: 10px;
}
table {width: 100%; border: 1px solid #000}
table.other th, table.other td {
    border: 1px dotted #777;
}


table.homepage td {padding: 10px 20px; border:none;}
table.sheet  {border: none;}
table.sheet td {padding: 3px; border:none; border-top:1px solid #aaa;}
table.other td {padding: 10px; }
table.bottom {margin-bottom:50px; }
table.nopadd td {padding: 0px 10px; }
table.smallpadd td {padding: 2px 10px; }
table.clear, table.clear th, table.clear td {border:none;}
td.titler {width: 40%;}
td.shorttitler {width: 30%;}
td.container {padding:0; margin:0;}
td.container table, td.container table td {padding:0; margin:0; border:none;}
td.subtitle {padding:5px 0; margin:0; border-bottom: 2px solid #000;}
table.clear td.storeys {border-bottom: 1px dotted #777 !important; border-right: 1px dotted #777 !important;}
table.clear td.storeys-bottom {border-bottom: 1px dotted #777 !important;}
table.clear td.storeys-right {border-right: 1px dotted #777 !important;}
.pagebreaker {page-break-after: always;}
ol { counter-reset: item }
li{ display: block }
li:before { content: counters(item, ".") " "; counter-increment: item }
	</style>
}
</head>
<body>