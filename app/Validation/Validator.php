<?php 
namespace App\Validation;

/**
 * * cette se charge de faire la validation des formulaire
 */
class Validator{
    private $data;
    private $errors;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * * cette methode traite la validation des données
     * @param array rules contiendra les donnée envoyé dans le formulaire
     * @return array 
     */
    public function validate(array $rules) : ?array
    {
        //$name represente les names de d'un formulaire et les valeurs des input
        foreach ($rules as $name => $rulesArray) {
            if(array_key_exists($name, $this->data)){
                foreach ($rulesArray as $rule) {
                    switch ($rule) {
                        case 'required':
                            $this->required($name, $this->data[$name]);
                            break;
                        case substr($rule, 0, 3) === 'min':
                            $this->min($name, $this->data[$name], $rule);
                        default:
                            # code...
                            break;
                    }
                }
            }
        }
        return $this->getErrors();
    }

    /**
     * * cette methode va se charger les champs require dans notre formulaire
     * @param string name le name d'un input du formulaire
     * @param string value la value d'un input du formulaire
     * @return void
     */
    public function required(string $name, string $value)
    {
        $value = trim($value);

        if(!isset($value) || is_null($value) || empty($value)) {
            $this->errors[$name][] = "{$name} est requis.";
        }
    }

    /**
     * * cette methode se charge de vérifier la valeur minimum requis pour un input
     * @param string name le name d'un input d'un formlaire
     * @param string value la value d'un input d'un formlaire
     * @param string rule la règle de validation
     * @return void
     */
    public function min(string $name, string $value, string $rule)
    {
        preg_match_all('/(\d+)/', $rule, $matches);
        $limit = (int) $matches[0][0];
        if(strlen($value) < $limit){
            $this->errors[$name][] = "{$name} doit avoir minimun {$limit} caractères.";
        }
    }

    /**
     * * un getter de notre attribut errors
     */
    public function getErrors() : ?array
    {
        return $this->errors;
    }
    

}