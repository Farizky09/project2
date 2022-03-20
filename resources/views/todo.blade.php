<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo list</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                        <button type="submit" class="btn btn-dark btn-sm px-4"><i class="fa fa-plus"></i></button>
                    </div>
                    <div id="list-todo" class="mt-2">

                    </div>

                </form>

            </div>
        </div>
    </div>

</body>


<script type="text/javascript">
    $(document).ready(function() { //untuk menyimpan dalam document ready
        listTodo()
        $("#form-add").submit(function(event) {  //form add id dari form yang dipakai
            event.preventDefault(); //mencegah reload halaman ketika klik submit
            var content = $('#content').val();  
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',  //method yang dipakai 
                url: "{{ route('store') }}",  //route untuk function store 
                data: {
                    content: content
                },
                success: function(result) {
                    $('#content').val('')
                    listTodo()
                }
            });
        });
    });

    function listTodo() {

        $.ajax({
            url: "{{ route('list') }}", //route yang dipakai untuk menampilkan list
            type: 'GET', //jenis urlnya
            cache: true,
            success: function(response) {
                $('#list-todo').html('')
                $.each(response, function(key, value) {
                    console.log(value); //menampilkan data value
                //    $('#list-todo').append('<div class="d-flex justify-content-between"><span>' + value.content + '</span> <a onclick="deleteTodo('+value.id+')"><i class="fa fa-trash" aria-hidden="true"></i></a></div>'); //untuk mengisi conten saat dimasukkan otomatis akan ke restart seperti awal (kosongan)
                     $('#list-todo').append('<div class="d-flex justify-content-between"><span>' + value.content + '</span> <span onclick="deleteTodo('+value.id+')" role="button"><i class="fa fa-trash" aria-hidden="true"></i></span></div>');
                })
            }

        });
    }

    function deleteTodo(id) {
        if (confirm("apakah anda yakin akan menghapus ini?")) {  //alert saat menghapus content
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            $.ajax({
                method: 'DELETE',
                url: "/"+id,
                success: function(result) {
                    listTodo()
                }
            });
        }
    }
</script>

</html>