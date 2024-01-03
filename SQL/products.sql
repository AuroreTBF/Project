CREATE TABLE products (
    product_id INT(80) AUTO_INCREMENT PRIMARY KEY,
    Category_id INT(80),
    user_id INT(80),
    name TEXT,
    price DOUBLE,
    description VARCHAR(500),
    stock INT(10),
    image VARCHAR(100),
    date_created DATE
);

ALTER TABLE products
ADD CONSTRAINT us
FOREIGN KEY (user_id) REFERENCES users(id);

ALTER TABLE products
ADD CONSTRAINT cat
FOREIGN KEY (Category_id) REFERENCES category(id);