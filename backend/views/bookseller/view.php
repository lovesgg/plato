<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Bookseller */

//$this->title = $model->title;
$this->title ="书商信息";
$this->params['breadcrumbs'][] = ['label' => '书商管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="bookseller-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> 修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash-o"></i> 删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '删除本条记录，确定?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'address',
            'contact',
            'mobile',
            'discount',
            // 'library_id',
            // 'user_id',
            // 'created_at:datetime',
            // 'updated_at:datetime',
            //'status',
        ],
    ]) ?>

</div>
