FROM amazonlinux:2

RUN yum install -y https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm

# 依存パッケージのインストール
RUN amazon-linux-extras install nginx1 && \
    amazon-linux-extras install php7.3 && \
    yum -y install zip unzip php-devel php-pear php-mbstring php-xml glibc-langpack-ja sudo ccze gcc vim procps libpng-devel git cronie libzip.x86_64 libzip-devel.x86_64
RUN pecl install zip

# 開発用にcomposerをインストール
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && mv composer.phar /usr/local/bin/composer

COPY ./etc /etc

# 起動コマンド
CMD bash -c "bash /etc/init.sh && nginx && php-fpm -F"
