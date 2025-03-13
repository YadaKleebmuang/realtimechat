FROM php:8.1-apache

# ติดตั้ง mysqli และ pdo_mysql
RUN docker-php-ext-install mysqli pdo pdo_mysql

# คัดลอกไฟล์โค้ดไปยัง Docker
COPY . /var/www/html

# ให้สิทธิ์ Apache อ่านไฟล์
RUN chown -R www-data:www-data /var/www/html

# เปิดใช้งาน mod_rewrite
RUN a2enmod rewrite

# เริ่ม Apache
CMD ["apache2-foreground"]
