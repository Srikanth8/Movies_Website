
-- id is the Primary Key as it is unique to each Movie
CREATE TABLE Movie (
id int NOT NULL,
title varchar(100),
year int,
rating varchar(10),
company varchar(50),
PRIMARY KEY(id)
)ENGINE=INNODB;

-- id is the Primary Key as it is unique to each Actor
CREATE TABLE Actor (
id int NOT NULL,
last varchar(20),
first varchar(20),
sex varchar(6),
dob date,
dod date,
PRIMARY KEY(id)
)ENGINE=INNODB;

-- mid is a Foreign Key that references id in Movie. This ensures that sales data of only movies that exist are included
-- The check ensures that the no. of tickets sold is a number greater than or equal to 0 (non-negative)
CREATE TABLE Sales (
mid int NOT NULL,
ticketsSold int,
totalIncome int,
FOREIGN KEY(mid) REFERENCES Movie(id),
CHECK(ticketsSold >= 0)
)ENGINE=INNODB;

-- id is the Primary Key as it is unique to each Director
CREATE TABLE Director (
id int NOT NULL,
last varchar(20),
first varchar(20),
dob date,
dod date,
PRIMARY KEY(id)
)ENGINE=INNODB;

-- mid is a Foreign Key that references id in Movie. This ensures that movie genre records of only movies that exist are included
CREATE TABLE MovieGenre (
mid int NOT NULL,
genre varchar(20),
FOREIGN KEY(mid) REFERENCES Movie(id)
)ENGINE=INNODB;

-- mid and did are Foreign Keys that reference id in Movie and id in Director respectively. This ensures that only movies and directors that exist are recorded in this table
CREATE TABLE MovieDirector (
mid int NOT NULL,
did int,
FOREIGN KEY(mid) REFERENCES Movie(id),
FOREIGN KEY(did) REFERENCES Director(id)
)ENGINE=INNODB;

-- mid and aid are Foreign Keys that reference id in Movie and id in Actor respectively. This ensures that only movies and actors that exist are recorded in this table 
CREATE TABLE MovieActor (
mid int NOT NULL,
aid int NOT NULL,
role varchar(50),
FOREIGN KEY(mid) REFERENCES Movie(id),
FOREIGN KEY(aid) REFERENCES Actor(id)
)ENGINE=INNODB;

-- The two checks ensures that the imdb and rot ratings are in the range 0 to 100 inclusive
CREATE TABLE MovieRating (
mid int NOT NULL,
imdb int,
rot int,
CHECK(imdb >= 0 AND imdb <= 100),
CHECK(rot >= 0 AND rot <= 100)
)ENGINE=INNODB;

-- The check ensures that the rating is in between 0 and 5 inclusive
CREATE TABLE Review (
name varchar(20),
time timestamp,
mid int,
rating int,
comment varchar(500),
CHECK(rating >=0 AND rating <= 5)
)ENGINE=INNODB;

CREATE TABLE MaxPersonID (
id int
)ENGINE=INNODB;

CREATE TABLE MaxMovieID (
id int
)ENGINE=INNODB;
