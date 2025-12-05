CREATE DATABASE IF NOT EXISTS starryEarings;
use starryEarings;

CREATE TABLE IF NOT EXISTS users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(20) NOT NULL,
    name VARCHAR(30),
    address VARCHAR(255),
    phone VARCHAR(20),
    created_at TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    category VARCHAR(10) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description VARCHAR(255) NOT NULL,
    stock INT(11) NOT NULL DEFAULT 0,
    image VARCHAR(255)
);

INSERT INTO users (email, password) VALUES
    ('user@example.com', 'password');

INSERT INTO products (name, category, price, description, stock, image) VALUES
    ('Star', 'stud', 39.99, 'Delicate star-shaped studs in warm rose gold tone, perfect for everyday wear!', 50, '../images/stud1.jpg'),
    ('Circle', 'stud', 44.99, 'Classic elegant crystal studs, perfect for special occasions!', 50, '../images/stud2.jpg'),
    ('Maple Leaf', 'stud', 54.99, 'Luxurious rose gold maple leaf-shaped stud earrings, perfect for special occasions!', 50, '../images/stud3.jpg'),
    ('Pearl with Petal', 'stud', 39.99, 'Light blue metallic petals with lustrous white pearl drops.', 50, '../images/stud4.jpg'),
    ('Tears', 'stud', 64.99, 'Elegant crystal earrings, perfect for special occasions!', 50, '../images/stud5.jpg'),
    ('Point', 'stud', 44.99, 'Classic crystal studs, perfect for special occasions!', 50, '../images/stud6.jpg'),
    ('Snowdrop', 'stud', 54.99, 'Timeless diamond-inspired crystal studs, perfect for special occasions!', 50, '../images/stud7.jpg'),
    ('Heart', 'stud', 34.99, 'Elegant gold heart-shaped stud earrings with crystals, perfect for everyday wear!', 50, '../images/stud8.jpg'),
    ('Ruby', 'stud', 39.99, 'Rich deep red jewel stud earrings, perfect for special occasions!', 50, '../images/stud9.jpg'),
    ('Big Pearl', 'stud', 44.99, 'Sophisticated white pearl earrings with gold metal caps, perfect for special occasions!', 50, '../images/stud10.jpg'),
    ('Minimalist', 'stud', 24.99, 'Contemporary crystal stud earrings in gold, perfect for everyday wear!', 50, '../images/stud11.jpg'),
    ('Pearl', 'stud', 39.99, 'Sophisticated white pearl earrings, perfect for everyday wear!', 50, '../images/stud12.jpg'),
    ('Unique', 'drop', 54.99, 'Elegant gold drop earrings with purple crystal point, perfect for special occasions!', 50, '../images/drop1.jpg'),
    ('Emerald', 'drop', 74.99, 'Elegant emerald drop earrings with delicate decoration in silver crystals, perfect for special occasions!', 50, '../images/drop2.jpg'),
    ('Sparkle', 'drop', 44.99, 'Luxurious teardrop earrings with a warm metallic frame, perfect for special occasions!', 50, '../images/drop3.jpg'),
    ('Amber', 'drop', 29.99, 'Sparkle amber gemstone drop earrings with antique silver caps.', 50, '../images/drop4.jpg'),
    ('Modern', 'drop', 59.99, 'Sleek gold drop earrings with sparkling crystal loop, perfect for special occasions!', 50, '../images/drop5.jpg'),
    ('Black-pink', 'drop', 54.99, 'Artisan-crafted earrings featuring a pink stone paired with a sleek black semicircle.', 50, '../images/drop6.jpg'),
    ('Pearl Drop', 'drop', 49.99, 'Luxurious pearl drop earrings with delicate silver hooks.', 50, '../images/drop7.jpg'),
    ('Pink', 'drop', 39.99, 'Lovely pastel ruby drop earrings with elegant wire-wrapped details in gold-plated metal.', 50, '../images/drop8.jpg'),
    ('Vibrance', 'drop', 54.99, 'Modern unique earrings featuring black curved tops and white pearl drops.', 50, '../images/drop9.jpg'),
    ('Classic', 'hoop', 59.99, 'Classic twisted textured gold hoop earrings, perfect for elevating everyday style.', 50, '../images/hoop1.jpg'),
    ('Glory', 'hoop', 69.99, 'Luxurious crystal hoops with polished gold wiring.', 50, '../images/hoop2.jpg'),
    ('Golden Hoop', 'hoop', 44.99, 'Minimalist C-shaped golden hoop earrings designed for everyday wear.', 50, '../images/hoop3.jpg'),
    ('Timeless', 'hoop', 74.99, 'Bold ribbed or grooved texture gold hoop earrings in warm rose gold tone, perfect for special occasions!', 50, '../images/hoop4.jpg'),
    ('Elegance', 'hoop', 54.99, 'Stunning sterling silver drop earrings featuring vibrant ruby gemstones.', 50, '../images/hoop5.jpg'),
    ('Beads', 'hoop', 34.99, 'Large multi-layered chandelier-style hoop earrings with hanging gemstone elements.', 50, '../images/hoop6.jpg'),
    ('Diamond', 'hoop', 49.99, 'Sparkling crystal hoop earrings set in polished silver, perfect for special occasions!', 50, '../images/hoop7.jpg'),
    ('Luxe', 'hoop', 64.99, 'Contemporary gold-colored latched-back earrings with crystal points.', 50, '../images/hoop8.jpg'),
    ('Pendant', 'hoop', 24.99, 'Distinctive pendant earrings featuring a scarab and an artistic portrait element.', 50, '../images/hoop9.jpg'),
    ('Sleek', 'hoop', 59.99, 'Classic chunky gold-tone hoop earrings with a smooth and polished finish.', 50, '../images/hoop10.jpg'),
    ('Dachshund', 'hoop', 39.99, 'Adorable dachshund-shaped hoop earrings in polished gold-tone metal.', 50, '../images/hoop11.jpg'),
    ('Magnificence', 'clip', 74.99, 'Stunning multi-gemstone clip-on earrings featuring tiered amethyst, peridot, and crystal accents in rose gold.', 50, '../images/clip1.jpg'),
    ('Moon', 'clip', 59.99, 'Unique crescent moon-shaped Chandbali clip-on Earrings.', 50, '../images/clip2.jpg'),
    ('Allure', 'clip', 59.99, 'Authentic Indian Jhumka clip-on earrings with dangling pearl beads, crafted in oxidized silver and gold-plated metal.', 50, '../images/clip3.jpg'),
    ('Distinction', 'clip', 64.99, 'Luxurious textured gold-tone clip-on earrings with sparkling stone accents.', 50, '../images/clip4.jpg'),
    ('Prestige', 'clip', 69.99, 'Stunning sapphire-inspired clip-on earrings, perfect for special occasions!', 50, '../images/clip5.jpg');