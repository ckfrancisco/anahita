#!/bin/bash

#mysql DUMP -- to compare users.. into text files and command line diff file1 file2
function goToDir()
{
	#From Desktop (default location if run from desktop)
	echo $PWD
	cd anahita-jerdon
	echo $PWD
	cd www
	echo $PWD

}

function runLocal()
{
	xdg-open localhost:8000
	php -S localhost:8000
	
}

function getUsers()
{
	echo "get the users okay"

}


function insertToDB()

	#option 1
	INSERT INTO anahita(people_person_id, node_id, email, username, password, usertype, gender, given_name, family_name,network_presence, last_visit_date, time_zone, language, activation_code)VALUES(3,4,'email@email.com','NAME22','ARGAEQ$agfaerasr$GAR','registered','NULL','NAME2','NAME2',0,1000-01-01 00:00:00,NULL,NULL,'6afjsndahg43rjjgs$$$oehg3urb3FDAGAER');
	#opetion 2
	INSERT INTO an_people_people(people_person_id, node_id, email, username, password, usertype, gender, given_name, family_name,network_presence, last_visit_date, time_zone, language, activation_code)VALUES(3,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL);
}



function main()
{
	goToDir
	runLocal
	getUsers
}

main