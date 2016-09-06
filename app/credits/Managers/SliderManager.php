<?php namespace credits\Managers;
use credits\Entities\Slider;
class SliderManager extends BaseManager
{

    public function getRules()
    {
        $rules=[
            'files' => 'image|required'

        ];

        return  $rules;
    }

    public function getMessage()
    {
        $messages = [
            'required'      => 'El campo :attribute es obligatorio.'
        ];
        return $messages;
    }

    /************ Utilizado directamente en SliderController ***************************/
    /// Sin nadie más lo utiliza, borrar clase.

    public function saveSlider()
    {
        $data=$this->prepareData($this->data);
        $slider= new Slider();
        $file=$data['files'];
        $fileName=sha1(time()).$file->getClientOriginalName();
        $slider->files=$fileName;
        if($slider->save())
        {
            $file->move("sliders",$fileName);
            return true;
        }
        return false;
    }



}
