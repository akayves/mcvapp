<?php 

namespace App\Controllers;

use App\Models\User;
use App\Validation\Validator;
use TypeError;

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
        /**
         * * validation des données
         */
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required']
        ]);
        
        try{
            $user = (new User($this->getDB()))->getByUsername($_POST['username']);
            if(password_verify($_POST['password'], $user->password)) :
                $_SESSION['auth'] = (int)$user->admin;
                return header('Location: /admin/posts?success=true');
                //on passe un message de success à notre url
             else :
                //return header('Location: /login');
                 $errors['username'][] ="nom d'utilisateur ou mot de passe incorrect";
             endif;
        }catch(TypeError $e){
            $errors['username'][] ="nom d'utilisateur ou mot de passe incorrect";
        }

        if($errors) {
            $_SESSION['errors'][] = $errors;
            return header('Location: /login');
            exit;
        }          
        
        
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