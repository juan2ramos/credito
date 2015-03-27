<?php

Route::get('mail','HomeController@email');
Route::group(['before' => 'auth'], function () {
    Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
    Route::group(['prefix' => 'admin'], function () {
        require(__DIR__ . '/routes/admin.php');
    });
    //mostrar solicitudes de credito

    Route::get('solicitud', ['as' => 'request', 'uses' => 'CreditController@showRequest']);
    Route::get('showCreditRequest/{id}', 'CreditController@showCreditRequest');
    Route::post('showCreditRequest/{id}', 'CreditController@acceptCredit');


    //Variables generales

    Route::get('variables', ['as' => 'variables', 'uses' => 'CreditController@showVariables']);
    Route::post('variables/{id}', ['as' => 'variables/{id}', 'uses' => 'CreditController@saveVariables']);

    //regiones

    Route::get('Regiones', ['as' => 'location', 'uses' => 'CreditController@showLocations']);
    Route::post('Regiones', ['as' => 'location', 'uses' => 'CreditController@addLocations']);

    Route::get('deleteLocation/{id}', 'CreditController@deleteLocation');
    Route::post('deleteLocation/{id}', 'CreditController@deleteLocation');

    //actualizar usuario

    Route::post('Actualizar/{id}', ['as' => 'update', 'uses' => 'UserController@updateClient']);
    Route::get('Actualizar/{id}', ['as' => 'update', 'uses' => 'UserController@userShow']);

    //estado del credito
    Route::get('estadoCredito', ['as' => 'state', 'uses' => 'UserController@showState']);

    //slider

    Route::get('slider', ['as' => 'slider', 'uses' => 'SliderController@showSlider']);
    Route::post('slider', ['as' => 'slider', 'uses' => 'SliderController@saveSlider']);
    Route::post('administrar', ['as' => 'administratorSlider', 'uses' => 'SliderController@uploadSlider']);


    Route::get('administratorSlider/{id}', 'SliderController@deleteSlider');
    Route::post('administratorSlider/{id}', 'SliderController@deleteSlider');

    Route::get('showCreditRequest/reprobate/{id}', 'CreditController@reprobateCredit');
    //Route::post('showCreditRequest/reprobate//{id}','CreditController@reprobateCredit');


});


Route::group(['before' => 'guest'], function () {
    Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
    Route::get('sign-up', ['as' => 'sign-up', 'uses' => 'UserController@signUp']);

});
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::post('passwordRestart', ['as' => 'passwordRestart', 'uses' => 'AuthController@password']);


//solicitud de credito
Route::get('credito', ['as' => 'credit', 'uses' => 'CreditController@index']);
Route::post('credito', ['as' => 'credit', 'uses' => 'CreditController@updateCredit']);
Route::post('submit', ['as' => 'submit', 'uses' => 'CreditController@saveImage']);

//Subida excel
Route::get('subidaExcel', ['as' => 'excel', 'uses' => 'UserController@showExcel']);
Route::post('subidaExcel', ['as' => 'excel', 'uses' => 'UserController@uploadExcel']);

//Subida excel diario
Route::get('subidaExcelDiario', ['as' => 'diario', 'uses' => 'UserController@showExcelDaily']);
Route::post('subidaExcelDiario', ['as' => 'diario', 'uses' => 'UserController@uploadExcelDaily']);

//restaurar contraseña

Route::get('restaurar/{id}', ['as' => 'restore', 'uses' => 'AuthController@restorePassword']);
Route::post('restaurar/{id}', ['as' => 'restore', 'uses' => 'AuthController@changePassword']);
Route::get('info', function () {
    Event::listen('generic.event', function ($client_data) {
        print_r($client_data);
        return BrainSocket::message('generic.event', array('user_id' => 100, 'message' => 'A message from a generic event fired in Laravel!'));
    });

});

Route::get('drawde', function () {
    return View::make('emails.accept');
});


