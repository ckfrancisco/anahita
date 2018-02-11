<? defined('KOOWA') or die ?>

<? if ($viewer->admin()) : ?>
<div class="btn-toolbar">
    <a href="<?= @route('view=person&layout=add') ?>" class="btn btn-primary">
        <?= @text('COM-PEOPLE-TOOLBAR-PERSON-NEW') ?>
    </a>
</div>
<? endif; ?>

<form action="<?= @route('layout=list') ?>" id="an-filterbox" class="an-filterbox form-inline" name="an-filterbox" method="get">
    <input placeholder="Filter..." type="text" name="q" class="input-large search-query" id="an-search-query" value="" size="21" maxlength="100" />
    <? if ($viewer->admin()) : ?>
    <?
    $usertypes = array(
        '' => AnTranslator::_('COM-PEOPLE-FILTER-USERTYPE'),
        ComPeopleDomainEntityPerson::USERTYPE_REGISTERED => @text('COM-PEOPLE-USERTYPE-REGISTERED'),
        ComPeopleDomainEntityPerson::USERTYPE_ADMINISTRATOR => @text('COM-PEOPLE-USERTYPE-ADMINISTRATOR'),
        ComPeopleDomainEntityPerson::USERTYPE_SUPER_ADMINISTRATOR => @text('COM-PEOPLE-USERTYPE-SUPER-ADMINISTRATOR'),
    );

    $uservalue = array(
        '' => AnTranslator::_('COM-PEOPLE-FILTER-USERTYPE'),
        ComPeopleDomainEntityPerson::USERVALUE_TEACHER => @text('COM-PEOPLE-USERVALUE-TEACHER'),
        ComPeopleDomainEntityPerson::USERVALUE_TUTOR => @text('COM-PEOPLE-USERVALUE-TUTOR'),
        ComPeopleDomainEntityPerson::USERVALUE_RECRUITER => @text('COM-PEOPLE-USERVALUE-RECRUITER'),
        ComPeopleDomainEntityPerson::USERVALUE_EMPLOYER => @text('COM-PEOPLE-USERVALUE-EMPLOYER'),
    );
    
    $html = $this->getService('com:base.template.helper.html');
    ?>
    <?= $html->select('filter[usertype]', array('options' => $usertypes)) ?>
    <label class="checkbox">
        <input type="checkbox" name="filter[disabled]">
        <?= @text('COM-PEOPLE-FILTER-DISABLED') ?>
    </label>
    <? endif; ?>
</form>


COM-PEOPLE-USERVALUE-TEACHER="Teacher"
COM-PEOPLE-USERVALUE-TUTOR="Tutor"
COM-PEOPLE-USERVALUE-RECRUITER="Recruiter"
COM-PEOPLE-USERVALUE-EMPLOYER="Employer"