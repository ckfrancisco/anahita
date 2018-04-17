Sparq

-- Team Mercury --
William Boston, Christian Francisco, 
Jerdon Helgeson, Alexander Lao, Peter Qafoku

searching.py documentation

Last Updated: 4/16/2018

-- Overview --
The searching algorithm works by comparing various attributes between two users. Each attribute is compared and given a weighted score. At the end, these scores are totaled up, and the closer the score is to zero, the more similar the two users are.

The current criteria being compared from the highest weight to the lowest weight are:
1. Location
2. Classes
3. Major
4. University
5. Interests
6. Age

-- Individual Functions --

=======================================

compute_distance(lat_one, lon_one, lat_two, lon_two):

Calculates the distance in miles between two geographical coordinates using a mathematical equation.

Parameters -	lat_one (Float): The latitude of the first coordinate.
		lon_one (Float): The longitude of the first coordinate.
		lat_two (Float): The latitude of the second coordinate.
		lon_two (Float): The longitude of the second coordinate.

Example Input -	(46.7298, 117.1817, 46.7324, 117.0002)

Returns - Float representing the distance in miles between the two coordinates.

=======================================

compute_location_distance(loc_one, loc_two):

Calculates the distance in miles between two locations. Uses the Google Maps API to retrieve the geographical coordinates of the two locations. Passes those coordinates to the compute_distance function to calculate the distance.

Parameters -	loc_one (String): The first location to compare.
		loc_two (String): The second location to compare.

Example Input -	("Pullman, WA", "Moscow, ID") or 
		("Washington State University", "University of Idaho")

Returns - Float representing the distance in miles between the two locations.

=======================================

hamming_distance(string_one, string_two):

Determines the Hamming distance between two strings of equal lengths. The Hamming distance is the number of differing characters between two strings.

Parameters -	string_one (string): The first string to compare.
		string_two (string): The second string to compare.

Precondition -	Strings must be of equal length.

Example Input - ("Cat", "Dog")

Returns - Integer representing the number of differing characters between the two strings.

=======================================

user_comparability(u_1, u_2):

Determines the comparability between a single user and a list of other users and returns the top three compatible users with respect to the single user. Builds up a dictionary for the scores of each attribute compared. Calls individual functions that compares specific attributes. Totals the score for each user using the total_scores function. Determines the top three users using the top_three function.

Parameters -	u_1 (Dictionary {string : varies}): Represents the user of interest.
		u_2 (List of Dictionaries {string : varies}): Represents the users being compared to the user of interest.

Example Input -	(user_one, users) where
		user_one = 
		{"age": 20,
                "location": "Pullman, WA",
                "university": "Washington State University",
                "major": "Computer Science",
                "classes": ["CptS 423", "CptS 451", "CptS 471"],
                "interests": ["Hiking", "Fishing", "Camping"]}
    
    		users = [
		{"age": 21,
                "location": "Moscow, ID",
                "university": "University of Idaho",
                "major": "Computer Science",
                "classes": ["CptS 423", "CptS 223", "Math 216"],
                "interests": ["Golf", "Camping", "Fishing"]},
		{"age": 23,
                "location": "Spokane, WA",
                "university": "Gonzaga University",
                "major": "Electical Engineering",
                "classes": ["EE 125", "EE 225", "EE 300"],
                "interests": ["Tennis", "Watching TV", "Beach"]}
 		]

Precondition - Keys and values must follow the same conventions.

Returns - List of lists with each sub-list representing one of the top three comparable users.

=======================================

total_scores(scores):

Sums up the scores in the dictionary.

Parameter - scores (Dictionary {string : int}): The dictionary of scores.

Example Input - ({"location": 3, "classes": 2, "major": 1, "university": 5})

Returns - Integer representing the total score.

=======================================

top_three(users):

Determines the top three users for a given user based on the final_score key calculated using the total_scores function.

