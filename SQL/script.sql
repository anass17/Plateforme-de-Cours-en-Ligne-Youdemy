create database youdemy;

use youdemy;

create table users (
	user_id int unsigned auto_increment primary key,
	first_name varchar(50) not null,
	last_name varchar(50) not null,
	email varchar(100) unique not null,
	password varchar(255) not null,
	role ENUM('student', 'teacher', 'admin') not null,
	status ENUM('active', 'banned', 'pending', 'deleted') not null,
	image_url varchar(100) default '',
	register_date timestamp default current_timestamp,
	token varchar(100),
	token_expiration datetime
)

alter table users add title varchar(100) not null;
alter table users add bio varchar(250) not null;

create table courses (
	course_id int unsigned auto_increment primary key,
	title varchar(100) not null,
	description text not null,
	image_path varchar(100) default '',
	publish_date timestamp default current_timestamp,
	type enum('Video', 'Document') not null,
	file_path varchar(100) not null,
	course_owner int unsigned,
	foreign key (course_owner) references users(user_id) on delete set null on update cascade
)

create table enrollement (
	course_id int unsigned,
	user_id int unsigned,
	enrollement_date timestamp default current_timestamp,
	foreign key (course_id) references courses(course_id) on delete cascade on update cascade,
	foreign key (user_id) references users(user_id) on delete cascade on update cascade
)

create table reviews (
	review_id int unsigned auto_increment primary key,
	content text not null,
	publish_date timestamp default current_timestamp,
	rating tinyint not null,
	review_course int unsigned,
	review_author int unsigned,
	foreign key (review_course) references courses(course_id) on delete cascade on update cascade,
	foreign key (review_author) references users(user_id) on delete cascade on update cascade
)

create table categories (
	cat_id int unsigned auto_increment primary key,
	cat_name varchar(50) not null
)

alter table courses add course_category int unsigned;
alter table courses add constraint fk1 foreign key (course_category) references categories(cat_id) on delete set null on update cascade;

create table tags (
	tag_id int unsigned auto_increment primary key,
	tag_name varchar(50) not null
)

create table course_tags (
	course_id int unsigned,
	tag_id int unsigned,
	foreign key (course_id) references courses(course_id) on delete cascade on update cascade,
	foreign key (tag_id) references tags(tag_id) on delete cascade on update cascade
)


insert into categories (cat_name) values
('Technology'), ('Sports'), ('Travel'), ('Food'), ('Fashion'), ('Entertainment'), ('Health & Wellness'), ('Education'), ('Home & Garden'), ('Business');

insert into tags (tag_name) values
('AI'), ('Machine Learning'), ('Robotics'), ('Cloud Computing'), ('Cybersecurity'), ('Blockchain');

insert into courses 
    (title, description, image_path, publish_date, type, file_path, course_owner, course_category)
values
    ('Intro to Programming', 'Learn the basics of programming using Python.', '', current_timestamp, 'Video', '', 14, 1),
    ('Healthy Living', 'A guide to living a healthier life with nutrition and exercise.', '', current_timestamp, 'Document', '', 14, 7),
    ('Adventure Travel', 'Explore exciting travel destinations around the world.', '', current_timestamp, 'Video', '', 14, 3),
    ('Fashion 101', 'Learn about the latest trends in fashion.', '', current_timestamp, 'Document', '', 14, 5),
    ('Sports for Beginners', 'A beginner\'s guide to various sports and physical activities.', '', current_timestamp, 'Video', '', 14, 2),
    ('Healthy Eating', 'A comprehensive guide on healthy eating habits.', '', current_timestamp, 'Document', '', 14, 7),
    ('Tech Innovations', 'Explore the latest innovations in technology and their impacts.', '', current_timestamp, 'Video', '', 14, 1),
    ('Business Strategy', 'Learn about key business strategies and practices.', '', current_timestamp, 'Document', '', 14, 10),
    ('Home Gardening Basics', 'Learn how to start a home garden and grow your own food.', '', current_timestamp, 'Video', '', 14, 9),
    ('Entertainment Industry Insights', 'An insider\'s view of the entertainment industry.', '', current_timestamp, 'Document', '', 14, 6);
    
















