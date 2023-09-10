drop table if exists Users;

create table Users (
    id integer not null primary key autoincrement,
    name varchar(50)
);

insert into Users (name) VALUES ('Elnaz');
insert into Users (name) VALUES ('Emma');
insert into Users (name) VALUES ('Mohsen');
insert into Users (name) VALUES ('Jack');
insert into Users (name) VALUES ('Ella');
