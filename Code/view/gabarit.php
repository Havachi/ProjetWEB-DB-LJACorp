<?php
/**
 * Author   : nicolas.glassey@cpnv.ch
 * Project  : Epreuve_151
 * Created  : 09.04.2019 - 18:01
 *
 * Last update :    [01.12.2018 author]
 *                  [add $logName in function setFullPath]
 * Git source  :    [link]
 */
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=$title;?></title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!--link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" /-->
    <link href="view/content/scripts/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="view/content/scripts/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

    <link href="view/template/default.css" rel="stylesheet" type="text/css" media="all" />
    <link href="view/template/fonts.css" rel="stylesheet" type="text/css" media="all" />

    <!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="header" class="container">
    <div id="logo">
        <h1><a href="#">MyPrivateTeacher</a></h1>
    </div>
    <div id="menu">
        <ul>
            <li><a href="index.php?action=home">Home</a></li>
            <li><a href="#" title="">Nos Cours</a></li>
            <li><a href="#">Login</a></li>
            <li><a href="#" style="color:#FC05CB">Register</a></li>
        </ul>
    </div>
</div>
<div id="page-wrapper">
    <div id="page" class="container">
        <?=$content;?>
    </div>
</div>
<div id="copyright">
    <p>&copy; Untitled. All rights reserved. | Photos by <a href="http://fotogrph.com/">Fotogrph</a> | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</p>
</div>
</body>
</html>