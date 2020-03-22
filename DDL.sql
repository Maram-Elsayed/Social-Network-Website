create DATABASE socialnetwork;
use socialnetwork ;

Create Table users(
        user_id int Auto_Increment,
		fname varchar(50) not null,
		lname varchar(70) not null,
		nickname varchar(70) not null,
		password varchar(70) not null,
		phone_1 int,
		phone_2 int,
		email varchar(70) unique not null,
		gender varchar(20) not null,
		birthdate varchar(20) not null,
		hometown varchar(70) ,
		aboutme varchar(250),
		marital_status varchar(15),
		profile_pic text ,	        
		PRIMARY key(user_id)
	);
	
	Create Table post(
	    post_id int Auto_Increment,
		caption varchar(200) not null,
		poster_name varchar(70) not null,
		poster_id int,
		posted_time TIMESTAMP,
		is_public varchar(15),
		image text ,		
		PRIMARY key(post_id),
		Foreign key(poster_id) REFERENCES users(user_id)
	);
	
	Create Table friend_requests(	  
      user_from int ,
      user_to int ,
      PRIMARY KEY (user_from,user_to),
	  Foreign key(user_from) REFERENCES users(user_id),
	  Foreign key(user_to) REFERENCES users(user_id)
);


Create Table friends(
      user_id1 int,
      user_id2 int,
      PRIMARY KEY (user_id1,user_id2),
	  Foreign key(user_id1) REFERENCES users(user_id),
	  Foreign key(user_id2) REFERENCES users(user_id)
	  
);
