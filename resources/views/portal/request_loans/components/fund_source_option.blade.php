<option></option>
@foreach($sources_list as $item)
    <option value="{{$item['SOURCE_ID']}}">{{$item['SOURCE_DESC']}}</option>
@endforeach
