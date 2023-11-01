Bonjour,  pour installer le projet blog_fati, veuillez suivre ces étapes:

1/ Clonez le projet : git clone https://github.com/fatialk/blog_fati.git

2/ Lancez la commande : composer install 

3/ Créez une base de données nommée "blog_fati" et importez y le fichier sql depuis le dossier "bdd" se trouvant à la racine de ce répertoire.

4 / Pour tester le formulaire de contact : 

        4.1 / Allez dans le fichier : DefaultController.php au niveau de la fonction contactAction()
        4.2 / Ajouter les données de votre serveur SMTP : (Host, Username, Password)
        4.3 / Au niveau de //Recipients: Ajouter l'adresse email qui sert pour l'envoi et celle ou vous souhaiterez recevoir le message de contact


