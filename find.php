<?php
include 'assets/php/functions.php';
$pdo = connect_mysql();


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

    <script>

        function redirect(url) {
            window.location.href = url;
        }

        $(document).ready(function () {
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
        });
    </script>

    <br>
    <a style="color: black; text-align: center; justify-content: center"></span><strong>Suchen: </strong></a>
    <br>
    <input id="email" type="text" placeholder="E-Mail" style="width: 250px; height: 40px;">
    <input type="button" class="button" value="Suchen"
           onclick="window.location.href = 'find.php?email=' + document.getElementById('email').value "
           style="width: 100px; height: 40px; background-color: #4379e5">

    <br>
    <br>

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

                        <?php

                        if (isset($_GET['email'])) {
                            $stmt = $pdo->prepare('SELECT * FROM polls WHERE email = ?');
                            $stmt->execute([$_GET['email']]);
                            $poll = $stmt->fetchAll(PDO::FETCH_ASSOC);


                            foreach ($poll as $polls):

                                $edit = "<a href='#' title='Admin Panel' onclick='redirect(`/admin.php?id=" . $polls['id'] . "&secret=". $polls['admin_id'] ."`)'><i class='fa-solid fa-pen' style='color: green'></i></a>";
                                $view = "<a href='#' title='Anschauen' onclick='redirect(`/vote.php?id=" . $polls['id'] . "`)'><i class='fa-sharp fa-solid fa-eye' style='color: gray'></i></a>";


                                echo '
<tr>
<th scope="row">' . $polls['title'] . '<br></th>
<th scope="row"><a href="/vote.php?id=' . $polls['id'] . '">Öffentlicher Link</a><br></th>
<th scope="row"><a href="/admin.php?id=' . $polls['id'] . '&secret='. $polls['admin_id'] .'">Admin Link</a><br></th>
<th scope="row">' . $edit . ' ' . $view . '<br></th>
</tr>
';
                            endforeach;
                        } else {
                            echo '
<tr>
<th scope="row"><br></th>
<th scope="row"><br></th>
<th scope="row"><br></th>
<th scope="row"><br></th>
</tr>
';
                        }

                        ?>
                        </tbody>
                    </div>
            </div>
        </div>

    </div>
</div>


<?= template_footer() ?>
