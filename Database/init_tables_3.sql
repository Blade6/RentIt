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

insert into board (userid,date,time,content)
values ('440221199506261917','2016-06-10','17:04:51','Hello World!');
insert into board (userid,date,time,content)
values ('440221198806012104','2016-06-10','17:54:30','My name is Linus Trovalds and I am your god.');
insert into board (userid,date,time,content)
values ('440221199505201918','2016-06-11','12:00:00','I think the deposit is too expensive.');
insert into board (userid,date,time,content)
values ('441520198403162016','2016-06-11','18:04:02','Love this website.Help me a lot.');

insert into admin (adminname,password,level)
values ('root','098f6bcd4621d373cade4e832627b4f6',1);