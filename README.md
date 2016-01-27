#STATUS
MOVED TO BITBUCKET 1/27/2016

#Developers
Alex Lukyanau

#Magento Settings
1. System->Configuration->Design->Package  sas

#Installation
1. Install Ruby+Compass 
   https://gorails.com/setup/ubuntu/14.04 <br/>
```
sudo apt-get update 
sudo apt-get install git-core curl zlib1g-dev build-essential libssl-dev libreadline-dev libyaml-dev libsqlite3-dev sqlite3 libxml2-dev libxslt1-dev libcurl4-openssl-dev python-software-properties 
sudo apt-get install libgdbm-dev libncurses5-dev automake libtool bison libffi-dev 
```

```
curl -L https://get.rvm.io | bash -s stable 
source ~/.rvm/scripts/rvm 
echo "source ~/.rvm/scripts/rvm" >> ~/.bashrc 
rvm install 2.1.2 
rvm use 2.1.2 --default
ruby -v
```
2. http://blog.acrona.com/index.php?post/2014/05/15/Installer-Fondation-et-Compass/sass-sur-Ubuntu-14.04
```
sudo apt-get install ruby-compass
gem install compass
```

#SASS Compilation
```
cd skin/frontend/sas/default/scss/
compass watch
```

#Additional options 

1. Usage ifconfig at the xml compare by value. Example: 

```
<action method="addItem" ifconfig="sas/sas_group/css_framework" condition="bootstrap" ><type>skin_css</type><name>css/bootstrap.css</name></action> 
```

#Extensions

1. Sashas_Slideshow <br/>
http://www.magentocommerce.com/magento-connect/slideshow-6.html <br/>


#Magmi Settings

1. Default UN/PW: magmi. After it configured it uses admin credentials <br/>
2. After first Login you need to fill databse connection credentials. Save Profile and Save Global parameters. <br/>
3. Filesystem Path to magento directory: ../../../  <br/>
4. Enable  Image attributes processor v1.0.33a  <br/>
4.1 Image search path:  var/import/images <br/>
4.2 Image import mode: Yes
5. Enable  Value Trimmer for select/multiselect v0.0.3  <br/>
6. Enable Configurable Item processor v1.3.7a
