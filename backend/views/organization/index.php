<?php

use common\models\OrganizationCatalog;
use common\models\Region;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii2mod\rating\StarRating;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\OrganizationQuery */
/* @var $catalogFilter backend\controllers\OrganizationController */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Organizations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-index">
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
                        <a href="<?=Yii::$app->homeUrl?>organization/create" class="btn btn-brand btn-icon-sm">
                            <i class="flaticon2-plus"></i> Add New
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-portlet__body">



            <!--begin: Datatable -->

            <?php Pjax::begin(); ?>
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
//                    'gps:url',
                    [
                        'attribute' => 'region_id',
                        'label' => 'Region',
                        'filter' => Region::find()->select(['name_en', 'id'])->indexBy('id')->column(),
                        'filterInputOptions' => [
                            'class' => 'form-control',
                            'prompt' => 'All'
                        ],
                        'value' => 'region.name_en'
                    ],
                    [
                        'attribute' => 'rating',
                        'format' => 'text',
                        'content' => function($model){
                            return StarRating::widget([
                                'name' => 'input_name',
                                'value' => $model->rating,
                                'clientOptions' => [
                                    'readOnly' => true,
                                ],
                            ]);
                        },
                        'filter' =>  Html::activeDropDownList(
                            $searchModel,
                            'rating',
                            array(1=>"1+",2=>"2+",3=>"3+",4=>"4+",5=>"5+"),
                            ['class'=>'form-control','prompt' => 'All']
                        ),
                    ],
                    [
                        'attribute' => 'catalog',
                        'headerOptions' => ['style' => 'color:#5867dd'],
                        'filter' =>  Html::activeDropDownList(
                            $searchModel,
                            'catalog',
                            $catalogFilter,
                            ['class'=>'form-control','prompt' => 'All']
                        ),
                        'format' => 'raw',
                        'value' => function($model){
                            $data_calatalog = OrganizationCatalog::find()->with('catalog')->where(['organization_id' => $model->id])->all();
                            $hh = '';
                            foreach ($data_calatalog as $item) {
                                $hh .= $item->catalog->name_en.'<br>';
                            }
                            return $hh;
                        }
                    ],
                    [
                        'attribute' => 'Image',
                        'headerOptions' => ['style' => 'color:#5867dd'],
                        'format' => 'raw',
                        'value' => function ($model) {
                            if (file_exists('uploads/'.$model->photo)){
                                return Html::img(Yii::$app->homeUrl. 'uploads/'.$model->photo, ['style'=>'width:100px']);
                            } else {
                                return Html::img(Yii::$app->homeUrl. 'uploads/nophoto.png', ['style'=>'width:100px']);
                            }
                        },
                    ],
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

            <?php Pjax::end(); ?>
            </div>
            <!--end: Datatable -->
        </div>
    </div>


</div>
