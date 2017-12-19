<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-about">
        <?php
            $data_mass = array($_POST['arr'],
                array('1','1Address','1Tel','1Fax','1Mobile','1HomepageAddress','1E-mail','1OtherHomepageAddress'),
                array('2','2Address','2Tel','2Fax','2Mobile','2HomepageAddress','2E-mail','2OtherHomepageAddress'));
            $ar = array('test'=>'123');
            echo json_encode($ar);
//            for ($i=0;$i<count($data_mass);$i++)
//            {
//                echo '<tr class="asd">';
//                for ($j=0;$j<count($_POST['arr']);$j++)
//                {
//                    echo '<td>';
//                    echo $data_mass[$i][$j];
//                    echo '</td>';
//                }
//                echo '</tr>';
//            }
        ?>
</div>

