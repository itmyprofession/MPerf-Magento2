#Installation
* [Installation Composer](#installation-composer)
* [Installation Manuelle](#installation-manuelle)
* [Installation Git](#installation-git)
* [Liaison](#liaison)
* [Maintenance](#maintenance)

## Installation Composer

### RECOMANDEE

> Vous trouverez les différentes méthodes d'installation dans le fichier  `Ìnstall_fr.md` . Voici la méthode recommendée.

1. Naviguez jusqu'au dossier racine de votre installation Magento 2 et entrez ces commandes

   ```shell
   composer require magento/magento-composer-installer
   composer require np6/mail-performance-magento
   php -f bin/magento setup:upgrade
   ```

2. Accédez ensuite au menu `System/Cache Management` depuis votre backend et rafraîchissez le cache.

3. Accédez au menu `Store/MailPerformance`.
> Si l'installation a échoué, vous ne verrez pas ce menu.

## Installation Git

### NOT RECOMANDEE

1. Clonez ce repository `git clone https://github.com/NP6/MPerf-Magento2`

2. Copiez collez son contenu dans `{Magento}/app/code/NP6/MailPerformance`

3. Lancez cette commande `php -f bin/magento setup:upgrade` depuis votre dossier racine Magento

4. Accédez au menu `System/Cache Management` et rafraîchissez le cache

5. Accédez au menu `Store/MailPerformance`.
> Si l'installation a échoué, vous ne verrez pas ce menu.

## Installation manuelle

### NON RECOMANDEE

0. Téléchargez ce repository

1. Naviguez depuis votre dossier racine Magento à `app/code`

2. Créez deux dossier suivant ce schéma: `NP6/MailPerformance`

   ```shell
   mkdir NP6 && cd NP6
   mkdir MailPerformance
   ```

3. Utilisez votre client FTP favoris pour transférer le contenu du repository dans le dossier `MailPerformance`

4. Lancez cette commande `php -f bin/magento setup:upgrade` depuis votre dossier racine Magento

5. Accédez au menu `System/Cache Management` et rafraîchissez le cache

6. Accédez au menu `Store/MailPerformance`.
> Si l'installation a échoué, vous ne verrez pas ce menu.

## Liaison

1. Accédez à la configuration de votre e-Boutique  `Store/Configuration/MailPerformance/Authentification`, puis entrez votre XKey.

2. Sauvegardez puis rafraîchissez le cache de Magento.

3. Accédez au menu `Store/MailPerformance` et cliquez sur le boutton  `Activer`.

## Maintenance

### Utilisant Composer

 Pour mettre à jour les fichiers du plugin, rendez vous dans le dossier racine de magento et lancez ces commandes:
 ```shell
 composer update
 php -f bin/magento setup:upgrade
 ```

### Utilisant une autre méthode

Suprimez le contenu du fichier `{Magento}/app/code/NP6/MailPerformance` et recommencez le processus d'installation.
