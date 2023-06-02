CREATE DATABASE bus_reservation;

USE bus_reservation;

CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    FullName VARCHAR(255) NOT NULL,
    SchoolEmail VARCHAR(255) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    SecurityQuestion VARCHAR(255) NOT NULL,
    SecurityAnswer VARCHAR(255) NOT NULL
);

CREATE TABLE Admins (
  AdminID INT PRIMARY KEY AUTO_INCREMENT,
  Username VARCHAR(255) UNIQUE NOT NULL,
  Password VARCHAR(255) NOT NULL
);

CREATE TABLE Routes (
    RouteID INT PRIMARY KEY AUTO_INCREMENT,
    RouteName VARCHAR(255) NOT NULL,
    DepartureTimes JSON NOT NULL
);

CREATE TABLE Reservations (
    ReservationID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT NOT NULL,
    RouteID INT NOT NULL,
    Date DATE NOT NULL,
    TimeOfDeparture TIME NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (RouteID) REFERENCES Routes(RouteID)
);

INSERT INTO Admins (Username, Password) VALUES 
('busreservation@epoka.edu.al', 'Admin01.');
('tiranabus@epoka.edu.al', 'Admin02.');
('durresbus@epoka.edu.al', 'Admin03.');

INSERT INTO Routes (RouteName, DepartureTimes) VALUES 
('Tirana-Campus', '{"Mon-Fri": ["07:40", "08:40", "09:40", "10:40", "11:40", "12:40", "13:40", "14:40", "15:40", "16:40", "17:40"], "Sat": ["08:30"]}'),
('Campus-Tirana', '{"Mon-Fri": ["09:55", "10:55", "11:55", "12:55", "13:55", "14:55", "15:55", "16:55", "18:55", "20:55"], "Sat": ["13:10"]}'),
('Durres-Campus', '{"Mon-Fri": ["08:00", "09:30", "11:00", "13:00", "15:00"]}'),
('Campus-Durres', '{"Mon-Fri": ["10:15", "12:15", "14:15", "15:40", "17:15"]}');