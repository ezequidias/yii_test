<?php
        /* @var $this yii\web\View */
        use yii\helpers\Url;
    ?>
    <h1>Update Conatct</h1>

    <form name="form" method="post" action="<?= Url::to(['clients/'.$model->id.'/contacts/create']); ?>">

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

    <?= $this->render('../contacts', $_params_); ?>