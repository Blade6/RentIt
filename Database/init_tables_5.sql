insert into rent (user_ID,license_no,date,days,guarantee_deposit)
values ('440221199505201918','YueA12345','2014-07-25',15,15000);

update rent set flag=1 ,g_1_flag=1 where user_ID='440221199505201918'and date='2014-07-25';

insert into accident (rent_id,user_ID,license_no,date,place)
values (1,'440221199505201918','YueA12345','2014-07-31','Guangzhou city Panyu district');

update rent
set draw_date='20140726',return_date='20140731',g_2_flag=0,penalty=0,p_flag=0,fare=0,fare_flag=0
where user_ID='440221199505201918' and date='2014-07-25';

insert into rent (user_ID,license_no,date,days,guarantee_deposit)
values ('441520198403162016','YueA39753','2016-05-30',10,38000);

update rent set draw_date = '20160601',flag = 1,g_1_flag=1,
fare =23700 where user_ID = '441520198403162016' and date = '2016-05-30';

update rent set return_date = '20160610',g_2_flag=1,penalty=0,p_flag=0,fare_flag=0
where user_ID='441520198403162016' and date = '2016-05-30';