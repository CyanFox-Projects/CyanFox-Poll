<?php
function connect_mysql()
{
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'cyanfox';
    $DATABASE_PASS = 'cyanfox';
    $DATABASE_NAME = 'cyanfox-poll';
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        exit('Failed to connect to database!');
    }
}

function generateRandomString(): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function return404()
{
    http_response_code(404);
    header("Location: assets/error/404.html");
    die();
}

function template_header($title)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>$title</title>
		
		<!-- Other CSS files -->
		<link href="/assets/css/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>
        
        <!-- Other JS files -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/sweetalert.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        
        <!-- DataTables JS files -->
        <script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../assets/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.6.1/js/dataTables.colReorder.min.js"></script>
        
</head>
<body>

<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}
</style>
</head>

<div class="topnav" id="myTopnav">
  <a href="../index.php" class="active">Startseite</a>
  <a href="../privacy/imprint.php"><i class="fas fa-info"></i> Impressum</a>
  <a href="../privacy/privacy.php"><i class="fas fa-info"></i> Datenschutz</a>
  <a href="../report.php"><i class="fas fa-exclamation-circle"></i> Fehler Melden</a>
  <a href="javascript:void(0);" class="icon" onclick="responsive()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<script>
function responsive() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>


EOT;
}

function template_footer()
{
    echo <<<EOT
    </body>
</html>
EOT;
}