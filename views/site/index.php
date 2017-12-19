<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
require_once ('simple_html_dom.php');
?>
<div class="site-index">
    <div class="row">
        <input class="btn_val" type="text">
        <button class="addCol btn-primary btn-lg">Добавить колонку</button>
        <button class="addParse btn-primary btn-lg">Запарсить</button>
        <button class="btn-primary btn-lg" id="btnExport" onclick="pars();">Сформировать файл excel</button>
        <div class="my_btn"></div>
        <div class="my_table">
            
        </div>  
    </div>
</div>
