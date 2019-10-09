create schema gestion;
use gestion;

CREATE TABLE `customer` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `document` varchar(512) NOT NULL,
  `name` varchar(512) NOT NULL,
  `lastname` varchar(512) DEFAULT NULL,
  `mobile` varchar(512) DEFAULT NULL,
  `phone` varchar(512) DEFAULT NULL,
  `email` varchar(512) DEFAULT NULL,
  `address` varchar(512) DEFAULT NULL,
  `observations` mediumtext DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
);

create table log_customer(
  `customer` varchar(12) NOT NULL,
  `operation` varchar(255) NOT NULL,
  `operation_date` datetime NOT NULL,
  `last_id` int(10) unsigned NULL,
  `new_id` int(10) unsigned NULL,
  `last_document` varchar(255) NULL,
  `new_document` varchar(255) NULL,
  `last_active` tinyint(1) NULL,
  `new_active` tinyint(1) NULL
    );


create table log_customer_select(
  `registros` int(10) NOT NULL,
  `operation_date` datetime NOT NULL,
  `ip_address` varchar(255) NULL,
  `host` varchar(255) NULL
  );


