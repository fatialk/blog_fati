Bonjour, pour installer le projet blog_fati, veuillez suivre ces étapes:

1/ Clonez le projet : git clone https://github.com/fatialk/blog_fati.git

2/ A la racine du projet, lancez la commande : composer install

3/ Importez dans votre base de données le fichier sql qui se trouve dans le dossier "bdd".

4/ Renommer le fichier .env.example en .env et complétez la configuration DATABASE et MAILER:
## DATABASE ##
DB_HOST= Serveur Mysql
DB_NAME= nom de la base de données
DB_USERNAME= nom de l'utilisateur de la BDD
DB_PASS= mot de passe de la BDD
## MAILER ##
MAILER_SERVER= Configurer le serveur SMTP
MAILER_USERNAME= Configurer son adresse utilisateur
MAILER_PASS= Configurer son mot de passe utilisateur
MAILER_ADDRESS_RECEIVER= Configurer l'adresse email qui va recevoir le message de contact


Ci-dessous le rapport qualité du code réalisé par CODACY:
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/d12d277c30814035839f7d09e36ac6b6)](https://app.codacy.com/gh/fatialk/blog_fati/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)
