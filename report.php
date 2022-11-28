<?php
include 'assets/php/functions.php';

template_header('Fehler melden');

if (!empty($_POST)) {

    $data = array(
        'secret' => "0xeD144d586921192F9abBFfd6Db1A55E9DDF6149d",
        'response' => $_POST['h-captcha-response']
    );
    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);

    $responseData = json_decode($response);
    if($responseData->success) {

        $site = isset($_POST['site']) ? $_POST['site'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';


        $webhookurl = "https://discord.com/api/webhooks/1006233647684255785/7snaxNQ55f1UZwjlzUDQ3nsyVS9r2SBs59wYXIV85hpj5P_Vdv2X-mTOWUmLauYl67Sg";

        $timestamp = date("c", strtotime("now"));

        $json_data = json_encode([

            "content" => "<@660206146786820096>",

            "username" => "Bug Report",

            "tts" => false,

            "embeds" => [
                [
                    "title" => "Bug Report",

                    "type" => "rich",

                    "description" => " Es wurde ein Bug Report gesendet \n \n **Seite/Titel** \n $site \n \n **Beschreibung** \n $description",

                    "timestamp" => $timestamp,

                    "color" => hexdec( "3366ff" ),

                ]
            ]

        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


        $ch = curl_init( $webhookurl );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec( $ch );
        curl_close( $ch );
        echo '<script> SweetAlert.fire({
            title: "Danke für die Meldung",
            icon: "success"
            }).then(function() {
                window.location.href = "index.php"
            });
              </script>';
    } else {
        echo '<script>SweetAlert.fire(
            title: "Capture fehlgeschlagen!",
            text: "Bitte fülle das Capture aus!",
            icon: "error"
        )</script>';
    }

}
?>



<link rel="stylesheet" type="text/css" href="assets/css/particle.css">
<link rel="stylesheet" href="assets/css/sites/report.css">

<script src='https://js.hcaptcha.com/1/api.js' async defer></script>

<script>
    $(document).ready(function () {
        $('site').attr('placeholder', 'Auf welcher Seite ist \n der Fehler aufgetreten?');
    });
</script>

<!-- panel -->
<div class="panel" style="width: 350px; left: 45%; top: 40%">
    <p> Fehler Melden </p>
    <form method="post" action="report.php">

        <div class="input">

            <label for="site">Seite/Titel</label>
            <textarea type="text" id="site" name="site" placeholder="Auf welcher Seite befindet sich &#10der Fehler" required></textarea>

        </div>

        <div class="input">

            <label for="site">Beschreibung</label>
                <textarea id="description" name="description" placeholder="Beschreibe den Fehler"
                          style="height:200px" required></textarea>

        </div>
        <div style="text-align: center" id="captcha_div" class="h-captcha" data-sitekey="95211084-2579-49d1-8fd4-c611e20a0b90"></div>

        <div class="input">
            <input class="button" type="submit" name="submit">
        </div>
    </form>
</div>


<!-- particles.js container -->
<div id="particles-js"></div>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="assets/js/particle.js"></script>

<?= template_footer() ?>
