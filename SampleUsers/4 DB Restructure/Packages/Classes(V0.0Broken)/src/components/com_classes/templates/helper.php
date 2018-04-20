<?php

/**
 * Template Helper.
 *
 * @category	Anahita
 */
class ComClassesTemplateHelper extends LibBaseTemplateHelperAbstract
{
    /**
     * Return a priority label.
     *
     * @param  ComClassesDomainEntityClass
     *
     * @return string
     */
    public function priorityLabel($class)
    {
        switch (true) {
            case $class->priority > 1:
                $label = 'highest';
                break;
            case $class->priority == 1:
                $label = 'high';
                break;
            case $class->priority == -1:
                $label = 'low';
                break;
            case $class->priority < -1:
                $label = 'lowest';
                break;
            default:
                $label = 'normal';
                break;
        }

        return $label;
    }

    /**
     * Class item priority list.
     *
     * @param string $selected priority constant
     *
     * @return string html priority list options
     */
    public function prioritylist($selected = null)
    {
        $html = $this->_template->getHelper('html');

        if (!$selected) {
            $selected = ComClassesDomainEntityClass::PRIORITY_NORMAL;
        }

        $options = array(
            array(ComClassesDomainEntityClass::PRIORITY_HIGHEST,    AnTranslator::_('COM-CLASSES-CLASS-PRIORITY-HIGHEST')),
            array(ComClassesDomainEntityClass::PRIORITY_HIGH,        AnTranslator::_('COM-CLASSES-CLASS-PRIORITY-HIGH')),
            array(ComClassesDomainEntityClass::PRIORITY_NORMAL,    AnTranslator::_('COM-CLASSES-CLASS-PRIORITY-NORMAL')),
            array(ComClassesDomainEntityClass::PRIORITY_LOW,        AnTranslator::_('COM-CLASSES-CLASS-PRIORITY-LOW')),
            array(ComClassesDomainEntityClass::PRIORITY_LOWEST,    AnTranslator::_('COM-CLASSES-CLASS-PRIORITY-LOWEST')),
        );

        return $html->select('priority', array('options' => $options, 'selected' => $selected))->class('input-medium')->id('class-priority');
    }
}
