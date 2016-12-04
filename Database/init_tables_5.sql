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