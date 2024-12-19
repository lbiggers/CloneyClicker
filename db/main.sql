DROP TABLE IF EXISTS users;

CREATE TABLE users (
	user VARCHAR(30) PRIMARY KEY,
    pass CHAR(64),
    score bigint
);

INSERT INTO users (user, pass, score) VALUES ('temp',sha2('temp',256),6);