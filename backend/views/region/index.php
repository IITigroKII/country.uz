<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\RegionQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Regions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                <h3 class="kt-portlet__head-title">
                    <?=Html::encode($this->title)?>
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="<?=Yii::$app->homeUrl?>" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        Back
                    </a>
                    &nbsp;
                    <div class="dropdown dropdown-inline">
                        <a href="<?=Yii::$app->homeUrl?>region/create" class="btn btn-brand btn-icon-sm">
                            <i class="flaticon2-plus"></i> Add New
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-portlet__body">
                <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => '{items}<div class="kt-datatable__pager kt-datatable--paging-loaded">{pager}<div class="kt-datatable__pager-info">{summary}</div></div>',
            'tableOptions' => ['class' => 'table kt-datatable__table'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name_uz',
                'name_en',
                'name_ru',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'headerOptions' => ['style' => 'color:#5867dd'],
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="la la-lg la-cog"> </span>', $url, [
                                'title' => Yii::t('app', 'view'),
                            ]);
                        },

                        'update' => function ($url, $model) {
                            return Html::a('<span class="la la-lg la-edit"> </span>', $url, [
                                'title' => Yii::t('app', 'update'),
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="la la-lg la-trash"> </span>', $url, [
                                'title' => Yii::t('app', 'delete'),
                            ]);
                        }

                    ],
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
</div>
