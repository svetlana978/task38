function showContent() {

    xhr = new XMLHttpRequest();
    xhr.open("POST", 'tableOutput.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState != 4) return 0;
        if (xhr.status == 200) {
            $('#table').html(xhr.responseText);
        }

    }
    xhr.send(null);
}


document.addEventListener('DOMContentLoaded', function() {

    let button = document.querySelectorAll('input');

    for (let i = 0; i < button.length; i++) {
        let but_id = {
            of_name: button[i].id,
        };
        $.ajax({
            url: 'offerActivityButtonStatus.php',
            type: 'POST',
            // dataType: Object,
            data: but_id,
            error: function() {
                console.log('Ошибка!');
            },
            success: function(a) {
                // console.log(a);
                if (a == 'YES') {
                    button[i].value = 'disact';
                } else button[i].value = 'act';
            }
        })
    }
})

document.addEventListener('click', function() {

    var button = event.target;
    if (button.tagName === 'INPUT' && button.type === 'button') {
        // console.log(button.id, button.value);
        // button.innerHTML = 0;
        // console.log(button.innerHTML);

        // console.log(button.innerText);
        let data = {
            of_name: button.id,
        };

        $.ajax({
            url: 'offerActivity.php',
            type: 'POST',
            data: data,
            error: function() {
                console.log('Ошибка!');
            },
            success: function(a) {
                console.log(a);

                if (a == 'YES') {
                    button.value = 'act';
                } else button.value = 'disact';
                showContent();


            }
        })

    }
});