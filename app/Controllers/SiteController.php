<?php

namespace App\Controllers;

use App\Models\Book;
use Doctrine\ORM\EntityManager;



class SiteController {
    function index() {
        $books = Book::query()->findAll();
        return view('home.twig', [
            'books' => $books
        ]);
    }

    function create() {
        return view('create.twig');
    }

    function store() {
        $name = request('name');

        $book = new Book();
        $book->setName($name);
        $book->save();

        return redirect('/');
    }

    function edit($id){
        $book = Book::query()->find($id);

        return view('edit.twig', [
            'book' => $book
        ]);
    }

    function update($id){
        $name = request('name');

        $book = Book::query()->find($id);
        $book->setName($name);
        $book->save();

        return redirect('/');
    }

    function destroy($id){
        $book = Book::query()->find($id);
        $book->delete();

        return redirect('/');
    }
}
