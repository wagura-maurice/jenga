FILENAME=jengaV1-backup-$(date "+%b_%d_%Y_%H_%M_%S").sql

mysqldump --column-statistics=0 -u dante -p --single-transaction --quick --lock-tables=false -h 127.0.0.1 -P 3306 jengaV1 > $FILENAME


mysql -u dante -p jenga < $FILENAME