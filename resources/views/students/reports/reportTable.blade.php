
<table id="table-data" class="table table-hover  ">
        <thead class="thead-dark">
    <tr>
        <th>code</th>
        <th>المستوي</th>
        <th>تصحيح الأسئلة المقالية</th>
        <th>درجتك</th>
        <th>الدرجة الكاملة</th>
    </tr>
    </thead>
    <tbody>
        @foreach($collection as $item)
            <tr>
                <td>{{$item->code}}</td>
                <td>{{$item->level->name}}</td>
                <td><a class="btn btn-primary" style="color:white" href="{{route("students.banks.correction")}}?bank_id={{$item->id}}&student_id={{$student_id}}&isExam={{$isExam}}">
                        @if(request("isExam") == 1)
                            تصحيح الأختبار
                        @else
                            تصحيح بنك الأسئلة
                        @endif
                    </a></td>
                <td>{{$item->studentGrade}}</td>
                <td>{{$item->totalGrade}}</td>
            </tr>

            @endforeach
    </tbody>
</table>

