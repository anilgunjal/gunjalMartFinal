create database napreview;

create table admins(
adminid bigint auto_increment primary key,
staffid varchar(20),
name varchar(100),
email varchar(100),
password varchar(100),
contact varchar(20),
address varchar(300),
dob DATE,
avatar varchar(200),
status tinyint(4) DEFAULT '1',
logstatus tinyint(4) DEFAULT '0',
lastlogindate TIMESTAMP NULL DEFAULT NULL,
createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

create table category(
catid bigint auto_increment primary key,
adminid int(11),
catname varchar(100),
createdDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

create table subcategory(
scatid bigint auto_increment primary key,
catid bigint,
adminid int(11),
subcatname varchar(100),
createdDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

create table products(
proid bigint auto_increment primary key,
catid bigint,
scatid bigint,
proname varchar(300),
promodelno varchar(100),
prodescp varchar(1000),
adminid int(11),
upadminid int(11) NULL DEFAULT NULL,
createdDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
updatedDate TIMESTAMP NULL DEFAULT NULL
);

create table specification(
spfid bigint auto_increment primary key,
scatid bigint,
specification varchar(1000),
createdDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

create table banner(
bannerid bigint auto_increment primary key,
adminid int(11),
imagepath varchar(250),
createdDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

create table users(
userid bigint auto_increment primary key,
username varchar(100),
email varchar(100),
password varchar(100),
contact varchar(50),
status tinyint(4) DEFAULT '1',
logstatus tinyint(4) DEFAULT '0',
lastlogindate TIMESTAMP NULL DEFAULT NULL,
createdDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reviewstat(
id int(200) NOT NULL,
proid int(20) NOT NULL,
userid int(10) NOT NULL,
store varchar(20) NOT NULL,
comments varchar(200) NOT NULL,
invoice varchar(200) NOT NULL,
status tinyint(4) DEFAULT '0',
upadminid int(11) NULL DEFAULT NULL,
createdDate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
updatedDate TIMESTAMP NULL DEFAULT NULL
)

create table points(
pid bigint auto_increment primary key,
userid bigint,
reviewid bigint,
points int(11),
adminid int(11),
createdDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);