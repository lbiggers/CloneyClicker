DROP TABLE IF EXISTS users;

CREATE TABLE users (
	user VARCHAR(30),
    pass CHAR(64),
    score bigint
);