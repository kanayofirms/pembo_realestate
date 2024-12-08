<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toastr Notification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css">
</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4>Toastr Notification</h4>
            </div>

            <div class="card-body">
                <a href="{{ route('notification_list', 'success') }}" class="btn btn-success">Success</a>
                <a href="{{ route('notification_list', 'info') }}" class="btn btn-info">Info</a>
                <a href="{{ route('notification_list', 'warning') }}" class="btn btn-warning">Warning</a>
                <a href="{{ route('notification_list', 'error') }}" class="btn btn-danger">Error</a>
            </div>
        </div>
    </div>

    @include('notifications.notifications')
</body>

</html>
