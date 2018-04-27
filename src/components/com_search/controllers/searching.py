#!/usr/bin/env python

import sys
import json
import math
import googlemaps

gmaps = googlemaps.Client(key="AIzaSyAjBqK524XM2z1uw_3gU6FW07rFhkD9SpI")

arts_humanities_mjr = ["ballet", "dance", "film", "music", "photography",
                       "theater", "literature", "foreign language", "philosophy"]

business_mjr = ["accounting", "business administration", "finance", "entrepreneurship",
                "marketing", "management"]

health_medicine_mjr = ["human development", "neuroscience", "nursing", "physiology",
                       "psychology", "sport science"]

stem_mjr = ["biochemistry", "bioengineering", "biology", "chemical engineering",
            "microbiology", "chemistry", "computer science", "earth science",
            "material science", "mathematics", "physics", "data analytics",
            "electrical engineering", "computer engineering"]

social_sciences_mjr = ["anthropology", "criminal justice", "human development",
                       "political science", "women's studies", "sociology"]

#########################################################################################

active_hobb = ["fishing", "walking", "exercise", "hunting", "team sports", "golf",
               "bicycling", "hiking", "swimming", "camping", "skiing", "bowling"
               "running", "dancing", "horseback riding", "tennis"]

outdoor_hobb = ["gardening", "traveling", "eating out", "working on cars", "boating",
                "motorcycling", "beach"]

indoor_hobb = ["reading", "watching tv", "family time", "computer", "listening to music",
               "entertaining", "shopping", "sleeping", "sewing", "relaxing", "playing music",
               "housework", "crafts", "watching sports", "playing cards", "cooking",
               "writing", "painting", "theater"]

# calculates the distance between two geographical coordinates
def compute_distance(lat_one, lon_one, lat_two, lon_two):
        earthRadiusMiles = 3959
        
        delta_lat = math.radians(lat_two - lat_one)
        delta_lon = math.radians(lon_two - lon_one)
        
        lat_one = math.radians(lat_one)
        lat_two = math.radians(lat_two)

        a = (pow(math.sin(delta_lat / 2), 2) + pow(math.sin(delta_lon / 2), 2) *
             math.cos(lat_one) * math.cos(lat_two))
        
        c = 2 * math.atan(math.sqrt(a) / math.sqrt(1 - a))
        
        return earthRadiusMiles * c

# calculates the distance between two locations.
# uses the Google Maps API to retrieve geographical information.
# example input (addresses, cities, states, landmarks)
def compute_location_distance(loc_one, loc_two):
        geo_one = gmaps.geocode(loc_one)
        lat_one = geo_one[0]["geometry"]["location"]["lat"]
        lon_one = geo_one[0]["geometry"]["location"]["lng"]

        geo_two = gmaps.geocode(loc_two)
        lat_two = geo_two[0]["geometry"]["location"]["lat"]
        lon_two = geo_two[0]["geometry"]["location"]["lng"]

        return compute_distance(lat_one, lon_one, lat_two, lon_two)

# calculates the hamming distance between
# strings of equal lengths
def hamming_distance(string_one, string_two):
        assert len(string_one) == len(string_two)
        return sum(match_one != match_two for match_one, match_two
                   in zip(string_one, string_two))

# determines the comparability between one user and
# the rest of the users based on their attributes
def user_comparability(u_1, u_2):
        result = []
        scores = {}
        for user in u_2:
            for (k_2, v_2) in user.items():
                for (k_1, v_1) in u_1.items():
                    if (k_1 == "location" and k_2 == "location"):
                            scores["location"] = compare_locations(v_1, v_2)
                    elif (k_1 == "classes" and k_2 == "classes"):
                            scores["classes"] = compare_classes(v_1, v_2)
                    elif (k_1 == "major" and k_2 == "major"):
                            scores["major"] = compare_majors(v_1, v_2)
                    elif (k_1 == "university" and k_2 == "university"):
                            scores["university"] = compare_universities(v_1, v_2)
                    elif (k_1 == "interests" and k_2 == "interests"):
                            scores["interests"] = compare_interests(v_1, v_2)
                    elif (k_1 == "age" and k_2 == "age"):
                            scores["age"] = compare_age(v_1, v_2)
                    elif (k_2 == "alias"):
                            scores["alias"] = v_2
                    elif (k_2 == "name"):
                            scores["name"] = v_2
                    else: continue
            result.append(dict(scores))

        for item in result:
            item["final_score"] = total_scores(item)

        top_three_suggestions = top_three(result)

        return top_three_suggestions

# sums up the scores dictionary
def total_scores(scores):
        total = 0
        for k, v in scores.items():
            if (k != "alias" and k != "name"):
                total += v
        return total

# determines the top three users
def top_three(users):
    max = 3
    if (max < len(users)):
        max = len(users)

    result = []
    sorted(users, key = lambda user: user["final_score"])

    for i in range(0, max):
        user_list = [users[i]["alias"], users[i]["name"]]
        result.append(user_list)

    return result

