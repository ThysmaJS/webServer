FROM openresty/openresty:alpine

# Installer perl et curl pour que opm fonctionne
RUN apk add --no-cache perl curl

# Installer resty.jwt
RUN opm get SkyLothar/lua-resty-jwt

# Copier la config et les scripts
COPY default.conf /etc/nginx/conf.d/default.conf
COPY jwt-check.lua /etc/nginx/jwt-check.lua
COPY ssl /etc/nginx/ssl/
