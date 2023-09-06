drop table if exists Posts;

create table Posts (
    id integer not null primary key autoincrement,
    title varchar(50),
    message TEXT,
    date DATE,
    userId integer,
    FOREIGN KEY (userId) REFERENCES Users(id)
);

insert into Posts (title,message,date, userId) VALUES ('My first post', 'This is my first post', '2023-09-01 14:20:02',1);
insert into Posts (title,message,date, userId) VALUES ('My Post 2', 'This is my second post here', '2023-09-03 14:20:02',1);
insert into Posts (title,message,date, userId) VALUES ('Daily routines', 'This is how my day went by.', '2023-08-25 14:20:02',2);
insert into Posts (title,message,date, userId) VALUES ('How to think positively', 'Avoid negative thoughts', '2023-07-23 14:20:02',5);
insert into Posts (title,message,date, userId) VALUES ('Human Characteristics', 'Here is a list', '2023-05-02 14:20:02',5);
