<!-- resources/views/albums.blade.php -->
<!DOCTYPE html>
<html lang="en">
{{-- @extends('layouts.app')  You can extend your layout if you have one --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        th.sortable {
            cursor: pointer;
        }
        th.sortable:hover {
            background-color: #f2f2f2;
        }
    </style>
    <title>Album</title>
</head>
<body>    
{{-- @section('content') --}}
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark ">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <span class="nav-link" >Total rows: <span style="color: crimson" id="count">{{ count($albums) }} </span> rows</span>
                    </li>
                    <li class="nav-item">
                        <a type="button" class="btn btn-primary nav-link" href="{{ url('view/album/create') }}">Create New Album</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">More Views</a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{ url('#') }}">Playlist</a></li>
                          <li><a class="dropdown-item" href="{{ url('view/track') }}">Tracks</a></li>
                          <li><a class="dropdown-item" href="{{ url('view/album') }}">Album</a></li>
                          <li><a class="dropdown-item" href="{{ url('view/artist') }}">Artist</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" action="{{ url('view/album/find') }}">
                    <input class="form-control me-2" type="text" placeholder="Search" name="s" id="s">
                    <div class="btn-group">
                        <button class="btn btn-primary" type="submit" ><i class="fa fa-search"></i></button>
                        <a class="btn btn-primary" href="{{ url('view/album/') }}">Reset</a>
                    </div>
                </form>
            </div>
        </div>
    </nav>
    
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-bordered table-hover " style="width: 100%" id="albumTable">
                    <thead class="table-success ">
                        <tr>
                            <th class="text-center text-nowrap sortable" data-column="0">Album ID</th>
                            <th class="text-center sortable" data-column="1">Album</th>
                            {{-- <th>Artist ID</th> --}}
                            <th class="text-center sortable" data-column="2">Artist</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($albums as $album)
                            <tr>
                                <td>{{ $album->AlbumId }}</td>
                                <td>{{ $album->Album }}</td>
                                {{-- <td>{{ $album->ArtistId }}</td> --}}
                                <td>{{ $album->Artist }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" class="btn btn-warning" href="{{ url('view/album/update/'.$album->AlbumId) }}">Update</a>
                                        <a type="button" class="btn btn-danger" href="{{ url('view/album/delete/'.$album->AlbumId) }}">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
{{-- @endsection --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#s').on('keyup',function(){
            // window.alert('view/album/find');
            if ($(this).val() !== "") {
                $.ajax({
                    type : 'get',
                    url : '/view/album/find',
                    data:{'s':$(this).val()},
                    success:function(data){
                        $('tbody').html(data.res);
                        $('#count').html(data.count);
                    },
                    error:function () {
                        console.log('error');
                    }
                });
            }
            else{
                $.ajax({
                    type : 'get',
                    url : '/view/album/find',
                    success:function(data){
                        $('tbody').html(data.res);
                        $('#count').html(data.count);
                    },
                    error:function () {
                        console.log('error');
                    }
                });
            }
        })
        var ascending = true;
        var currentColumn = 0;
        $('#albumTable th.sortable').click(function () {
            // alert($(this).index());
            // Get the column index of the clicked header
            var columnIndex = $(this).data('column');
            if (currentColumn === columnIndex) {
                ascending = !ascending;
            } else {
                ascending = true;
            }

            currentColumn = columnIndex;

            // Make an Ajax request to update table content based on the clicked column
            $.ajax({
                type: 'get',
                url: '/view/album/sort',
                data: { cdix: columnIndex, order: ascending ? 'asc' : 'desc' },
                success: function(data) {
                    // Update the table body with the new data
                    $('#albumTable tbody').html(data.res);
                    $('#count').html(data.count);
                    // console.log('Data loaded successfully');
                },
                error: function() {
                    console.log('Error loading data');
                }
            });
        })
    })
    
</script>
</body>
</html>