<?php

/**
 * Template Helper.
 *
 * @category	Anahita
 */
class ComInterestsTemplateHelper extends LibBaseTemplateHelperAbstract
{
    /**
     * Return a priority label.
     *
     * @param  ComInterestsDomainEntityInterests
     *
     * @return string
     */
    public function priorityLabel($interests)
    {
        switch (true) {
            case $interests->priority > 1:
                $label = 'highest';
                break;
            case $interests->priority == 1:
                $label = 'high';
                break;
            case $interests->priority == -1:
                $label = 'low';
                break;
            case $interests->priority < -1:
                $label = 'lowest';
                break;
            default:
                $label = 'normal';
                break;
        }

        return $label;
    }

    /**
     * Interests item priority list.
     *
     * @param string $selected priority constant
     *
     * @return string html priority list options
     */
    public function prioritylist($selected = null)
    {
        $html = $this->_template->getHelper('html');

        if (!$selected) {
            $selected = ComInterestsDomainEntityInterests::PRIORITY_NORMAL;
        }

        $options = array(
            array(ComInterestsDomainEntityInterests::PRIORITY_HIGHEST,    AnTranslator::_('COM-INTERESTS-INTERESTS-PRIORITY-HIGHEST')),
            array(ComInterestsDomainEntityInterests::PRIORITY_HIGH,        AnTranslator::_('COM-INTERESTS-INTERESTS-PRIORITY-HIGH')),
            array(ComInterestsDomainEntityInterests::PRIORITY_NORMAL,    AnTranslator::_('COM-INTERESTS-INTERESTS-PRIORITY-NORMAL')),
            array(ComInterestsDomainEntityInterests::PRIORITY_LOW,        AnTranslator::_('COM-INTERESTS-INTERESTS-PRIORITY-LOW')),
            array(ComInterestsDomainEntityInterests::PRIORITY_LOWEST,    AnTranslator::_('COM-INTERESTS-INTERESTS-PRIORITY-LOWEST')),
        );

        return $html->select('priority', array('options' => $options, 'selected' => $selected))->class('input-medium')->id('interests-priority');
    }
}
