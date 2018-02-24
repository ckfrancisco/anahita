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
    $html = $this->getService('com:base.template.helper.html');
    ?>
    
    <?= $html->select('filter[usertype]', array('options' => $usertypes)) ?>
    <label class="checkbox">
        <input type="checkbox" name="filter[disabled]">
        <?= @text('COM-PEOPLE-FILTER-DISABLED') ?>
    </label>
    <? endif; ?>
</form>

<form action="<?= @route('layout=list') ?>" id="an-filterbox" class="an-filterbox form-inline" name="an-filterbox" method="get">
    <input placeholder="Filter..." type="text" name="q" class="input-large search-query" id="an-search-query" value="" size="21" maxlength="100" />
    <? if ($viewer->admin()) : ?>
    <?                                                              # copied code from above ----- william
    $academictypes = array(
        '' => AnTranslator::_('COM-PEOPLE-FILTER-ACADEMICTYPE'),
		ComPeopleDomainEntityPerson::ACADEMICTYPE_STUDENT => @text('COM-PEOPLE-ACADEMICTYPE-STUDENT'),
        ComPeopleDomainEntityPerson::ACADEMICTYPE_RECRUITER => @text('COM-PEOPLE-ACADEMICTYPE-TUTOR'),
        ComPeopleDomainEntityPerson::ACADEMICTYPE_TEACHER => @text('COM-PEOPLE-ACADEMICTYPE-TEACHER'),
    );
    $html = $this->getService('com:base.template.helper.html');
    ?>
    
    <?= $html->select('filter[$academictype]', array('options' => $academictypes)) ?>
    <label class="checkbox">
        <input type="checkbox" name="filter[disabled]">
        <?= @text('COM-PEOPLE-FILTER-DISABLED') ?>
    </label>
    <? endif; ?>
</form>

<form action="<?= @route('layout=list') ?>" id="an-filterbox" class="an-filterbox form-inline" name="an-filterbox" method="get">
    <input placeholder="Filter..." type="text" name="q" class="input-large search-query" id="an-search-query" value="" size="21" maxlength="100" />
    <? if ($viewer->admin()) : ?>
    <?                                                              # copied code from above ----- william
    $corporatetypes = array(
        '' => AnTranslator::_('COM-PEOPLE-FILTER-ACADEMICTYPE'),
		ComPeopleDomainEntityPerson::CORPORATETYPE_NONE => @text('COM-PEOPLE-CORPORATETYPE-NONE'),
        ComPeopleDomainEntityPerson::CORPORATETYPE_RECRUITER => @text('COM-PEOPLE-CORPORATETYPE-RECRUITER'),
        ComPeopleDomainEntityPerson::CORPORATETYPE_EMPLOYER => @text('COM-PEOPLE-CORPORATETYPE-EMPLOYER'),
    );
    $html = $this->getService('com:base.template.helper.html');
    ?>
    
    <?= $html->select('filter[$corporatetype]', array('options' => $corporatetypes)) ?>
    <label class="checkbox">
        <input type="checkbox" name="filter[disabled]">
        <?= @text('COM-PEOPLE-FILTER-DISABLED') ?>
    </label>
    <? endif; ?>
</form>