# determines the comparability between the ages of
# two users. returns a score based on the difference
# in ages. similiarly aged users will result in a better score
def compare_age(a_1, a_2):
        score = 0
        difference = abs(a_2 - a_1)
        
        if (difference < 3):
                score += 0
        elif (difference < 5):
                score += 1
        else:
                score += 2

        #print("Age score = " + str(score))
        
        return score

# general purpose function that determines
# the comparability between the locations
# of two users. returns a score based on the distance.
# closer locations will result in a better score
def compare_locations(loc_one, loc_two):
        score = 0
        loc_weight = 5
        
        distance = compute_location_distance(loc_one, loc_two)

        if (distance < 10):
                score += 0
        elif (distance < 25):
                score += 1
        elif (distance < 50):
                score += 2
        else:
                score += 3

        #print("Loc score = " + str(loc_weight * score))
        
        return loc_weight * score

# determines the comparability between the class schedules of
# two users. assumes parameters in the form
# ["ClassID ClassNumber"] (e.g. ["CptS 421", "CptS 423"])
def compare_classes(classes_one, classes_two):
        score = 0
        
        # convert each course in the lists to lowercase
        classes_one = [c.lower() for c in classes_one]
        classes_two = [c.lower() for c in classes_two]

        for c1 in classes_one:
                # check if taking the same class
                if c1 in classes_two:
                        score += 0
                # check if classID matches
                else:
                        for c2 in classes_two:
                                # parse the class id and class number
                                # output = (["CptS", "423"])
                                # index 0 = classID, index 1 = classNum
                                c_one_list = c1.split(" ")
                                c_two_list = c2.split(" ")

                                # check if class ID matches
                                if (c_one_list[0] == c_two_list[0]):
                                        score += 1
                                else:
                                        score += 2

        #print("Class score = " + str(score))

        return score

# determines the comparability between the majors
# of two users. uses the lists of majors to calculate
# a score.
def compare_majors(maj_one, maj_two):
        score = 0
        major_weight = 3

        # convert parameters to lowercase
        maj_one = maj_one.lower()
        maj_two = maj_two.lower()

        if (maj_one == maj_two):    # same major
                score += 0
        # need to find a more efficient way to do this...
        elif ((maj_one in arts_humanities_mjr and maj_two in arts_humanities_mjr) or
              (maj_one in business_mjr and maj_two in business_mjr) or
              (maj_one in health_medicine_mjr and maj_two in health_medicine_mjr) or
              (maj_one in stem_mjr and maj_two in stem_mjr) or
              (maj_one in social_sciences_mjr and maj_two in social_sciences_mjr)):
                score += 1
        else:
                score += 2

        #print("Major score = " + str(major_weight * score))
        
        return major_weight * score

# determines the comparability between the
# universities of two users. uses the distance
# function to calculate a score.
def compare_universities(uni_one, uni_two):
        score = 0
        uni_weight = 2

        distance = compute_location_distance(uni_one, uni_two)

        if (distance == 0):     # same university
                score += 0
        if (distance < 10):
                score += 1
        elif (distance < 25):
                score += 2
        elif (distance < 50):
                score += 3
        else:
                score += 4

        #print("Uni score = " + str(uni_weight * score))
        
        return uni_weight * score

# determines the comparability between the
# interests of two users. assumes parameters in list form.
# uses the lists of interests to calculate a score.
def compare_interests(inter_one, inter_two):
        score = 0
        interests_weight = 1

        # convert each interest in the lists to lowercase
        inter_one = [i.lower() for i in inter_one]
        inter_two = [i.lower() for i in inter_two]

        for iOne in inter_one:
                # check if the same interest
                if iOne in inter_two:
                        score += 0
                # check for matching categories
                else:
                        for iTwo in inter_two:
                                # check if category matches
                                if ((iOne in active_hobb and iTwo in active_hobb) or
                                    (iOne in outdoor_hobb and iTwo in outdoor_hobb) or
                                    (iOne in indoor_hobb and iTwo in indoor_hobb) or
                                    (iOne in active_hobb and iTwo in outdoor_hobb) or
                                    (iOne in outdoor_hobb and iTwo in active_hobb)):
                                        score += 1
                                else:
                                        score += 2

        #print("Interests score = " + str(score))

        return interests_weight * score
        
if __name__ == '__main__':
    #user_one = {"age": 20,
    #            "location": "Pullman, WA",
    #            "university": "Washington State University",
    #            "major": "Computer Science",
    #            "classes": ["CptS 423", "CptS 451", "CptS 471"],
    #            "interests": ["Hiking", "Fishing", "Camping"]}
    
    #user_two = {"age": 21,
    #            "location": "Moscow, ID",
    #            "university": "University of Idaho",
    #            "major": "Computer Science",
    #            "classes": ["CptS 423", "CptS 223", "Math 216"],
    #            "interests": ["Golf", "Camping", "Fishing"]}

    current_user = json.loads(sys.argv[1])
    everyone_else = json.loads(sys.argv[2])

    print (json.dumps(user_comparability(current_user, everyone_else)))
