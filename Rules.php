<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Правила применения рекомендательных технологий</title>
    <link rel="stylesheet" href="Rules.css">
</head>
<body>
    <div class="attic">
        <div class="logo"> <a href="Main.php">
            <img src="A&A.svg" alt="Логотип">
        </a></div>
        <input type="text" class="search-input" placeholder="Название товара/категория...">
        <button class="button catalog">Каталог</button>
        <button class="image-button">

<a href="Favourites.php"><img src="Vector.png" alt="Избр">
</button><a>
<a href="Cart.php" ><button class="image-button">
    <img src="Vector1.png" alt="Корз" >
</button><a>
</a>
<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!-- Кнопка профиля -->
<a href="login.php">
<button class="image-button" id="profile-button">
<img src="Vector2.png" alt="Польз">
</button>
</a>
</div>
    <h3 class="title">Правила применения рекомендательных технологий</h3>
    <ol class="text">
        <li>ООО «A&A» (далее – «Общество») является владельцем сайта www. A&Achoco.ru (далее – «Сайт»), на котором применяются информационные технологии предоставления информации на основе сбора, систематизации и анализа сведений, относящихся к предпочтениям пользователей сети "Интернет", находящихся на территории Российской Федерации.</li>
        <li>Под рекомендательными технологиями здесь и далее понимаются информационные технологии предоставления информации на основе сбора, систематизации и анализа сведений, относящихся к предпочтениям пользователей сети «Интернет», находящихся на территории Российской Федерации».</li>
        <li>Общество не допускает применения рекомендательных технологий, которые нарушают права и законные интересы граждан и организаций, а также не допускает применение рекомендательных технологий в целях предоставления информации с нарушением законодательства Российской Федерации.</li>
        <li>Для алгоритмических вычислений и машинного обучения Общество использует данные, полученные от пользователей Сайта, а также техническую информацию, собираемую автоматически, в том числе информацию о том, как пользователь пользуется сайтом и информацию об устройстве пользователя, а именно:</li>
        <ul>
        <li>данные о любых действиях пользователя на Сайте;</li>
        <li>данные о любых запросах пользователя на Сайте;</li>
        <li>данные о выбранном пункте выдачи заказов;</li>
        <li>IP адрес;</li>
        <li>файлы cookies;</li>
        <li>длительность пользовательской сессии;</li>
        <li>точки входа (сторонние сайты, с которых пользователь по ссылке переходит на сайт);</li>
        <li>точки выхода (ссылки на сайте, по которым пользователь переходит на сторонние сайты);</li>
        <li>страна пользователя;</li>
        <li>геопозиция;</li>
        <li>регион пользователя;</li>
        <li>часовой пояс, установленный на устройстве пользователя;</li>
        <li>провайдер пользователя;</li>
        <li>браузер пользователя;</li>
        <li>ОС пользователя;</li>
        <li>информация об устройстве пользователя;</li>
        <li>параметры экрана (разрешение, глубина цветности, параметры размещения страницы на экране);
        дата и время посещения сайта;</li>
        <li>источник перехода (UTM метка);</li>
        <li>данные, содержащиеся в личном кабинете пользователя, зарегистрированного на Сайте;</li>
        <li>данные сетевого трафика.</li>
    </ul>
    <li>Общество использует рекомендательные технологии для формирования персональных и неперсональных подборок на сайте, обработки запросов пользователей Сайта при поиске товаров в целях быстрого предварительного отбора товаров, из которых пользователь Сайта может выбрать наиболее подходящие.</li>
    <li>Для формирования выдачи рекомендаций применяются такие технологии как нейросети, ансамбли решающих деревьев, коллаборативные фильтрации и классические модели машинного обучения. Алгоритмы обучаются и применяются с целью подобрать для пользователя Сайта наиболее релевантные товары на основании его действий на сайте.</li>
    <li>Процесс работы рекомендательных технологий Общества заключается в следующем:</li>
    <li>формируется набор данных о последней активности пользователя;</li>
    <li>на основании этого набора делается предсказание его последующих действий набором алгоритмов;</li>
    <li>результаты работы нескольких алгоритмов объединяются и формируют рекомендации, подходящие пользователю;</li>
    <li>на основании схожести характеристик товаров и информации о пользователе отобранные рекомендации досортировываются и сохраняются для выдачи пользователю;</li>
    <li>на этапе выдачи товаров заранее рассчитанные рекомендации перемешиваются в соответствии с бизнес-правилами.</li>
    </ol>
<div class="Basement">
    <div class="logo">
        <img src="A&A2.svg" alt="Логотип" class="image-button">
    </div>
    <div class="social-media-container">
        <div class="social-media">
            <img src="vk.svg" alt="VK" class="image-button2">
        </div>
        <div class="social-media">
            <img src="odnoklassniki.svg" alt="Odnoklassniki" class="image-button2">
        </div>
        <div class="social-media">
            <img src="tg.svg" alt="Telegram" class="image-button2">
        </div>
        <div class="social-media">
            <img src="youtube.svg" alt="YouTube" class="image-button2">
        </div>
    </div>
    <div class="footer-text">
        <p>© A&A 2025. Все права защищены.
            Применяются рекомендательные технологии</p>
    </div>
    <div class="footer-text2">
    <div class="column">
            <h4>Страницы</h4>
            <a href="Main.php">Главная</a>
            <a href="Catalog.php">Каталог</a>
            <a href="Cart.php">Корзина</a>
            <a href="Favourites.php">Избранное</a>
            <a href="Personal account.php">Профиль</a>
            <a href="Delivery.php">Доставка</a>
            <a href="Purchases.php">Покупки</a>
        </div>
        <div class="column">
            <h4>Услуги</h4>
            <a href="Delivery.php">Доставка</a>
            <a href="support">Служба поддержки</a>
        </div>
        <div class="column">
            <h4>Документация</h4>
            <a href="expiration">Сроки годности</a>
            <a href="storage-terms">Условия хранения</a>
            <a href="composition">Состав</a>
            <a href="Privacy Policy.php">Конвидициальность</a>
            <a href="Rules.php">Технологии</a>
        </div>
    </div>
</div>
</body>
</html>