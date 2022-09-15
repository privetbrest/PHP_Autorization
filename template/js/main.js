$("#submit").click(function () {

    
    var params = {
        login: $("#login").val(),
        password: $("#password").val(),
        confirmPassword: $("#confirmPassword").val(),
        email: $("#email").val(),
        name: $("#name").val(),
        // dataType : 'json',
        // contentType: 'application/json;charset=UTF-8',
    }
    // $.post("ajax.php", params, function (data) {
    //     $("#hello").html(data);
        
    // }, 'json');
    $.ajax({
          type: 'POST',
          url: "/controllers/UserController.php",
          contentType: 'application/json;charset=UTF-8',
          data: params,
          success: function (data) {
                $("#hello").html(data);
            },
          dataType: "json"
        });
        
});
