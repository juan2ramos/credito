<?php namespace credits\Managers;
use credits\Entities\Slider;
class SliderManager extends BaseManager
{

    public function getRules()
    {
        $rules=[
            'files'         => 'image|required'

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
    public function saveSlider()
    {
        $data=$this->prepareData($this->data);
        $slider= new Slider();
        $file=$data['files'];
        $fileName=sha1(time()).$file->getClientOriginalName();
        $slider->files=$fileName;
        if($slider->save())
        {
            $client = \App::make('aws')->get('s3');
            $result = $client->putObject(array(
                'Bucket'     => 'creditos',
                'Key'        => $fileName,
                'SourceFile' => $file,
                
            ));
            #$file->move("sliders",$fileName);
            return true;
        }
        return false;
    }



}
