<?php
    /* @var $this SiteController */

    $this->pageTitle=Yii::app()->name;
    Yii::app()->clientScript->registerPackage('notes_reactjs');
?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation">
                    <a href="#" class="btn btn-default" role="button">Main</a>
                </li>
                <li role="presentation">
                    <a href="#" class="btn btn-default" role="button">First</a>
                </li>
                <li role="presentation">
                    <a href="#" class="btn btn-default" role="button">Another</a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <div id="content">

            </div>
        </div>
    </div>
</div>
