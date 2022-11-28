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

function sendEmail($email, $subject, $from, $message) {
    mail($email, $subject, $message, "From: " . $from);
}

function generateRandomString(): string {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function template_header($title)
{
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

    <nav class="navtop">
    	<div>
    		<h1 style="cursor: pointer" onclick="window.location.href = '../index.php'">Umfragen</h1>
            <a style="font-size: 15px;" href="../privacy/imprint.php"><i class="fas fa-info"></i>Impressum</a>
            <a style="font-size: 15px;" href="../privacy/privacy.php"><i class="fas fa-info"></i>Datenschutzerklärung</a>
            <a style="font-size: 15px;" href="../report.php"><i class="fas fa-exclamation-circle"></i>Fehler Melden</a>
        </div>

    </nav>
EOT;
}

function template_footer()
{
    echo <<<EOT
    </body>
</html>
EOT;
}