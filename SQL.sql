CREATE DATABASE bakery;

USE bakery;

CREATE TABLE customers (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  address VARCHAR(100) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE orders (
  id INT(11) NOT NULL AUTO_INCREMENT,
  customer_id INT(11) NOT NULL,
  order_date DATETIME NOT NULL,
  delivery_date DATETIME NOT NULL,
  status ENUM('pending', 'delivered') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (id),
  FOREIGN KEY (customer_id) REFERENCES customers(id)
);

CREATE TABLE order_items (
  id INT(11) NOT NULL AUTO_INCREMENT,
  order_id INT(11) NOT NULL,
  item_name VARCHAR(50) NOT NULL,
  quantity INT(11) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (order_id) REFERENCES orders(id)
);

CREATE TABLE menu (
  id INT(11) NOT NULL AUTO_INCREMENT,
  item_name VARCHAR(50) NOT NULL,
  description VARCHAR(100) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE discounts (
  id INT(11) NOT NULL AUTO_INCREMENT,
  item_id INT(11) NOT NULL,
  discount DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (item_id) REFERENCES menu(id)
);

CREATE TABLE inventory (
  id INT(11) NOT NULL AUTO_INCREMENT,
  item_id INT(11) NOT NULL,
  quantity INT(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (item_id) REFERENCES menu(id)
);/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  user1
 * Created: 16 Nov 2023
 */

