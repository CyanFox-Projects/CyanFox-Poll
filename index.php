<?php
include 'assets/php/functions.php';
$pdo = connect_mysql();
$stmt = $pdo->query('SELECT p.*, GROUP_CONCAT(pa.title ORDER BY pa.id) AS answers FROM polls p LEFT JOIN poll_answers pa ON pa.poll_id = p.id GROUP BY p.id');
$polls = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Polls')?>


<link rel="stylesheet" type="text/css" href="assets/css/particle.css">
<link rel="stylesheet" type="text/css" href="assets/css/index.css">

<!-- panel -->
<div class="panel">
    <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Umfrage</h1>
    <input type="submit" style="font-family: Verdana, Geneva, Tahoma, sans-serif;" value="Umfrage erstellen" class="create" onclick="window.location.href = 'create.php';">
    <input type="submit" style="font-family: Verdana, Geneva, Tahoma, sans-serif;" value="Umfrage finden" class="find" onclick="window.location.href = 'find.php';">

    <div class="source_code_div">
        <i class="fa-brands fa-github icon"></i>
        <input type="submit" style="font-family: Verdana, Geneva, Tahoma, sans-serif;" value="&nbsp;&nbsp;Source Code" class="source_code" onclick="window.location.href = 'https://github.com';">
    </div>
</div>


<!-- particles.js container -->
<div id="particles-js"></div>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="assets/js/particle.js"></script>

<?=template_footer()?>
