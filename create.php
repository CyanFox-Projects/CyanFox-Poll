

<?php
include 'assets/php/functions.php';
$pdo = connect_mysql();
$admin = generateRandomString();
$msg = '';

template_header('Umfrage erstellen');

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
    if ($responseData->success) {

        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $answers = $_POST['answers'];

        if (isset($_POST['useMaxAnswers'])) {
            $stmt = $pdo->prepare('INSERT INTO polls (title, description, admin_id, withmax, email) VALUES (?, ?, "' . $admin . '", "true", "' . $email . '")');
            $stmt->execute([$title, $description]);
            $poll_id = $pdo->lastInsertId();

            $max_votes = $_POST['max_votes'];
            $i = -1;

            foreach ($answers as $index => $answer) {

                ++$i;
                $stmt = $pdo->prepare('INSERT INTO poll_answers (poll_id, title, max_votes, voted_votes) VALUES (?, ?, "' . $max_votes[$i] . '", "0")');
                $stmt->execute([$poll_id, $answer]);
            }

            header("Location: admin.php?id=" . $poll_id . "&secret=" . $admin);
        } else {
            $stmt = $pdo->prepare('INSERT INTO polls (title, description, admin_id, withmax) VALUES (?, ?, "' . $admin . '", "false", "' . $email . '")');
            $stmt->execute([$title, $description]);
            $poll_id = $pdo->lastInsertId();
            $i = -1;

            foreach ($answers as $index => $answer) {

                ++$i;
                $stmt = $pdo->prepare('INSERT INTO poll_answers (poll_id, title, max_votes, voted_votes) VALUES (?, ?, "999", "0")');
                $stmt->execute([$poll_id, $answer]);
            }

            if(!$email == ""){
                sendEmail($email, "Umfrage erstellt", "lenny@petschl.org", "Deine Umfrage wurde erstellt. Du kannst das Admin-Panel unter folgendem Link finden: https://petschl.org/poll/admin.php?id=" . $poll_id . "&secret=" . $admin);

            }
            header("Location: admin.php?id=" . $poll_id . "&secret=" . $admin);
        }


    } else {
        echo '<script>SweetAlert.fire(
            "Capture fehlgeschlagen!",
            "Bitte fülle das Capture aus!",
            "info"
        )</script>';
    }

}
?>


<script src='https://js.hcaptcha.com/1/api.js' async defer></script>

<script src="assets/js/sites/create.js"></script>

<div class="content update">
    <h2>Umfrage erstellen</h2>
    <form id="create_form" action="create.php" method="post">
        <label for="title">Titel <a style="color: red">*</a></label>
        <input type="text" name="title" id="title" placeholder="Titel der Umfrage" required>

        <label for="description">Beschreibung</label>
        <input type="text" name="description" id="description" placeholder="Beschreibung der Umfrage">

        <label for="email">E-Mail</label>
        <input type="email" name="email" id="email" placeholder="E-Mail Adresse">

        <label for="useMaxAnswers">Maximale antworten nutzen? <a style="color: red">*</a></label>
        <input style="display: flex; margin-left: -47%" type="checkbox" id="useMaxAnswers" name="useMaxAnswers"
               onclick="check()" checked>

        <label for="answers">Antwort Möglichkeiten <a style="color: red">*</a></label>
        <div class="answers_div" style="display: flex;">
            <div id="answers_div_option">
                <input name="answers[0]" id="answers" placeholder="Antwort Möglichkeit" required>
            </div>

            <div id="answers_div_max">
                <input min="1" style="width: 173px" type='number' name='max_votes[0]' id='max_votes' class="max_votes"
                       placeholder='Max Stimmen' required>
            </div>
        </div>

        <a style="cursor: pointer; color: gray" onclick="add()"><i class="fa-solid fa-plus"></i> Antwort hinzufügen</a>
        <br>
        <a style="cursor: pointer; color: gray" onclick="remove()"><i class="fa-solid fa-minus"></i> Antwort
            entfernen</a>

        <br>

        <div id="captcha_div" class="h-captcha" data-sitekey="95211084-2579-49d1-8fd4-c611e20a0b90"></div>
        <input id="submit" type="submit" value="Erstellen">
    </form
    >
</div>

<?= template_footer() ?>
