#Install
* [Composer Install](##Composer Install)
* [Manual Install](##Manual Install)
* [Git Install](##Git Install)
* [Setup](##setup)
* [Maintainance](##Maintainance)

## Composer Install

### RECOMENDED

1. Go to the root folder of your Magento 2 installation and type

   ```shell
   composer require magento/magento-composer-installer
   composer require tym17/mail-performance
   ```

2. Run `php -f bin/magento setup:upgrade` from your Magento root folder

3. Navigate in your Magento 2 backend to `System/Cache Management` and flush Magento Cache

4. Navigate in your Magento 2 backend to `Store/Configuration/Advanced/Advanced` and check if you can see MailPerformance

## Git Install

### NOT RECOMENDED

1. Clone this repository `git clone https://github.com/NP6/MPerf-Magento2`

2. Copy and paste the content of it to `{Magento}/app/code/NP6/MailPerformance`

3. Run `php -f bin/magento setup:upgrade` from your Magento root folder

4. Navigate in your Magento 2 backend to `System/Cache Management` and flush Magento Cache

5. Navigate in your Magento 2 backend to `Store/Configuration/Advanced/Advanced` and check if you can see MailPerformance

## Manual Install

### NOT RECOMENDED

0. Download this repository

1. Navigate from your root folder to `app/code`

2. Create 2 directory following this scheme: `NP6/MailPerformance`

   ```shell
   mkdir NP6 && cd NP6
   mkdir MailPerformance
   ```

3. Using your favorite FTP client/methods transfert the content of this repository inside the freshly created `MailPerformance` directory

4. Run `php -f bin/magento setup:upgrade` from your Magento root folder

5. Navigate in your Magento 2 backend to `System/Cache Management` and flush Magento Cache

6. Navigate in your Magento 2 backend to `Store/Configuration/Advanced/Advanced` and check if you can see MailPerformance


## Maintainance

### Using composer

 To update the MailPerformance module, navigate to your Magento 2 root folder and execute the following command:
 ```shell
 composer update
 php -f bin/magento setup:upgrade
 ```

### Using an other method

Delete and follow again the installation of the module.
