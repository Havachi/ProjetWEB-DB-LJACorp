CREATE USER 'appliConnector'@'localhost' IDENTIFIED BY '123qweasD$';
GRANT SELECT, INSERT, UPDATE ON snows.* TO 'appliConnector'@'localhost';
