CREATE TABLE category (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name TEXT,
    description VARCHAR(500)
);


INSERT INTO category (id, name, description) VALUES
(1, 'Washing', 'Cleanse and wash exterior surfaces.'),
(2, 'Correction & Polishing', 'Remove imperfections and polish surfaces.'),
(3, 'Protective Wax', 'Apply wax for protection and shine.'),
(4, 'Rim Tires', 'Clean and shine wheels and tires.'),
(5, 'Windows and headlights', 'Clean and polish windows and headlights.'),
(6, 'Interior', 'Clean and maintain interior surfaces.'),
(7, 'Kits', 'Offer complete car care kits.'),
(8, 'Accessories', 'Include additional car accessories.'),
(9, 'Others', 'All other car related products');