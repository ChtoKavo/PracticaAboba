CREATE DATABASE aaaa;
USE aaaa;

CREATE TABLE Roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_role VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    dob DATE,          -- Дата рождения
    gender VARCHAR(50), -- Пол
    phone VARCHAR(15),  -- Телефон
    role_id INT,
    FOREIGN KEY (role_id) REFERENCES Roles(id)
);

CREATE TABLE Category (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL
);

CREATE TABLE Product (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    img MEDIUMBLOB,
    weight DECIMAL(10, 2), -- Вес товара
    composition TEXT,       -- Состав товара
    expiration_date text,   -- Срок годности
    price DECIMAL(10, 2),
    category_id INT,        -- Идентификатор категории
    discount DECIMAL(5, 2) DEFAULT 0, -- Скидка в процентах
    discounted_price DECIMAL(10, 2), -- Цена со скидкой
    FOREIGN KEY (category_id) REFERENCES Category(category_id) -- Внешний ключ
);
drop table product ;
DELETE FROM reviews WHERE product_id IN (SELECT product_id FROM product);
ALTER TABLE reviews DROP FOREIGN KEY reviews_ibfk_1;
ALTER TABLE favorites DROP FOREIGN KEY favorites_ibfk_2;

CREATE TABLE Reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    user_id INT,
    review_text TEXT NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5), -- Рейтинг от 1 до 5
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES Product(product_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE Images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_data LONGBLOB NOT NULL,
    image_name VARCHAR(255) NOT NULL
);

CREATE TABLE favorites (
    favorites_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id), -- Исправлено на user_id
    FOREIGN KEY (product_id) REFERENCES Product(product_id)
);


INSERT INTO Roles (name_role) VALUES 
('Admin'),
('User'),
('Guest');

INSERT INTO Users (username, pass, email, role_id) VALUES 
('admin', 'admin', 'admin@gmail.com', 1),   
('user', 'user', 'user@gmail.com', 2),  
('Guest', 'Guest', 'Guest@gmail.com', 3);   

INSERT INTO Category(category_name) VALUES 
("шоколадные конфеты"),
("плитка шоколада");

INSERT INTO Users(gender) VALUES 
("мужской"),
("Женский");


