<option value=""></option>
@foreach($list as $item)
    <option value="{{$item['VALUE']}}">{{$item['LABEL']}}</option>
@endforeach
