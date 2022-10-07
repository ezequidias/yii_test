<?php
        /* @var $this yii\web\View */
        use yii\helpers\Url;
        use yii\helpers\Html;
        use yii\bootstrap5\ActiveForm;
    ?>
    <h1>Update Client</h1>

    <?php if(count($model->errors) > 0): ?>
    <div class="alert alert-danger" role="alert"> <?php foreach($model->errors as $error)echo $error[0].'</br>'; ?> </div>
    <?php endif; ?>
    
    <?php $form = ActiveForm::begin(['id' => 'clients-form']); ?>
        <?= $form->field($model, 'name')->input('name', ['placeholder' => "Enter Your Name"]) ?>
        <?= $form->field($model, 'email')->input('email', ['placeholder' => "Enter Your Email"]) ?>
        <div class="form-group"> <?= Html::submitButton('Save', ['class' => 'btn btn-primary mt-2']) ?> </div>
    <?php ActiveForm::end(); ?>

    <?= $this->render('../contacts', $_params_); ?>