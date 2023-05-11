<?php 
namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * * cette class gère nos exceptions personnalisées
 */
class NotFoundException extends Exception {

    public function __construct(string $message = "", int $code = 0, Throwable|null $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * * cette method affiche les erreurs 404
     */
    public function error404()
    {
        http_response_code(404);
        require VIEWS . 'errors/404.php';
    }
}
