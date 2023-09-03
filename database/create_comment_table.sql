drop table if exists Comments;

create table Comments (
    id integer not null primary key autoincrement,
    message TEXT,
    date DATE,
    userId integer,
    postId integer,
    parentCommentID integer nullable,
    FOREIGN KEY (userId) REFERENCES Users(id),
    FOREIGN KEY (postId) REFERENCES Post(id),
    FOREIGN KEY (parentCommentID) REFERENCES Comment(id)
);

insert into Comments (message,date,userId,postId,parentCommentID) VALUES ('Wow! Amazing!','2023-09-03',3, 5, null);
insert into Comments (message,date,userId,postId,parentCommentID) VALUES ('Welcome!','2023-09-03',2,1,null);
insert into Comments (message,date,userId,postId,parentCommentID) VALUES ('Great Job!','2023-09-02',1,3,null);
insert into Comments (message,date,userId,postId,parentCommentID) VALUES ('She is right! Well done!','2023-09-03',5,3,3);
insert into Comments (message,date,userId,postId,parentCommentID) VALUES ('Well done!','2023-09-04',4,3,3);
insert into Comments (message,date,userId,postId,parentCommentID) VALUES ('Keep up the good work!','2023-09-03',4,3,null);
insert into Comments (message,date,userId,postId,parentCommentID) VALUES ('Thanks!','2023-09-05',2,3,3);
insert into Comments (message,date,userId,postId,parentCommentID) VALUES ('Thanks!','2023-09-05',2,3,4);
insert into Comments (message,date,userId,postId,parentCommentID) VALUES ('Thanks!','2023-09-05',2,3,5);
insert into Comments (message,date,userId,postId,parentCommentID) VALUES ('Thanks!','2023-09-05',2,3,6);
