# Zend Project

## Valentin Kajdan 4IW2

Projet de liste de meetups sur une base de Zend Framework 3 + Doctrine

### Lancement du Projet

php et composer sont nécessaires au lancement du projet. Un serveur local également (type wamp, mamp...)
* Cloner le projet
* $ composer install && composer update

### Routes

* **home** (``/``) : Affiche la liste des meetups disponibles.
* **add a meetup** (``/new``) : Affiche le formulaire d'ajout d'un meetup.
* **meetup page** (``/meetup/:id``) : Affiche les détails sur un meetup.
* **update meetup page** (``/meetup/:id/update``) : Affiche le formulaire de modification du meetup.
* **delete meetup page** (``/meetup/:id/delete``) : Route de suppression d'un meetup.

*App en cours de développement...*
