--------------------------------------------------------

ALTER TABLE '#__sessions' ADD 'academictype' varchar(255);
ALTER TABLE '#__sessions' ADD 'corporatetype' varchar(255);

ALTER TABLE '#__people_people' ADD 'academictype' varchar(255);
ALTER TABLE '#__people_people' ADD 'corporatetype' varchar(255);
