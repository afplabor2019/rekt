CREATE TABLE `Advertisement` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `game` VARCHAR(255) NOT NULL,
    `skillRange` VARCHAR(255),
    `lookingFor` VARCHAR(255),
    `age` VARCHAR(255),
    `region` VARCHAR(255),
    `role` VARCHAR(255),
    `goal` VARCHAR(255),
    `advertiserID` INT NOT NULL,
    `language` VARCHAR(255),
    `communication` VARCHAR(255),
    `teamName` VARCHAR(255)
)