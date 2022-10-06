<?php
    use yii\helpers\Url;
    use yii\widgets\LinkPager;
    use app\components\CustomPagination;
    /* @var $this yii\web\View */
    ?>
    <h1 class="text text-center">Clients</h1>
    <a href="<?= Url::to(['clients/create']);?>" class="btn btn-success">New Client</a>
    <table class="table mt-4">
        <thead>
        <tr>
            <th>#</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($clients as $client): ?>
                <tr>
                    <td><?= $client->id; ?></td>
                    <td><div style="width:50px;height:50px;"><?= $client->photo; ?></div></td>
                    <td><?= $client->name; ?></td>
                    <td><?= $client->email; ?></td>
                    <td>
                        <a href="<?= Url::to(['clients/details', 'id' => $client->id]);?>" class="btn btn-info btn-sm text-white">Details</a>
                        <a href="<?= Url::to(['clients/update', 'id' => $client->id]);?>" class="btn btn-success btn-sm text-white">Edit</a>
                        <a href="<?= Url::to(['clients/delete', 'id' => $client->id]);?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        <?= \yii\bootstrap4\LinkPager::widget(['pagination' => $pagination]) ?>