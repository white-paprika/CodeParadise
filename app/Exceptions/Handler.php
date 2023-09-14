<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    protected $dontReport = [
        BusinessException::class,
    ];

    public function render($request, Throwable $e)
    {
        if ($e instanceof BusinessException)
        {
            return response()->view('errors.businessException', 
                [
                    'message' => $e->getUserMessage(),
                ]);
        }
        return parent::render($request, $e);
    }

    /** 
     * BusinessException содержит:
     * getMessage = Business exception (В parent конструкторе)
     * getUserMessage = "Строка_указанная_при_создании_объекта"
     * Все остальное наследуется от \Exception (код ошибки, файл, строка и тд)
     * */ 
}
