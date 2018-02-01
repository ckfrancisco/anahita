<?php defined('KOOWA') or die; ?>

<?= sprintf(@text('COM-ACADEMIC-MAIL-BODY-ACCOUNT-ACTIVATE'), $person->name)?> 
<?= @route('option=com_people&view=session&token='.$person->activationCode) ?>
