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

def generateSelenium():
    #nFile = open("RandomUsers.csv","r")
    sFile = open("seleniumInput","w")
    sFile.write('<?xml version="1.0" encoding="UTF-8"?>\n')
    sFile.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">\n')
    sFile.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">\n')
    sFile.write('<head profile="http://selenium-ide.openqa.org/profiles/test-case">\n')
    sFile.write('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\n')
    sFile.write('<link rel="selenium.base" href="http://localhost:8000/" />\n')
    sFile.write('<title>insertUsersSelenium</title>\n')
    sFile.write('</head>\n')
    sFile.write('<body>\n')
    sFile.write('<table cellpadding="1" cellspacing="1" border="1">\n')
    sFile.write('<thead>\n')
    sFile.write('<tr><td rowspan="1" colspan="3">insertUsersSeleniumTest2</td></tr>\n')
    sFile.write('</thead><tbody>\n')

    sFile.write('<tr>\n')
    sFile.write('<td>open</td>\n')
    sFile.write('<td>/</td>\n')
    sFile.write('<td></td>\n')
    sFile.write('</tr>\n')

    sFile.write('<tr>\n')
    sFile.write('<td>click</td>\n')
    sFile.write('<td>xpath=(//button[@type="button"])[2]</td>\n')
    sFile.write('<td></td>\n')
    sFile.write('</tr>\n')

    sFile.write('<tr>\n')
    sFile.write('<td>clickAndWait</td>\n')
    sFile.write('<td>css=li &gt; a</td>\n')
    sFile.write('<td></td>\n')
    sFile.write('</tr>\n')

    sFile.write('<tr>\n')
    sFile.write('<td>clickAndWait</td>\n')
    sFile.write('<td>link=Sign up</td>\n')
    sFile.write('<td></td>\n')
    sFile.write('</tr>\n')

    firstLine = True
    with open("RandomUsers.csv", 'r') as f:
        for line in f:
            if(firstLine == False):
                #print(line)
                spLine = line.replace(",","")
                #print(spLine)

                spLine = spLine.split("  ")
                dataCounter = 0
                for uData in spLine: #there are 5 items in spLine
                    uData = uData.replace(" ","")
                    sFile.write('<tr>\n')
                    sFile.write('<td>type</td>\n')
                    if(dataCounter == 0):
                        sFile.write('<td>id=person-given-name</td>\n')
                    elif(dataCounter == 1):
                        sFile.write('<td>id=person-family-name</td>\n')
                    elif(dataCounter == 2):
                        sFile.write('<td>id=person-username</td>\n')
                    elif(dataCounter == 3):
                        sFile.write('<td>id=person-email</td>\n')
                    elif(dataCounter == 4):
                        sFile.write('<td>id=person-password</td>\n')
                    dataCounter = dataCounter + 1
                    sFile.write('<td>'+uData+'</td>\n')
                    sFile.write('</tr>\n')

                sFile.write('<tr>\n')
                sFile.write('<td>clickAndWait</td>\n')
                sFile.write('<td>//button[@type="submit"]</td>\n')
                sFile.write('<td></td>\n')
                sFile.write('</tr>\n')

                sFile.write('<tr>\n')
                sFile.write('<td>clickAndWait</td>\n')
                sFile.write('<td>link=Sign up</td>\n')
                sFile.write('<td></td>\n')
                sFile.write('</tr>\n')
            else:
                firstLine = False

    sFile.write('</tbody></table>\n')
    sFile.write('</body>\n') 
    sFile.write('</html>\n')
        
def run():
    names = getNames()
    #printNames(names)
    generateCsv(names)
    generateSelenium()
        
    
