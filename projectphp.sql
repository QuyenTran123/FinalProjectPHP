drop database if exists Watch;
create database Watch DEFAULT CHARACTER SET UTF8;
use Watch;


create table if not exists category (
id int(11) not null auto_increment,
cat_name varchar(255),
note text,
primary key(id)
);

create table if not exists product (
id int(11) not null auto_increment,
prod_name varchar(255),
category_id int(11),
price int(11),
quantity int(11),
status int(1),
imported_date date,
image mediumblob,
xem int(11),
sale int(11),
primary key(id),
foreign key(category_id) references category (id)
);

create table if not exists users (
id int(11) not null auto_increment,
user_name varchar(255),
address varchar(255),
password varchar(255),
sdt varchar(100),
email varchar(255),
img varchar(255),
role varchar(255) default 'khachhang',
primary key (id)
);

create table if not exists orders (
id int(11) not null auto_increment,
cus_id int(11),
date date,
primary key (id),
foreign key (cus_id) references users (id)
);

create table if not exists prod_orders (
prod_id int(11) not null auto_increment,
order_id int(11),
quantity int(11),
primary key(prod_id, order_id),
foreign key(prod_id) references product(id),
foreign key(order_id) references orders(id)
);

create table if not exists comments(
com_id int(11) not null auto_increment,
cus_name varchar(255),
comment varchar(255),
primary key (com_id)
);

insert into category (cat_name) values
('Đồng hồ bấm giờ'),
('Đồng hồ thợ lặn'),
('Đồng hồ báo thức'),
('Đồng hồ nguyên tử'),
('Đồng hồ điện tử'),
('Đồng hồ thông minh'),
('Đồng hồ đa năng'),
('Đồng hồ cơ'),
('Đồng hồ mặt trời'),
('Đồng hồ kỹ thuật số');


/*insert into orders (user_name, date) values
(1,date('2018-01-02')),
(1,date('2018-12-12')),
(2,date('2018-01-02')),
(2,date('2018-01-03')),
(2,date('2018-03-01'));*/


insert into product 
(prod_name,		category_id,	price,	quantity,	status,	imported_date,image,xem,sale) 
values
('Đồng hồ thông minh SmartWatch nữ ', 	6, 100000, 100, 4, date('2015-01-02'),'uploads/slide1.gif',0,79000),
('Đồng hồ thông minh SmartWatch nam', 	6, 100000, 100, 4, date('2015-01-02'),'uploads/slide2.gif',0,80000),
('Đồng hồ thông minh SmartWatch em bé', 	6, 100000, 100, 4, date('2015-01-02'),'uploads/slide3.gif',0,80000),
('Đồng hồ thông minh SmartWatch nâu ăn', 	6, 100000, 100, 3, date('2015-01-02'),'uploads/moinhat1.png',0,70000),
('Đồng hồ thông minh SmartWatch học hành', 	6, 100000, 100, 3, date('2015-01-02'),'uploads/moinhat2.png',0,8000),
('Đồng hồ thông minh SmartWatch em yêu', 	6, 100000, 100, 3, date('2015-01-02'),'uploads/moinhat3.png',0,2000),
('Đồng hồ thông minh SmartWatch baby', 	6, 100000, 100, 2, date('2015-01-02'),'uploads/bamgio1.jpg',0,2000),
('Đồng hồ thông minh SmartWatch handsome', 	6, 100000, 100, 2, date('2015-01-02'),'uploads/baothuc2.jpg',0,2000),
('Đồng hồ thông minh SmartWatch ', 	6, 100000, 100, 2, date('2015-01-02'),'uploads/conu1.jpg',0,2000),
('Đồng hồ thông minh SmartWatch', 	6, 100000, 100, 2, date('2015-01-02'),'uploads/dientu1.jpg',0,2000),
('Đồng hồ thông minh SmartWatch', 	6, 100000, 100, 2, date('2015-01-02'),'uploads/danang.jpg',0,2000),
('Đồng hồ thông minh SmartWatch', 	6, 100000, 100, 2, date('2015-01-02'),'uploads/govuong1.jpg',0,2000),

