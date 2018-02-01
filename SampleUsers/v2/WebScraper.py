import csv
import urllib
import random
#from bs4 import BeautifulSoup

scrapePage = 'https://www.randomlists.com/random-names'
fields = "firstName, lastName, username, email, password, \n"

def getNames():
    file = open("names","r")
    names = []
    for r in file:
        line = ((file.readline()).rstrip())
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
    

def run():
    names = getNames()
    printNames(names)
    
        
    
