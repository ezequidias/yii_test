 <?php
    /* @var $this yii\web\View */
    use yii\helpers\Url;
use yii\widgets\ActiveForm;
    
    ?>
    <h1>New Contact</h1>

    <div class="form-group">
        <label for="name">Photo: </label> <div style="width:50px;height:50px;"><?= $model->photo; ?></div><br/>
        <label for="name">name: </label> <b><?= $model->name; ?></b><br/>
        <label for="email">Email: </label> <b><?= $model->email; ?></b><br/>
    </div>
    <form name="form" method="post" action="<?= Url::to(['clients/'.$model->id.'/contacts/create']); ?>">
<?php var_dump($errors); ?>
    <?php if(count($errors) > 0): ?>
    <div class="alert alert-danger" role="alert">
        <?php
        foreach($errors as $error){
            echo $error[0].'</br>';
        }
        ?>
    </div>
    <?php endif; ?>

    <input type="hidden" name="<?= \yii::$app->request->csrfParam; ?>" 
                value="<?= \yii::$app->request->csrfToken; ?>">

        <div class="form-group">
            <label for="country_code">Country:</label>
            <select class="form-control" name="country_code">
                <?php
                foreach($countries as $country){
                    echo '<option value="'.($country->idd->root ?? '').($country->idd->suffixes[0] ?? '') .'">'. $country->name->common.' ('.($country->idd->root ?? '').($country->idd->suffixes[0] ?? '') .') </option>';
                }
                ?>
            </select >
        </div>
        <div class="form-group">
            <label for="phone">Number:</label>
            <input type="text" class="form-control" id="number" name="number" placeholder="number">
        </div>

        <button type="submit" class="btn btn-primary mt-2">Save</button>
    </form>