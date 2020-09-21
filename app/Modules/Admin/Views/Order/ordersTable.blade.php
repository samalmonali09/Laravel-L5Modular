
{{--Created by  Monali Samal
      * @author Monali Samal (monalisamal@globussoft.in)
--}}



<html>
@if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-success">
        {{ session('error') }}
    </div>
@endif
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <h1 style="color: #23527c">OrderList</h1>
</head>

<body>

<form action = "/admin/ordersAdds" method = "post">

    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">

    <table>


        <tr>
            <td>order_id</td>
            <td><input type = "text" name = "order_id" required /></td>
        </tr>

        <tr>
            <td>user_id</td>
            <td><input type = "text" name = "user_id" required /></td>
        </tr>
        <tr>
            <td>tx_id</td>
            <td><input type = "text" name = "tx_id" required /></td>
        </tr>

        <tr>
            <td>package_id</td>
            <td><input type = "text" name = "package_id"  required/></td>
        </tr>
        <tr>
            <td>autolikes_id</td>
            <td><input type = "text" name = "autolikes_id"  required/></td>
        </tr>

        <tr>
            <td>subscription_id</td>
            <td><input type = "text" name = "subscription_id"  required/></td>
        </tr>
        <tr>
            <td>order_url</td>
            <td><input type = "text" name = "order_url"  required/></td>
        </tr>
        <tr>
            <td>url_type</td>
            <td><input type = "text" name = "url_type"  required/></td>
        </tr>
        <tr>
            <td>start_count</td>
            <td><input type = "text" name = "start_count"  required/></td>
        </tr>
        <tr>
            <td>end_count</td>
            <td><input type = "text" name = "end_count"  required/></td>
        </tr>
        <tr>
            <td>quantity</td>
            <td><input type = "text" name = "quantity"  required/></td>
        </tr>
 <tr>

            <td>quantity_done </td>
            <td><input type = "text" name = "quantity_done"  required/></td>
        </tr>

        <tr>
            <td>comment_id</td>
            <td><input type = "text" name = "comment_id"  required/></td>
        </tr>
        <tr>
            <td>start_time</td>
            <td><input type = "text" name = "start_time"  required/></td>
        </tr>
        <tr>
            <td>orders_per_run</td>
            <td><input type = "text" name = "orders_per_run"  required/></td>
        </tr>
        <tr>
            <td>time_interval</td>
            <td><input type = "text" name = "time_interval"  required/></td>
        </tr>
        <tr>
            <td>status</td>
            <td><input type = "text" name = "status"  required/></td>
        </tr>
        <tr>
            <td>added_time</td>
            <td><input type = "text" name = "added_time"  required/></td>
        </tr>
        <tr>
            <td>updated_time</td>
            <td><input type = "text" name = "updated_time"  required/></td>
        </tr>
        <tr>
            <td colspan = "2" align = "center">
                <button type = "submit" class="btn btn-success" value = "Post" />Submit</button>
            </td>
        </tr>
    </table>
</form>
<a href="/admin/logout"><button type="button" class="btn btn-info"> Logout</button></a>

</body>
</html>
