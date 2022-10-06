<?php
    use yii\helpers\Url;
    /* @var $this yii\web\View */
    ?>
    <h1 class="text text-center">Contacts by Country</h1>
    <table class="table mt-4">
        <thead>
        <tr>
            <th>Country Code</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($contacts as $row): ?>
                <tr>                   
                    <td><?= $row['country_code']; ?></td>
                    <td><?= $row['count']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>