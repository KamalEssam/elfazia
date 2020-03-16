
<table id="table-data" class="table table-hover  ">
        <thead class="thead-dark">
    <tr>
        <th>code</th>
        <th>المستوي</th>
        <th>درجتك</th>
        <th>الدرجة الكاملة</th>
    </tr>
    </thead>
    <tbody>
        @foreach($collection as $item)
            <tr>
                <td>{{$item->code}}</td>
                <td>{{$item->level->name}}</td>
                <td>{{$item->studentGrade}}</td>
                <td>{{$item->totalGrade}}</td>
            </tr>

            @endforeach
    </tbody>
</table>

