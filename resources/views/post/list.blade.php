<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Post List</title>
    <link rel="stylesheet" href="{{ asset('bootstarp/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
</head>

<body>
    <div class="container">
        <div class="row" style="margin-top: 45px">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Post </div>
                     <div class="card-body">
                      .......
                     </div>
                   
                </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                  <div class="card-header">Add New Post</div>
                  <div class="card-body">
                    <form action="{{ route('add.post') }}"> method="POST" id="add-post-form">
                        @csrf 
                        <div class="form-group">
                            <label for="">Judul</label>
                            <input type="text" class="form-control" name="judul" placeholder="Masukkan Judul Post">
                            <span class="text-danger error-text" judul_error></span>
                        </div>
                      <div class="form-group">
                          <label for="">Isi</label>
                          <input type="text" class="form-control" name="isi" placeholder="Masukkan Isi Post">
                          <span class="text-danger error-text" isi_error></span>
                      </div>
                      <div class="form-group">
                        <label for="">Gambar</label>
                        <input type="file" class="form-control" name="gambar" placeholder="Masukkan Gambar Post">
                        <span class="text-danger error-text" gambar_error></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success">SAVE</button>
                    </div>
                    </form>
                  </div>
              </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script>
        toastr.options.preventDuplicates = true;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function(){
            //ADD NEW POST
            $('#add-post-form').on('submit', function(e){
                e.prevenDevault();
                var form =this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                      $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.code == 0){
                            $.each(data.error, function(prefix, val){
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            $(form)[0].reset();
                            //alert(data.msg);
                            toastr.success(data.msg);
                        }

                    }
                });
            });
        });


    </script>

</body>

</html>
