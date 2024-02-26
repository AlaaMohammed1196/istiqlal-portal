@foreach($data['CURRENCIES'] as $item)
    <tr>
        <th scope="row">{{$item['CURR_NAME']}}</th>
        <td>{{$item['BUY_PRICE']}}</td>
        <td>{{$item['SELL_PRICE']}}</td>
        <td>{{$item['MID_PRICE']}}</td>
    </tr>
@endforeach
