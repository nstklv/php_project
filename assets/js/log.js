$.ajax({
    type: "POST",
    url: "page1.php",
    data: {
        'name_user': name_user,
        'email_user': email_user,
        'password_user': password_user,
        'password_2_user': password_2_user
    },
    dataType: "json",
    success: function(data) {
        // Обработка успешного ответа сервера
        if (data.result === 'success') {
           
            alert('Регистрация прошла успешно!');
            
            window.location.href = "login.php";
        } else {
           
            alert('Ошибка регистрации: ' + data.error_message);
        }
    },
    error: function(xhr, status, error) {
       
        console.error("Ошибка запроса:", error);
      
        alert('Произошла ошибка при отправке запроса');
    }
});
