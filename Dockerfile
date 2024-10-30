FROM debian:bookworm-slim

# Instala dependências e MySQL Server
RUN apt-get update && apt-get install -y \
    mysql-server \
    && rm -rf /var/lib/apt/lists/*

# Configura o MySQL para aceitar conexões externas
RUN sed -i 's/bind-address\s*=.*$/bind-address = 0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf

# Define as portas e o comando de inicialização
EXPOSE 3306
CMD ["mysqld"]
