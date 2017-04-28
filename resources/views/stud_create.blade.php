<html>

<head>
    <title>Profile</title>
</head>

<body>
<form action = "{{url('/create')}}" method = "post">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

    <table>
        <tr>
            <td>Name</td>
            <td><input type='text' name='stud_name' /></td>
        </tr>
        <tr>
            <td colspan = '2'>
                <input type = 'submit' value = "Add student"/>
            </td>
        </tr>
    </table>

</form>

</body>
</html>