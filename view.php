<?php
include 'assets/php/functions.php';
$pdo = connect_mysql();

if (isset($_GET['id'])) {

    $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($poll) {

        $stmt = $pdo->prepare('SELECT * FROM poll_answers WHERE poll_id = ? ORDER BY poll_id DESC;');
        $stmt->execute([$_GET['id']]);

        $poll_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $stmt = $pdo->prepare('SELECT vote, name, id FROM poll_vote WHERE poll_id = ? ORDER BY poll_id DESC;');
        $stmt->execute([$_GET['id']]);

        $voters = $stmt->fetchAll(PDO::FETCH_ASSOC);

        template_header('Abstimmungen von ' . $poll['title']);
        if (isset($_GET['del'])) {
            if ($_GET['del'] == 'true') {


                echo "<script>
                        
                        Swal.fire({
                          title: 'Antwort löschen',
                          text: 'Um die Antwort zu löschen, gib bitte die ID von der Antwort ein. Die ID bekommt man nach dem abstimmen',
                          icon: 'warning',
                          showCancelButton: true,
                          cancelButtonColor: '#3085d6',
                          confirmButtonColor: '#d33',
                          confirmButtonText: 'Löschen!',
                          cancelButtonText: 'Abbrechen',
                          input: 'text',
                          inputAttributes: {
                            autocapitalize: 'off'
                          },
                          showLoaderOnConfirm: true,
                          preConfirm: (key) => {
                            
                              Swal.fire({
                                  title: 'Antwort gelöscht',
                                  text: 'Die Antwort wurde erfolgreich gelöscht',
                                  icon: 'success',
                              }).then(function() {
                                    window.location.href = 'view.php?id=" . $_GET['id'] . "&del=true&deleteKey=' + key;
                              });
                              
                          },
                          allowOutsideClick: () => !Swal.isLoading()
                        })
                      
                        </script>";


                if (isset($_GET['deleteKey'])) {

                    $stmt = $pdo->prepare('SELECT * FROM poll_vote WHERE deleteKey = "' . $_GET['deleteKey'] . '" AND poll_id=?;');
                    $stmt->execute([$_GET['id']]);
                    $poll_vote = $stmt->fetch(PDO::FETCH_ASSOC);

                    $stmt = $pdo->prepare(
                        "UPDATE `poll_answers` SET `poll_id`=" . $_GET['id'] . ",`title`='" . $poll_vote['vote'] . "',
                                    `voted_votes`= voted_votes - 1 WHERE poll_id = " . $_GET['id'] . " AND title = '" . $poll_vote['vote'] . "';");
                    $stmt->execute([$_GET['id']]);

                    $stmt = $pdo->prepare("DELETE FROM poll_vote WHERE deleteKey = '" . $_GET['deleteKey'] . "';");
                    $stmt->execute([$_GET['id']]);
                    header('Location: view.php?id=' . $_GET['id']);
                }
            }
        }
    } else {
        exit('Eine Umfrage mit dieser ID existiert nicht.');
    }
} else {
    exit('Es wurde keine ID angegeben.');
}
?>



<meta http-equiv="refresh" content="60">

<div class="content poll-result">
    <h2><?= $poll['title'] ?></h2>
    <p><strong>Beschreibung:</strong> <br> <?= $poll['description'] ?></p>
    <style>
        .userlink {
            width: 230px;
        }
    </style>

    <script>

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
    <a href="vote.php?id=<?= $_GET['id'] ?>" style="color: black">
        </span><strong>Öffentlicher Link zur Umfrage: </strong></a>
    <br>
    <input type="text" class="userlink" onClick="this.select();"
           value="https://<?= $_SERVER['SERVER_NAME'] ?>/vote.php?id=<?= $_GET['id'] ?>">

    <div style="float: right;">
        <a href='./view.php?id=<?= $_GET['id'] ?>&del=true'> <span title='Eine Antwort löschen'>
            <i class='fas fa-trash-alt' style='color: red'></i></a>

    </div>
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
                </tr>
                </thead>

                <tbody id="view_body">

                <?php foreach ($voters as $voter):

                    $stmt = $pdo->prepare('SELECT max_votes, voted_votes, title FROM poll_answers WHERE poll_id = ? AND title = "' . $voter['vote'] . '";');
                    $stmt->execute([$_GET['id']]);
                    $poll_answer_votes = $stmt->fetch(PDO::FETCH_ASSOC);

                    echo '
<tr>
<th scope="row">' . $voter['name'] . '<br></th>
<th scope="row">' . $voter['vote'] . '<br></th>
</tr>
';
                endforeach; ?>
                </tbody>
        </div>

    </div>
</div>

<?= template_footer() ?>
