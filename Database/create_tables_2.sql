--
-- 车辆表
-- 注意:押金等于车辆价值的1/10 
--
CREATE table car
(license_no char(9) NOT NULL COMMENT '车牌号码',
picture varchar(50) COMMENT '车辆图片存储路径',
type varchar(5) COMMENT '车辆类型',
brand varchar(20) COMMENT '车辆品牌',
seat_number int COMMENT '车辆座位数',
color varchar(15) COMMENT '车辆颜色',
rent_fare int COMMENT '车辆单日租金',
value int COMMENT '车辆价值',
flag tinyint(1) DEFAULT 0 COMMENT '车辆是否被租',
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
-- 交付押金并取车后视为订单成功
-- 单日缴纳金为押金的1/10
--
CREATE TABLE rent
(id int NOT NULL AUTO_INCREMENT,
user_ID char(18) NOT NULL COMMENT '租车用户身份证号',
license_no char(9) NOT NULL COMMENT '所租车辆车牌号码',
date char(10) NOT NULL COMMENT '订单日期',
days int COMMENT '租车天数',
flag tinyint(1) DEFAULT 0 COMMENT '订单是否成功',
guarantee_deposit int COMMENT '押金',
g_1_flag tinyint(1) DEFAULT 0 COMMENT '是否支付押金',
draw_date char(8) COMMENT '取车日期',
return_date char(8) COMMENT '还车日期',
g_2_flag tinyint(1) DEFAULT 0 COMMENT '是否归还押金',
penalty int DEFAULT 0 COMMENT '单日缴纳金',
p_flag tinyint(1) DEFAULT 0 COMMENT '是否收取缴纳金',
fare int COMMENT '总租金',
fare_flag tinyint(1) DEFAULT 0 COMMENT '是否支付租金',
PRIMARY KEY (id),
FOREIGN KEY (license_no) REFERENCES car(license_no),
FOREIGN KEY (user_ID) REFERENCES user(identity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- 事故表
--
CREATE TABLE accident
(id int(8) NOT NULL AUTO_INCREMENT,
rent_id int NOT NULL COMMENT '肇事的租车条目',
user_ID char(18) NOT NULL COMMENT '肇事司机身份证号',
license_no char(9) NOT NULL COMMENT '肇事车辆车牌号码',
date char(10) NOT NULL COMMENT '肇事日期',
place varchar(30) COMMENT '肇事地点',
PRIMARY KEY (id),
FOREIGN KEY (rent_id) REFERENCES rent(id),
FOREIGN KEY (user_id) REFERENCES user(identity),
FOREIGN KEY (license_no) REFERENCES car(license_no)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- 留言表
--
CREATE TABLE board
(id int(8) NOT NULL AUTO_INCREMENT,
user_ID char(18) NOT NULL COMMENT '留言用户身份证号',
date char(10) NOT NULL COMMENT '留言日期',
time char(8) NOT NULL COMMENT '留言时间',
content varchar(140) COMMENT '留言内容',
flag tinyint(1) DEFAULT 0 COMMENT '是否隐藏留言内容',
PRIMARY KEY (id),
FOREIGN KEY (user_ID) REFERENCES user(identity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- 管理员表
-- 0表示普通级别，1表示高级级别，默认创建普通管理员
--
CREATE TABLE admin
(id int(8) NOT NULL AUTO_INCREMENT,
adminname varchar(20) NOT NULL COMMENT '管理员名称',
password char(32) NOT NULL COMMENT '管理员密码',
level tinyint(1) DEFAULT 0 '管理员级别',
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;