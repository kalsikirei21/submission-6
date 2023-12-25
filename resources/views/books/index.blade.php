<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h2>Data Buku</h2>
    <a class="btn btn-primary" type="submit" href="/authors/index" colspan="100">Add Author</a>
    <br>

    @if (session('status'))
        <h4>{{session('status')}}</h4>
    @endif

    <br>
    <form name="book-save-form" id="book-save-form" action="{{url('/books/save-book')}}" method="post">
        @csrf
        <table class="table table-borderless">
            <tr>
                <td>ID</td>
                <td>:</td>
                <td><input type="text" name="id" id="id" readonly></td>

            </tr>
            <tr>
                <td>Book Name</td>
                <td>:</td>
                <td><input type="text" name="book_name" id="book-name"></td>

            </tr>
            <tr>
                <td>Author</td>
                <td>:</td>
                {{-- <td><input type="text" name="author" id="author"></td> --}}
                <td>
                    <select name="author_id" id="author">
                        <option value="">-- Pilih Author --</option>
                        @foreach ($dataAuthor as $a)
                        <option value="{{ $a['author_id'] }}">{{ $a['author_name'] }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" type="button" class="btn btn-success">Save</button>
                    <button type="button" id="button-reset" type="button" class="btn btn-danger">Reset</button>
                </td>
            </tr>
        </table>

    </form>
    <br>
    <table class="table table-success table-striped">
        <tr>
            <th>No.</th>
            <th>ID</th>
            <th>Book Name</th>
            <th>Author</th>
            <th>Published Date</th>
            <th colspan="2">Action</th>
        </tr>
        @php($num = 1)
        @foreach ($data as $b)
        <tr class="row-data">
            <td>{{ $num++ }}</td>
            <td>{{ $b['id'] }}</td>
            <td>{{ $b['book_name'] }}</td>
            <td>{{ $b['author_name'] }}</td>
            <td>{{ $b['published_at'] }}</td>
            <td>
                <button id="button-edit" class="btn btn-outline-success"
                    data-id="{{ $b['id'] }}"
                    data-name="{{ $b['book_name'] }}"
                    data-author="{{ $b['author_id'] }}" >Edit</button>
            </td>
            <td>
                <form action="{{ url('/books/delete-book?id=').$b['id'] }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <script>
        var button = $('.button-edit')

        $(document).ready(function() {
            clearForm()
        });

        button.each(function(index) {
                $(this).on('click', function(){
                    var id = $(this).data('id')
                    var name = $(this).data('name')
                    var author = $(this).data('author')

                    $('#id').val(id)
                    $('#book-name').val(name)
                    $('#author').val(author)
                });
            });

        $('#button-reset').on('click', function () {
            clearForm()
        })

        function clearForm(){
            $('#id').val('')
            $('#book-name').val('')
            $('#author').val('')
        }

    </script>
</div>
</body>
</html>
