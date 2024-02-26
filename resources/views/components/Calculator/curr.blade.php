<option></option>
@foreach($currencies as $item)
    <option value="{{$item['CURR_ID']}}">{{$item['CURR_NAME']}}</option>
@endforeach
