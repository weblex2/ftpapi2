<div>

    <select class="dropdown">
    @foreach ($mydata as $key => $row) 
    <option class="dropdown-option" value="{{$row['id']}}">{{$row['name']}}</option>
    @endforeach
    </select>
</div>