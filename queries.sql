CREATE TABLE `users` (
  `id` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
  CREATE TABLE `posts` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `user_id` int(11) DEFAULT NULL,
 `title` varchar(255) NOT NULL,
 `body` text NOT NULL,
 `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8

INSERT INTO users(`username`, `email`, `role`, `password`) VALUES ('admin','test@test.com','admin','$2y$10$EQrjRXo0Yeghbxas7ngdcO4fnMV2tQHDdSh2UFJ1w9zOb4WqApCDe')
