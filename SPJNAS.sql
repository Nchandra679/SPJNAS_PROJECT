CREATE DATABASE SPJNAS;

CREATE TABLE Users (
	U_ID INT(10) NOT NULL AUTO_INCREMENT,
	Title VARCHAR(10) NOT NULL,
	First_Name VARCHAR(40) NOT NULL,
	Other_Name VARCHAR(100) DEFAULT NULL,
	Last_Name VARCHAR(40) NOT NULL,
	Degree VARCHAR(20) NOT NULL,
	Password VARCHAR(255) NOT NULL,
	Email VARCHAR(40) NOT NULL DEFAULT 0,
	Date_Create DATETIME NOT NULL,
	Area_of_Speciality VARCHAR(10) DEFAULT NULL,
	Access_level VARCHAR(20) NOT NULL,
	Phone_Number VARCHAR(15) DEFAULT NULL,
	Account_Active BOOLEAN DEFAULT TRUE,
	PRIMARY KEY (U_ID)
);
	
CREATE TABLE LOG_FILE (
	ID INT NOT NULL AUTO_INCREMENT,
	U_ID INT(10) NOT NULL,
	Date_login DATETIME NOT NULL,
	Date_logout DATETIME DEFAULT NULL,
	PRIMARY KEY (ID),
	CONSTRAINT FK_ID FOREIGN KEY (U_ID) REFERENCES Users (U_ID)
);
	
CREATE TABLE Manuscript (
	ID INT(10) NOT NULL AUTO_INCREMENT,
	ArticleType VARCHAR(20) DEFAULT NULL,
	Title VARCHAR(255) NOT NULL DEFAULT 0,
	Abstract TEXT DEFAULT NULL,
	KeyWords VARCHAR(255) NOT NULL DEFAULT 0,
	Classifications VARCHAR(40) DEFAULT NULL,
	Highlights VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
	Manuscript VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
	Cover_Letter VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
	Date_Upload datetime DEFAULT NULL,
	Submit BOOLEAN DEFAULT FALSE,
	Review_Process VARCHAR(50) DEFAULT NULL,
	PRIMARY KEY (ID)
);

CREATE TABLE ManuscriptAuthor(
	ID INT(10) NOT NULL,
	U_ID INT(10) NOT NULL,
	PRIMARY KEY (ID, U_ID),
	CONSTRAINT FK_MAID FOREIGN KEY (ID) REFERENCES Manuscript (ID),
	CONSTRAINT FK1_MAID FOREIGN KEY (U_ID) REFERENCES USERS (U_ID)
);

CREATE TABLE Suggested_Reviewer (
	S_ID INT(10) NOT NULL AUTO_INCREMENT,
	ID INT(10) NOT NULL,
	Title VARCHAR(10) NOT NULL,
	First_Name VARCHAR(40) NOT NULL,
	Other_Name VARCHAR(100) DEFAULT NULL,
	Last_Name VARCHAR(40) NOT NULL,
	Degree VARCHAR(20) NOT NULL,
	Email VARCHAR(40) NOT NULL DEFAULT 0,
	Reason VARCHAR(255) DEFAULT NULL,
	PRIMARY KEY (S_ID),
	CONSTRAINT FK1_SRID FOREIGN KEY (ID) REFERENCES Manuscript (ID)
);	

CREATE TABLE Response (
	R_ID INT(10) NOT NULL AUTO_INCREMENT,
	ID INT(10) NOT NULL,
	U_ID INT(10) NOT NULL,
	Decision VARCHAR(60) DEFAULT NULL,
	Comments TEXT DEFAULT NULL,
	Originality VARCHAR(10) DEFAULT NULL,
	Justify VARCHAR(10) DEFAULT NULL,
	Credit VARCHAR(10) DEFAULT NULL,
	STitle VARCHAR(10) DEFAULT NULL,
	Clear_Text VARCHAR(10) DEFAULT NULL,
	Shorten VARCHAR(10) DEFAULT NULL,
	References_C VARCHAR(10) DEFAULT NULL,
	Illustrations VARCHAR(10) DEFAULT NULL,
	Figures VARCHAR(10) DEFAULT NULL,
	Review_Done BOOLEAN DEFAULT FALSE,
	PRIMARY KEY (R_ID),
	CONSTRAINT FK_RID FOREIGN KEY (U_ID) REFERENCES USERS (U_ID),
	CONSTRAINT FK1_RID FOREIGN KEY (ID) REFERENCES Manuscript (ID)	
);	

CREATE TABLE Editor_Response (
	E_ID INT(10) NOT NULL AUTO_INCREMENT,
	ID INT(10) NOT NULL,
	U_ID INT(10) NOT NULL,
	Decision VARCHAR(60) DEFAULT NULL,
	Comments TEXT DEFAULT NULL,
	PRIMARY KEY (E_ID),
	CONSTRAINT FK_EID FOREIGN KEY (U_ID) REFERENCES USERS (U_ID),
	CONSTRAINT FK1_EID FOREIGN KEY (ID) REFERENCES Manuscript (ID)	
);
	
INSERT INTO `users`( `Title`, `First_Name`, `Last_Name`, `Degree`, `Password`, `Email`, `Area_of_Speciality`, `Access_level`) VALUES ("Mr", "Nickeel", "Chandra", "BSE", "binuh2am", "nickeelchandra@gmail.com", "AI", "Editor" );



