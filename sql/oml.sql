INSERT INTO profile(profileId, profileDisplayName, profileEmail, profileHash, profileRealName, profileWebAddress) values (unhex("95ad0914b2a343608d88414bf9d08091"),"mjbovee","michael.j.bovee@gmail.com", "40124e125", "Michael Bovee", "mjbovee.com");

INSERT INTO profile(profileId, profileDisplayName, profileEmail, profileHash, profileRealName) VALUES(unhex("6e677e4bd46a4c3dbc9a5a51b6178bdd"), "bmalley", "bmalley@email.com", "40124e126", "Brita Alley");

INSERT INTO photo(photoId, photoProfileId, photoPath, photoSize, photoTitle) VALUES(unhex("a000656ef8e24517b5d9a7af552805ef"), unhex("95ad0914b2a343608d88414bf9d08091"), "http://www.mjboveephoto.com", "21.2mb", "Photo I Took");

INSERT INTO comment(commentId, commentPhotoId, commentProfileId, commentDate) VALUES(unhex("86988389e4a142c18b282e4045a38e81"), unhex("a000656ef8e24517b5d9a7af552805ef"), unhex("95ad0914b2a343608d88414bf9d08091"), "10-12-12");

INSERT INTO `like`(likePhotoId, likeProfileId, likeDate) VALUES(unhex("a000656ef8e24517b5d9a7af552805ef"), unhex("95ad0914b2a343608d88414bf9d08091"), "12-12-12");

INSERT INTO `like`(likePhotoId, likeProfileId, likeDate) VALUES(unhex("a000656ef8e24517b5d9a7af552805ef"), unhex("6e677e4bd46a4c3dbc9a5a51b6178bdd"), "10-10-10");

UPDATE profile SET profileDisplayName = "michaeljbovee91", profileRealName = "Michael J Bovee" WHERE profileId = unhex("95ad0914b2a343608d88414bf9d08091");

DELETE FROM comment WHERE commentId = unhex("86988389e4a142c18b282e4045a38e81");

SELECT photoId, photoProfileId, photoPath, photoSize, photoTitle FROM photo WHERE photoId = unhex("a000656ef8e24517b5d9a7af552805ef");

SELECT profile.profileId, profile.profileDisplayName, photo.photoId, photo.photoTitle FROM profile INNER JOIN photo ON photo.photoProfileId = profile.profileId WHERE photoId = unhex("a000656ef8e24517b5d9a7af552805ef");

SELECT COUNT(*) FROM `like` WHERE likePhotoId = unhex("a000656ef8e24517b5d9a7af552805ef");

-- SELECT COUNT(*) FROM `like` WHERE likeTweetId = uuid;