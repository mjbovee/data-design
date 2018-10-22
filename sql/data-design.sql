ALTER DATABASE mbovee CHARACTER SET utf8 COLLATE utf8_unicode_ci;

-- drop tables if they exist

DROP TABLE IF EXISTS commment;
DROP TABLE IF EXISTS `like`;
DROP TABLE IF EXISTS photo;
DROP TABLE IF EXISTS profile;

-- create comment table

CREATE TABLE profile (
	-- primary key
	profileId BINARY(16) NOT NULL,
	-- attributes
	profileDisplayName VARCHAR(32) NOT NULL,
	profileEmail VARCHAR(128) NOT NULL,
	profileHash CHAR(97) NOT NULL,
	profileRealName VARCHAR(32) NOT NULL,
	profileWebAddress VARCHAR(128),
	-- prevent duplicate data
	UNIQUE(profileDisplayName),
	UNIQUE(profileEmail),
	-- primary key
	PRIMARY KEY(profileId)
);

CREATE TABLE photo (
	-- primary key
	photoId BINARY(16) NOT NULL,
	-- foreign keys
	photoProfileId BINARY(16) NOT NULL,
	-- attributes
	photoCopyright VARCHAR(128),
	photoFormat VARCHAR(8),
	photoPath VARCHAR(128) NOT NULL,
	photoSize VARCHAR(16) NOT NULL,
	photoTitle VARCHAR(64) NOT NULL,
	-- create foreign key relations
	FOREIGN KEY(photoProfileId) REFERENCES profile(profileId),
	-- create primary key
	PRIMARY KEY(photoId)
);

CREATE TABLE comment (
	-- primary key
	commentId BINARY(16) NOT NULL,
	-- foreign keys
	commentPhotoId BINARY(16) NOT NULL,
	commentProfileId BINARY(16) NOT NULL,
	-- attributes
	commentContent VARCHAR(1000),
	commentDate DATETIME(6) NOT NULL,
	-- indices for foreign keys
	INDEX(commentPhotoId),
	INDEX(commentProfileId),
	-- create foreign key relations
	FOREIGN KEY(commentPhotoId) REFERENCES photo(photoId),
	FOREIGN KEY(commentProfileId) REFERENCES profile(profileId),
	-- create primary key
	PRIMARY KEY(commentId)
);

-- create like table

CREATE TABLE `like` (
	-- foreign keys
	likePhotoId BINARY(16) NOT NULL,
	likeProfileId BINARY(16) NOT NULL,
	-- attributes
	likeDate DATETIME(6) NOT NULL,
	-- indices for foreign keys
	INDEX(likePhotoId),
	INDEX(likeProfileId),
	-- create foreign key relations
	FOREIGN KEY(likePhotoId) REFERENCES photo(photoId),
	FOREIGN KEY(likeProfileId) REFERENCES profile(profileId),
	-- create primary key
	PRIMARY KEY(likePhotoId, likeProfileId)
);

CREATE TABLE photoComment (
	photoCommentPhotoId BINARY(16) NOT NULL,
	photoCommentCommentId BINARY(16) NOT NULL,
	FOREIGN KEY(photoCommentPhotoId) REFERENCES photo(photoId),
	FOREIGN KEY(photoCommentCommentId) REFERENCES comment(commentId),
	PRIMARY KEY(photoCommentPhotoId, photoCommentCommentId)
);