<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crosearchssorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>

<div class="container">
    <div class="container-fluid">
        <div class="row bg-dark text-light py-2">


            <h1 class="books-heading mx-auto mt-3">BookWise.com</h1>


            <div class="col-12 mt-3 ">
                <form action="" class="form-inline">
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="search" name="search" id="" placeholder="Search" class="form-control-sm"
                               value="{{$search}}">

                    </div>
                    <div class="btn-group mb-2" role="group">
                        <button class="btn btn-dark ">Search</button>
                        <a href="{{url('/books')}}">
                            <button class="btn btn-dark ">Reset</button>
                        </a>
                    </div>
                    <div class="col-6 text-end ml-10 pull-right logout">
                        <button class="btn btn-dark mb-2"
                                onclick="window.location.href='{{ route('logout', $books) }}'">
                            Logout
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @if(count($books)>0)
        <table class="table">
            <thead class="table-dark">
            <tr class="table-active">
                <th>Title</th>
                <th>Author</th>
                <th>Publication Date</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">

            @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publication_date->format('d/m/Y') }}</td>
                    <td>{{ $book->description }}</td>
                    <td>
                        {{--                    <button class="btn btn-dark"><a class="anchor" href="{{ route('books.edit', $book) }}">Edit</a>--}}
                        {{--                    </button>--}}
                        <button class="btn btn-dark" onclick="window.location.href='{{ route('books.edit', $book) }}'">
                            Edit
                        </button>


                        <form method="POST" action="{{ route('books.destroy', $book) }}" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-dark">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    @endif
    <div>
        <a href="{{ route('books.create') }}" class="btn btn-secondary addbook">Add Book</a>
    </div>
</div>
<div class="pagination justify-content-center mt-4">
    {{$books->links('pagination::simple-bootstrap-4')}}


</div>
</body>
</html>
