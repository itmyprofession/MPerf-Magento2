# MailPerformance
> Plugin pour Magento2

* [This file in english](https://github.com/tym17/MPerf-Magento2/blob/Release/README.md)
* [Installation](#installation)
* [Lier MailPerformance à Magento 2](#lier-mailperformance-à-magento-2)
* [Maintenance](#maintenance)
* [Liens](#liens)

Ce plugin vous permet de créer ou mettre à jour des cibles MailPerformance et de les placer dans un segment MailPerformance à chaque fois qu'un de vos client effectue un achat.
## Installation
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

## Lier MailPerformance à Magento 2

1. Accédez à la configuration de votre e-Boutique  `Store/Configuration/MailPerformance/Authentification`, puis entrez votre XKey.

2. Sauvegardez puis rafraîchissez le cache de Magento.

3. Accédez au menu `Store/MailPerformance` et cliquez sur le boutton  `Activer`.

## Maintenance

* Si vous avez suivi l'installation avec **composer** (la méthode recommandée) et que vous souhaitez **mettre à jour le plugin**.
  > Naviguez jusqu'à votre dossier racine Magento 2:
  ```shell
  composer require np6/mail-performance-magento
  php -f bin/magento setup:upgrade
  ```

* Pour synchroniser les **champs** et d'autres composants  **MailPerformance** :
  > Accédez au menu `Store/MailPerformance`, cliquez sur le boutton  **Recharger**

## Liens

* [Magento2 Devdocs](http://devdocs.magento.com/)
* [Packagist](https://packagist.org/packages/tym17/mail-performance)
