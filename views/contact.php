<?php
/**
 * @var $this \paul_core\paul_core\View
 * @var $model \app\models\ContactForm
 */

use paul_core\paul_core\form\Form;
use paul_core\paul_core\form\TextareaField;

$this->title = 'contact'
?>
<h1>contact us</h1>
<?php $form = Form::begin('','post'); ?>
<?php echo $form->field($model, 'subject'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo new TextareaField($model, 'body'); ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php $form = Form::end(); ?>