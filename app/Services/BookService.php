<?php

namespace App\Services;

use App\DTO\Book\StoreDTO;
use App\DTO\Book\UpdateDTO;
use App\Exceptions\BusinessException;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BookService 
{
    public function filterBooks(){
        return QueryBuilder::for(Book::class)
            ->allowedFilters([
                'name',
                AllowedFilter::scope('price_range'), 
                AllowedFilter::scope('genres', 'selected_genres'), //here request's key doesnt match with scope name => selected_genres is an alias (scope name is scopeSelectedGenres but filter handles "genres" array (check form in view))
                ])
            ->allowedSorts([
                'created_at',
                'price',
                'name',
                'release_year',
                'items_in_stock',
            ])
            ->with('genre')
            // ->with('authors')
            ->get();
    }

    /**
     * @param StoreBookDTO $DTO
     * @return Book $book
     * Function runs in try-catch using DB transaction
     * 
     * Behaviour:
     * 1. Creates a Book model instance, using data form $DTO
     * 2. Handles file uploading
     *  - checking if file exists and us valid
     *  - generating new file name
     *  - moving file to public/images/books/
     *  - generating path field for new book record in DB
     * 3. Attaches authors to book (m2m)  
     * 
     */
    public function storeBook(StoreDTO $dto): void
    {
        try{
            DB::beginTransaction();

            // throw new BusinessException("I was called in BookService::storeBook()");

            $book = new Book;
            $book->name = $dto->name;
            $book->description = $dto->description;
            $book->price = $dto->price;
            $book->items_in_stock = $dto->items_in_stock;
            $book->release_year = $dto->release_year;
            $book->translator = $dto->translator;
            $book->genre_id = $dto->genre_id;
            $book->path = '';
            
            // Uploading image 
            if($dto->file !== null){
                $book = $this->uploadImage($book, $dto->file);
            }
            // Saving
            $book->save();
            // Attaching authors to book
            $authors_ids = $dto->authors;
            $book->authors()->attach($authors_ids);
            
            DB::commit();

        } catch(\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    public function updateBook(UpdateDTO $dto, Book $book): void
    {    
        try{
            DB::beginTransaction();
            
            // throw new BusinessException("I was called in BookService::updateBook()");
        
            $book->name = $dto->name;
            $book->description = $dto->description;
            $book->price = $dto->price;
            $book->items_in_stock = $dto->items_in_stock;
            $book->release_year = $dto->release_year;
            $book->translator = $dto->translator;
            $book->genre_id = $dto->genre_id;
            $book->path = '';

            // Uploading image 
            if($dto->file !== null){
                $book = $this->uploadImage($book, $dto->file);
            }
            // Saving
            $book->save();
            // Attaching authors to book
            $authors_ids = $dto->authors;
            $book->authors()->sync($authors_ids);
           
            DB::commit();

        } catch(\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function UploadImage(Book $book, $file)
    {
        // Checking if file isn't null, that it's actually a file and is valid
        if ($file == null) {
            throw new BusinessException("File is null.");
        }

        if (!($file->isFile() && $file->isValid())) {
            throw new BusinessException("Some problem with file.");
        }

        // Generating a new file name as file extension concatenated to current time (for uniqueness) 
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        // moving file to public/images directory with new name
        $file->move(public_path('images/books/'), $fileName);
        // making a path for db
        $book->path = 'images/books/' . $fileName;

        return $book;
    }
}