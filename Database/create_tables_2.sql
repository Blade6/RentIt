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
-- 留言表
-- 留言内容操作状态有4种:正常显示0，用户个人删除1，管理员删除2和3，管理员彻底删除null
-- 用户个人删除，则意见反馈页面不能看见，但用户个人页面可以看见，用户可以选择恢复
-- 管理员删除有两种状态:
-- 2表示用户没有删除该条记录，但是管理员删除了，意见反馈页面和用户个人页面都不能看见，只有管理员页面可以恢复或彻底删除
-- 3表示用户删除了该记录，其他与2类似
-- 管理员彻底删除，则数据库表中将不再有该条记录
CREATE TABLE board
(id int(8) NOT NULL AUTO_INCREMENT,
userid char(18) NOT NULL COMMENT '留言用户身份证号',
date char(10) NOT NULL COMMENT '留言日期',
time char(8) NOT NULL COMMENT '留言时间',
content varchar(140) COMMENT '留言内容',
flag tinyint(1) DEFAULT 0 COMMENT '留言内容显示状态',
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