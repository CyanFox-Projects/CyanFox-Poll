<?php
include 'assets/php/functions.php';
$pdo = connect_mysql();

if (isset($_GET['id'])) {

    $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);


    if (isset($_GET['secret'])) {
        if ($_GET['secret'] == $poll['admin_id']) {

            if ($poll) {

                $stmt = $pdo->prepare('SELECT * FROM poll_answers WHERE poll_id = ? ORDER BY poll_id DESC;');
                $stmt->execute([$_GET['id']]);

                $poll_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (isset($_GET['change'])) {
                    if ($_GET['change'] == 'true') {

                       /* if (isset($_GET['use_max_answers'])) {

                            $stmt = $pdo->prepare("UPDATE `polls` SET `withmax`='" . $_GET['use_max_answers'] . "' WHERE id = ?");
                            $stmt->execute([$_GET['id']]);
                            header('Location: edit.php?id=' . $_GET['id'] . '&secret=' . $_GET['secret']);
                        }*/
                        if (isset($_GET['title'])) {

                            $stmt = $pdo->prepare("UPDATE `polls` SET `title`='" . $_GET['title'] . "' WHERE id = ?");
                            $stmt->execute([$_GET['id']]);
                            header('Location: edit.php?id=' . $_GET['id'] . '&secret=' . $_GET['secret']);
                        }
                        if (isset($_GET['description'])) {

                            $stmt = $pdo->prepare("UPDATE `polls` SET `description`='" . $_GET['description'] . "' WHERE id = ?");
                            $stmt->execute([$_GET['id']]);
                            header('Location: edit.php?id=' . $_GET['id'] . '&secret=' . $_GET['secret']);
                        }
                        if (isset($_GET['admin'])) {

                            $stmt = $pdo->prepare("UPDATE `polls` SET `admin_id`='" . $_GET['admin'] . "' WHERE id = ?");
                            $stmt->execute([$_GET['id']]);
                            header('Location: edit.php?id=' . $_GET['id'] . '&secret=' . $_GET['secret']);
                        }
                        if (isset($_GET['email'])) {

                            $stmt = $pdo->prepare("UPDATE `polls` SET `email`='" . $_GET['email'] . "' WHERE id = ?");
                            $stmt->execute([$_GET['id']]);
                            header('Location: edit.php?id=' . $_GET['id'] . '&secret=' . $_GET['secret']);
                        }
                    }
                }

                if (isset($_GET['change_max'])) {
                    if (isset($_GET['name'])) {

                        $stmt = $pdo->prepare(
                            "UPDATE `poll_answers` SET `poll_id`=" . $_GET['id'] . ",
                                    `max_votes`= '" . $_GET['change_max'] . "' WHERE poll_id = " . $_GET['id'] . " AND title = '" . $_GET['name'] . "';");
                        $stmt->execute([$_GET['id']]);
                    }
                }

                if (isset($_GET['del'])) {
                    if ($_GET['del'] == 'true') {

                        if (isset($_GET['poll_name'])) {

                            $stmt = $pdo->prepare("DELETE FROM poll_answers WHERE title = '" . $_GET['poll_name'] . "' AND poll_id = " . $_GET['id'] . ";");
                            $stmt->execute([$_GET['id']]);

                            $stmt = $pdo->prepare("DELETE FROM poll_vote WHERE vote = '" . $_GET['poll_name'] . "' AND poll_id = " . $_GET['id'] . ";");
                            $stmt->execute([$_GET['id']]);

                            header('Location: edit.php?id=' . $_GET['id'] . "&secret=" . $_GET['secret']);
                        }

                        if (isset($_GET['delPoll'])) {
                            $stmt = $pdo->prepare("DELETE FROM polls WHERE id = " . $_GET['id'] . ";");
                            $stmt->execute([$_GET['id']]);

                            $stmt = $pdo->prepare("DELETE FROM poll_answers WHERE poll_id = " . $_GET['id'] . ";");
                            $stmt->execute([$_GET['id']]);

                            $stmt = $pdo->prepare("DELETE FROM poll_vote WHERE poll_id = " . $_GET['id'] . ";");
                            $stmt->execute([$_GET['id']]);
                            header('Location: ../index.php');
                        }
                    }
                }
            } else {
                return404();
            }
        } else {
            return404();
        }

    } else {
        return404();
    }
} else {
    exit('Es wurde keine ID angegeben.');
}
?>

<?= template_header('Admin Panel von ' . $poll['title']) ?>

<script src="assets/js/sites/edit.js"></script>

