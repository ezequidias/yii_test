<?php
    /* @var $this yii\web\View */
    use yii\helpers\Url;
    use yii\widgets\LinkPager;
    use app\components\CustomPagination;
?>
    <h1 class="mb-4">Details</h1>

    <div class="form-group">

        <label for="name">Photo: </label> <div style="width:50px;height:50px;"><?= $model->photo; ?></div><br/>
        <label for="name">name: </label> <b><?= $model->name; ?></b><br/>
        <label for="email">Email: </label> <b><?= $model->email; ?></b><br/>
    </div>

    <?= $this->render('../contacts', $_params_); ?>