CREATE TABLE People(
 personID CHAR(4) NOT NULL,
 firstName CHAR(25) NOT NULL,
 lastName CHAR(25) NOT NULL,
 email VARCHAR(100) NULL,
 job CHAR(25) NULL,
 description VARCHAR(255) NULL,
 CONSTRAINT PK_People PRIMARY KEY (personID)
);
CREATE TABLE Ip_Address(
 ipID VARCHAR(10) NOT NULL,
 ipaddress INT NULL,
 reason VARCHAR(255) NULL,
 CONSTRAINT PK_Ip_Address PRIMARY KEY (ipID)
);
CREATE TABLE Responder(
responderID CHAR(4) NOT NULL,
handler VARCHAR(25) NOT NULL,
 CONSTRAINT PK_Responder PRIMARY KEY (responderID)
);
CREATE TABLE Comment(
commenID CHAR(4) NOT NULL,
handler CHAR(25) NULL,
description VARCHAR(255) NOT NULL,
date DATE,
responderID CHAR(4) NULL,
CONSTRAINT PK_Comment PRIMARY KEY (commenID),
CONSTRAINT FK_Responder FOREIGN KEY (responderID) REFERENCES Responder
(responderID)
);
CREATE TABLE Incident(
incidentID CHAR(4) NOT NULL,
type VARCHAR(25) NOT NULL,
state VARCHAR(25) NOT NULL,
date DATE,
responderID CHAR(4) NULL,
commenID CHAR(4) NULL,
ipID VARCHAR(10) NULL,
personID CHAR(4) NULL,
CONSTRAINT PK_Incident PRIMARY KEY (incidentID),
CONSTRAINT FK_Responded FOREIGN KEY (responderID) REFERENCES Responder
(responderID),
CONSTRAINT FK_Comment FOREIGN KEY (commenID) REFERENCES Comment
(commenID),
CONSTRAINT FK_Ip_Address FOREIGN KEY (ipID) REFERENCES Ip_Address (ipID),
CONSTRAINT FK_Person FOREIGN KEY (personID) REFERENCES People (personID),
CONSTRAINT CHK_State CHECK (state = 'open' OR state = 'closed' OR state = 'stalled')
);