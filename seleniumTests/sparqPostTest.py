import unittest
from selenium import webdriver

class SparqLoginTestCase(unittest.TestCase):
    
    def setUp(self):
        self.browser = webdriver.Firefox()
        self.addCleanup(self.browser.quit)

    def testValidLogin(self):
        self.broswer.get('https://localhost:8000')
        #todo replace 'Anahita' with 'Sparq' when on merged project
        self.assertIn('Anahita',self.browser.title) #make sure we're at the right page

        #things to try if this doesnt work:
        #1. remove div.
        #2. remove space
        self.broswer.find_element_by_css_selector('div.btn .btn-primary').click()
        inputElement = browser.find_element_by_id("person-username")
        inputElement.send_keys('PeterQafoku')
        inputElement = browser.find_element_by_id("person-password")
        inputElement.send_keys('Password')
        inputElement.send_keys(Keys.ENTER)
        #check title to ensure that login was successful
        self.assertIn('SparqTitle',self.browser.title) #make sure we're at the right page
        #now click on box, and make a post. default should be story post
        self.broswer.find_element_by_css_selector('form-placeholder').click()
        inputElement = browser.find_element_by_id("note-body")
        inputElement.send_keys('This is a post')
        self.broswer.find_element_by_css_selector('div.btn btn-primary pull-right').click()
        #manually check UI to see if post is made? not sure of a better way ATM

if __name__ == '__main__':
    unittest.main(verbosity=2)
        
        
