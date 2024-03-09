$(document).ready(function() {
    $(document).on('click', '.add-to-favorite', function() {
        var bag_id = $(this).data('bag-id');
        var heartIcon = $(this);

        // Проверяем, добавлен ли товар в избранное
        $.ajax({
            url: 'check_favorite.php',
            method: 'POST',
            data: { bag_id: bag_id },
            success: function(response) {
                if (response === 'not_exists') {
                    // Если товар еще не добавлен в избранное, добавляем
                    $.ajax({
                        url: 'add_to_liked.php',
                        method: 'POST',
                        data: { bag_id: bag_id },
                        success: function(response) {
                            if (response === 'success') {
                                alert('Товар добавлен в избранное!');
                                heartIcon.addClass('liked');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else if (response === 'exists') {
                    // Если товар уже добавлен в избранное, удаляем
                    $.ajax({
                        url: 'remove_from_liked.php',
                        method: 'POST',
                        data: { bag_id: bag_id },
                        success: function(response) {
                            if (response === 'success') {
                                alert('Товар удален из избранного!');
                                heartIcon.removeClass('liked');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
