# AudioVizualiser

This project work with symfony and node
Use 
    - npm install 
    - composer require
to get dependancies and
    - symfony console make:migration:migrate
    - symfony console doctrine:fixtures:load
to get data and
    - npm run dev
    - symfony serve:start
to run the serveur

fictures are installed on this project, please check fictures documentation
webpack is installed on this project, please check webpack and webpack encore documentation

dans php.ini
    passer upload_max_filesize a 8192k

la bdd est pgSQL avec par défaut
    - DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=14&charset=utf8"
    - db : app
    - mdp : !ChangeMe!
    - port : 5432

Les musiques ont été déposé sur git beurk, à voir pour faire un .zip avec les fixtures pour "simuler" un serveur de fichier

