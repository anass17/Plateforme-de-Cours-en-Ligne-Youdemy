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


INSERT INTO users (user_id, first_name, last_name, email, password, role, status, image_url, token, token_expiration, title, bio)
VALUES
(1, 'Ahmed', 'El Fassi', 'ahmed.elfassi@example.com', '$2y$12$qRIJQWQl2gl5VPjGyfVkzOOn2LJvv1NLAMq24AMLFQOSEZq4zRPMq', 'admin', 'active', '', null, '2026-02-15 12:00:00', 'Platform Administrator', 'Ahmed manages the platform and oversees all operations.'),
(2, 'Sara', 'El Mansouri', 'sara.elmansouri@example.com', '$2y$12$qRIJQWQl2gl5VPjGyfVkzOOn2LJvv1NLAMq24AMLFQOSEZq4zRPMq', 'student', 'active', '', null, '2026-02-15 12:00:00', 'Computer Science Student', 'Sara is passionate about learning new technologies and web development.'),
(3, 'Fatima', 'Benali', 'fatima.benali@example.com', '$2y$12$qRIJQWQl2gl5VPjGyfVkzOOn2LJvv1NLAMq24AMLFQOSEZq4zRPMq', 'teacher', 'active', '', null, '2026-02-15 12:00:00', 'Mathematics Teacher', 'Fatima has 5 years of experience teaching mathematics at high school level.'),
(4, 'Hassan', 'Toumi', 'hassan.toumi@example.com', '$2y$12$qRIJQWQl2gl5VPjGyfVkzOOn2LJvv1NLAMq24AMLFQOSEZq4zRPMq', 'teacher', 'active', '', null, '2026-02-15 12:00:00', 'Physics Teacher', 'Hassan loves explaining complex physics concepts in simple ways.'),
(5, 'Naima', 'Fadili', 'naima.fadili@example.com', '$2y$12$qRIJQWQl2gl5VPjGyfVkzOOn2LJvv1NLAMq24AMLFQOSEZq4zRPMq', 'teacher', 'active', '', null, '2026-02-15 12:00:00', 'Chemistry Teacher', 'Naima enjoys conducting interactive experiments for her students.'),
(6, 'Khadija', 'Rifi', 'khadija.rifi@example.com', '$2y$12$qRIJQWQl2gl5VPjGyfVkzOOn2LJvv1NLAMq24AMLFQOSEZq4zRPMq', 'student', 'active', '', null, '2026-02-15 12:00:00', 'Business Student', 'Khadija is exploring entrepreneurship and digital marketing strategies.'),
(7, 'Youssef', 'Chikhi', 'youssef.chikhi@example.com', '$2y$12$qRIJQWQl2gl5VPjGyfVkzOOn2LJvv1NLAMq24AMLFQOSEZq4zRPMq', 'student', 'pending', '', null, '2026-02-15 12:00:00', 'Engineering Student', 'Youssef is learning software engineering and web development.'),
(8, 'Laila', 'Zerouali', 'laila.zerouali@example.com', '$2y$12$qRIJQWQl2gl5VPjGyfVkzOOn2LJvv1NLAMq24AMLFQOSEZq4zRPMq', 'student', 'deleted', '', null, '2026-02-15 12:00:00', 'Art Student', 'Laila enjoys digital art and graphic design.'),
(9, 'Ilyas', 'Ait Ahmed', 'ilyas.aitahmed@example.com', '$2y$12$qRIJQWQl2gl5VPjGyfVkzOOn2LJvv1NLAMq24AMLFQOSEZq4zRPMq', 'student', 'active', '', null, '2026-02-15 12:00:00', 'Computer Engineering Student', 'Ilyas is focused on programming and AI projects.'),
(10, 'Omar', 'Bouazza', 'omar.bouazza@example.com', '$2y$12$qRIJQWQl2gl5VPjGyfVkzOOn2LJvv1NLAMq24AMLFQOSEZq4zRPMq', 'teacher', 'banned', '', null, '2026-02-15 12:00:00', 'History Teacher', 'Omar has a passion for teaching Moroccan history and culture.');


insert into courses 
    (title, description, image_path, publish_date, type, file_path, course_owner, course_category)
values
    ('Intro to Programming', 'Learn the basics of programming using Python.', '', current_timestamp, 'Video', '', 3, 1),
    ('Healthy Living', 'A guide to living a healthier life with nutrition and exercise.', '', current_timestamp, 'Document', '', 3, 7),
    ('Adventure Travel', 'Explore exciting travel destinations around the world.', '', current_timestamp, 'Video', '', 4, 3),
    ('Fashion 101', 'Learn about the latest trends in fashion.', '', current_timestamp, 'Document', '', 5, 5),
    ('Sports for Beginners', "A beginner's guide to various sports and physical activities.", '', current_timestamp, 'Video', '', 5, 2),
    ('Healthy Eating', 'A comprehensive guide on healthy eating habits.', '', current_timestamp, 'Document', '', 4, 7),
    ('Tech Innovations', 'Explore the latest innovations in technology and their impacts.', '', current_timestamp, 'Video', '', 3, 1),
    ('Business Strategy', 'Learn about key business strategies and practices.', '', current_timestamp, 'Document', '', 3, 10),
    ('Home Gardening Basics', 'Learn how to start a home garden and grow your own food.', '', current_timestamp, 'Video', '', 4, 9),
    ('Entertainment Industry Insights', "An insider's view of the entertainment industry.", '', current_timestamp, 'Document', '', 5, 6);
    
















