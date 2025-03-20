function searchProducts() {
    const query = document.getElementById('search-input').value.toLowerCase(); // Получаем поисковый запрос
    const products = document.querySelectorAll('.product'); // Получаем все товары
    let foundProducts = false; // Флаг для проверки, найдены ли товары

    // Если запрос пустой, показываем все товары
    if (query === '') {
        products.forEach(product => {
            product.style.display = 'block'; // Показываем все товары
        });
        return; // Завершаем выполнение функции
    }

    // Перебираем все товары
    products.forEach(product => {
        const title = product.getAttribute('data-title').toLowerCase(); // Название товара
        const category = product.getAttribute('data-category').toLowerCase(); // Категория товара

        // Проверяем, совпадает ли запрос с названием или категорией
        if (title.includes(query) || category.includes(query)) {
            product.style.display = 'block'; // Показываем товар
            foundProducts = true; // Устанавливаем флаг, что товары найдены
        } else {
            product.style.display = 'none'; // Скрываем товар
        }
    });

    // Если товары не найдены, выводим сообщение
    if (!foundProducts) {
        document.getElementById('product-container').innerHTML = '<p class="no-products-message">Товары не найдены.</p>';
    } else {
        // Если товары найдены, убедимся, что контейнер с товарами отображается
        const productContainer = document.getElementById('product-container');
        if (productContainer.innerHTML === '<p class="no-products-message">Товары не найдены.</p>') {
            // Если ранее было сообщение "Товары не найдены", восстанавливаем список товаров
            location.reload(); // Перезагружаем страницу (или можно восстановить список через JavaScript)
        }
    }
}

// Обработчики событий
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');

    // Очищаем поле поиска при загрузке страницы
    searchInput.value = '';

    // Обработчик события для ввода текста (поиск при вводе)
    searchInput.addEventListener('input', searchProducts);

    // Обработчик события для клавиши Enter
    searchInput.addEventListener('keypress', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Отменяем стандартное поведение
            searchProducts(); // Выполняем поиск
        }
    });
});