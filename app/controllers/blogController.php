<?php 

namespace App\Controllers;
/**
 * * cette class permet de gerer les blog
 */
class blogController{

    public function index()
    {
        echo 'je suis la home page';
    }

    /**
     * * cette methode affiche un article particulier
     * @param id
     * @return void
     */
    public function show(int $id)
    {
        echo 'je suis le post '. $id;
    }
}