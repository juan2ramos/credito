<?php


use credits\Managers\SliderManager;
use credits\Entities\Slider;
use credits\Repositories\LogRepo;
use credits\Repositories\SliderRepo;


class SliderController extends BaseController
{

    public function showSlider()
    {
        $sliders = Slider::all();
        $i = 0;
        $select = [ 0 => "no colocar"];
        if(count($sliders))
        {
            foreach($sliders as $slider)
            {
                $i++;
                $select = $select+[$i=>"".$i."°"];
            }
        }
        return View::make('front.slider',compact('sliders','select'));
    }

    public function saveSlider()
    {
        $SliderManager = new sliderManager(new slider(), Input::all());
        $validator=$SliderManager->isValid();
        if($validator){
            return Redirect::route('slider')->withErrors($validator)->withInput();
        }
        $SliderManager->saveSlider();
        new LogRepo(
            [
                'responsible'=> 'administrador por definir',
                'action' => 'ha subido un slider',
                'affected_entity' => 'home',
                'method' => 'saveSlider'
            ]
        );
        return Redirect::route('slider')->with(array('mensaje' => 'Los slider estan guardados'));
    }

    public function uploadSlider()
    {
        $sliders = Slider::all();
        $numberSlider=Input::all();
        $slider=new SliderRepo();
        for($i=0;$i<count($sliders);$i++)
        {
            $slider->uploadSlider($sliders[$i]->id,$numberSlider[$i]);
        }
        return Redirect::route('slider')->with(array('mensaje' => 'Los slider estan guardados'));
    }

    public function deleteSlider($id)
    {
        $slider = Slider::find($id);
        if($slider->delete())
            return Redirect::route('slider')->with(array('mensaje' => 'La imagen fue eliminada'));
        return Redirect::route('slider')->with(array('mensaje' => 'No se pudo eliminar la imagen'));
    }
}