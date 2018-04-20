import csv
import urllib
import random
#from bs4 import BeautifulSoup

#TODO:
#find & use test harness tool to auto input users into the database through the onboarding interface
#Look into removal of users as well

scrapePage = 'https://www.randomlists.com/random-names'
fields = "firstName, lastName, username, email, password, \n"

def getNames():
    file = open("names","r")
    names = []
    for line in file.readlines():
        line = line.rstrip()
        spLine = line.split()
        names.append(spLine[0])
        names.append(spLine[1])
    file.close()
    return names

def printNames(names):
    for n in names:
        print(n)

def generateCsv(names):
    #it would be faster to just walk through names and write to the csv as I do it instead of making users and writing that to the csv
    with open('RandomUsers.csv','w') as csvfile:
        rusers = csv.writer(csvfile, delimiter=',',quoting = csv.QUOTE_NONE, escapechar=' ')
        rusers.writerow(["firstName, lastName, username, email, password, "])
        num = int(input("how many users? "))
        while(num > 0):
            n1 = names[int(random.uniform(0,400))]
            n2 = names[int(random.uniform(0,400))]
            #there are lots of possibilities for usernames and email addresses... for now I will just append names together and use that 
            tempstr = n1 + ", "+n2 +", "+ n1+n2 + ", " + n1+n2+"@email.com, password,"
            rusers.writerow([tempstr])
            num = num - 1
    csvfile.close()
            
        
def run():
    names = getNames()
    #printNames(names)
    generateCsv(names)
        
    
