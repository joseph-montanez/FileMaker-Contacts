## Installing

### Prerequests

 - VirtualBox
 - Vagrant

### Setup Homestead

Homestead of a laravel / lumen environment that provides the same setup for each person. In this directory there is a `Homestead.yaml`. Please edit that file for the follow

	folders:
    - map: "C:/Users/xingo/Documents/NetBeansProjects/Contacts/backend"
      to: "/home/vagrant/backend"


Then change the `map` variable to your own directory location. Once you change the `map` to your path, then run the following:

	vendor\bin\homestead up

Now if that does not work, then you may need to setup a few other things. For example you may need an ssh key generated:

	ssh-keygen.exe -t rsa -b 4096 -C "your@email.com"

Also there might be an issue with the box not existing to rather than running Homestead you can run Vagrant:

	vagrant up



