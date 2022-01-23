document.addEventListener('change', function() {
    var check = event.target;

    if (check.tagName === 'INPUT' && check.type === 'checkbox') {
        console.log(check.id, check.checked);
        //element = Number(check.id);
        let data = {
            str_num: Number(check.id),
        };
        $.ajax({
            url: 'offerActivity.php',
            type: 'POST',
            // dataType: Object,
            data: data,
            error: function() {
                console.log('Ошибка!');
            },
            success: function() {
                console.log('done');
            }
        })
    }
});