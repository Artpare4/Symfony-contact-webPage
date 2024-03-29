# Symfony contact
![Static Badge](https://img.shields.io/badge/BUT-S3-teal)
![Static Badge](https://img.shields.io/badge/Symfony-6.3-blue) 
## Parent Arthur

Site web en Symfony listant des contacts. 
Il m'a permis de me familiariser avec les concepts de symfony et doctine orm. Notamment le système de routes, la création d'entité/formulaires avec le makeBundle, le système de migration, etc...

## Installation/Configuration

## Installation du répertoire:
Installer le répertoire:
```
git clone https://iut-info.univ-reims.fr/gitlab/pare0028/symfony-contacts.git
```
Ensuite,placez-vous dans le répertoire du projet et exécutez la commande ci-dessous:
```
composer install
```
### Cs-fixer:
Placez vous dans le répertoire de travail pour télécharger cs-fixer et entrez la commande ci-dessous:
```
composer require friendsofphp/php-cs-fixer --dev
```

## Liste commande

Pour lancer un serveur symfony:
``` 
composer start
```

### Cs-fixer:
Pour lancer les tests cs-fixer:
```
composer text:cs
```

Pour modifier voter code avec cs-fixer:
```
composer fix:cs
```


### Tests:
Crée une nouvelle base de donnée pour les tests  puis les exécutes 
```
composer test:codeception
```

Exécute les tests de cs-fixer et de code codeception
```
composer test
```

### Base de donnée :

Crée une nouvelle base de donnée selon le modèle doctrine et génrère des valeurs aléatoires
```
composer db
```

Structure de la base de données:
- Contact:
  - Id (entier) : id du contact
  - firstname (chaîne de caractère): prénom du contact
  - lastname (chaîne de caractère): nom de famille du contact
  - email (chaîne de caractère): email du contact

### Utilisateurs: 
#### User1 : 
- email : root@example.com
- firstname : Tony
- lastname : Stark
- roles  : ['ROLE_ADMIN']

#### User2:
- email : user@example.com
- firstname : Peter
- lastname : Parker 
- roles : ['ROLE_USER']