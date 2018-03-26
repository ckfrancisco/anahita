<?php

class ComJobsTemplateHelper extends KTemplateHelperAbstract
{
    public function selectemployment($options = array())
    {
        $viewer = get_viewer();
        $options = new KConfig($options);

        $options->append(array(
            'id' => 'job-employment',
            'selected' => 'Full-Time',
            'name' => 'employment',
        ));

        $selected = $options->selected;

        unset($options->selected);

        $usertypes = array(
            'Full-Time',
            'Part-Time',
            'Internship',
            'Co-Op',
            'Consulting',
            'Contracting',
        );

        $html = $this->getService('com:base.template.helper.html');

        return $html->select($options->name, array('options' => $usertypes, 'selected' => $selected), KConfig::unbox($options));
    }
    public function selectvisa($options = array())
    {
        $viewer = get_viewer();
        $options = new KConfig($options);

        $options->append(array(
            'id' => 'job-visa',
            'selected' => 'Full-Time',
            'name' => 'employment',
        ));

        $selected = $options->selected;

        unset($options->selected);

        $usertypes = array(
            'U.S. Citizen',
            'Green Card',
            'Work Visa',
            'Student Visa',
            'Visa Required',
            'Other',
        );

        $html = $this->getService('com:base.template.helper.html');

        return $html->select($options->name, array('options' => $usertypes, 'selected' => $selected), KConfig::unbox($options));
    }
}
