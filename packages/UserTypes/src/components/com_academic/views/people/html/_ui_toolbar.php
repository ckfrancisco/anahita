<? defined('KOOWA') or die ?>

<? if ($viewer->admin()) : ?>
<div class="btn-toolbar">
    <a href="<?= @route('view=person&layout=add') ?>" class="btn btn-primary">
        <?= @text('COM-ACADEMIC-TOOLBAR-PERSON-NEW') ?>
    </a>
</div>
<? endif; ?>

<form action="<?= @route('layout=list') ?>" id="an-filterbox" class="an-filterbox form-inline" name="an-filterbox" method="get">
    <input placeholder="Filter..." type="text" name="q" class="input-large search-query" id="an-search-query" value="" size="21" maxlength="100" />
    <? if ($viewer->admin()) : ?>
    <?
    $usertypes = array(
        '' => AnTranslator::_('COM-ACADEMIC-FILTER-USERTYPE'),
        ComPeopleDomainEntityPerson::USERTYPE_REGISTERED => @text('COM-ACADEMIC-USERTYPE-REGISTERED'),
        ComPeopleDomainEntityPerson::USERTYPE_ADMINISTRATOR => @text('COM-ACADEMIC-USERTYPE-ADMINISTRATOR'),
        ComPeopleDomainEntityPerson::USERTYPE_SUPER_ADMINISTRATOR => @text('COM-ACADEMIC-USERTYPE-SUPER-ADMINISTRATOR'),
    );
    $html = $this->getService('com:base.template.helper.html');
    ?>
    <?= $html->select('filter[usertype]', array('options' => $usertypes)) ?>
    <label class="checkbox">
        <input type="checkbox" name="filter[disabled]">
        <?= @text('COM-ACADEMIC-FILTER-DISABLED') ?>
    </label>
    <? endif; ?>
</form>
