<?php
include 'assets/php/functions.php';
$pdo = connect_mysql();

if (isset($_GET['id'])) {

    $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);


    if (isset($_GET['secret'])) {
        if ($_GET['secret'] == $poll['admin_id']) {

            template_header('Admin Panel von ' . $poll['title']);
            if ($poll) {


                $stmt = $pdo->prepare('SELECT * FROM poll_answers WHERE poll_id = ? ORDER BY poll_id DESC;');
                $stmt->execute([$_GET['id']]);

                $poll_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);


                $stmt = $pdo->prepare('SELECT vote, name, id FROM poll_vote WHERE poll_id = ? ORDER BY poll_id DESC;');
                $stmt->execute([$_GET['id']]);

                $voters = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (isset($_GET['del'])) {
                    if ($_GET['del'] == 'true') {

                        if (isset($_GET['userid'])) {

                            $stmt = $pdo->prepare('SELECT * FROM poll_vote WHERE id = "' . $_GET['userid'] . '";');
                            $stmt->execute([$_GET['id']]);
                            $poll_vote = $stmt->fetch(PDO::FETCH_ASSOC);

                            $stmt = $pdo->prepare(
                                "UPDATE `poll_answers` SET `poll_id`=" . $_GET['id'] . ",`title`='" . $poll_vote['vote'] . "',
                                    `voted_votes`= voted_votes - 1 WHERE poll_id = " . $_GET['id'] . " AND title = '" . $poll_vote['vote'] . "';");
                            $stmt->execute([$_GET['id']]);

                            $stmt = $pdo->prepare("DELETE FROM poll_vote WHERE id = " . $_GET['userid'] . ";");
                            $stmt->execute([$_GET['id']]);
                            echo "<script>window.location.href = 'admin.php?id=" . $_GET['id'] . "&secret=" . $_GET['secret'] . ";</script>";
                        }

                        if (isset($_GET['delPoll'])) {
                            $stmt = $pdo->prepare("DELETE FROM polls WHERE id = " . $_GET['id'] . ";");
                            $stmt->execute();

                            $stmt = $pdo->prepare("DELETE FROM poll_answers WHERE poll_id = " . $_GET['id'] . ";");
                            $stmt->execute();

                            $stmt = $pdo->prepare("DELETE FROM poll_vote WHERE poll_id = " . $_GET['id'] . ";");
                            $stmt->execute();

                            echo "<script>window.location.href = '../index.php';</script>";
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
    return404();
}
?>


<meta http-equiv="refresh" content="60">

<div class="content poll-result">
    <h2><?= $poll['title'] ?></h2>
    <p><strong>Beschreibung:</strong> <br> <?= $poll['description'] ?></p>
    <style>

        .delete {
            float: right;
            margin-right: 6px;
            margin-top: -40px;
            position: relative;
            color: red;
        }

        .edit {
            float: right;
            margin-right: -20px;
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
    </style>
    <br>


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

    <span title='Umfrage löschen'></span>
    <i style="cursor: pointer;" class='fas fa-trash-alt delete' onclick="confirmDelete()"></i>

    <a href='edit.php?id=<?= $_GET['id'] ?>&secret=<?= $_GET['secret'] ?>'> <span title='Umfrage bearbeiten'></span>
    <i class='fas fa-pencil-alt edit' style='color: gray'></i></a>

    <script>

        function confirmDelete() {

            Swal.fire({
                title: 'Umfrage löschen?',
                text: "Dies kann nicht rückgängig gemacht werden!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Löschen!',
                cancelButtonText: 'Abbrechen'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Gelöscht!',
                        'Die Umfrage wurde erfolgreich gelöscht.',
                        'success'
                    ).then((result) => {
                        window.location.href = "./admin.php?id=<?= $_GET['id'] ?>&secret=<?= $_GET['secret'] ?>&del=true&delPoll=true";
                    })
                }
            })
        }

        $(document).ready(function () {

            loadDataTable();


        });

        function loadDataTable() {
            $('#table').DataTable({
                colReader: {
                    realtime: true,
                },
                responsive: true,
                destroy: true,
                paging: true,
                ordering: true,
                info: true,
                searching: true,
            });
        }

    </script>
    <br>
    <br>

    <div class="wrapper" id="wrapper" style="width: 2000px;">

        <div class="poll-question">
            <br>

            <table id="table" class="display" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Abstimmung</th>
                    <th>Insgesamte Stimmen</th>
                    <th>Maximale Stimmen</th>
                    <th>Aktionen</th>
                </tr>
                </thead>

                <tbody id="view_body">

                <?php foreach ($voters as $voter):

                    $del = "<a href='./admin.php?id=" . $_GET['id'] . "&secret=" . $_GET['secret'] . "&del=true&userid=" . $voter['id'] . "' <span title='Diese Antwort löschen'>
<i class='fas fa-trash-alt' style='color: red'></i></a>";


                    $stmt = $pdo->prepare('SELECT max_votes, voted_votes, title FROM poll_answers WHERE poll_id = ? AND title = "' . $voter['vote'] . '";');
                    $stmt->execute([$_GET['id']]);
                    $poll_answer_votes = $stmt->fetch(PDO::FETCH_ASSOC);

                    echo '
<tr>
<th scope="row">' . $voter['name'] . '<br></th>
<th scope="row">' . $voter['vote'] . '<br></th>
<th scope="row">' . $poll_answer_votes['voted_votes'] . '<br></th>
<th scope="row">' . $poll_answer_votes['max_votes'] . '<br></th>
<th scope="row">' . $del . '<br></th>
</tr>
';
                endforeach; ?>
                </tbody>
        </div>

    </div>
</div>

<?= template_footer() ?>
