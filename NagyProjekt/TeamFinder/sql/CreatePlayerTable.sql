CREATE TABLE `Players` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL, 
    `steamID`  VARCHAR(255),
    `uplayName`  VARCHAR(255),
    `lolName` VARCHAR(255)
)