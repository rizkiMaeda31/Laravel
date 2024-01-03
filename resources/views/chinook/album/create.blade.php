<!DOCTYPE html>
<html lang="en">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
    <title>Create New Album</title>
    <body class="container mt-5">
        <form method="POST" action="{{url('api/chinook/album')}}" id="form">
            @csrf
            <h3>Create New Album</h3>
            <div class="form-group">
                <label for="title">Album Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="artist">Artist:</label>
                <select class="form-control" id="artist" name="artist">
                    @foreach($artists as $artist)
                        <option value="{{ $artist->ArtistId }}">{{ $artist->Name }}</option>
                    @endforeach
                </select>
            </div>
            <a type="button" class="btn btn-primary" href="{{url('view/album')}}">Back</a>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </body>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        document.getElementById('form').addEventListener('submit', function (event) {
            // Prevent the default form submission
            event.preventDefault();
    
            // Perform Ajax submission
            $.ajax({
                type: 'POST',
                url: '{{ url('api/chinook/album') }}',
                data: $(this).serialize(),
                success: function (response) {
                    // Open a new tab or window with the desired URL
                    var newTab = window.open('{{ url('view/album') }}/');
                    if (newTab) {
                        newTab.focus();
                    } else {
                        // Handling for browsers with pop-up blockers
                        window.location.href = '{{ url('view/album') }}/';
                    }
                },
                error: function () {
                    console.log('Error in form submission');
                }
            });
        });
    </script>
</html>