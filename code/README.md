Up & Running
1. Download & Install Vagrant + VirtualBox
First thing you need to do is install VirtualBox:

https://www.virtualbox.org/wiki/Downloads

and Vagrant:

http://www.vagrantup.com/downloads.html


2. Boot Ubuntu 

Boot the Vagrant Box:

vagrant up
(this will install ubuntu and node.js so may take a few minutes - depending on your internet connection)



3. Login

vagrant ssh

4. Install dependencies 


Inside the code/ folder run

Composer install

To access database 
User homestead
Pass secret

To run migrations first create the database test

restore db from dump file.


when finish you can access  the page in 

http://products.local/
