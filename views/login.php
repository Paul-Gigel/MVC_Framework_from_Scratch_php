<?php
/**
 * @var $model \app\models\User
 */
?>
<h1>Login</h1>
<?php $form = \app\core\form\Form::begin('',"post"); ?>

<?php echo $form->field($model, 'email')?>
<?php echo $form->field($model, 'password')->passwordField()?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end()?>

<?php
/*<div class="row">
    <div class="col">
        <?php echo $form->field($model, 'firstname')?>
    </div>
    <div class="col">
        <?php echo $form->field($model, 'lastname')?>
    </div>
</div>*/
?>