create database mysite;
use mysite;
create table user
(
id int primary key auto_increment,
first varchar(30),
last varchar(30),
email varchar(50),
dob date,
gender varchar(10),
pass varchar(20)
);

select * from user;

alter table user
add imagePath varchar(50) not null;


alter table user
drop column dob;
desc user;

delete from user
where id >0;

alter table user
add fileName varchar(50) not null;

create table imageProc
(
id int primary key auto_increment,
inputFileName varchar(30),
inputFilePath varchar(30),
edgeMapName   varchar(30),
edgeMapPath   varchar(30)
);


