<?php
use credits\Entities\Point;
use credits\Entities\Location;
use credits\Entities\CreditRequest;
use credits\Managers\PointManager;

class PointController extends BaseController {


    public function show()
    {
        $locations = [''=>'seleccione una region'] + Location::all()->lists('name','id');
        $points = Point::all();
        return View::make('back.point',compact('points','locations'));
    }

    public function update(){
        $point = Point::find(Input::get('id'));
        $point->isEnterpricingShop = Input::get('check');
        $point->save();
        return ['data' => Input::get('check')];
    }

    public function create()
    {
        $pointManager = new PointManager(new Point(),Input::all());
        $pointValidator = $pointManager->isValid();

        if($pointValidator)
            return Redirect::route('point')->withErrors($pointValidator)->withInput();

        $message = $pointManager->savePoint();
        return Redirect::route('point')->with('message',$message);
    }

    public function delete($id)
    {
        $credit = CreditRequest::where('point',$id)->first();
        if($credit)
            return Redirect::route('point')->with('message_error','el punto de venta no se puede eliminar por que esta siendo utilizado');

        $point = Point::find($id);
        $point->delete();
        return Redirect::route('point')->with('message','el punto de venta se elimino exitosamente');

    }
}
