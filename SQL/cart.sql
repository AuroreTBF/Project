CREATE TABLE shopping_cart (
    Shopping_cart_id INT(80) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(80),
    date_created DATE
);
CREATE TABLE cart_items (
    cart_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    product_id INT(11),
    quantity INT(11),
    date_added DATE,
    shoppingCartId INT(80)
);
ALTER TABLE shopping_cart
ADD CONSTRAINT shopping
FOREIGN KEY (user_id) REFERENCES users(id);

ALTER TABLE cart_items
ADD CONSTRAINT shop
FOREIGN KEY (shoppingCartId) REFERENCES shopping_cart(Shopping_cart_id);

ALTER TABLE cart_items
ADD CONSTRAINT cart
FOREIGN KEY (product_id) REFERENCES products(product_id);

