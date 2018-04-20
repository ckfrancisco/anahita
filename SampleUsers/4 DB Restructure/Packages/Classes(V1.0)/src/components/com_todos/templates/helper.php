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
     * @param  ComClassesDomainEntityClasses
     *
     * @return string
     */
    public function priorityLabel($classes)
    {
        switch (true) {
            case $classes->priority > 1:
                $label = 'highest';
                break;
            case $classes->priority == 1:
                $label = 'high';
                break;
            case $classes->priority == -1:
                $label = 'low';
                break;
            case $classes->priority < -1:
                $label = 'lowest';
                break;
            default:
                $label = 'normal';
                break;
        }

        return $label;
    }

    /**
     * Classes item priority list.
     *
     * @param string $selected priority constant
     *
     * @return string html priority list options
     */
    public function prioritylist($selected = null)
    {
        $html = $this->_template->getHelper('html');

        if (!$selected) {
            $selected = ComClassesDomainEntityClasses::PRIORITY_NORMAL;
        }

        $options = array(
            array(ComClassesDomainEntityClasses::PRIORITY_HIGHEST,    AnTranslator::_('COM-CLASSES-CLASSES-PRIORITY-HIGHEST')),
            array(ComClassesDomainEntityClasses::PRIORITY_HIGH,        AnTranslator::_('COM-CLASSES-CLASSES-PRIORITY-HIGH')),
            array(ComClassesDomainEntityClasses::PRIORITY_NORMAL,    AnTranslator::_('COM-CLASSES-CLASSES-PRIORITY-NORMAL')),
            array(ComClassesDomainEntityClasses::PRIORITY_LOW,        AnTranslator::_('COM-CLASSES-CLASSES-PRIORITY-LOW')),
            array(ComClassesDomainEntityClasses::PRIORITY_LOWEST,    AnTranslator::_('COM-CLASSES-CLASSES-PRIORITY-LOWEST')),
        );

        return $html->select('priority', array('options' => $options, 'selected' => $selected))->class('input-medium')->id('classes-priority');
    }
}
