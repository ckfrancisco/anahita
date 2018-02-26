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

# calculates the distance between two geopraphical coordinates
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

# calculates the distance between two locations
# uses the Google Maps API to retrieve geographical information
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

# determines the comparability between two users
# based on their attributes
def user_comparability(u_1, u_2):
        scores = {}
        for (k_1, v_1), (k_2, v_2) in zip (u_1.items(), u_2.items()):
                if (k_1 == "city" and k_2 == "city"):
                        scores["city"] = compare_locations(v_1, v_2)
                elif (k_1 == "major" and k_2 == "major"):
                        scores["major"] = compare_majors(v_1, v_2)
                elif (k_1 == "university" and k_2 == "university"):
                        scores["university"] = compare_universities(v_1, v_2)
                elif (k_1 == "age" and k_2 == "age"):
                        scores["age"] = compare_age(v_1, v_2)

        return total_scores(scores)

# sums up the scores dictionary
def total_scores(scores):
        total = 0
        for k, v in scores.items():
                total += v
        return total 

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

        print("Age score = " + str(score))
        
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

        print("Loc score = " + str(score))
        
        return loc_weight * score

# determines the comparability between the classes
# of two users.
def compare_classes(class_one, class_two):
        score = 0
        classes_weight = 4

        if (class_one == class_two):    # same class
                score += 0

        return classes_weight * score

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

        print("Major score = " + str(score))
        
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

        print("Uni score = " + str(score))
        
        return uni_weight * score

# determines the comparability between the
# interests of two users.
def compare_interests(inter_one, inter_two):
        score = 0
        interests_weight = 1

        print("Interests score = " + str(score))

        return interests_weight * score
        
if __name__ == '__main__':
    user_one = {"age": 20, "city": "Pullman",
                "university": "Washington State University",
                "major": "Computer Science"}
    user_two = {"age": 21, "city": "Moscow",
                "university": "University of Idaho",
                "major": "Electrical Engineering"}

    print("Score = " + str(user_comparability(user_one, user_two)))
