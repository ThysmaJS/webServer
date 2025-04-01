#!/bin/bash

mkdir -p ssl
cd ssl

# 1. Générer la clé privée de l'autorité
openssl genrsa -out ca.key 4096

# 2. Certificat de l'autorité auto-signé
openssl req -x509 -new -nodes -key ca.key -sha256 -days 3650 \
    -subj "//C=FR/ST=France/L=Vitrolles/O=DonSecure/CN=donsecure.local" \
    -out ca.crt

# 3. Clé privée du serveur
openssl genrsa -out server.key 4096

# 4. CSR (demande de certificat serveur)
openssl req -new -key server.key \
    -subj "//C=FR/ST=France/L=Vitrolles/O=DonSecure/CN=localhost" \
    -out server.csr

# 5. Certificat signé
openssl x509 -req -in server.csr -CA ca.crt -CAkey ca.key -CAcreateserial \
    -out server.crt -days 365 -sha256

# 6. Nettoyage
rm server.csr
