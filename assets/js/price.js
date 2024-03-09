$(document).ready(function() {
    $('.filter, .category-filter').change(function() {
        // Собираем выбранные значения фильтров
        var filters = [];
        $('.filter:checked').each(function() {
            filters.push($(this).val());
        });

        // Собираем выбранные значения фильтров по категориям
        var categoryFilters = [];
        $('.category-filter:checked').each(function() {
            categoryFilters.push($(this).val());
        });

        // Получаем значения минимальной и максимальной цены
        var minPrice = $('#min-price').val();
        var maxPrice = $('#max-price').val();

        var search = document.querySelector('.cards').getAttribute('data-search');

        // Отправляем AJAX-запрос на сервер
        $.ajax({
            url: 'filter_products.php',
            type: 'POST',
            data: { filters: filters, categoryFilters: categoryFilters, search_query: search, min_price: minPrice, max_price: maxPrice },
            dataType: 'html',
            success: function(response) {
                $('#products-container').html(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    });
});
