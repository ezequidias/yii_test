<?php
        /* @var $this yii\web\View */
        use yii\helpers\Url;
    ?>
    <h1>Update Client</h1>

    <form name="form" method="post" action="<?= Url::to(['clients/update', 'id' => $model->id]); ?>">

    <input type="hidden" name="<?= \yii::$app->request->csrfParam; ?>" 
                value="<?= \yii::$app->request->csrfToken; ?>">

        <div class="form-group">
            <label for="name">name:</label>
            <input type="text" class="form-control" id="name" name="name" 
                    placeholder="Name" value="<?= $model->name; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email"
                    placeholder="Email" value="<?= $model->email; ?>">
        </div>

        <button type="submit" class="btn btn-primary mt-2">Save</button>
    </form>

    <?= $this->render('../contacts', $_params_); ?>