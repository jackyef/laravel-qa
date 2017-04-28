<html>

<head>
    <title>Stud view</title>
</head>

<body>
<a href="{{url('/createform')}}">Insert new student</a>
<table border="1">
    <tr>
       <th>ID</th>
       <th>Name</th>
       <th>Action</th>
    </tr>
    @foreach ($students as $student)
        <tr>
            <td>{{$student->id}}</td>
            <td>{{$student->name}}</td>
            <td>
                <a href="{{url("/view/$student->id")}}">View</a>|
                <a href="{{url("/edit/$student->id")}}">Edit</a>|
                <a href="{{url("/delete/$student->id")}}">Delete</a>
            </td>
        </tr>
    @endforeach
</table>

</body>
</html>