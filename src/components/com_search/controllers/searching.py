import math

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
        
if __name__ == '__main__':
    lat_one = input("Enter latitude one: ")
    lon_one = input("Enter longitude one: ")
    lat_two = input("Enter latitude two: ")
    lon_two = input("Enter longitude one: ")
    print(compute_distance(float(lat_one), float(lon_one),
                           float(lat_two), float(lon_two)))
