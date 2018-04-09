<?php

class ComJobsTemplateHelper extends LibBaseTemplateHelperAbstract
{
    public function selectemployment($options = array(), $preselected = null)
    {
        $viewer = get_viewer();
        $options = new KConfig($options);

        if(!$preselected)
        {
            $preselected = AnTranslator::_('COM-JOBS-EMPLOYMENT-SELECT');
        }

        $options->append(array(
            'id' => 'job-employment',
            'selected' => $preselected,
            'name' => 'employment',
        ));

        $selected = $options->selected;

        unset($options->selected);

        $employmenttypes = array(
            "" => AnTranslator::_('COM-JOBS-EMPLOYMENT-SELECT'),
            AnTranslator::_('COM-JOBS-EMPLOYMENT-FULLTIME') => AnTranslator::_('COM-JOBS-EMPLOYMENT-FULLTIME'),
            AnTranslator::_('COM-JOBS-EMPLOYMENT-PARTIME') => AnTranslator::_('COM-JOBS-EMPLOYMENT-PARTIME'),
            AnTranslator::_('COM-JOBS-EMPLOYMENT-INTERNSHIP') => AnTranslator::_('COM-JOBS-EMPLOYMENT-INTERNSHIP'),
            AnTranslator::_('COM-JOBS-EMPLOYMENT-COOP') => AnTranslator::_('COM-JOBS-EMPLOYMENT-COOP'),
            AnTranslator::_('COM-JOBS-EMPLOYMENT-CONSULTING') => AnTranslator::_('COM-JOBS-EMPLOYMENT-CONSULTING'),
            AnTranslator::_('COM-JOBS-EMPLOYMENT-CONTRACTING') => AnTranslator::_('COM-JOBS-EMPLOYMENT-CONTRACTING'),
        );

        $html = $this->getService('com:base.template.helper.html');

        return $html->select($options->name, array('options' => $employmenttypes, 'selected' => $preselected), KConfig::unbox($options));
    }
    public function selectvisa($options = array(), $preselected = null)
    {
        $viewer = get_viewer();
        $options = new KConfig($options);

        if(!$preselected)
        {
            $preselected = AnTranslator::_('COM-JOBS-VISA-SELECT');
        }

        $options->append(array(
            'id' => 'job-visa',
            'selected' => AnTranslator::_('COM-JOBS-VISA-SELECT'),
            'name' => 'visa',
        ));

        $selected = $options->selected;

        unset($options->selected);

        $visatypes = array(
            "" => AnTranslator::_('COM-JOBS-VISA-SELECT'),
            AnTranslator::_('COM-JOBS-VISA-USCITIZEN') => AnTranslator::_('COM-JOBS-VISA-USCITIZEN'),
            AnTranslator::_('COM-JOBS-VISA-GREENCARD') => AnTranslator::_('COM-JOBS-VISA-GREENCARD'),
            AnTranslator::_('COM-JOBS-VISA-WORKVISA') => AnTranslator::_('COM-JOBS-VISA-WORKVISA'),
            AnTranslator::_('COM-JOBS-VISA-STUDENTVISA') => AnTranslator::_('COM-JOBS-VISA-STUDENTVISA'),
            AnTranslator::_('COM-JOBS-VISA-VISAREQUIRED') => AnTranslator::_('COM-JOBS-VISA-VISAREQUIRED'),
            AnTranslator::_('COM-JOBS-VISA-OTHER') => AnTranslator::_('COM-JOBS-VISA-OTHER'),
        );

        $html = $this->getService('com:base.template.helper.html');

        return $html->select($options->name, array('options' => $visatypes, 'selected' => $selected), KConfig::unbox($options));
    }
}
