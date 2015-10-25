#Developers
Alex Lukyanau

#Magento Settings
1. System->Configuration->Design->Package  sas

#Instalaltion
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

#Additional options 

1. Usage ifconfig at the xml comapre by value. Example: 

```
<action method="addItem" ifconfig="sas/sas_group/css_framework" condition="bootstrap" ><type>skin_css</type><name>css/bootstrap.css</name></action> 
```
