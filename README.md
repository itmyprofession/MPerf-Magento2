# MailPerformance
> A plugin for Magento 2

* [Ce fichier en français](https://github.com/np6/MPerf-Magento2/blob/Release/LISEZMOI.md)
* [Install](#Install)
* [Linking MailPerformance to Magento 2](#Linking-MailPerformance-to-Magento-2)
* [Maintainance](#Maintainance)
* [Links](#Links)

## Install
> You will find more installation methods in the `Ìnstall.md` file. however this is the recomended one.

1. Go to the root folder of your Magento 2 installation and type

   ```shell
   composer require magento/magento-composer-installer
   composer require np6/mail-performance
   php -f bin/magento setup:upgrade
   ```

2. Navigate in your Magento 2 backend to `System/Cache Management` and flush Magento Cache

3. Navigate in your Magento 2 backend to `Store/MailPerformance`
> if the installation didn't work, you will not see the menu.

## Linking MailPerformance to Magento 2

1. Navigate to `Store/Configuration/MailPerformance/Authentification`, enter your XKey, save and flush Magento Cache

2. Navigate to `Store/MailPerformance` and click on the `Àuthenticate` button.

## Maintainance

* If you followed the installation process using **composer** (the default/recomended one) and would like to **update the plugin**.
  > Navigate to your Magento 2 root and type those commands:
  ```shell
  composer require np6/mail-performance
  php -f bin/magento setup:upgrade
  ```

* To refresh **fields** and other **MailPerformance** components :
  > Navigate to `Store/MailPerformance` and click on the **Reload** button

## Links

* [Magento2 Devdocs](http://devdocs.magento.com/)
* [Packagist link](https://packagist.org/packages/np6/mail-performance)
