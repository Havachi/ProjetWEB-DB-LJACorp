DROP TABLE IF EXISTS `Locations`;
CREATE TABLE `Locations`
(
    IDLoc        INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    FK_IDUser    INT(10) UNSIGNED NOT NULL,
    DateLocStart DATE,
    DateLocEnd   DATE,
    LocStatus    smallint(2),
    PRIMARY KEY (`IDLoc`),
    FOREIGN KEY (FK_IDUser) REFERENCES users (IDUser)
) COLLATE = 'utf8_general_ci'
  ENGINE = InnoDB;

DROP TABLE IF EXISTS `OrderedSnow`;
CREATE TABLE `OrderedSnow`
(
    IDOrder        INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    FK_IDLoc       INT(10) UNSIGNED NOT NULL,
    FK_IDSnow      INT(11) UNSIGNED NOT NULL,
    DateOrderEnd   DATE,
    QtyOrder       SMALLINT(6),
    NbDOrder       SMALLINT(6),
    OrderStatus    SMALLINT(2),
    PRIMARY KEY (`IDOrder`),
    FOREIGN KEY (FK_IDLoc) REFERENCES users (IDUser),
    FOREIGN KEY (FK_IDSnow) REFERENCES snows (IDSnow)
) COLLATE = 'utf8_general_ci'
  ENGINE = InnoDB;