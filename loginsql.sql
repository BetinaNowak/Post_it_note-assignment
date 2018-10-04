USE mul2018;

CREATE TABLE users (
	id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(40) UNIQUE,
    pwhash VARCHAR(255)
);

INSERT INTO users (username, pwhash) VALUES ("admin", "123");
