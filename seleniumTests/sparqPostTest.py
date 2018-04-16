import unittest
from selenium import webdriver
from selenium.common.exceptions import NoSuchElementException
from time import sleep

class SparqLoginTestCase(unittest.TestCase):
    
    def setUp(self):
        self.browser = webdriver.Firefox()
        self.addCleanup(self.browser.quit)

    def testValidNotePost(self):
        self.browser.get('http://localhost:8000')
        #todo replace 'Anahita' with 'Sparq' when on merged project
        self.assertIn('Anahita',self.browser.title) #make sure we're at the right page
        self.browser.find_element_by_xpath('.//*[@id=\'desktop-main-menu\']/span/a').click()
        inputElement = self.browser.find_element_by_id("person-username")
        inputElement.send_keys('PeterQafoku')
        inputElement = self.browser.find_element_by_id("person-password")
        inputElement.send_keys('password')
        self.browser.find_element_by_xpath('.//*[@id=\'person-form\']/div/button').click()
        #check title to ensure that login was successful
        self.assertIn('Share',self.browser.find_element_by_xpath('.//*[@id=\'com-composer-container\']/div[2]/div[1]/a').get_attribute('text')) #make sure we're at the right page
        #finished login, now find note and click
        sleep(2) #sleep for 2 seconds, let page load
        dropdown = self.browser.find_element_by_xpath('.//*[@id=\'com-composer-container\']/div[1]/div')
        dropdown.click()
        dropdownOption = self.browser.find_element_by_xpath('.//*[@id=\'composer-menu\']/li[1]/a')
        dropdownOption.click()
        
        #set the text of the post and submit it
        textBox = self.browser.find_element_by_xpath('.//*[@id=\'note-body\']')
        textBox.send_keys('this is a post')
        self.browser.find_element_by_xpath('.//*[@id=\'com-composer-container\']/div[2]/div[1]/form/div[2]/button').click()
        #ensure that the post was made
        text = self.browser.find_element_by_xpath('.//*[@id=\'an-stories\']/div/div/div/div[2]').text
        self.assertIn('this is a post',text)
        #delete the post
        sleep(2) #sleep for 2 seconds, let page load
        self.browser.find_element_by_xpath('.//*[@id=\'an-stories\']/div/div/div/div[4]/ul/li[3]/a').click()
        sleep(1) #sleep for 1 seconds, let page load
        self.browser.find_element_by_xpath('.//*[@id=\'an-modal\']/div[3]/button').click()
        #ensure we are at the correct page
        self.assertIn('Share',self.browser.find_element_by_xpath('.//*[@id=\'com-composer-container\']/div[2]/div[1]/a').get_attribute('text')) #make sure we're at the right page

    def testInvalidNotePost(self):
        self.browser.get('http://localhost:8000')
        #todo replace 'Anahita' with 'Sparq' when on merged project
        self.assertIn('Anahita',self.browser.title) #make sure we're at the right page
        self.browser.find_element_by_xpath('.//*[@id=\'desktop-main-menu\']/span/a').click()
        inputElement = self.browser.find_element_by_id("person-username")
        inputElement.send_keys('PeterQafoku')
        inputElement = self.browser.find_element_by_id("person-password")
        inputElement.send_keys('password')
        self.browser.find_element_by_xpath('.//*[@id=\'person-form\']/div/button').click()
        #check title to ensure that login was successful
        self.assertIn('Share',self.browser.find_element_by_xpath('.//*[@id=\'com-composer-container\']/div[2]/div[1]/a').get_attribute('text')) #make sure we're at the right page
        #finished login, now find note and click
        sleep(2) #sleep for 2 seconds, let page load
        dropdown = self.browser.find_element_by_xpath('.//*[@id=\'com-composer-container\']/div[1]/div')
        dropdown.click()
        dropdownOption = self.browser.find_element_by_xpath('.//*[@id=\'composer-menu\']/li[1]/a')
        dropdownOption.click()
        
        #submit without setting the text
        self.browser.find_element_by_xpath('.//*[@id=\'com-composer-container\']/div[2]/div[1]/form/div[2]/button').click()
        #try to delete a story
        try:
            self.browser.find_element_by_xpath('.//*[@id=\'an-stories\']/div/div/div/div[4]/ul/li[3]/a').click()
            sleep(1) #sleep for 1 seconds, let page load
            self.browser.find_element_by_xpath('.//*[@id=\'an-modal\']/div[3]/button').click()
        except NoSuchElementException:
            print("\nCaught NoSuchElementException\n")

if __name__ == '__main__':
    unittest.main(verbosity=2)
        
        
