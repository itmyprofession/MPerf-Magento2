echo '/!\ This setup is not recomended /!\'
echo '/!\ Please ensure you are in your magento root directory ! /!\'
pause
# Retrieving and setting up module's files
cd app/code
mkdir Tym17 && cd Tym17
mkdir MailPerformance
cp -Rv ../../../MPerf-Magento2/* ./MailPerformance/
# Enable module
# app/etc/config.php
cd ../../..
php -f bin/magento setup:upgrade
