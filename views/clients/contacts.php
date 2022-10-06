<?php
    /* @var $this yii\web\View */
    use yii\helpers\Url;
    use yii\widgets\LinkPager;
    use app\components\CustomPagination;
?>
    <h1 class="text text-center">Contacts</h1>
    <a href="<?= Url::to(['clients/'.$model->id.'/contacts/create']);?>" class="btn btn-success">New Contact</a>
    <table class="table mt-4">
        <thead>
        <tr>
            <th>#</th>
            <th>Country</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($model->contacts as $contact): ?>
                <tr>
                    <td><?= $contact->id; ?></td>
                    <td><?= $contact->country_code; ?></td>
                    <td><?= $contact->number; ?></td>
                    <td>
                        <a href="<?= Url::to(['clients/'.$model->id.'/contacts/'.$contact->id.'/update']);?>" class="btn btn-success btn-sm text-white">Edit</a>
                        <a href="<?= Url::to(['clients/'.$model->id.'/contacts/'.$contact->id.'/delete']);?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>