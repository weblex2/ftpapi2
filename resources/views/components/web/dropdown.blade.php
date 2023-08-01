<div>

    <select name="{{$name}}" {{ $attributes->merge(['class' => 'card']) }}>
    @foreach ($mydata as $key => $row)
    <option class="dropdown-option" value="{{$row['id']}}">{{$row['name']}}</option>
    @endforeach
    </select>
</div>
