# Development Cluster GitOps

### Apache HTTP Server Configuration
##### <code># ansible-playbook apache2.yaml</code>
/etc/apache2/ports.conf  
/etc/apache2/conf-available/api.conf  
/etc/apache2/conf-available/base-view.conf  
/etc/apache2/conf-available/userportal.conf  
/etc/apache2/sites-available/000-default.conf  
/etc/apache2/sites-available/default-ssl.conf  

### Apache HTTP Server Web Content
##### <code># ansible-playbook apache2-content.yaml</code>
/var/www/html/constants.php  

### Shorewall Firewall Configuration
##### <code># ansible-playbook shorewall.yaml</code>
/etc/shorewall/rules  
