<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo list</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.cs" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
{{--  
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet" />
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet" />  --}}

</head>

<body class="bg-info">
    <div class="container w-25 mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3>To-do List</h3>
                <form action="{{ route('store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="input-group">
                    <input type="text" name="content" class="form-control" placeholder="Tambah Tugas kamu">
                    <button type="submit" class="btn btn-dark btn-sm px-4"><i class="fas fa-plus"></i></button>
                </div>
            </form>
{{--  // penghitungan tugas  --}}
@if(count($todolists))
<ul class="list-group list-group-flush mt-3">
    @foreach ($todolists as $todolist)
<li class="list-group-item">
    <form action="{{ route('destroy', $todolist->id) }}" method="POST">
        {{ $todolist->content }}
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-link btn-sm float-end"><i class="fas fa-trash"></i></button>
    </form>
     </li>
        
    @endforeach
      </ul>
      @else 
      <p class="text-center mt-3"> Tidak Ada Tugas</p>
       @endif
            </div>
        @if(count($todolists))
        <div class="card-footer">
            Kamu Memiliki {{ count($todolists) }} Tugas tertunda
        </div>
        @else
        @endif
        </div>
    </div>
    
</body>
</html>