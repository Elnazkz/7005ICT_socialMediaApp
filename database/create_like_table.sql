drop table if exists Likes;

create table Likes (
    id integer not null primary key autoincrement,
    postId integer,
    userId integer,
    FOREIGN KEY (postId) REFERENCES Post(id),
    FOREIGN KEY (userId) REFERENCES User(id)
);

insert into Likes (postId, userId) VALUES (1, 2);
insert into Likes (postId, userId) VALUES (1, 3);
insert into Likes (postId, userId) VALUES (1, 4);
insert into Likes (postId, userId) VALUES (1, 5);
insert into Likes (postId, userId) VALUES (2, 5);
insert into Likes (postId, userId) VALUES (3, 1);
insert into Likes (postId, userId) VALUES (3, 3);
insert into Likes (postId, userId) VALUES (3, 5);

