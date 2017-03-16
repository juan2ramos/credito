<?php
use credits\Entities\Point;
use credits\Entities\Location;
use credits\Entities\CreditRequest;
use credits\Managers\PointManager;

class PointController extends BaseController {


    public function show()
    {
        $locations = [''=>'seleccione una region'] + Location::orderBy('name' )->lists('name','id');
        $points = Point::where('state', '>', 0)->orderBy('name' )->get();
        return View::make('back.point',compact('points','locations'));
    }

    public function update(){
        $point = Point::find(Input::get('id'));
        Input::get('type') == 1
            ? $point->isEnterpricingShop = Input::get('check')
            : $point->isCreditShop = Input::get('check');

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
        $point = Point::find($id);
        $point->update(['state' => -2]);
        return Redirect::route('point')->with('message','El punto de venta se elimino exitosamente');
    }
    public function editPoint($id)
    {
        $point = Point::find($id);
        $locations = Location::all();
        return View::make('back.pointUpdate',compact('point','locations'));

    } public function editPointUpdate()
    {
        $point = Point::find(Input::get('id'));
        $point->update(['name' => Input::get('name'),'location_id' => Input::get('location_id') ]);
        return Redirect::route('editPoint',Input::get('id'))->with('message','Nombre actualizado');

    }
}
