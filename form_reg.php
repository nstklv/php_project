<?php 
include_once('db.php');
include('header.php');
?>


<link rel="stylesheet" type="text/css" href="./assets/css/reg.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<section class="main-section">
    <h2>Регистрация</h2>
    <div class="form-wrapper">
        <form action="reg.php" method="post" id="form_test" class="form">
            <label class="label_desc">Имя:</label>
            <input type="text" id="name_user" value="" class="input" name="name_user" required />
            <label id="name_user_error" class="error"></label>
            <label class="label_desc">E-mail:</label>
            <input type="text" id="email_user" value="" class="input" name="email_user" required />
            <label id="email_user_error" class="error"></label>
            <label class="label_desc">Пароль:</label>
            <input type="password" id="password_user" class="input" name="password_user" />
            <label id="password_user_error" class="error"></label>
            <label class="label_desc">Повторите пароль:</label>
            <input type="password" id="password_2_user" class="input" name="password_2_user" />
            <label id="password_2_user_error" class="error"></label>
            <input type="submit" value="Регистрация" id="send_data" class="btn_form" />
            <label id="auth" class="#"></label>
            <label class="reg_login">У вас уже есть аккаунт? <a href="login.php" class="btn_login"> Войти</a></label>
        </form>
    </div>
</section>

<?php include('footer.php'); ?>

<script>
    $('input').bind('blur', function(e) {
        //минус класс ошибок с инпутов
        $('input').each(function() {
            $(this).removeClass('error_input');
        });
        // минус текст ошибок
        $('.error').hide();
        // считывание
        var name_user = $('#name_user').val();
        var email_user = $('#email_user').val();
        var password_user = $('#password_user').val();
        var password_2_user = $('#password_2_user').val();

        $.ajax({
            type: "POST",
            url: "page1.php",
            data: { // какие данные будут переданы
                'name_user': name_user,
                'email_user': email_user,
                'password_user': password_user,
                'password_2_user': password_2_user
            },
            dataType: "json",
            // действие, при ответе с сервера
            success: function(data) {
                console.log(data);
                // в случае, когда пришло success. Отработало без ошибок
                if (data.result == 'success') {
                    $('input[type="submit"]').attr('disabled', false);
                } else {
                    // перебираем массив с ошибками
                    for (var errorField in data.text_error) {
                        console.log(errorField);
                        // выводим текст ошибок
                        $('#' + errorField + '_error').html(data.text_error[errorField]);
                        // показываем текст ошибок
                        $('#' + errorField + '_error').show();
                        // обводим инпуты красным цветом
                        $('#' + errorField).addClass('error_input');
                        // блокируем кнопку отправки в случае ошибок в форме
                        $('input[type="submit"]').attr('disabled', true);
                        return true;
                    }
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        // останавливаем сабмит, чтоб не перезагружалась страница
        return false;
    });
</script>
<script src="./assets/js/log.js"></script>
