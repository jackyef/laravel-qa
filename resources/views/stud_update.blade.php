<html>

<head>
    <title>Update</title>
</head>

<body>
<a href="/stud">back to list</a>
<br/>
<form action = "{{url('/edit/submit')}}/{{$student->id}}" method = "post">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
    <input type ="hidden" name="id" value="<?= $student->id?>">
    <table>
        <tr>
            <td>Name</td>
            <td><input type='text' name='stud_name' value="<?= $student->name ?>"/></td>
        </tr>
        <tr>
            <td colspan = '2'>
                <input type = 'submit' value = "Update student"/>
            </td>
        </tr>
    </table>

</form>

</body>
</html>