Route::get('refresh/{pass}', function () {

    Mail::send('emails.test', ['message' => 'jajajaja'], function ($message) {
        $message->to('juan2ramos@gmail.com', 'creditos lilipink')->subject('prueba');

    });
});
Route::get('pdf', function () {
    $html = '
<html>
<head>
    <style>
        body{font-family: Georgia font-weight: 100;color:#8d8d8d; font-size: 18px}
        .wrapper{padding: 10px 10px}
        span{border: 1px solid #da0080; padding: 10px 0;text-align: right; text-align: center}
        table {  border-collapse: collapse;  border-spacing: 0;  }
        td {  vertical-align: top; height: 30px  }
        h1, h2,  th, td { font-weight:normal;margin: 0;padding: 0 }
         h1, h2{font-size: 16px}
        img { border: 0;margin: 0;padding: 0 }
        .back{ background: #ffe9f8}
        .table td{border: 1px solid #da0080;}
        .table td {box-sizing: border-box;}
</style>
</head>
<body>
<table width="530"  class="wrapper">

<tr valign="middle">
  <td>
    <img width="200px" src="img/logocreditos.png" alt="" />
  </td>
  <td>
    <h1 style="margin: 10px 0">ESTADO DE CUENTA</h1>
    <h2 style="margin: 10px 0; border: 1px solid  #da0080; padding: 0 10px">Interes de mora</h2>
  </td>
</tr>
<tr>
  <td>
    Nombre  Juan Ramos
  </td>
  <td style="">Feha de facturación
    <div style="width: 195px; display: inline-block; text-align: center; font-size: 14px; ">
      <span style="display: inline-block;width:30px;">12</span>
      <span style="display: inline-block;width:30px;">12</span>
      <span style="display: inline-block;width:30px;">1985</span>
    </div>
  </td>
</tr>
<tr>
  <td>
    Dirección calle 1d
  </td>
  <td>Cupo Total
      <span>1213212</span>
  </td>
</tr>

<tr>
  <td>
    Cédula 80923233
  </td>
  <td>Cupo Disponible
      <span>1213212</span>
  </td>
</tr>
<tr>
  <td>
    Ciudad Bogotá
  </td>
</tr>

<tr  class="back" valign="middle">
  <td>
   PAGUE HASTA
   <span>12</span>
   <span>12</span>
   <span>1285</span>
  </td>
  <td>PAGO MINIMO
      <span>24234324</span>
  </td>
</tr>

<tr class="back padding" valign="middle">
  <td>
   PAGUE TOTAL
   <span>12</span>
  </td>
  <td>PAGO fAVOR
      <span>24234324</span>
  </td>
  <tr>
    <td colspan="2"><br/>
        <table class="table" width="100%"  ">
          <tr style="text-align: center; font-size: 12px" valign="middle">
              <td>COMPRA <br /> NÚMERO</td>
              <td>DD</td>
              <td>MM</td>
              <td>AA</td>
              <td>DETALLE</td>
              <td style="font-size: 8px">TASA <br />INTERES</td>
              <td>VALOR <br /> COMPRA</td>
              <td>CARGOS Y <br /> ABONOS</td>
              <td>SALDO <br /> CRÉDITO <br /> DIFERIDO </td>
              <td>CUOTAS</td>
          </tr>
          <tr height="300px">
            <td height="300px"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table><br/>
    </td>
  </tr>
</tr>
<tr class="back">
  <td> Saldo en mora <span>12weqweqw</span> </td>
  <td> Gastos legales<span>12weqweqw</span> </td>
</tr>

<tr class="back">
  <td> Compras del mes <span>12weqweqw</span> </td>
  <td> Cargos no diferidos<span>12weqweqw</span> </td>
</tr>


<tr class="back">
  <td> Intereses <span>12weqweqw</span> </td>
  <td> Notas Crédito<span>12weqweqw</span> </td>
</tr>

<tr class="back" >
  <td colspan="2"> Honorarios <span>12weqweqw</span> </td>
</tr>

<tr>
<td colspan="2"><p style="text-align: justify">

Cualquier inconformidad favor comunicarla a creditos@innova-quality.com.co, puede enviar comunicación escrita a José Rubiano o Jeimmy Fonseca a la Carrera 20 No 164-13 en Bogotá o comunicarse al PBX: 670 2400 Ext 208 - 133, horario de atención: lunes a viernes de 8:00 a.m. a 5:00 p.m.
Innova Quality S.A.S. reporta a las centrales de riesgo el incumplimiento de su obligación. Apreciado cliente recuerde que de incurrir en mora se dara inicio a la gestión de cobranza que causara gastos correspondientes conforme a las politicas de Innova Quality S.A.S. que pueden ser consultadas en la pagina web:
www.creditos.lilipink.com
</p></td>
</tr>
</table>
</body>
</html>
';
    return PDF::load($html, 'A4', 'portrait')->show();

});