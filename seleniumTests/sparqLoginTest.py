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
        #TODO mention in meeting, whoever has the css template code, add a title field to the main page if we can

    def testInvalidLogin(self):
        self.broswer.get('https://localhost:8000')
        #todo replace 'Anahita' with 'Sparq' when on merged project
        self.assertIn('Anahita',self.browser.title) #make sure we're at the right page
        
        self.broswer.find_element_by_css_selector('div.btn .btn-primary').click()
        inputElement = browser.find_element_by_id("person-username")
        inputElement.send_keys('Foo')
        inputElement = browser.find_element_by_id("person-password")
        inputElement.send_keys('Foo')
        inputElement.send_keys(Keys.ENTER)
        #check title to ensure that login failed
        element = browser.find_element_by_css_selector(div.alert alert-error alert-block close)
        self.assertIn('find an account that matched the username and password that you have entered',element.p) #make sure we're at the right page
        
if __name__ == '__main__':
    unittest.main(verbosity=2)
        
