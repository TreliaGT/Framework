<?php 

namespace App\Controllers;
use GGCode\framework\Http\Response;
use GGCode\framework\Controllers\AbstractController;
use App\Models\Book;

class BookController extends AbstractController {

    public function show(int $id): Response {
        $data = [
            'title' => $id,
        ];

        return $this->render('book', $data);
    }

    public function create(): Response {

        return $this->render('createbook');
    }

    public function store() : void{
        $book = new Book();
        $book->setTitle($this->request->getPostParams('title'));
        $book->setBody($this->request->getPostParams('body'));
        $book->save();
        dd($book);
    }
}
