<?php

use credits\Entities\User;
class ExtractsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function sendEmail($identification)
	{
		$users = DB::table('users')->whereRaw("roles_id = 4 and identification_card = {$identification}")->get();
		$extracts = DB::table('extracts')->whereRaw("numero_documento = {$identification}")->get();
		$minPay = DB::table('excelDaily')->whereRaw("cedula = {$identification}")->get();

		foreach($users as $user) {
				$html = "
				<html>
				<head>
					<style>
						body{font-family: Georgia font-weight: 100;color:#8d8d8d; font-size: 18px}
						.wrapper{padding: 10px 10px}
						span{border: 1px solid #da0080; padding: 10px 0;text-align: right; text-align: center}
						table {  border-collapse: collapse;  border-spacing: 0;  }
						td, th {  vertical-align: top; height: 30px  }
						h1, h2,  th, td { font-weight:normal;margin: 0;padding: 0 }
						 h1, h2{font-size: 16px}
						img { border: 0;margin: 0;padding: 0 }
						.back{ background: #ffe9f8}
						.table {border-bottom: 1px solid #da0080;}
						.table tbody{text-align: center;}
						.table th{border: 1px solid #da0080;}
						.table td{border-right: 1px solid #da0080;border-left: 1px solid #da0080;}
						.table td, .table th {box-sizing: border-box;}
						.capitalize{text-transform: capitalize; border:none;}
						.uppercase{text-transform: uppercase; border:none;}
				</style>
				</head>
				<body>
				<table width='530'  class='wrapper'>
				
				<tr valign='middle'>
				  <td>
					<img width='200px' src='img/logocreditos.png'/>
				  </td>
				  <td>
					<h1 style='margin: 10px 0'>ESTADO DE CUENTA</h1>
					<h2 style='margin: 10px 0; border: 1px solid  #da0080; padding: 0 10px'>Interes de mora</h2>
				  </td>
				</tr>
				<tr>
				  <td>
					Nombre: <span class='capitalize'>{$user->name} {$user->last_name}</span>
				  </td>
				  <td style=''>Feha de facturación
					<div style='width: 195px; display: inline-block; text-align: center; font-size: 14px; '>
					  <span style='display: inline-block;width:30px;'>P</span>
					  <span style='display: inline-block;width:30px;'>P</span>
					  <span style='display: inline-block;width:30px;'>P</span>
					</div>
				  </td>
				</tr>
				<tr>
				  <td>
					Dirección: <span class='capitalize'>{$user->address}</span>
				  </td>
				  <td>Cupo Total
					  <span>P</span>
				  </td>
				</tr>
				
				<tr>
				  <td>
					Cédula: {$user->identification_card}
				  </td>
				  <td>Cupo Disponible
					  <span>P</span>
				  </td>
				</tr>
				<tr>
				  <td>
					Ciudad: <span class='capitalize'>{$user->residency_city}</span>
				  </td>
				</tr>
				
				<tr  class='back' valign='middle'>
				  <td>
				   PAGUE HASTA
				   <span>P</span>
				   <span>P</span>
				   <span>P</span>
				  </td>
				  <td>PAGO MINIMO
					  <span>$ {$minPay[0]->pago_minimo}</span>
				  </td>
				</tr>
				
				<tr class='back padding' valign='middle'>
				  <td>
				   PAGUE TOTAL
				   <span>P</span>
				  </td>
				  <td>PAGO FAVOR
					  <span>P</span>
				  </td>
				  <tr>
					<td colspan='2'><br/>
						<table class='table' width='100%'>
						  <thead>
						  	<tr style='text-align: center; font-size: 12px' valign='middle'>
							  <th>COMPRA <br /> NÚMERO</th>
							  <th>DD</th>
							  <th>MM</th>
							  <th>AA</th>
							  <th>DETALLE</th>
							  <th style='font-size: 8px'>TASA <br />INTERES</th>
							  <th>VALOR <br /> COMPRA</th>
							  <th>CARGOS Y <br /> ABONOS</th>
							  <th>SALDO <br /> CRÉDITO <br /> DIFERIDO </th>
							  <th>CUOTAS</th>
						  	</tr>
						  </thead>
						  <tbody>";
						  foreach($extracts as $extract) {
							  $html .="
							  <tr>
								<td>{$extract->id}</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>{$extract->tasa_interes} %</td>
								<td>$ {$extract->valor_compra}</td>
								<td>$ {$extract->cargos_abonos}</td>
								<td>$ {$extract->saldo_credito_diferido}</td>
								<td>{$extract->cuotas}</td>
							  </tr>";
						  }
						$html.="
						</tbody>
					  </table><br/>
					</td>
				  </tr>
				</tr>
				<tr class='back'>
				  <td> Saldo en mora <span>P</span> </td>
				  <td> Gastos legales<span>P</span> </td>
				</tr>
				
				<tr class='back'>
				  <td> Compras del mes <span>P</span> </td>
				  <td> Cargos no diferidos<span>P</span> </td>
				</tr>
				
				
				<tr class='back'>
				  <td> Intereses <span>P</span> </td>
				  <td> Notas Crédito<span>P</span> </td>
				</tr>
				
				<tr class='back'>
				  <td colspan='2'> Honorarios <span>P</span> </td>
				</tr>
				
				<tr>
				<td colspan='2'><p style='text-align: justify'>
				
				Cualquier inconformidad favor comunicarla a creditos@innova-quality.com.co, puede enviar comunicación escrita a José Rubiano o Jeimmy Fonseca a la Carrera 20 No 164-13 en Bogotá o comunicarse al PBX: 670 2400 Ext 208 - 133, horario de atención: lunes a viernes de 8:00 a.m. a 5:00 p.m.
				Innova Quality S.A.S. reporta a las centrales de riesgo el incumplimiento de su obligación. Apreciado cliente recuerde que de incurrir en mora se dara inicio a la gestión de cobranza que causara gastos correspondientes conforme a las politicas de Innova Quality S.A.S. que pueden ser consultadas en la pagina web:
				www.creditos.lilipink.com
				</p></td>
				</tr>
				</table>
				</body>
				</html>
				";
		}
		return PDF::load($html, 'A4', 'portrait')->show();
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
