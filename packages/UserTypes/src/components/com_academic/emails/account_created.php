<?php defined('KOOWA') or die; ?>

<?= sprintf(@text('COM-ACADEMIC-MAIL-BODY-ACCOUNT-CREATED'), $person->name) ?> 
<?= @route('option=com_people&view=session&reset_password=1&token='.$person->activationCode) ?>
