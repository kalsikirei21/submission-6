<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Authors\AuthorController;
use App\Http\Controllers\Controller;
use App\Models\Books;
use Exception;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(){

        $model = new Books();
        $data = $model->select(
            'books.id',
            'book_name',
            'authors.author_id',
            'authors.author_name',
            'published_at',
        )
        ->leftJoin('authors', 'books.author_id', '=', 'authors.author_id')
        ->get()->toArray();

        $dataAuthor = AuthorController::getAuthors();

        return view('books/index', compact('data', 'dataAuthor'));
    }

    public function saveBook(Request $request){
        $post = $request->post();

        $body['id'] = $post['id'];
        $body['book_name'] = $post['book_name'];
        $body['author_id'] = $post['author_id'];

        $sukses = 'Data Sukses Disimpan!';
        $gagal = 'Data Gagal Disimpan!';

        if (isset($body['id'])) {
            $result = self::updateBook($body);
        } else {
            $result = self::createBook($body);
        }

        if ($result == true) {
            return redirect('books/index')->with('status', $sukses);
        } else {
            return redirect('books/index')->with('status', $gagal);
        }
    }

    private function createBook($body){

        $model = new Books();
        try{
            $sukses = 'Data Sukses Disimpan!';
            $gagal = 'Data Gagal Disimpan!';
            if(isset($body['book_name'])){
                $model->create($body);
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {
            return false;
        }
    }

    private function updateBook($body){
        $model = new Books();
        try{
            $sukses = 'Data Sukses Disimpan!';
            $gagal = 'Data Gagal Disimpan!';
            if(isset($body['book_name'])){
                $model->where('id', $body['id'])->update($body);
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {
            return false;
        }
    }

}
