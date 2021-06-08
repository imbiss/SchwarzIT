FROM mysql/mysql-server:5.7
RUN  yum install -y vim
COPY my.cnf /etc/mysql/my.cnf
ENV MYSQL_ROOT_PASSWORD password
ENV MYSQL_DATABASE user-db
ENV MYSQL_USER user
ENV MYSQL_PASSWORD user