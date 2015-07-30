Database creation :
create database hms;

Patients Table : 
create table patients (id int(10) NOT NULL,name varchar(20) NOT NULL,age int(2) NOT NULL,gender varchar(10) NOT NULL,occupation varchar(20) NOT NULL,mobile int(10) NOT NULL,address varchar(50) NOT NULL,PRIMARY KEY (id));

Prescription Table :
create table prescription(id int(10) NOT NULL,medicine varchar(50) NOT NULL,diagnosis varchar(50) NOT NULL,instructions varchar(50) NOT NULL,doc_name varchar(20) NOT NULL,PRIMARY KEY(id));

Users Table :
create table users(username varchar(20) NOT NULL,password varchar(20) NOT NULL,PRIMARY KEY(username));


