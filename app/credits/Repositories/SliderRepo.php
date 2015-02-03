<?php

namespace credits\Repositories;

use credits\Entities\Slider;

class SliderRepo extends BaseRepo{

    private $_data;

    public function __construct(){
        $this->model = $this->getModel();
    }
    protected function getModel(){
        return new Slider();
    }
    public function uploadSlider($id,$numberSlider)
    {

        $slider=$this->model->find($id);
        $slider->number_slider=$numberSlider;
        $slider->save();
    }

}