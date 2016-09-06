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
        $inputs = Input::all();
        $file = $inputs['files'];

        $filename = sha1(time()) . $file->getClientOriginalName();
        $slider = Slider::create(['files' => $filename]);
        if(!$slider)
            return Redirect::route('slider')->with(['mensaje' => 'Los slider no pudieron ser guardados. Initente de nuevo']);
        $file->move("sliders" , $filename);
        return Redirect::route('slider')->with(['mensaje' => 'Los slider estan guardados']);
    }

    public function uploadSlider()
    {
        $inputs = Input::all();

        foreach ($inputs as $key => $input){
            if (strpos($key, 'position') !== false) {
                $data = explode(",", $input);
                $slider = Slider::find($data[0]);
                $slider->update(['number_slider' => $data[1]]);
            }
        }

        return Redirect::route('slider')->with(['message' => 'Los slider estan guardados']);
    }

    public function deleteSlider($id)
    {
        $slider = Slider::find($id);
        if($slider->delete())
            return Redirect::route('slider')->with(array('mensaje' => 'La imagen fue eliminada'));
        return Redirect::route('slider')->with(array('mensaje' => 'No se pudo eliminar la imagen'));
    }
}