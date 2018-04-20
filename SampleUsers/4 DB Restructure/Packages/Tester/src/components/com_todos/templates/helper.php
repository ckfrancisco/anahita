<?php

/**
 * Template Helper.
 *
 * @category	Anahita
 */
class ComTesterTemplateHelper extends LibBaseTemplateHelperAbstract
{
    /**
     * Return a priority label.
     *
     * @param  ComTesterDomainEntityTester
     *
     * @return string
     */
    public function priorityLabel($tester)
    {
        switch (true) {
            case $tester->priority > 1:
                $label = 'highest';
                break;
            case $tester->priority == 1:
                $label = 'high';
                break;
            case $tester->priority == -1:
                $label = 'low';
                break;
            case $tester->priority < -1:
                $label = 'lowest';
                break;
            default:
                $label = 'normal';
                break;
        }

        return $label;
    }

    /**
     * Tester item priority list.
     *
     * @param string $selected priority constant
     *
     * @return string html priority list options
     */
    public function prioritylist($selected = null)
    {
        $html = $this->_template->getHelper('html');

        if (!$selected) {
            $selected = ComTesterDomainEntityTester::PRIORITY_NORMAL;
        }

        $options = array(
            array(ComTesterDomainEntityTester::PRIORITY_HIGHEST,    AnTranslator::_('COM-TESTER-TESTER-PRIORITY-HIGHEST')),
            array(ComTesterDomainEntityTester::PRIORITY_HIGH,        AnTranslator::_('COM-TESTER-TESTER-PRIORITY-HIGH')),
            array(ComTesterDomainEntityTester::PRIORITY_NORMAL,    AnTranslator::_('COM-TESTER-TESTER-PRIORITY-NORMAL')),
            array(ComTesterDomainEntityTester::PRIORITY_LOW,        AnTranslator::_('COM-TESTER-TESTER-PRIORITY-LOW')),
            array(ComTesterDomainEntityTester::PRIORITY_LOWEST,    AnTranslator::_('COM-TESTER-TESTER-PRIORITY-LOWEST')),
        );

        return $html->select('priority', array('options' => $options, 'selected' => $selected))->class('input-medium')->id('tester-priority');
    }
}
