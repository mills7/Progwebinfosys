<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Gruppe 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->


  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="/">Gruppe 2</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="<?php echo str_replace("\\", "/", dirname($_SERVER['SCRIPT_NAME']));?>/info/">Gruppe Info</a></li>
              <li><a href="<?php echo str_replace("\\", "/", dirname($_SERVER['SCRIPT_NAME']));?>/wiki/">Wiki</a></li>
            </ul>
           	<form class="navbar-form pull-right" action="/index.php?page=wiki" method="GET">
           	 <div class="input-prepend">
				<span class="add-on"><i class="icon-search"></i></span>
				<input type="hidden" name="page" value="wiki">
				<input class="span2" id="inputIcon" type="search" name="title">
			</div>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
