<!DOCTYPE html>
<html>
<head>
    <title>Edit Book - Laravel CRUD Application</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">

</head>
<body>
<div class="container w-50">


    <main>
        <h1 class="text-center mt-5">Edit Book</h1>
        <form method="POST" action="{{ route('books.update', $book) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $book->title) }}" required>
                @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $book->author) }}" required>
                @if ($errors->has('author'))
                    <span class="text-danger">{{ $errors->first('author') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="publication_date">Publication Date:</label>
                <input type="date" class="form-control" id="publication_date" name="publication_date" value="{{ old('publication_date', $book->publication_date->format('Y-m-d')) }}" required>
                @if ($errors->has('publication_date'))
                    <span class="text-danger">{{ $errors->first('publication_date') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required>{{ old('description', $book->description) }}</textarea>
                @if ($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-dark">Update</button>
        </form>
    </main>
</div>
</body>
</html>
