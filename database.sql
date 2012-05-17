CREATE TABLE calendars (
  `name` varchar(255) NOT NULL,
  description varchar(255) NOT NULL,
  owner_id int(11) NOT NULL,
  url varchar(32) NOT NULL,
  id int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (id)
);

CREATE TABLE `events` (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  event_date datetime NOT NULL,
  calendar_id int(11) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY event_date (event_date)
);

CREATE TABLE owners (
  `name` varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  username varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  id int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (id)
);
