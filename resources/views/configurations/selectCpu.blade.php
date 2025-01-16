@if(!empty($cpus_select))
    <option selected="selected" disabled="disabled" data-price="0">Выберите процессор</option>
    @foreach($cpus_select as $conf)
        <option value="{{ $conf -> id }}" data-price='{{ $conf -> price }}'>{{ $conf -> model }}</option>
    @endforeach
@endif
