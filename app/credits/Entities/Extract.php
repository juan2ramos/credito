<?php
/**
 * Created by PhpStorm.
 * User: juan2ramos
 * Date: 11/03/15
 * Time: 6:17 PM
 */

namespace credits\Entities;


class Extract extends \Eloquent{

   // protected $fillable = ['0', '1_a_30', '31_60', '61_90', 'cargos_y_abonos', 'cuotas', 'detalle', 'dias_vencido', 'fecha_contabilizacion', 'nit', 'numero_documento', 'saldo_credito_diferido', 'saldo_sin_vencer', 'tasa_de_interes', 'valor_compra'];
    protected $fillable = [ 'nit',
                            'numero_documento',
                            'punto_venta',
                            'tasa_interes',
                            'valor_compra',
                            'cargos_abonnos',
                            'saldo_credito_diferido',
                            'cuotas',
                            'dias_vencidos',
                            'saldo_sin_vencer',
                            'un_mes',
                            'dos_meses',
                            'tres_meses',
                            'created_at',
                            'updated_at',
                            'fecha_contabilizacion',
                            'mas_tres'
                          ];

}