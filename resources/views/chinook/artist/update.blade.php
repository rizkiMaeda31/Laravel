<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            body {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                margin: 0;
            }

            .container {
                width: 300px; /* Adjust the width as needed */
            }

            select {
                max-width: 100%;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        </style>
        <title>Update Artist {{ $current->Name }}</title>
    </head>
    
    <body class="container mt-5">
        <form method="POST" action="{{url('api/chinook/artist')}}" id="form">
            @csrf
            @method('PUT')
            <h3>Update Artist</h3>
            <div class="form-group">
                <label for="name">Artist Name:</label>
                <input type="text" class="form-control" id="title" name="name" required value="{{$current->Name}}">
                <input type="text" class="form-control" hidden name="id" readonly value="{{$current->ArtistId}}">
            </div>
            <a type="button" class="btn btn-primary" href="{{url('view/artist')}}">Back</a>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </body>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        document.getElementById('form').addEventListener('submit', function (event) {
            // Prevent the default form submission
            event.preventDefault();
    
            // Perform Ajax submission
            $.ajax({
                type: 'PUT',
                url: '{{ url('api/chinook/artist') }}',
                data: $(this).serialize(),
                success: function (response) {
                    // Open a new tab or window with the desired URL
                    var newTab = window.open('{{ url('api/chinook/artist') }}/'+response.req.id, '_blank');
                    if (newTab) {
                        newTab.focus();
                    } else {
                        // Handling for browsers with pop-up blockers
                        window.location.href = '{{ url('api/chinook/artist') }}/'+response.req.id;
                    }
                },
                error: function () {
                    console.log('Error in form submission');
                }
            });
        });
    </script>
</html>