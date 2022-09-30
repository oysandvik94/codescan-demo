
### Roundcube plugin "user_alias"

 Plugin for allows users to log in using aliases (user and/or domain) from Postfix
 This only works with the Postfix database!!!


# Install

 1. Place this plugin folder into plugins directory of Roundcube
 2. Add 'user_alias' to $config['plugins'] in your Roundcube config
 3. Rename 'config.inc.php.dist' to 'config.inc.php'
 4. Configure the credentials to access the postfix database in the config.inc.php file