('Đồng hồ bấm giờ nấu ăn', 	1, 100000, 100, 1, date('2015-01-02'),'uploads/q2.jpg',0,2000),
('Đồng hồ bấm giờ nam', 	1, 100000, 100, 1, date('2015-01-02'),'uploads/q3.jpg',0,2000),
('Đồng hồ bấm giờ nữ', 	1, 100000, 100, 1, date('2015-01-02'),'uploads/q4.jpg',0,2000),
('Đồng hồ bấm giờ hiện đại', 	1, 100000, 100, 1, date('2015-01-02'),'uploads/q5.jpg',0,2000),
('Đồng hồ bấm giờ cổ hủ', 	1, 100000, 100, 1, date('2015-01-02'),'uploads/t6.jpg',0,0),
('Đồng hồ bấm giờ thời thượng', 	1, 100000, 100, 1, date('2015-01-02'),'uploads/q7.jpg',0,0),
('Đồng hồ bấm giờ fashion', 	1, 100000, 100, 1, date('2015-01-02'),'uploads/q8.jpg',0,2000),
('Đồng hồ bấm giờ luxary', 	1, 100000, 100, 1, date('2015-01-02'),'uploads/q9.jpg',0,2000),
('Đồng hồ bấm giờ', 	1, 100000, 100, 1, date('2015-01-02'),'uploads/q10.jpg',0,0),


('Đồng hồ thợ lặn nam', 	2, 100000, 100, 1, date('2015-01-02'),'uploads/t1.jpg',0,0),
('Đồng hồ thợ lặn nữ', 	2, 100000, 100, 1, date('2015-01-02'),'uploads/t2.jpg',0,0),
('Đồng hồ thợ lặn thông minh', 	2, 100000, 100, 1, date('2015-01-02'),'uploads/t3.jpg',0,2000),
('Đồng hồ thợ lặn nhịp tim', 	2, 100000, 100, 1, date('2015-01-02'),'uploads/t4.jpg',0,0),
('Đồng hồ thợ lặn fashion', 	2, 100000, 100, 1, date('2015-01-02'),'uploads/t5.jpg',0,2000),
('Đồng hồ thợ lặn luxary', 	2, 100000, 100, 1, date('2015-01-02'),'uploads/t6.jpg',0,0),
('Đồng hồ thợ lặn baby', 	2, 100000, 100, 1, date('2015-01-02'),'uploads/t7.jpg',0,0),
('Đồng hồ thợ lặn đò chơi', 	2, 100000, 100, 1, date('2015-01-02'),'uploads/t8.jpg',0,2000),
('Đồng hồ thợ lặn', 	2, 100000, 100, 1, date('2015-01-02'),'uploads/t9.jpg',0,0),


('Đồng hồ thông minh SmartWatch', 	6, 100000, 100, 1, date('2015-01-02'),'uploads/thongminh2.jpg',0,2000),

('Đồng hồ đa năng gỗ vuông',7, 2500000, 20, 	 1, date('2010-01-02'),'uploads/govuong1.jpg',0,0),
('Đồng hồ đa năng đo điện trở kỹ thuật', 	7, 200000, 10, 1, date('2015-01-20'),'uploads/kythuat2.jpg',0,2000),

('Đồng hồ cơ nữ Shahire',8, 500000, 5, 	 1, date('2016-01-02'),'uploads/conu1.jpg',0,0),
('Đồng hồ cơ nam', 	8, 600000, 18, 1, date('2018-01-02'),'uploads/conu2.jpg',0,0),

('Đồng hồ mặt trời nữ tích lũy năng lượng',9, 2500000, 50, 	 1, date('2017-01-02'),'uploads/mattroi1.jpg',0,2000),
('Đồng hồ mặt trời', 	9, 100000, 150, 1, date('2016-12-02'),'uploads/mattroi2.jpg',0,0),

('Đồng hồ kỹ thuật số',10, 200000, 50, 	 1, date('2018-01-02'),'uploads/kythuat1.jpg',0,0),
('Đồng hồ Led kỹ thuật số', 	10, 100000, 125, 1, date('2019-01-01'),'uploads/kythuat2.jpg',0,2000);


insert into users(user_name,password)
value ('user','password');
