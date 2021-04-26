CREATE TABLE users (
    username varchar(20) NOT NULL UNIQUE,
    email varchar(320) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    LastName varchar(255),
    FirstName varchar(255),
    PRIMARY KEY (username)
)

CREATE TABLE tasks (
    ID int NOT NULL AUTO_INCREMENT,
    username varchar(20) NOT NULL,
    title varchar(32),
    description varchar (255),
    due DATETIME,
    urgency ENUM('normal', 'important', 'very-important'),
	completion boolean,
    PRIMARY KEY (ID),
    FOREIGN KEY (username) REFERENCES users(username)
);