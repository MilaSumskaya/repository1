$(document).ready(function(){

    $("#exampleInputPassword2").blur(function() {
        var pass = document.getElementById('exampleInputPassword1').value;
        var pass2 = document.getElementById('exampleInputPassword2').value;
        if (pass != pass2) {
          $("#password").html('Пароли не совпадают!');
        }
        if (pass === pass2) {
          $("#password").html('');
        }
      })

    $("#login").blur(function(){ //при потере фокуса
       //заносим в переменные данные с формы
       let login = document.getElementById("login").value;
       //формируем ajax запрос
       $.ajax({
        type:'post', //метод передачи
        url: 'testlogin.php', //кому передать
        data:({login: login}), //массив ланных имя:значение
        dataType:'html', //тип результата
        success:  function(result){ //если запрос успешен, выполнить функцию с результатом
            $("#massage").html("<p style='color: red'>"+result+"</p>");
        }
       })
    })
})