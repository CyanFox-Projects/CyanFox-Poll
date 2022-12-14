<?php
include 'assets/php/functions.php';
?>

<?= template_header('Umfragen') ?>


<link rel="stylesheet" type="text/css" href="assets/css/particle.css">
<link rel="stylesheet" type="text/css" href="assets/css/sites/index.css">

<script>

    function showChangeLog() {
        Swal.fire({
            title: 'Änderungsprotokoll',
            html: '+ Multiple choice geht jetzt auch bei max. Antworten <br> * Etwas besseres Design für Handys <br>',
            footer: '<a href="https://github.com/CyanFox-Projects/CyanFox-Poll">Github</a>',
            icon: 'info',
            confirmButtonText: 'Ok'
        });
    }

</script>

<!-- panel -->
<div class="panel">
    <h1>Umfrage</h1>

    <input type="submit" value="Umfrage erstellen" class="create" onclick="window.location.href = 'create.php';">
    <input type="submit" value="Umfrage finden" class="find" onclick="window.location.href = 'find.php';">

    <br>
    <br>

    <div class="icon_div">
        <i class="fa-solid fa-clipboard-check icon"></i>
        <input style="background-color: #31a364;" type="submit" value="&nbsp;&nbsp; Änderungsprotokoll" class="changelog" onclick="showChangeLog()">
    </div>

    <div class="icon_div">
        <i class="fa-brands fa-github icon"></i>
        <input style="background-color: #31a364" type="submit" value="&nbsp;&nbsp;Source Code"
               class="source_code" onclick="window.location.href = 'https://github.com/CyanFox-Projects/CyanFox-Poll';">
    </div>
</div>


<!-- particles.js container -->
<div id="particles-js"></div>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="assets/js/particle.js"></script>

<?= template_footer() ?>
