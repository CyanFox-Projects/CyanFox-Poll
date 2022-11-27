<?php
include 'assets/php/functions.php';
$pdo = connect_mysql();

if(isset($_GET['email'])){
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$_GET['email']]);
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<?= template_header('Umfrage suchen') ?>


<div class="content poll-result">
    <h2>Umfrage suchen</h2>

    <style>

        html, body {
            max-width: 100%;
            overflow-x: hidden;
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
        <a style="color: black; text-align: center; justify-content: center"></span><strong>Suchen: </strong></a>
        <br>
        <input id="email" type="text" placeholder="E-Mail" style="width: 250px; height: 40px;">
        <input type="button" class="button" value="Suchen"
               onclick="window.location.href = 'find.php?email=' + document.getElementById('email').value " style="width: 100px; height: 40px; background-color: #4379e5">

        <br>
        <br>
    </div>

    <div class="wrapper" id="wrapper" style="width: 2000px;">

        <div class="poll-question">
            <div data-role="main" class="ui-content">
                <br>

                <table id="table" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Umfrage</th>
                        <th>Öffentlicher Link</th>
                        <th>Admin Link</th>
                        <th>Aktionen</th>
                    </tr>
                    </thead>
                    <div id="votes">
                        <tbody id="view_body">

                        <?php foreach ($poll as $polls):

                            $del = "<a href='./edit.php?id=" . $_GET['id'] . "&secret=" . $_GET['secret'] . "&del=true&poll_name=" . $poll_answer['title'] . "'
<i class='fas fa-trash-alt' style='color: red'></i></a>";


                            echo '
<tr>
<th scope="row">' . $poll['title'] . '<br></th>
<th scope="row"><a href="https://' . $_SERVER['SERVER_NAME'] .'/vote.php?id='. $_GET['id'] .'">Öffentlicher Link</a><br></th>
<th scope="row"><a href="https://' . $_SERVER['SERVER_NAME'] .'/admin.php?id='. $_GET['id'] .'">Admin Link</a><br></th>
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