Parameter - users (List of Dictionaries {string : varies}): The list of all users being compared.

Example Input - ([
		{"age": 21,
                "location": "Moscow, ID",
                "university": "University of Idaho",
                "major": "Computer Science",
                "classes": ["CptS 423", "CptS 223", "Math 216"],
                "interests": ["Golf", "Camping", "Fishing"],
		"final_score": 100},
		{"age": 23,
                "location": "Spokane, WA",
                "university": "Gonzaga University",
                "major": "Electical Engineering",
                "classes": ["EE 125", "EE 225", "EE 300"],
                "interests": ["Tennis", "Watching TV", "Beach"],
		"final_score": 150}
 		])

Returns - A list of the top three users.

=======================================

compare_age(a_1, a_2):

Compares the ages between two users and returns an age score. The age score is calculated by evaluating the difference in ages.

Parameters -	a_1 (int): The first age to compare.
		a_2 (int): The second age to compare.

Example Input -	(21, 22)

Returns - Integer representing the age score.

=======================================

compare_locations(loc_one, loc_two):

Compares the locations between two users and returns a weighted location score. The location score is calculated by evaluating the distance between the two locations. Uses the compute_location_distance to calculate the distance.

Parameters -	loc_one (string): The first location to compare.
		loc_two (string): The second location to compare.

Example Input -	("Pullman, WA", "Moscow, ID") or 
		("Washington State University", "University of Idaho")

Returns - Integer representing the location score.

=======================================

compare_classes(classes_one, classes_two):

Compares the classes between two users and returns a weighted classes score. The classes score is calculated by evaluating the class prefix ("CptS") and then the class number ("423").

Parameters - 	classes_one (List [string]): The list of classes for the first user.
		classes_two (List [string]): The list of classes for the second user.

Example Input - (["CptS 423", "CptS 451", "CptS 471"], 
		 [CptS 423", "CptS 223", "Math 216"])

Returns - Integer representing the classes score.

=======================================

compare_majors(maj_one, maj_two):

Compares the majors between two users and returns a weighted major score. The major score is calculated by checking if the passed-in majors exist in the same pre-determined major lists declared at the top of the file (arts_humanities_mjr, business_mjr, health_medicine_mjr, stem_mjr, social_sciences_mjr).

Parameters -	maj_one (string): The first major to compare.
		maj_two (string): The second major to compare.

Example Input - ("Computer Science", "Electrical Engineering")

Returns - Integer representing the major score.

=======================================

compare_universities(uni_one, uni_two):

Compares the universities between the two users and returns a weighted university score. The university score is calculated by evaluating the distance between the two universities using the compute_location_distance function.

Parameters - 	uni_one (string): The first university to compare.
		uni_two (string): The second university to compare.

Example Input - ("Washington State University", "University of Idaho")

Returns - Integer representing the university score.

=======================================

compare_interests(inter_one, inter_two):

Compares the interests between the two users and returns a weighted interests score. The interests score is calculated by checking if the interests exist in the same pre-determined interest lists declared at the top of the file (active_hobb, outdoor_hobb, indoor_hobb).

Parameters -	inter_one (List [string]): The list of interests for the first user.
		inter_two (List [string]): The list of interests for the second user.

Example Input -	(["Hiking", "Fishing", "Camping"], ["Golf", "Camping", "Fishing"])

Returns - Integer representing the interests score.

=======================================

-- Improvments/Problems --
The compare_classes function will run into issues when the classes being compared are from different universities since each university has their own way to catalog their classes. For example, computer science might have the prefix "CptS" at one university, but it might be "CS" at another university. Additionally, the class number might differ at different universities, but it may actually represent the same class. For example the introductory data structures class might be "CptS 122" at one university, but "CptS 100" at another university.

The compare_majors and compare_interests functions need a more elegant solution than just checking against hard-coded lists. It will obviously run into issues if a major or interest does not exist in their respective lists.
