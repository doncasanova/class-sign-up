CREATE DATABASE register;

  use register;
  
  CREATE TABLE users (
 id int(11) NOT NULL AUTO_INCREMENT,
 username varchar(50) NOT NULL,
 email varchar(50) NOT NULL,
 password varchar(50) NOT NULL,
 admin BOOLEAN,
 trn_date datetime NOT NULL,
 PRIMARY KEY (`id`)
 );