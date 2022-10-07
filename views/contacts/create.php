 <?php
    /* @var $this yii\web\View */
    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\bootstrap5\ActiveForm;
    use kartik\select2\Select2
    ?>
    <h1>New Contact</h1>

    <div class="form-group">
        <label for="name">Photo: </label> <div style="width:50px;height:50px;"><?= $model->photo; ?></div><br/>
        <label for="name">name: </label> <b><?= $model->name; ?></b><br/>
        <label for="email">Email: </label> <b><?= $model->email; ?></b><br/>
    </div>

    <?php if(count($model->errors) > 0): ?>
    <div class="alert alert-danger" role="alert"> <?php foreach($model->errors as $error)echo $error[0].'</br>'; ?> </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(['id' => 'clients-contacts-form']); ?>
        <?= $form->field($model_contact, 'country_code')->widget(Select2::classname(), [
            'data' => $countries,
            'options' => ['placeholder' => 'Select a country...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); 
        ?>
        <?= $form->field($model_contact, 'number')->input('number', ['placeholder' => "Enter Your Number"]) ?>
        <div class="form-group"> <?= Html::submitButton('Save', ['class' => 'btn btn-primary mt-2']) ?> </div>
    <?php ActiveForm::end(); ?>
