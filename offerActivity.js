$('#offer_activity').click(function() {
    console.log(3);
    $.post(
        "offerActivity.php", { myActionName: "Выполнить" }

    );
    print(3);

});