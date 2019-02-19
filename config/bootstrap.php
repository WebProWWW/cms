<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-06 20:01
 */

Yii::setAlias('@app', dirname(__DIR__));
Yii::setAlias('@vendor', dirname(__DIR__).'/vendor');
Yii::setAlias('@components', dirname(__DIR__).'/components');
Yii::setAlias('@modules', dirname(__DIR__).'/modules');
Yii::setAlias('@assets', dirname(__DIR__).'/assets');
Yii::setAlias('@widgets', dirname(__DIR__).'/widgets');
Yii::setAlias('@console', dirname(__DIR__).'/console');
Yii::setAlias('@abstracts', dirname(__DIR__).'/abstracts');
function dump($data){return'<pre>'.print_r((!$data)?'NULL':$data,true).'</pre>';}
