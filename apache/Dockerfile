FROM php:8.2-apache

# Active mod_rewrite si besoin (pas obligatoire ici, mais utile)
RUN a2enmod rewrite

# Copie les fichiers HTML et PHP dans le dossier de l'appli
COPY html/ /var/www/html/

# Donne les bons droits (optionnel mais propre)
RUN chown -R www-data:www-data /var/www/html

# Expose le port 80 par défaut (déjà fait automatiquement)
