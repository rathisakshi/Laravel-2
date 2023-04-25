<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
<div class="container w-50">
    <h1 class="text-center mt-5">Add Book</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('books.store') }}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title')  @enderror" id="title" name="title" required>
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" name="author" required>
            @if ($errors->has('author'))
                <span class="text-danger">{{ $errors->first('author') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="publication_date">Publication Date</label>
            <input type="date" class="form-control" id="publication_date" name="publication_date" required>
            @if ($errors->has('publication_date'))
                <span class="text-danger">{{ $errors->first('publication_date') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
            @if ($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-dark">Add</button>
        <button class="btn btn-dark" onclick="location.href='{{ route('books.index') }}'">Cancel</button>

    </form>

</div>


</body>
</html>

