Dependencies:
-postgresql
-php >= 8.0
-composer >= 2

Deploy:
1. Create database;
2. make: cp .env.example .env
3. fill database connection 

   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=wallet
   DB_USERNAME=root
   DB_PASSWORD=
4. composer install
5. make: php artisan migrate
6. for run locally: php artisan serve

getBalanceMethod GET /api/wallet/balance?wallet_id=
makeTransactionMethod POST /api/wallet/transaction

SQL запрос
Написать SQL запрос, который вернет сумму, полученную по причине refund за последние 7 дней.

select sum(value) from transactions where reason = 'refund' and created_at >= DATEADD(day,-7, GETDATE());