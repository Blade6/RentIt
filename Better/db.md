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
FOREIGN KEY (coll) REFERENCES blog(collection),
FOREIGN KEY (userid) REFERENCES user(identity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

为什么多了15行就无法建表成功？