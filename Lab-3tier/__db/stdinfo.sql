/*
MySQL Data Transfer
Source Host: localhost
Source Database: stdinfo
Target Host: localhost
Target Database: stdinfo
Date: 4/6/2012 5:22:59 PM
*/


-- ----------------------------
-- Table structure for student
-- ----------------------------
CREATE TABLE `student` (
  `Id` int(11) NOT NULL auto_increment,
  `Roll` varchar(50) default NULL,
  `Name` varchar(255) default NULL,
  `Email` varchar(255) default NULL,
  `DateOfBirth` datetime default NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `student` VALUES ('1', '028', 'John Doe', 'jdoe@example.org', null);
INSERT INTO `student` VALUES ('2', null, null, null, null);
