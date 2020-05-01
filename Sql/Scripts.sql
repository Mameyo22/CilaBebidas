CREATE TABLE `cilabebidas`.`usuarios` ( 
    `userId` INT NOT NULL AUTO_INCREMENT ,
     `username` VARCHAR NOT NULL ,
      `isadmin` BOOLEAN NOT NULL , 
      `userpicture` VARCHAR NOT NULL , 
       `userpwd` VARCHAR NOT NULL ,
      PRIMARY KEY (`userId`)) 
ENGINE = InnoDB;


ALTER TABLE `usuarios` ADD `useremail` VARCHAR(200) NOT NULL AFTER `username`;