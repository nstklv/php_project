    $(document).ready(function(){
        $('.cards').slick({
            dots: true, // Показать пагинацию
            infinite: false, // Бесконечный слайдер
            speed: 300, // Скорость анимации
            slidesToShow: 4, // Количество слайдов для показа
            slidesToScroll: 1, // Количество слайдов для прокрутки
            prevArrow: '<button type="button" class="slick-prev">Previous</button>', // Кнопка "назад"
            nextArrow: '<button type="button" class="slick-next">Next</button>', // Кнопка "вперед"
            responsive: [
                {
                    breakpoint: 1024, // Разрешение экрана для медиа-запроса
                    settings: {
                        slidesToShow: 2 // Количество слайдов для показа при разрешении 1024px и меньше
                    }
                },
                {
                    breakpoint: 600, // Разрешение экрана для медиа-запроса
                    settings: {
                        slidesToShow: 1 // Количество слайдов для показа при разрешении 600px и меньше
                    }
                }
            ]
        });
    });

