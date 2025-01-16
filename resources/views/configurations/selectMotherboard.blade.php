@if(!empty($motherboards_select))
    <option selected="selected" disabled="disabled" data-qtyram='0' data-price="0">Выберите материнскую плату</option>
    @foreach($motherboards_select as $conf)
        <option value="{{ $conf -> id }}" data-qtyram='{{ $conf -> qty_ram }}' data-price='{{ $conf -> price}}'>{{ $conf -> model }}</option>
    @endforeach
@endif
