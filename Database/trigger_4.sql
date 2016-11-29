DELIMITER $$
CREATE TRIGGER `rent_insert` AFTER INSERT ON `rent`
FOR EACH ROW
BEGIN
  UPDATE car SET flag=1 WHERE car.license_no = new.license_no;
  UPDATE user SET flag=1 WHERE user.identity = new.user_ID;
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `rent_delete` BEFORE delete ON `rent`
FOR EACH ROW
BEGIN
UPDATE car SET flag=0 WHERE car.license_no=old.license_no;
UPDATE user SET flag=0 WHERE user.identity=old.user_ID;
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `rent_update` AFTER UPDATE ON `rent`
FOR EACH ROW
BEGIN 
  if new.flag=1 && old.flag=0
  THEN UPDATE car SET num=num+1 WHERE car.license_no = new.license_no;
       UPDATE user SET flag=1 WHERE user.identity = new.user_ID;
  END if;
  if new.return_date is not null && old.return_date is null
  THEN UPDATE car SET flag=0 WHERE car.license_no = new.license_no;
       UPDATE user SET flag=0 WHERE user.identity = new.user_ID;
  END if;
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `accident_insert` AFTER INSERT ON `accident`
FOR EACH ROW
BEGIN 
UPDATE user SET accident_num=accident_num+1 WHERE user.identity = new.user_ID;
END
$$
DELIMITER ;