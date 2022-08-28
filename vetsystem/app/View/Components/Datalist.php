<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Datalist extends Component
{
    public $title;
    public $route;
    public $header;
    public $data;
    public $hide;

    public function __construct($title, $route, $header, $data, $hide) {
        $this->title = $title;
        $this->route = $route;   
        $this->header = $header;
        $this->data = $data;    
        $this->hide = $hide;   
    }

    public function render()
    {
        return view('components.datalist');
    }
}
