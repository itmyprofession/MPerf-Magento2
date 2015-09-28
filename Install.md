#Install
* [Composer Install](##Composer Install)
* [Manual Install](##Manual Install)
* [Git Install](##Git Install)
* [Setup](##setup)

## Composer Install

1. Go to the root folder of your Magento 2 installation and type

   ```shell
   composer require magento/magento-composer-installer
   composer require tym17/mail-performance
   ```

2. Edit *{Magento}/app/etc/config.php* at the end of the array

  ```diff
  <?php
  return array (
    'modules' =>
    array (
      'Magento_Store' => 1,
      ...
      'Magento_CatalogWidget' => 1,
      'Magento_Wishlist' => 1,
      +'Tym17_MailPerformance' => 1,
      ),
  );
  ```
3. Navigate in your Magento 2 backend to *System/Cache Management* and flush Magento Cache

   * You might need to run `php -f bin/magento setup:upgrade` from your Magento root folder

4. Navigate in your Magento 2 backend to *Store/Configuration/Advanced/Advanced* and check if you can see MailPerformance
