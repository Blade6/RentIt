--
-- 车辆表
-- 注意:押金等于车辆价值的1/10 
-- 新增车辆默认是不可外租的
--
CREATE table car
(license_no char(9) NOT NULL COMMENT '车牌号码',
picture varchar(50) DEFAULT 'car.png' COMMENT '车辆图片存储路径',
type varchar(5) COMMENT '车辆类型',
brand varchar(20) COMMENT '车辆品牌',
seat_number int COMMENT '车辆座位数',
color varchar(15) COMMENT '车辆颜色',
rent_fare int COMMENT '车辆单日租金',
value int COMMENT '车辆价值',
flag tinyint(1) DEFAULT 1 COMMENT '车辆是否被租',
num int DEFAULT 0 COMMENT '车辆出租次数',
PRIMARY KEY (license_no)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- 用户表
-- checked = 1 : 通过核验，可以租车
-- checked = 0 : 已提交材料，正在核验，不能租车
-- checked = -1 : 未提交材料，未核验，不能租车
--
CREATE TABLE user
(identity char(18) NOT NULL COMMENT '用户身份证号',
username varchar(15) NOT NULL COMMENT '用户名',
password char(32) NOT NULL COMMENT '用户密码',
picture varchar(100) DEFAULT 'default/head.png' COMMENT '用户头像存储路径',
shutup tinyint(1) DEFAULT 0 COMMENT '用户当前是否被禁言',
name varchar(15) COMMENT '用户真实姓名',
gender char(2) COMMENT '用户性别',
age int COMMENT '用户年龄',
phone_num char(11) COMMENT '用户手机号码',
flag tinyint(1) DEFAULT 0 COMMENT '用户当前是否租车',
checked tinyint(1) DEFAULT -1 COMMENT '用户当前核验情况',
accident_num int DEFAULT 0 COMMENT '用户肇事数量',
PRIMARY KEY (identity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- 租车表
-- 订单状态:成功2,处理中0,失败-1
-- 当用户确认订单却没有按时前来取车，视为订单失败，管理员修改状态为-1
-- 交付押金并取车后视为订单成功
-- 单日缴纳金为押金的1/10
-- 押金状态:用户未支付0,用户已支付1,公司已退还2
--
CREATE TABLE rent
(id int NOT NULL AUTO_INCREMENT,
userid char(18) NOT NULL COMMENT '租车用户身份证号',
license_no char(9) NOT NULL COMMENT '所租车辆车牌号码',
date char(10) NOT NULL COMMENT '订单日期',
days int COMMENT '租车天数',
flag tinyint(1) DEFAULT 0 COMMENT '订单状态',
deposit int COMMENT '押金',
g_flag tinyint(1) DEFAULT 0 COMMENT '押金状态',
draw_date char(10) COMMENT '取车日期',
return_date char(10) COMMENT '还车日期',
penalty int DEFAULT 0 COMMENT '单日缴纳金',
p_flag tinyint(1) DEFAULT 0 COMMENT '是否收取缴纳金',
fare int COMMENT '总租金',
fare_flag tinyint(1) DEFAULT 0 COMMENT '是否支付租金',
PRIMARY KEY (id),
FOREIGN KEY (license_no) REFERENCES car(license_no),
FOREIGN KEY (userid) REFERENCES user(identity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- 事故表
--
CREATE TABLE accident
(id int(8) NOT NULL AUTO_INCREMENT,
rentid int NOT NULL COMMENT '肇事的租车条目',
userid char(18) NOT NULL COMMENT '肇事司机身份证号',
license_no char(9) NOT NULL COMMENT '肇事车辆车牌号码',
date char(10) NOT NULL COMMENT '肇事日期',
place varchar(30) COMMENT '肇事地点',
PRIMARY KEY (id),
FOREIGN KEY (rentid) REFERENCES rent(id),
FOREIGN KEY (userid) REFERENCES user(identity),
FOREIGN KEY (license_no) REFERENCES car(license_no)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- 博客表
-- collection是帖子的序列号
-- tag的可取值：水贴(0000),意见(1111),求助(2222)
-- flag置0表示显示，置1表示管理员删帖，用户不能删帖
--
CREATE TABLE blog
(id int(8) NOT NULL AUTO_INCREMENT,
collection char(8) NOT NULL COMMENT '帖子序列',
replyNum int(8) NOT NULL DEFAULT 0 COMMENT '回复数',
title varchar(30) NOT NULL COMMENT '帖子标题',
tag char(4) NOT NULL DEFAULT '0000' COMMENT '帖子类型',
content text COMMENT '帖子内容',
date char(10) NOT NULL COMMENT '发帖日期',
time char(5) NOT NULL COMMENT '发帖时间',
userid char(18) NOT NULL COMMENT '作者',
flag tinyint(1) DEFAULT 0 COMMENT '显示状态',
PRIMARY KEY (id),
FOREIGN KEY (userid) REFERENCES user(identity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- 帖子表
-- 
CREATE TABLE post
(id int(8) NOT NULL AUTO_INCREMENT,
coll char(8) NOT NULL COMMENT '帖子主题',
floor int(8) NOT NULL COMMENT '帖子楼层',
userid char(18) NOT NULL COMMENT '回复者',
date char(10) NOT NULL COMMENT '回帖日期',
time char(5) NOT NULL COMMENT '回帖时间',
content text COMMENT '回复内容',
refloor int(8) DEFAULT 0 COMMENT '回复楼层',
flag tinyint(1) DEFAULT 0 COMMENT '显示状态',
PRIMARY KEY (id),
FOREIGN KEY (userid) REFERENCES user(identity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 管理员表
-- 0表示普通级别，1表示高级级别，默认创建普通管理员
--
CREATE TABLE admin
(id int(8) NOT NULL AUTO_INCREMENT,
adminname varchar(20) NOT NULL COMMENT '管理员名称',
password char(32) NOT NULL COMMENT '管理员密码',
level tinyint(1) DEFAULT 0 COMMENT '管理员级别',
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into car (license_no,picture,type,brand,seat_number,color,rent_fare,value,flag,num)
values ('YueA12345','YueA12345.jpg','car','HONDA',5,'white',150,150000,0,0);
insert into car (license_no,picture,type,brand,seat_number,color,rent_fare,value,flag,num)
values ('YueF12580','YueF12580.jpg','truck','VOLKSWAGEN',2,'white',125,120000,0,0);
insert into car (license_no,picture,type,brand,seat_number,color,rent_fare,value,flag,num)
values ('YueB16520','YueB16520.jpg','car','BMW',5,'black',385,350000,0,0);
insert into car (license_no,picture,type,brand,seat_number,color,rent_fare,value,flag,num)
values ('YueB20416','YueB20416.jpg','car','TOYATA',5,'red',260,250000,0,0);
insert into car (license_no,picture,type,brand,seat_number,color,rent_fare,value,flag,num)
values ('YueA20127','YueA20127.jpg','car','BENZ',5,'blue',425,400000,0,0);
insert into car (license_no,picture,type,brand,seat_number,color,rent_fare,value,flag,num)
values ('YueA39753','YueA39753.jpg','car','VOLKSWAGEN',5,'grey',395,380000,0,0);

insert into user (identity,username,password,name,picture,gender,age,phone_num,accident_num,flag,checked)
values ('440221199506261917','Benjamin','5d9f71b71b207b9e665820c0dce67bdb','何建鸿','440221199506261917/Blade6.jpg','男',20,'18826100944',0,0,0);
insert into user (identity,username,password,name,picture,gender,age,phone_num,accident_num,flag,checked)
values ('440221199505201918','Cooper','cd21b93cfd8d6824dc2bce1a19decaf7','魔术师','440221199505201918/V.jpeg','男',21,'13713652324',0,0,1);
insert into user (identity,username,password,name,picture,gender,age,phone_num,accident_num,flag,checked)
values ('441520198403162016','Shelly','de7de37a35074c337d73b6eaa9bd22dc','张怡宁','441520198403162016/YiNing.jpg','女',32,'18974362980',0,0,1);
insert into user (identity,username,password,name,picture,gender,age,phone_num,accident_num,flag,checked)
values ('440221198806012104','root','098f6bcd4621d373cade4e832627b4f6','神','440221198806012104/linus.jpg','男',28,'12345678900',0,0,-1);

insert into admin (adminname,password,level)
values ('root','098f6bcd4621d373cade4e832627b4f6',1);

insert into blog (collection,replyNum,title,tag,content,date,time,userid)
values ('1224abcd',3,'Hello World','0000','This is a begin','2016-12-24','16:11','440221199506261917');

insert into blog (collection,replyNum,title,tag,content,date,time,userid)
values ('1224fweo',0,'梦里不知身是客','0000','一晌贪欢','2016-12-24','16:11','440221199506261917');

insert into blog (collection,replyNum,title,tag,content,date,time,userid)
values ('12249hgy',0,'和子由渑池怀旧','0000','人生到处知何似，应似飞鸿踏雪泥。泥上偶然留指爪，鸿飞哪复计东西。','2014-12-24','21:38','440221199506261917');

insert into post (coll,floor,userid,date,time,content,refloor)
values ('1224abcd',1,'440221198806012104','2016-12-24','17:54','My name is Linus Trovalds and I am your god.',0);

insert into post (coll,floor,userid,date,time,content,refloor)
values ('1224abcd',2,'440221199506261917','2016-12-24','18:00','Prove it',1);

insert into post (coll,floor,userid,date,time,content,refloor)
values ('1224abcd',3,'440221199505201918','2016-12-25','12:00','This is interesting.',0);

insert into post (coll,floor,userid,date,time,content,refloor)
values ('1224abcd',4,'440221199506261917','2016-12-25','12:15','Merry Christmas.',0);

insert into post (coll,floor,userid,date,time,content,refloor)
values ('1224abcd',5,'440221199506261917','2016-12-25','12:16','Time tells.',3);

DELIMITER $$
CREATE TRIGGER `rent_insert` AFTER INSERT ON `rent`
FOR EACH ROW
BEGIN
  UPDATE car SET flag=1 WHERE car.license_no = new.license_no;
  UPDATE user SET flag=1 WHERE user.identity = new.userid;
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `rent_delete` BEFORE delete ON `rent`
FOR EACH ROW
BEGIN
UPDATE car SET flag=0 WHERE car.license_no=old.license_no;
UPDATE user SET flag=0 WHERE user.identity=old.userid;
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `rent_update` AFTER UPDATE ON `rent`
FOR EACH ROW
BEGIN 
  if new.flag=1 && old.flag=0
  THEN UPDATE car SET num=num+1 WHERE car.license_no = new.license_no;
       UPDATE user SET flag=1 WHERE user.identity = new.userid;
  END if;
  if new.return_date is not null && old.return_date is null
  THEN UPDATE car SET flag=0 WHERE car.license_no = new.license_no;
       UPDATE user SET flag=0 WHERE user.identity = new.userid;
  END if;
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `accident_insert` AFTER INSERT ON `accident`
FOR EACH ROW
BEGIN 
UPDATE user SET accident_num=accident_num+1 WHERE user.identity = new.userid;
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `post_insert` AFTER INSERT ON `post`
FOR EACH ROW
BEGIN
  UPDATE blog SET replyNum=replyNum+1 WHERE blog.collection = new.coll;
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `post_delete` AFTER DELETE ON `post`
FOR EACH ROW
BEGIN
  UPDATE blog SET replyNum=replyNum-1 WHERE blog.collection = old.coll;
END
$$
DELIMITER ;

insert into rent (id,userid,license_no,date,days,deposit)
values (1,'440221199505201918','YueA12345','2014-07-25',15,15000);

update rent set flag=1 ,g_flag=1 ,draw_date='2014-07-26' where id=1;

insert into accident (rentid,userid,license_no,date,place)
values (1,'440221199505201918','YueA12345','2014-07-31','Guangzhou city Panyu district');

update rent
set return_date='2014-07-31',penalty=0,p_flag=0,fare=0,fare_flag=0
where id=1;

insert into rent (userid,license_no,date,days,deposit)
values ('441520198403162016','YueA39753','2016-05-30',10,38000);

update rent set draw_date = '2016-06-01',flag = 1,g_flag=1,
fare =23700 where id=2;

update rent set return_date = '2016-06-10',g_flag=2,penalty=0,p_flag=0,fare_flag=0
where userid = '441520198403162016' and date = '2016-05-30';