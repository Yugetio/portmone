#!/bin/bash


 psql -v ON_ERROR_STOP=1 --username "api_user" --dbname "portmone" <<-EOSQL
     CREATE USER portmone WITH PASSWORD '@GR&G)*(@HR#&RH';
     CREATE DATABASE portmone;
     GRANT ALL PRIVILEGES ON DATABASE portmone TO portmone;
 EOSQL
