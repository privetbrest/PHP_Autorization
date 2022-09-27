//Обработка формы login
$(document).ready(function()
{
  $("#submitLog").click(function()
  {
    var params = {
      login: $.trim($("#login").val()),
      password: $.trim($("#password").val()),
    }
    $.ajax({
            type: 'POST',
            // contentType: 'application/json;charset=UTF-8', 
            url: "",
            data: params,
            dataType: "json",
            success: function(data)
            {
              $("#log6").html("");
              $("#logPass").html("");
              // JSON.parse(data);
              if (data.errLog6 == "errorsLog6")
              {
                $("#log6").html(data.textLog6);
              } else if (data.errLogPass == "errorsLogPass")
              {
                $("#logPass").html(data.textLogPass);
              } else {
                window.location.href = "/cabinet";
              }

            
            
              //   $("#Log6").html("");
            //   $("#LogPass").html("");
            // if (data.indexOf('errorsLog6') > 0) {
            //   $("#Log6").html("Login не должен быть короче 6-ти символов");
            // } else if (data.indexOf('errorsLogPass') > 0) {
            //   $("#LogPass").html("Неправильные данные для входа на сайт");
            // } else {
            //   window.location.href = "/cabinet";
            // }
            
            },
          
    });
  });
  
});


//Обработка формы register и edit
$(document).ready(function()
{
  $("#submitReg").click(function()
  {
    var params = {
      login: $.trim($("#login").val()),
      password: $.trim($("#password").val()),
      confirmPassword: $.trim($("#confirmPassword").val()),
      email: $.trim($("#email").val()),
      name: $.trim($("#name").val()),
    }
    $.ajax({
              type: 'POST',
              // contentType: 'application/json;charset=UTF-8', 
              url: "",
              data: params,
              dataType: "json",
              success: function(data)
            {
              
              $("#log6").html("");
              $("#logSpace").html("");
              $("#logUse").html("");
              $("#pass6").html("");
              $("#passData").html("");
              $("#passChar").html("");
              $("#passConflict").html("");
              $("#emailIncorrect").html("");
              $("#emailUse").html("");
              $("#nameSpace").html("");
              $("#nameLengthMin").html("");
              $("#nameLengthMax").html("");
              $("#reg").html("");
              // console.log(data.textLog6);
              if (data.errLog6 == 'errorsLog6')
              {
                $("#log6").html(data.textLog6);
              }
              if (data.errLogSpace == "errorsLogSpace")
              {
                $("#logSpace").html(data.textLogSpace);
              }
              if (data.errLogUse == "errorsLogUse")
              {
                $("#logUse").html(data.textLogUse);
              }
              if (data.errPass6 == "errorsPass6")
              {
                $("#pass6").html(data.textPass6);
              }
              if (data.errPassData == "errorsPassData")
              {
                $("#passData").html(data.textPassData);
              }
              if (data.errPassChar == "errorsPassChar")
              {
                $("#passChar").html(data.textPassChar);
              }
              if (data.errPassConflict == "errorsPassConflict")
              {
                $("#passConflict").html(data.textPassConflict);
              }
              if (data.errEmailIncorrect == "errorsEmailIncorrect")
              {
                $("#emailIncorrect").html(data.textEmailIncorrect);
              }
              if (data.errEmailUse == "errorsEmailUse")
              {
                $("#emailUse").html(data.textEmailUse);
              }
              if (data.errNameSpace == "errorsNameSpace")
              {
                $("#nameSpace").html(data.textNameSpace);
              }
              if (data.errNameLengthMin == "errorsNameLengthMin")
              {
                $("#nameLengthMin").html(data.textNameLengthMin);
              }
              if (data.errNameLengthMax == "errorsNameLengthMax")
              {
                $("#nameLengthMax").html(data.textNameLengthMax);
              }
              if (data.errReg == "successReg")
              {
                $("#reg").html(data.textReg);
              } else if (data.errEdit == "successEdit") {
                $("#edit").html(data.textEdit);
                console.log(data.textEdit);
                window.location.href = "/cabinet/edit";
              }
             
            // if (data.indexOf('errorsLog6') > 0) {
            //   $("#Log6").html("Login не должен быть короче 6-ти символов");
            // }
            // if (data.indexOf('errorsLogSpace') > 0) {
            //   $("#logSpace").html("Login не должен содержать пробелы");
            // }
            // if (data.indexOf('errorsLogUse') > 0) {
            //   $("#logUse").html("Такой Login уже используется");
            // }
            // if (data.indexOf('errorsPass6') > 0) {
            //   $("#pass6").html("Пароль не должен быть короче 6-ти символов");
            // }
            // if (data.indexOf('errorsPassData') > 0) {
            //   $("#passData").html("Пароль должен содержать буквы и цифры");
            // }
            // if (data.indexOf('errorsPassChar') > 0) {
            //   $("#passChar").html("Пароль не должен содержать спец символы");
            // }
            // if (data.indexOf('errorsPassConflict') > 0) {
            //   $("#passConflict").html("Пароли не совпадают");
            // }
            // if (data.indexOf('errorsEmailIncorrecte') > 0) {
            //   $("#emailIncorrect").html("Неправильный email");
            // }
            // if (data.indexOf('errorsEmailUse') > 0) {
            //   $("#emailUse").html("Такой Email уже используется");
            // }
            // if (data.indexOf('errorsNameSpace') > 0) {
            //   $("#nameSpace").html("Имя не должно содержать пробелы");
            // }
            // if (data.indexOf('errorsNameLengthMin') > 0) {
            //   $("#nameLengthMin").html("Имя не должно быть короче 2-х символов");
            // }
            // if (data.indexOf('errorsNameLengthMax') > 0) {
            //   $("#nameLengthMax").html("Имя не должно быть длинее 25-х символов");
            // }
            // if (data.indexOf('successReg') > 0) {
            //   $("#reg").html("Вы зарегистированы!");
            // } else if (data.indexOf('successEdit') > 0) {
            //   $("#edit").html("Пользовательские данные обновлены!");
            //   window.location.href = "/cabinet/edit";
            // }
            },
          
    });
  });
  
});

//Обработка формы delete
$(document).ready(function()
{
  $("#submitDel").click(function()
  {
    var params = {
      password: $.trim($("#password").val()),
    }
    $.ajax({
            type: 'POST',
            url: "",
            data: params,
            // dataType: "json",
            success: function(data)
            {
              $("#passCorrect").html("");
            if (data.errPassCorrect == "errorsPassCorrect")
            {
              $("#passCorrect").html(data.textPassCorrect);
            } else 
            {
              window.location.href = "/user/login";
            }
              
            
            },
          
    });
  });
  
});