<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @include('layouts.header')
</head>
<body>
    <div class="container">
    <h2>Data Author</h2>
    <br>

    @if (session('status'))
        <h4>{{session('status')}}</h4>
    @endif

    <br>
    <form name="book-save-form" id="book-save-form" action="{{url('/authors/save-authors')}}" method="post">
        @csrf
        <table class="table table-striped">
            <tr>
                <td>Author ID</td>
                <td>:</td>
                <td><input type="text" name="author_id" id="author-id" readonly></td>
            </tr>
            <tr>
                <td>Author Name</td>
                <td>:</td>
                <td><input type="text" name="author_name" id="author-name"></td>

            </tr>
            <tr>
                <td colspan="100">
                    <button type="submit" class="btn btn-primary">Save</button>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <table class="table table-hover">
        <tr>
            <th>No.</th>
            <th>Author ID</th>
            <th>Author Name</th>
            <th colspan="2">Action</th>
        </tr>
        @php($num = 1)
        @foreach ($data as $b)
        <tr class="row-data">
            <td>{{ $num++ }}</td>
            <td>{{ $b['author_id'] }}</td>
            <td>{{ $b['author_name'] }}</td>
            <td>
                <button id="button-edit" class="btn btn-outline-success"
                    data-author="{{ $b['author_id'] }}"
                    data-author="{{ $b['author_name'] }}" >Edit</button>
            </td>
            <td>

                    <button type="submit" class="btn btn-outline-danger">Delete</button>
            </td>
        </tr>
        @endforeach
    </table>
</div>
</body>
</html>
