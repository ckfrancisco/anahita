import math
import googlemaps

gmaps = googlemaps.Client(key="AIzaSyAjBqK524XM2z1uw_3gU6FW07rFhkD9SpI")

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

# calculates the distance between two cities
def compute_city_distance(city_one, city_two):
        geo_one = gmaps.geocode(city_one)
        lat_one = geo_one[0]["geometry"]["location"]["lat"]
        lon_one = geo_one[0]["geometry"]["location"]["lng"]

        geo_two = gmaps.geocode(city_two)
        lat_two = geo_two[0]["geometry"]["location"]["lat"]
        lon_two = geo_two[0]["geometry"]["location"]["lng"]

        print("Distance between " + city_one + " and " + city_two +
              " is " + str(compute_distance(lat_one, lon_one, lat_two, lon_two)) +
              " miles!")

# calculates the hamming distance between
# strings of equal lengths
def hamming_distance(string_one, string_two):
        assert len(string_one) == len(string_two)
        return sum(match_one != match_two for match_one, match_two
                   in zip(string_one, string_two))
        
if __name__ == '__main__':
    loc_one = input("Enter location one: ")
    loc_two = input("Enter location two: ")
    compute_city_distance(loc_one, loc_two)
    
    print(hamming_distance("banana", "bonono"))
