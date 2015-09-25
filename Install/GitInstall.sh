echo '/!\ This setup is not recomended /!\'
echo '/!\ Please ensure you are in your magento root directory ! /!\'
pause
# Retrieving and setting up module's files
cd app/code
mkdir tym17 && cd tym17
mkdir MPerf
git clone https://github.com/Tym17/MPerf-Magento2.git
cp -Rv MPerf-Magento2/* ./MPerf/
# Enable module
# app/etc/config.php
