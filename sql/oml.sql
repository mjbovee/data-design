INSERT INTO profile(profileId, profileDisplayName, profileEmail, profileHash, profileRealName, profileWebAddress) values (unhex("95ad0914b2a343608d88414bf9d08091"),"mjbovee","michael.j.bovee@gmail.com", "40124e125", "Michael Bovee", "mjbovee.com");

INSERT INTO photo(photoId, photoProfileId, photoPath, photoSize, photoTitle) VALUES(unhex("a000656ef8e24517b5d9a7af552805ef"), unhex("95ad0914b2a343608d88414bf9d08091"), "http://www.mjboveephoto.com", "21.2mb", "Photo I Took");

INSERT INTO comment(commentId, commentPhotoId, commentProfileId, commentDate) VALUES(unhex("86988389e4a142c18b282e4045a38e81"), unhex("a000656ef8e24517b5d9a7af552805ef"), unhex("95ad0914b2a343608d88414bf9d08091"), "10-12-12");

UPDATE profile SET profileDisplayName = "michaeljbovee91", profileRealName = "Michael J Bovee" where profileId = unhex("95ad0914b2a343608d88414bf9d08091");