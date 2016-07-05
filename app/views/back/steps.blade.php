<form action="{{route('updateDatabase')}}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <select name="step" id="step">
        <option value="1">Paso 1</option>
        <option value="2">Paso 2</option>
        <option value="3">Paso 3</option>
        <option value="4">Paso 4</option>
    </select>
    <input type="file" id="file" name="file">
    <input type="submit">
</form>
