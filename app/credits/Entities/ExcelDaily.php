<?php namespace credits\Entities;


class ExcelDaily extends \Eloquent
{
    protected $table = 'excelDaily';
    protected $fillable = ['cedula','Pago_Minimo'];
}
