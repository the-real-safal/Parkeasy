CREATE TABLE `booking` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `area_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL,
  `lis_no` text NOT NULL,
  `plate_no` text NOT NULL,
  `e_date` datetime NOT NULL,
  `d_date` datetime NOT NULL,
  `status` text NOT NULL,
  `charge` decimal(10, 2) NOT NULL,
  FOREIGN KEY (`area_id`) REFERENCES `areas`(`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
  FOREIGN KEY (`vehicle_type_id`) REFERENCES `vehicle_types`(`id`)
);

CREATE TABLE `areas` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `name` text NOT NULL
);

CREATE TABLE `users` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL
);

CREATE TABLE `vehicle_types` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `name` text NOT NULL
);

CREATE TABLE `messages` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `msgdate` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);

CREATE TABLE `otp` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `otp` varchar(6) NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `lot_no` text NOT NULL,
  `duration` text NOT NULL,
  `charge` decimal(10, 2) NOT NULL,
  `status` text NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
  FOREIGN KEY (`area_id`) REFERENCES `areas`(`id`)
);
