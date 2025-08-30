# kaib.net/dev — Dev README

## ENV
Set environment variables or use web server env:
```
APP_ENV=dev
BASE_PREFIX=/dev/
# DB_* are read from api/config.php as requested
```

## Migrations
Apply migrations in order:
```
mysql -u $DB_USER -p$DB_PASS -h $DB_HOST -P $DB_PORT $DB_NAME < migrations/001_add_user_columns.sql
mysql -u $DB_USER -p$DB_PASS -h $DB_HOST -P $DB_PORT $DB_NAME < migrations/002_balance_audit.sql
mysql -u $DB_USER -p$DB_PASS -h $DB_HOST -P $DB_PORT $DB_NAME < migrations/003_indexes.sql
```

## Health
- /dev/api/health.php
- /dev/api/health_db.php

## Admin API
- GET  /dev/api/admin/users_list.php?page=1&per=20&q=
- POST /dev/api/admin/user_update.php (id, nickname?, new_password?, delta?, reason?) + X-CSRF
