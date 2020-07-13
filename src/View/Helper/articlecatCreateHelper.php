<?php
namespace App\View\Helper;

use Cake\View\Helper;

class articlecatCreateHelper extends Helper
{

    public function create(){

        $html = 
            '<div class="test_element">
                <button class="editOuter"> check button </button>
                <p>checking how elements work in cakephp</p>
                <button class="editOuter"> check button </button>
            </div>';

        return $html;

    }
}

