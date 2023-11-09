# Symfony contact
## Parent Arthur
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
Exécute les tests de code codeception
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

Structure de la base de donnée:
- Contact:
  - Id (entier) : id du contact
  - firstname (chaîne de caractère): prénom du contact
  - lastname (chaîne de caractère): nom de famille du contact
  - email (chaîne de caractère): email du contact
