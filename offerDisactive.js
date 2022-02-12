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
            // dataType: Object,
            data: data,
            error: function() {
                console.log('Ошибка!');
            },
            success: function(a) {
                console.log(a);
                // location.reload();

                if (a == 'YES') {
                    button.value = 'act';
                } else button.value = 'disact';
            }
        })






    }
});