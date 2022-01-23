document.addEventListener('change', function() {
    var check = event.target;

    if (check.tagName === 'INPUT' && check.type === 'checkbox') {
        //console.log(check.id, check.value, check.checked);
        element = Number(check.id);
        $.ajax({
            url: 'offerActivity.php',
            type: 'POST',
            data: element,
            error: function() {
                console.log('Ошибка!');
            },
            success: function() {
                console.log('done');
            }
        })
    }
});