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

function changeMax(poll_name) {

    Swal.fire({
        title: 'Maximale Stimmen ändern',
        text: "Gebe eine neue Zahl an!",
        icon: 'info',
        input: 'number',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ändern!',
        cancelButtonText: 'Abbrechen',
        preConfirm: (newMax) => {
            if (!newMax) {
                Swal.showValidationMessage('<i class="fa fa-info-circle"></i> Bitte gebe eine Zahl an!')
            }
            Swal.fire(
                'Geändert!',
                'Maximale Stimmen geändert.',
                'success'
            ).then((result) => {
                window.location.href = "edit.php?id=<?= $_GET['id'] ?>&secret=<?= $_GET['secret'] ?>&change_max=" + newMax + "&name=" + poll_name;
            })
        }
    })

}

/*function useMaxAnswers(poll_id, secret, value) {
    if(value) {
        window.location.href = "edit.php?id=" + poll_id + "&secret=" + secret + "&change=true&use_max_answers=true";
    }else{
        window.location.href = "edit.php?id=" + poll_id + "&secret=" + secret + "&change=true&use_max_answers=false";
    }
}*/

function inputText(poll_id, secret, type) {

    if (type === "title") {
        Swal.fire({
            title: 'Titel ändern',
            text: "Gebe einen neuen Titel an!",
            icon: 'info',
            input: 'text',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ändern!',
            cancelButtonText: 'Abbrechen',
            preConfirm: (input) => {
                Swal.fire(
                    'Geändert!',
                    'Titel geändert.',
                    'success'
                ).then((result) => {
                    window.location.href = "edit.php?id=" + poll_id + "&secret=" + secret + "&change=true&title=" + input;
                })
            }
        })

    } else if (type === "description") {
        Swal.fire({
            title: 'Beschreibung ändern',
            text: "Gebe eine neue Beschreibung an!",
            icon: 'info',
            input: 'text',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ändern!',
            cancelButtonText: 'Abbrechen',
            preConfirm: (input) => {
                Swal.fire(
                    'Geändert!',
                    'Beschreibung geändert.',
                    'success'
                ).then((result) => {
                    window.location.href = "edit.php?id=" + poll_id + "&secret=" + secret + "&change=true&description=" + input;
                })
            }
        })

    } else if (type === "admin") {
        Swal.fire({
            title: 'Admin Secret ändern',
            text: "Gebe ein neues Secret an!",
            icon: 'info',
            input: 'text',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ändern!',
            cancelButtonText: 'Abbrechen',
            preConfirm: (input) => {
                Swal.fire(
                    'Geändert!',
                    'Secret geändert.',
                    'success'
                ).then((result) => {
                    window.location.href = "edit.php?id=" + poll_id + "&secret=" + secret + "&change=true&admin=" + input;
                })
            }
        })

    } else if (type === "email") {
        Swal.fire({
            title: 'E-Mail ändern',
            text: "Gebe eine neue E-Mail Addresse an!",
            icon: 'info',
            input: 'email',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ändern!',
            cancelButtonText: 'Abbrechen',
            preConfirm: (input) => {
                if (!input) {
                    Swal.showValidationMessage('<i class="fa fa-info-circle"></i> Bitte gebe eine E-Mail Addresse an!')
                }
                Swal.fire(
                    'Geändert!',
                    'E-Mail geändert.',
                    'success'
                ).then((result) => {
                    window.location.href = "edit.php?id=" + poll_id + "&secret=" + secret + "&change=true&email=" + input;
                })
            }
        })

    } else {
        console.log("Provide a valid type!");
    }
}


function confirmDelete() {

    Swal.fire({
        title: 'Umfrage löschen?',
        text: "Dies kann nicht rückgängig gemacht werden!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
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