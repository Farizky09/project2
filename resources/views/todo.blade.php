<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo list</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.cs" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>

<body class="bg-info">
    <div class="container w-25 mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3>To-do List</h3>
                <form action="{{ route('store') }}" method="POST" autocomplete="off" id="form-add">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="content" id="content" class="form-control" placeholder="Tambah Tugas kamu">
                        <button type="submit" class="btn btn-dark btn-sm px-4"><i class="fas fa-plus"></i></button>
                    </div>
                    <div id="list-todo">
                        
                    </div>

                </form>

            </div>
        </div>
    </div>
   
</body>


</div>


<script type="text/javascript">
    $(document).ready(function() {
        $("#form-add").submit(function(event) {
            event.preventDefault();
            var content = $('#content').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: "{{ route('store') }}",
                data: {
                    content: content
                },
                success: function(result) {

                }
            });
        });
    });

    $(document).ready( function () {
        $.ajax({
                            url: "{{ route('list') }}", 
                            type: 'GET',
                            cache: true, 
                            success: function(response){
                                $.each(response, function (key, value) { 
                                    $('#list-todo').append("<tr>\
                                                <td>"+.content+"</td>\
                                               
                                                </tr>");
                                })
                            }
                            
                        });
</script>

</html>