#!/bin/bash

# Para hacer el backup
mysqldump -u root -p triggers_security_ilia > ./triggers_backup.sql

# Para restaurarlo
mysql -u root -p triggers_security_ilia < ./triggers_backup.sql

# Copia avanzada
mysqldump -u root -p --all-databases --single-transaction --routines --triggers > backup-all.sql
