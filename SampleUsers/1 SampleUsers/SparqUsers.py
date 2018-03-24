#Sparq Test Users
import csv


#Create real sounding users
#commit stuff to christians repo

def basicOut():
    filename = "SparqUsers.txt"
    file = open(filename, "w")
    i = 0
    file.write("firstName, lastName, username, email, password, \n")
    while(i < 200):
        file.write("User"+str(i)+", "+"lastname"+str(i)+", "+"username"+str(i)+", "+"email"+str(i)+"@mail.com, "+ "password, \n")
        i = i + 1
    file.close()


def csvOut():
    with open('SparqUsers.csv', 'w') as csvfile:
        susers = csv.writer(csvfile, delimiter=',',quotechar='|', quoting=csv.QUOTE_MINIMAL)
        i = 0
        while(i < 200):
            tempstr = "User"+str(i)+", "+"lastname"+str(i)+", "+"username"+str(i)+", "+"email"+str(i)+"@mail.com, "+ "password, "
            susers.writerow([tempstr])
            i = i + 1
