<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<style>
    .navbar-custom-menu,.navbar-nav
    {
        width:100% !important;
    }

    .navbar .navbar-static-top
    {
        background-color:rgb(235,235,235)!important;;
    }
    .logo
    {
        background-color:rgb(255,255,255) !important;
        color:black !important;;
    }
    .search-patient, #suggestions-container ul
    {
        background-color: white;
        width: 500px;
        border: 1px solid rgb(225,225,225);
        border-radius: 3px;

    }

    #suggestions-container ul li
    {
        height: 25px;
    }
    #suggestions-container ul li a
    {
     color:black
    }
    .search-patient
    {
        margin: 8px;
        margin-left: 20px;
        height: 35px;
    }
    .search-patient input
    {
        height: 100%;
        border: none;
        width:90%
    }
    .search-patient span
    {
        font-size: 16px;
        margin: 9px;
        float: right;
        color: rgb(215,215,215);
    }
    #suggestions-container
    {
        position: absolute;
        height:100%;
    }
</style>
<header class="main-header">
    <style src="/css/site.css"></style>
    <?= Html::a('<span class="logo-mini" style="">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation" style="background-color:rgb(235,235,235)">

<!--        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">-->
<!--            <span class="sr-only">Toggle navigation</span>-->
<!--        </a>-->

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li>
                    <div class="search-patient">
                    <input  type="text" name="keyword" oninput="searchPatients(this.value)">
                        <span class="glyphicon glyphicon-search"></span>
                        <div id="suggestions-container"></div>
                    </div>

                </li>
                <!-- Messages: style can be found in dropdown.less-->
<!--                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php //echo $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">Alexander Pierce</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?php //echo $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                Alexander Pierce - Web Developer
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>-->

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
    <script>
        function searchPatients(keyword)
        {
            $.post("/patient/patient-search",
            {'keyword':keyword,'tag':'ul'},
             function (data)
             {
                document.getElementById('suggestions-container').innerHTML=data;
             });
        }
    </script>
</header>
