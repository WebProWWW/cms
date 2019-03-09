<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-01-01 19:15
 */

namespace widgets;


use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\widgets\LinkPager;

/**
 * Class Pagination
 * @package widgets
 *
 * @property ActiveDataProvider $dataProvider
 */

class Pagination extends Widget
{

    public $dataProvider = null;


    public function run()
    {
        if ($this->dataProvider === null) return '';
        return ''
        .'<div class="row justify-content-center">'
            .'<div class="col-auto">'
                .LinkPager::widget([
                    'pagination' => $this->dataProvider->pagination,
                    'linkContainerOptions' => ['class' => 'pagination-item'],
                    'linkOptions' => ['class' => 'pagination-link'],
                    'maxButtonCount' => 5,
                    'nextPageLabel' => '<i class="fas fa-angle-right"></i>',
                    'prevPageLabel' => '<i class="fas fa-angle-left"></i>',
                ])
            .'</div>'
        .'</div>';
    }

}