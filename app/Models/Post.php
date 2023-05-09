<?php 

    namespace App\Models;

use DateTime;

    class Post extends Model{

        protected $table = 'posts';

        /**
         * * cette methode permet de formater la colonne created_at en date local
         * @param void
         * @return string
         */
        public function getCreatedAt() : string
        {
            //date_default_timezone_set('Africa/Abidjan');
            return (new DateTime($this->created_at))->format('d/m/Y à h:i');
        }

        /**
         * *cette method va extrait une petite partie de l'article
         * @param void
         * @return string
         */
        public function getExcerpt() : string
        {
            return substr($this->content, 0, 250) . ' ...';   
        }

        /**
         * *cette methode va générer un button html
         * @param void
         * @return string
         */
        public function getButton()
        {
            return <<<html
            <a class="btn btn-primary" href="/posts/$this->id">lire l'article</a>
html;
        }

    }