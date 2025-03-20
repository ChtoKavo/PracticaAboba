function addToFavorites(productId, event) {
    event.stopPropagation(); // Останавливаем всплытие события
    // Ваш код для добавления в избранное
    console.log('Добавлено в избранное:', productId);
}

function addToCart(productId, event) {
    event.stopPropagation(); // Останавливаем всплытие события
    // Ваш код для добавления в корзину
    console.log('Добавлено в корзину:', productId);
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const productLinks = document.querySelectorAll('.product-link');

    searchInput.addEventListener('input', function() {
        const searchText = searchInput.value.trim().toLowerCase();

        productLinks.forEach(function(productLink) {
            const product = productLink.querySelector('.product');
            const productTitle = product.getAttribute('data-title');
            const productCategory = product.getAttribute('data-category');

            if (productTitle.includes(searchText) || productCategory.includes(searchText)) {
                productLink.style.display = 'block';
            } else {
                productLink.style.display = 'none';
            }
        });
    });
});