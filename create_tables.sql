# Use this file to create the tables.

CREATE TABLE users
(
  user_id INT(11) NOT NULL AUTO_INCREMENT,
  user_level TINYINT(1) NOT NULL DEFAULT 0,
  email VARCHAR(60) NOT NULL,
  pass CHAR(40) NOT NULL,
  first_name VARCHAR(20) NOT NULL,
  last_name VARCHAR(40) NOT NULL,
  active CHAR(32) NULL,
  registration_date DATETIME NOT NULL,
  last_logged_on DATETIME NULL,
  PRIMARY KEY (user_id),
  UNIQUE KEY (email),
  INDEX login (email, pass)
);

CREATE TABLE forums
(
  forum_id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL UNIQUE,
  content LONGTEXT NOT NULL,
  user_id INT(11) NOT NULL,
  posted_on DATETIME NOT NULL,
  PRIMARY KEY (forum_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE artists
(
  artist_id INT NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(20) NULL,
  middle_name VARCHAR(20) NULL,
  last_name VARCHAR(40) NOT NULL,
  PRIMARY KEY (artist_id),
  UNIQUE full_name (last_name, first_name, middle_name)
);

CREATE TABLE prints
(
  print_id INT(10) NOT NULL AUTO_INCREMENT,
  artist_id INT(10) NOT NULL,
  print_name VARCHAR(60) NOT NULL,
  price DECIMAL(6,2) NOT NULL,
  size VARCHAR(60) NULL,
  description VARCHAR(255) NULL,
  image_name VARCHAR(60) NOT NULL,
  PRIMARY KEY (print_id),
  FOREIGN KEY (artist_id) REFERENCES artists(artist_id),
  INDEX (artist_id),
  INDEX (print_name),
  INDEX (price)
);

CREATE TABLE orders
(
  order_id INT(10) NOT NULL AUTO_INCREMENT,
  user_id INT(10) NOT NULL,
  total DECIMAL(10,2) NOT NULL,
  order_date TIMESTAMP,
  PRIMARY KEY (order_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  INDEX (user_id),
  INDEX (order_date)
);

CREATE TABLE order_contents
(
  oc_id INT(10) NOT NULL AUTO_INCREMENT,
  order_id INT(10) NOT NULL,
  print_id INT(10) NOT NULL,
  quantity TINYINT(3) NOT NULL,
  price DECIMAL(6,2) NOT NULL,
  ship_date DATETIME DEFAULT NOT NULL,
  PRIMARY KEY (oc_id),
  FOREIGN KEY (order_id) REFERENCES orders(order_id),
  FOREIGN KEY (print_id) REFERENCES prints(print_id),
INDEX (order_id),
INDEX (print_id),
INDEX (ship_date)
);

CREATE TABLE messages
(
  message_id INT(11) NOT NULL AUTO_INCREMENT,
  `body` LONGTEXT(600) NOT NULL,
  date_entered DATETIME NOT NULL,
  user_id INT(11) NOT NULL,
  forum_id INT(11) NOT NULL,
  PRIMARY KEY (message_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (forum_id) REFERENCES forums(forum_id)
);
