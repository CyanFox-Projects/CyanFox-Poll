
var hidden = false;

function check() {
    if (document.getElementById('useMaxAnswers').checked) {
        $('.max_votes').show();
        hidden = false;

        document.getElementById('answers_div_max').innerHTML = "";
        document.getElementById('answers_div_option').innerHTML = "";
        add();

        document.getElementById('answers_div_max').required = true;
    } else {
        $('.max_votes').hide();
        hidden = true;

        document.getElementById('answers_div_max').innerHTML = "";
        document.getElementById('answers_div_option').innerHTML = "";
        add();

        document.getElementById('answers_div_max').required = false;
    }
}

$('.add').on('click', add);
$('.remove').on('click', remove);

let i = 1;

function add() {

    if(hidden) {
        var new_input = '<input name="answers[' + i + ']" id="answers" placeholder="Antwort Möglichkeit" required>';
        $('#answers_div_option').append(new_input);
        i++;
    }else {
        var new_input = '<input name="answers[' + i + ']" id="answers" placeholder="Antwort Möglichkeit" required>';
        var new_input_max = "<input min='1' style='width: 173px' type='number' name='max_votes[" + i + "]' id='max_votes' class='max_votes' placeholder='Max Stimmen' required>";


        i++;
        $('#answers_div_option').append(new_input);
        $('#answers_div_max').append(new_input_max);
    }
}

function remove() {
    if (i === 1) {
        return;
    }
    if ($('#answers_div_option input').length > 0) {
        $('#answers_div_option input:last').remove();
    }
    if ($('#answers_div_max input').length > 0) {
        $('#answers_div_max input:last').remove();
    }
    i--;
}

$(document).ready(function () {
    window.addEventListener("keydown", function(e) {
        if(e.key === "+") {
            add();
        }
        if(e.key === "-") {
            remove();
        }
    });
});