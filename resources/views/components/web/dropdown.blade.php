<select name="{{$name}}" {{$required}}>

    @if (isses($emptyOption) && $emptyOption==1)
        <option class="dropdown-option" value=""></option>
    @endif

    @foreach ($mydata as $key => $row)
    <option class="dropdown-option" {{ count($mydata)==1 ? "selected" : "" }} value="{{$row['id']}}">{{$row['name']}}</option>
    @endforeach
</select>

