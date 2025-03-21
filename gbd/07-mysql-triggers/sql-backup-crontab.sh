#!/bin/bash
mysqldump -u root -p triggers_security_ilia > ./triggers_security_ilia.sql

# Para automatizarlo con crontab, podemos acceder al archivo con crontab -e.
# Y añadir esta linea:
# 0 2 * * * /home/ilia/Documentos/Triggers/sql-backup-crontab.sh O la ruta que corresponda.

(crontab -l 2>/dev/null; echo "0 2 * * * /ruta/al/backup") | crontab -