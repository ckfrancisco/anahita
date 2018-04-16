import unittest
from selenium import webdriver

class SparqLoginTestCase(unittest.TestCase):
    
    def setUp(self):
        self.browser = webdriver.Firefox()
        self.addCleanup(self.browser.quit)

    def testValidLogin(self):
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
##        #TODO mention in meeting, whoever has the css template code, add a title field to the main page if we can
##

    def testInvalidLogin(self):
            self.browser.get('http://localhost:8000')
            #todo replace 'Anahita' with 'Sparq' when on merged project
            self.assertIn('Anahita',self.browser.title) #make sure we're at the right page
            self.browser.find_element_by_xpath('.//*[@id=\'desktop-main-menu\']/span/a').click()
            inputElement = self.browser.find_element_by_id("person-username")
            inputElement.send_keys('foo')
            inputElement = self.browser.find_element_by_id("person-password")
            inputElement.send_keys('foofoo')
            self.browser.find_element_by_xpath('.//*[@id=\'person-form\']/div/button').click()
            #check title to ensure that login failed
            element = self.browser.find_element_by_xpath('.//*[@id=\'container-system-message\']/div')
            self.assertIn('find an account that matched the username and password that you have entered',element.text)
            
if __name__ == '__main__':
    unittest.main(verbosity=2)
        