<div class="content poll-result">
    <h2><?= $poll['title'] ?></h2>
    <p><strong>Beschreibung:</strong> <br> <?= $poll['description'] ?></p>

    <style>

        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }

        .delete {
            float: right;
            margin-right: 6px;
            margin-top: -40px;
            position: relative;
            color: red;
        }

        .userlink {
            width: 230px;
        }

        .adminlink {
            width: 260px;
        }

        .button {
            border: none;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            background-color: #4379e5;
            font-weight: bold;
        }

    </style>
    <br>

    <a href="#" <span title='Umfrage löschen'></span>
    <i class='fas fa-trash-alt delete' onclick="confirmDelete()"></i></a>

    <a href="admin.php?id=<?= $_GET['id'] ?>&secret=<?= $_GET['secret'] ?>" style="color: red">
        </span><strong>Administrationsseite der Umfrage: </strong></a>
    <br>
    <input type="text" class="adminlink" onClick="this.select();"
           value="https://<?= $_SERVER['SERVER_NAME'] ?>/admin.php?id=<?= $_GET['id'] ?>&secret=<?= $_GET['secret'] ?>">

    <br>
    <br>

    <a href="vote.php?id=<?= $_GET['id'] ?>" style="color: black">
        </span><strong>Öffentlicher Link zur Umfrage: </strong></a>
    <br>
    <input type="text" class="userlink" onClick="this.select();"
           value="https://<?= $_SERVER['SERVER_NAME'] ?>/vote.php?id=<?= $_GET['id'] ?>">

    <br>

    <br>
    <div style="display: table-row">
        <a style="color: black"></span><strong>Titel ändern: </strong></a>
        <br>
        <input onclick="inputText('<?= $_GET['id'] ?>', '<?= $_GET['secret'] ?>', 'title')" type="button"
               class="button" value="Ändern" style="width: 100px; height: 40px; background-color: #4379e5">
        <input type="text" value="<?= $poll['title'] ?>" disabled>

        <br>
        <br>

        <a style="color: black"></span><strong>Beschreibung ändern: </strong></a>
        <br>
        <input onclick="inputText('<?= $_GET['id'] ?>', '<?= $_GET['secret'] ?>', 'description')"
               type="button" class="button" value="Ändern"
               style="width: 100px; height: 40px; background-color: #4379e5">
        <input type="text" value="<?= $poll['description'] ?>" disabled>

        <br>
        <br>


        <a style="color: black"></span><strong>Admin Secret ändern: </strong></a>
        <br>
        <input onclick="inputText('<?= $_GET['id'] ?>', '<?= $_GET['secret'] ?>', 'admin')"
               type="button" class="button" value="Ändern"
               style="width: 100px; height: 40px; background-color: #4379e5">
        <input type="text" value="<?= $poll['admin_id'] ?>" disabled>

        <br>
        <br>

        <a style="color: black;"></span><strong>E-Mail ändern: </strong></a>
        <br>
        <input onclick="inputText('<?= $_GET['id'] ?>', '<?= $_GET['secret'] ?>', 'email')"
               type="button" class="button" value="Ändern"
               style="width: 100px; height: 40px; background-color: #4379e5">
        <input type="text" value="<?= $poll['email'] ?>" disabled>

        <br>
        <br>
    </div>
    <br>
    <br>
    <br>

    <div class="wrapper" id="wrapper" style="width: 2000px;">

        <div class="poll-question">
            <div data-role="main" class="ui-content">
                <br>

                <table id="table" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Abstimmungs Name</th>
                        <th>Insgesamte Stimmen</th>
                        <th>Maximale Stimmen</th>
                        <th>Aktionen</th>
                    </tr>
                    </thead>
                    <div id="votes">
                        <tbody id="view_body">

                        <?php foreach ($poll_answers as $poll_answer):

                            $del = "<a href='./edit.php?id=" . $_GET['id'] . "&secret=" . $_GET['secret'] . "&del=true&poll_name=" . $poll_answer['title'] . "'
<i class='fas fa-trash-alt' style='color: red'></i></a>";


                            $stmt = $pdo->prepare('SELECT max_votes, voted_votes, title FROM poll_answers WHERE poll_id = ? AND title = "' . $poll_answer['title'] . '";');
                            $stmt->execute([$_GET['id']]);
                            $poll_answer_votes = $stmt->fetch(PDO::FETCH_ASSOC);


                            $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
                            $stmt->execute([$_GET['id']]);
                            $poll = $stmt->fetch(PDO::FETCH_ASSOC);
                            $edit_max = "";

                            if($poll['withmax'] == "true"){
                                $edit_max = "<a href='#' onclick='changeMax(`" . $poll_answer_votes['title'] . "`)' <i class='fas fa-pencil-alt' style='color: gray'></i></a>";
                            }
                            echo '
<tr>
<th scope="row">' . $poll_answer['title'] . '<br></th>
<th scope="row">' . $poll_answer_votes['voted_votes'] . '<br></th>
<th scope="row">' . $poll_answer_votes['max_votes'] . '<br></th>

<th scope="row">' . $del . ' ' . $edit_max . '<br></th>
</tr>
';
                        endforeach; ?>
                        </tbody>
                    </div>
            </div>
        </div>

    </div>

</div>


<?= template_footer() ?>
