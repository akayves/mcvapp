<?php 

namespace App\Controllers;

use App\Models\User;

/**
 * * cette class permet de gérer les utilisateurs qui peuvent se connecter
 * * à la partie admin de notre application ou non
 */

 class userController extends Controller {

    /**
     * * cette methode va renvoyer la vue de notre page login
     */
    public function login()
    {
        return $this->view('auth.login');
    }

    /**
     * * cette methode va traiter le formulaire de notre vue login
     */
    public function loginPost()
    {
        $user = (new User($this->getDB()))->getByUsername($_POST['username']);
        
        if(password_verify($_POST['password'], $user->password)) :
           $_SESSION['auth'] = (int)$user->admin;
           return header('Location: /admin/posts?success=true');
           //on passe un message de success à notre url
        else :
            return header('Location: /login');
            /**
             * * on pourrait envoyer une variable errror dans l'url pour les message
             * * d'erreur
             */
            
        endif;
    }
    
    /**
     * * cette methode permet de se deconnecter
     */
    public function logout()
    {
        session_destroy();
        return header('Location: /');
    }

 }