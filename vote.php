<?php
include 'assets/php/functions.php';
$pdo = connect_mysql();


if (isset($_GET['id'])) {


    $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($poll) {

        template_header('Abstimmen');

        $stmt = $pdo->prepare('SELECT * FROM poll_answers WHERE poll_id = ?');
        $stmt->execute([$_GET['id']]);

        $poll_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (isset($_POST['poll_answer'])) {

            if (isset($_POST['name'])) {
                $name = (!empty($_POST['name'])) ? $_POST['name'] : "";

                $stmt = $pdo->prepare('SELECT * FROM poll_answers WHERE poll_id = ?');
                $stmt->execute([$_GET['id']]);
                $poll_answer = $stmt->fetch(PDO::FETCH_ASSOC);
                $deleteKey = generateRandomString();


                if (isset($_POST['poll_answer']) && is_array($_POST['poll_answer'])) {
                    foreach ($_POST['poll_answer'] as $value) {

                        $stmt = $pdo->prepare('SELECT max_votes, voted_votes, title FROM poll_answers WHERE title = "' . $value . '" AND poll_id = ?');
                        $stmt->execute([$_GET['id']]);
                        $poll_answer_votes = $stmt->fetch(PDO::FETCH_ASSOC);

                        echo '<script>console.log("' . $value . ' - Max votes = ' . $poll_answer_votes['max_votes'] . '")</script>';

                        if ($poll_answer_votes['voted_votes'] >= $poll_answer_votes['max_votes']) {
                            echo '<script>
Swal.fire({
    title: "Fehler",
    text: "Bei einer deiner Antwort wurde das Ziel schon erreicht. Bitte wähle eine andere Antwort aus.",
    icon: "error",
    confirmButtonText: "Ok"
    }).then(function() {
        window.location = "vote.php?id=' . $_GET['id'] . '";
    });
</script>';
                        } else {
                            $poll_id = $poll['id'];
                            $poll_answer_title = $poll_answer_votes['title'];

                            $stmt = $pdo->prepare('INSERT INTO `poll_vote`(`poll_id`, `vote`, `name`, `deleteKey`) VALUES ("' . $poll['id'] . '", "' . $value . '", "' . $name . '", "' . $deleteKey . '")');
                            $stmt->execute([$_GET['id']]);

                            $stmt = $pdo->prepare('SELECT * FROM poll_vote WHERE poll_id = "' . $_GET['id'] . '" AND name = "' . $name . '";');
                            $stmt->execute([$_GET['id']]);
                            $voter = $stmt->fetch(PDO::FETCH_ASSOC);

                            if($poll['withmax'] == "true"){
                                $stmt = $pdo->prepare('UPDATE poll_answers SET voted_votes = voted_votes + 1 WHERE title = "' . $value . '" AND poll_id = "' . $_GET['id'] . '"');
                                $stmt->execute([$_GET['id']]);
                            }

                            echo '<script>
Swal.fire({
    title: "User ID",
    html: "Deine Delete-Key ist <b>' . $deleteKey . '</b>. Diesen brauchst du, wenn du deine Antwort löschen willst",
    showDenyButton: true,
    denyButtonColor: "#32a367",
    confirmButtonText: "Ok",
    denyButtonText: "Kopieren",
    icon: "info",
}).then(function (e) {
    if (e.isConfirmed) {
        window.location = "view.php?id=' . $_GET['id'] . '";
    } else if (e.isDenied) {
        navigator.clipboard.writeText("' . $deleteKey . '");
        
    Swal.fire({
        title: "Kopiert",
        html: "Der Code wurde in die Zwischenablage kopiert",
        confirmButtonText: "Ok",
        icon: "success",
    }).then(function (e) {
        window.location = "view.php?id=' . $_GET['id'] . '";
    });
    }
});
</script>';
                        }
                    }
                }
            }
            exit;
        }
    } else {
        return404();
    }
} else {
    exit('Es wurde keine ID angegeben.');
}
?>


<div class="content poll-vote">
    <h2><?= $poll['title'] ?></h2>
    <p><?= $poll['description'] ?></p>
    <form action="vote.php?id=<?= $_GET['id'] ?>" method="post">
        <label>
            <input type="text" placeholder="Dein Name" name="name" required>
        </label>

        <style>

            [type="checkbox"] {
                vertical-align: middle;
            }
        </style>
        <?php for ($i = 0; $i < count($poll_answers); $i++): ?>

            <?php

            $stmt = $pdo->prepare('SELECT max_votes, voted_votes, title FROM poll_answers WHERE poll_id = ? AND title = "' . $poll_answers[$i]['title'] . '";');
            $stmt->execute([$_GET['id']]);
            $poll_answer_votes = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <label style="word-wrap:break-word">
                <input type="checkbox" name="poll_answer[]"
                       value="<?= $poll_answers[$i]['title'] ?>">
                <?= $poll_answers[$i]['title'] ?> <?php

                if($poll['withmax'] == "true") {
                    echo "(" . $poll_answer_votes['voted_votes'] . " von ".  $poll_answer_votes['max_votes'] . " haben schon dafür Abgestimmt)";
                }
                ?>
            </label>
        <?php endfor; ?>
        <div>


            <input type="submit" value="Abstimmen" name="submit">
            <a href="view.php?id=<?= $poll['id'] ?>">Alle Antworten</a>
        </div>
    </form>
</div>

<?= template_footer() ?>
