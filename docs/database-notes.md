# Database Notes

The application source uses a local MySQL database named `vihsida` and PDO connections.

The uploaded archive did not include a complete `.sql` database dump. To run the project fully, create the required tables according to the forms and queries used in the PHP files.

Main PHP files to inspect for database structure:

- `src/inscription.php`
- `src/fiche.php`
- `src/unite.php`
- `src/reference.php`
- `src/rapporteur.php`
- `src/caneva_*.php`
- `src/graph*.php`

Recommended improvement before production use:

- centralize database connection in one `config.php` file;
- replace repeated credentials in each PHP file;
- add prepared statements everywhere;
- add authentication hardening;
- avoid publishing real patient data;
- create a documented `database/schema.sql` file.
