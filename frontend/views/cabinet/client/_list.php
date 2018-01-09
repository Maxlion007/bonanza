<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 16.06.17
 * Time: 18:48
 */
use yii\widgets\DetailView;
use core\entities\User\User;

?>

<div class="block top">
    <div class="title"><?= Yii::t('app', 'Information'); ?></div>

    <div class="row">
        <?php if ($user->oneLevel()) {
            echo '<div class="col-sm-6">';
            echo DetailView::widget([
                'model' => $user,
                'options' => ['tag' => 'ul', 'class' => 'user-info client'],
                'template' => '<li>{captionOptions}<span>{label}</span>{contentOptions}{value}</li>',
                'attributes' => [
                    'client.organization',
                    'client.contact_face',
                    'phone',
                    'email',
                ],
            ]);
            echo '</div>';
        } else {
            echo '<div class="col-sm-6">';
            echo DetailView::widget([
                'model' => $user,
                'options' => ['tag' => 'ul', 'class' => 'user-info client'],
                'template' => '<li>{captionOptions}<span>{label}</span>{contentOptions}{value}</li>',
                'attributes' => [
                    'client.organization',
                    'client.contact_face',
                    'phone',
                    'email',
                    'client.pravo_form',
                    'client.field_of_specialisation',
                    'client.work_phone',
                ],
            ]);
            echo '</div>';
            echo '<div class="col-sm-6">';
            echo DetailView::widget([
                'model' => $user,
                'options' => ['tag' => 'ul', 'class' => 'user-info client'],
                'template' => '<li>{captionOptions}<span>{label}</span>{contentOptions}{value}</li>',
                'attributes' => [
                    'client.inn',
                    'client.social_insurance',
                    'client.address',
                    'client.zip_code',
                    'client.pravo_form',
                    'client.bank_account_number',
                ],
            ]);
            echo '</div>';
        }
        ?>
</div>
</div>
