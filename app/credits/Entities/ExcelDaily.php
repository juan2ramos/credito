<?php namespace credits\Entities;


class ExcelDaily extends \Eloquent
{

    protected $table='excelDaily';
    protected $fillable = array('cedula','Pago_Minimo');
}
