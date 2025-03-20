document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const products = document.querySelectorAll('.product');

    // Функция для поиска
    function searchProducts() {
        const searchText = searchInput.value.toLowerCase(); // Получаем текст поиска

        products.forEach(product => {
            const title = product.getAttribute('data-title'); // Название товара
            const category = product.getAttribute('data-category'); // Категория товара

            // Проверяем, совпадает ли текст поиска с названием или категорией
            if (title.includes(searchText) || category.includes(searchText)) {
                product.style.display = 'block'; // Показываем товар
            } else {
                product.style.display = 'none'; // Скрываем товар
            }
        });
    }

    // Обработчик события для кнопки поиска
    searchButton.addEventListener('click', searchProducts);

    // Обработчик события для ввода текста (поиск при вводе)
    searchInput.addEventListener('input', searchProducts);
});

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');

    // Обработчик события для клавиши Enter
    searchInput.addEventListener('keypress', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Отменяем стандартное поведение формы
            const query = searchInput.value.trim();
            if (query.length >= 2) { // Поиск выполняется только при вводе 2 и более символов
                window.location.href = `Catalog.php?query=${encodeURIComponent(query)}`;
            }
        }
    });
});