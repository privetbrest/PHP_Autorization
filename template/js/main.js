$("#send").click(function () {
    var params = {
        text: $("#input1").val(),
    }
    $.post("/views/user/registr.php", params, function (data) {
        $("#hello").html(data);
    });
});