INSERT INTO Product (title, category_id, weight, composition, expiration_date, price, discount, discounted_price, description, img) VALUES
('Черная магия', 1, 386, 'клубника, молочный шоколад (сахар, какао-масло, молочный порошок, эмульгатор: соевый лецитин), карамель (сахар, глюкозный сироп, сливки, масло)', '1 неделя', 1900, 50, 950, 'Погрузитесь в мир сладкого наслаждения с нашей клубникой в шоколаде! Каждая ягодка отбирается вручную, чтобы гарантировать максимальную свежесть и сочность. Обвалянная в нежном молочном или темном шоколаде, клубника создает идеальное сочетание сладости и легкой кислинки. Этот десерт станет настоящим украшением любого стола и подарит вам незабываемые моменты удовольствия. Идеально подходит для романтического ужина, праздников или просто как лакомство для себя!', LOAD_FILE('C:\\Users\\anka\\Desktop\\дз\\product1.jpg')),
('Розовая сказка', 1, 250, 'розовый шоколад (сахар, какао-масло, молочный порошок, натуральный краситель: малиновый экстракт, эмульгатор: соевый лецитин), сушеная малина.', 'от 3 до 4 недель', 1200, 50, 600, 'Насладитесь легкостью и свежестью с плиткой розового шоколада, украшенной сушеными ягодами. Каждый кусочек — это взрыв фруктового вкуса, который идеально сочетается с кремовой текстурой розового шоколада. Отличный выбор для сладкоежек!', LOAD_FILE('C:\\Users\\anka\\Desktop\\дз\\image2.jpg')),
('Вкус счастья', 1, 470, 'темный шоколад (сахар, какао-масло, какао-порошок, эмульгатор: соевый лецитин), сушеные ягоды (малина, черника), натуральный ароматизатор.', 'от 2 до 3 недель', 1300, 50, 650, 'Откройте для себя уникальный вкус с плиткой темного шоколада, дополненной сушеными ягодами. Этот контраст сладости и кислоты создаст незабываемое впечатление. Идеально подходит для тех, кто ценит натуральные ароматы!', LOAD_FILE('C:\\Users\\anka\\Desktop\\дз\\image3.svg')),
('Лунный шоколад', 1, 365, 'молочный шоколад (сахар, какао-масло, молочный порошок, эмульгатор: соевый лецитин), карамель (сахар, глюкозный сироп, сливки), обжаренные орехи (фундук, грецкий орех).', 'от 3 до 4 недель', 1100, 50, 550, 'Подарите себе свежесть с конфетами "Лунный шоколад". Мягкая начинка с мятным вкусом, покрытая темным шоколадом, подарит вам незабываемые ощущения. Идеальный выбор для любителей мятных десертов!', LOAD_FILE('C:\\Users\\anka\\Desktop\\дз\\image4.svg')),
('Карамельный шоколад', 1, 300, 'молочный шоколад (сахар, какао-масло, молочный порошок, эмульгатор: соевый лецитин), карамель (сахар, глюкозный сироп, сливки), обжаренные орехи (фундук, грецкий орех).', 'от 2 до 3 недель', 1200, 50, 600, 'Погрузитесь в мир сладости с плиткой шоколада, в которую добавлены хрустящие орехи и тягучая карамель. Молочный шоколад создает идеальный фон для этого восхитительного сочетания. Наслаждайтесь каждым кусочком!', LOAD_FILE('C:\\Users\\anka\\Desktop\\дз\\image5.svg')),
('Симфония', 1, 420, 'темный шоколад (сахар, какао-масло, какао-порошок, эмульгатор: соевый лецитин), корица, перец чили.', '2 недели', 1900, 50, 950, 'Откройте для себя необычное сочетание с плиткой темного шоколада, приправленной корицей и щепоткой перца чили. Этот смелый вкус подарит вам незабываемые ощущения и станет настоящим открытием для любителей острых ощущений.', LOAD_FILE('C:\\Users\\anka\\Desktop\\дз\\image6.svg')),
('Сладкие мгновения', 1, 300, 'разноцветный шоколад (сахар, какао-масло, молочный порошок, эмульгатор: соевый лецитин), кокосовая стружка, натуральный ароматизатор.', 'от 3 до 4 недель', 1200, 50, 600, 'Откройте для себя экзотику с конфетами "Сладкие мгновения". Нежный белый шоколад в сочетании с кокосовой стружкой создает уникальный вкус, который перенесет вас на тропический остров. Каждая конфета — это кусочек рая!', LOAD_FILE('C:\\Users\\anka\\Desktop\\дз\\image7.svg')),
('Мистическое удовольствие', 1, 150, 'молочный шоколад (сахар, какао-масло, молочный порошок, эмульгатор: соевый лецитин), мед, сахар, натуральный ароматизатор.', 'от 3 до 4 недель', 900, 50, 450, 'Откройте для себя сладость с конфетами "Мистическое удовольствие". Нежный молочный шоколад в сочетании с медовой начинкой создают гармонию вкусов, которая подарит вам тепло и уют. Эти конфеты — отличный выбор для подарка!', LOAD_FILE('C:\\Users\\anka\\Desktop\\дз\\image8.svg')),
('Нежные дольки', 2, 400, 'темный шоколад (сахар, какао-масло, молочный порошок, эмульгатор: соевый лецитин), сушеные фрукты (ананас, манго, киви), натуральный ароматизатор.', 'от 2 до 3 недель', 1200, 50, 600, 'Насладитесь легкостью и свежестью с плиткой молочного шоколада, украшенной сушеными ягодами. Каждый кусочек — это взрыв фруктового вкуса, который идеально сочетается с кремовой текстурой белого шоколада. Отличный выбор для сладкоежек!', LOAD_FILE('C:\\Users\\anka\\Desktop\\дз\\image9.svg')),
('Шоколадный поцелуй', 2, 450, 'темный шоколад (сахар, какао-масло, какао-порошок, эмульгатор: соевый лецитин), мятная начинка (сахар, глюкозный сироп, ароматизатор).', 'от 3 до 4 недель', 1200, 50, 600, 'Погрузитесь в мир нежности с нашей плиткой темного шоколада, в которую добавлены хрустящие орехи. Каждый кусочек — это идеальное сочетание кремовой текстуры и орехового аромата. Наслаждайтесь этой плиткой в любое время дня!', LOAD_FILE('C:\\Users\\anka\\Desktop\\дз\\image10.svg')),
('Сладкий шторм', 2, 400, 'темный шоколад (сахар, какао-масло, какао-порошок, эмульгатор: соевый лецитин), сушеные ягоды (малина, черника), натуральный ароматизатор.', 'от 3 до 4 недель', 1200, 50, 600, 'Откройте для себя уникальный вкус с плиткой темного шоколада, дополненной щепоткой морской соли. Этот контраст сладости и солености создаст незабываемое впечатление. Идеально подходит для истинных ценителей шоколада!', LOAD_FILE('C:\\Users\\anka\\Desktop\\дз\\image11.svg')),
('Шоколадный бум', 1, 386, 'молочный шоколад (сахар, какао-масло, молочный порошок, эмульгатор: соевый лецитин), карамель (сахар, глюкозный сироп, сливки).', '1 неделя', 1200, 50, 600, 'Погрузитесь в мир сладости с плиткой шоколада, дополненной хрустящей карамелью. Каждый кусочек — это сочетание нежного молочного шоколада и долек фруктов, который подарит вам радость и удовольствие', LOAD_FILE('C:\\Users\\anka\\Desktop\\дз\\image12.svg'));

SELECT * FROM Category;
SELECT * FROM Product p JOIN Category c ON p.category_id = c.category_id ;
SELECT * FROM product WHERE product_id = ?;
SELECT * FROM Images;
SELECT * FROM Users;
ALTER TABLE Product MODIFY COLUMN expiration_date VARCHAR(255);


SELECT * FROM PR2.product;

UPDATE Product
SET img = REPLACE(img, '.jpg', '.svg')
WHERE img LIKE '%.jpg';

UPDATE Product
SET img = REPLACE(img, 'image1', 'product1')
WHERE img LIKE '%image1%';
SELECT img FROM Product;
drop table product
