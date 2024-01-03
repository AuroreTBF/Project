CREATE TABLE wishlist (
    wishlist_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11),
    product_id INT(11),
    date_created DATE
);
ALTER TABLE wishlist
ADD CONSTRAINT wish
FOREIGN KEY (user_id) REFERENCES users(id);