CREATE TABLE posts (
  post_id INT(80) AUTO_INCREMENT PRIMARY KEY,
  user_id,
  title VARCHAR(50),
  description VARCHAR(500),
  image VARCHAR(100),
  date_created DATE
);

ALTER TABLE products
ADD CONSTRAINT us
FOREIGN KEY (user_id) REFERENCES users(id);
