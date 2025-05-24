FROM httpd:2.4.63

COPY index.html /usr/local/apache2/htdocs/
COPY pngwing.com.png /usr/local/apache2/htdocs/

