Start the project
```ddev start```

Get server info
```ddev describe```

Install composer libraries
```ddev composer install```

Connect DBMS to
```
Host: 127.0.0.1 
Port: 9002
Login: root 
Pass: root
```

Run queries if the demo table articles doesn't exist
```
CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `articles` (`article_id`, `title`, `content`)
VALUES
	(1,'first article','This is my first article'),
	(2,'second article','This is my second article'),
	(3,'third article','This is my third article');
  ```

Open website
[http://localhost:9000](http://localhost:9000/)
