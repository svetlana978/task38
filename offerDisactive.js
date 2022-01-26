document.addEventListener('change', function() {
    var check = event.target;

    if (check.tagName === 'INPUT' && check.type === 'checkbox') {
        console.log(check.id, check.checked);
        // str_num = Number(check.id);
        let data = {
            of_name: check.id,
        };
        // const dataObj = {
        //     element: Number(check.id)
        // };

        // const data = JSON.stringify(dataObj);

        // $.ajax({
        //     type: "POST",
        //     url: "offerActivity.php",
        //     data: data,
        //     contentType: "application/json; charset=utf-8",
        //     dataType: "json",
        //     success: function(msg) {
        //         console.log('success');
        //     }
        // });

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