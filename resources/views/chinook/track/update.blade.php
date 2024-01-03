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
        <title>Update Track {{ $fields['TrackName']['value'] }}</title>
    </head>
    
    <body class="container-fluid mt-2">
        <form method="POST" action="{{url('api/chinook/track')}}" id="form">
            @csrf
            @method('PUT')
            <h3>Update Track</h3>
            <div class="row">
                @foreach ($fields as $fieldName => $field)
                    <div class="col-6">
                    <div class="form-group">
                        <label for="{{ $fieldName }}">{{ $field['label'] }}:</label>
                        
                        @if ($field['type'] == 'text')
                            <input type="text" class="form-control"
                                   id="{{ $fieldName }}" name="{{ $fieldName }}" 
                                   {{ $field['required'] ? 'required' : '' }}
                                   value="{{ $field['value'] ?? ''}}"
                                   {{ $field['isDisabled'] ? '':''}}
                            >
                        
                        @elseif ($field['type'] == 'select')
                            <select class="form-control form-select" id="{{ $fieldName }}" name="{{ $fieldName }}" 
                            {{ $field['required'] ? 'required' : '' }}
                            {{ $field['isDisabled'] ? '':''}}
                            >
                                @foreach ($field['options'] as $value => $key)
                                    <option value="{{ $value }}" {{ isset($field['selectedId']) && $field['selectedId'] == $value ? 'selected' : '' }}>
                                        {{ $key }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    </div>
                @endforeach
            </div>
                <div class="form-group">
                    <a type="button" class="btn btn-primary" href="{{url('view/track')}}">Back</a>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
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
                url: '{{ url('api/chinook/track') }}',
                data: $(this).serialize(),
                success: function (response) {
                    // Open a new tab or window with the desired URL
                    var newTab = window.open('{{ url('api/chinook/track') }}/'+response.req.id, '_blank');
                    if (newTab) {
                        newTab.focus();
                    } else {
                        // Handling for browsers with pop-up blockers
                        window.location.href = '{{ url('api/chinook/track') }}/'+response.req.id;
                    }
                },
                error: function () {
                    console.log('Error in form submission');
                }
            });
        });
    </script>
</html>