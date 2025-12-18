
/* CREATE TABLES */

CREATE TABLE `ProjectUsers` (
    `Username` VARCHAR(30) NOT NULL,
    `Password` VARCHAR(255) NOT NULL,
    `Email`  VARCHAR(255) NOT NULL,
    `Country` VARCHAR(64),
    `DOB` DATE,
    PRIMARY KEY (`Username`)
);

CREATE TABLE `ProjectMyShows` (
    `StorageID` VARCHAR(60) NOT NULL,
    `Username` VARCHAR(30) NOT NULL,
    `SeriesID` INT NOT NULL,
    `SeriesName` VARCHAR(60),
    `DateTimeAdded` DATETIME,
    `ViewingStatus` BOOLEAN NOT NULL,
    PRIMARY KEY (`StorageID`),
    FOREIGN KEY (`Username`) REFERENCES ProjectUsers (`Username`)
);