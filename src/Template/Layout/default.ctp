<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Sports Application Sandbox Playground';
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?= $cakeDescription ?>:
            <?= $this->fetch('title') ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <?= $this->Html->css('base.css') ?>
        <?= $this->Html->css('style.css') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>

        <?php echo $this->Html->script('http://code.jquery.com/jquery.min.js'); ?> 
        <?php echo $this->Html->script('https://cdn.jsdelivr.net/npm/velocity-animate@2.0/velocity.min.js'); ?>         
        <?php echo $this->Html->script('https://use.fontawesome.com/37339b609d.js'); ?> 
        <?php echo $this->Html->script('https://www.gstatic.com/charts/loader.js'); ?> 
        
        <!-- Vue.js CDN - choice made to go for react -->
        <?php echo $this->Html->script('https://cdn.jsdelivr.net/npm/vue/dist/vue.js'); ?> 
        <?php echo $this->Html->script('https://unpkg.com/vuex'); ?> 
        
        
        <!-- testing react CDN : might need to add crossorigin attribute -->
        <!-- https://reactjs.org/docs/cdn-links.html -->
        <?php // echo $this->Html->script('https://unpkg.com/react@16/umd/react.development.js'); ?>         
        <?php // echo $this->Html->script('https://unpkg.com/react-dom@16/umd/react-dom.development.js'); ?>         

    </head>
    <body>
        <nav class="top-bar expanded" data-topbar role="navigation">
            <ul class="title-area large-3 medium-4 columns">
                <li class="name">
                    <h1><a href=""><?= $this->fetch('title') ?></a></h1>
                </li>                
            </ul>
            <ul class="top_right">
                <li><a target="_blank" href="https://book.cakephp.org/3.0/">Documentation</a></li>
                <li><?php echo $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout']); ?></li>
            </ul>
        </nav>
        <?= $this->Flash->render() ?>
        <div class="container clearfix">
            <?= $this->fetch('content') ?>
        </div>
        <footer>
            </footer>
    </body>
</html>

<style>

    .title-area{

        width: 100%;
        
        }

    .top_right{

        position: absolute;
        top: 10px;
        right: 10px;

    }

    .top_right li{

        display: inline;
        padding: 10px;

    }        

</style>