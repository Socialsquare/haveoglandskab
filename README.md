# haveoglandskab-website
Danmarks største fagudstilling for den grønne branche

## Opsætning af udviklingsmiljø

1. Tag en kopi af wp-config-sample.php og kald den wp-config.php: `cp wp-config-sample.php wp-config.php`.
2. Få en administrator konto på sitet
3. Eksportér og importér indhold: http://www.haveoglandskab.dk/wp-admin/export.php
4. Eksportér og importér "Custom Fields":  http://www.haveoglandskab.dk/wp-admin/edit.php?post_type=acf&page=acf-export
5. Eksportér og importér "Adminimize" opsætning: http://www.haveoglandskab.dk/wp-admin/options-general.php?page=adminimize%2Fadminimize.php#import
6. Overfør widgets til sidens footer: http://www.haveoglandskab.dk/wp-admin/widgets.php
7. Aktivér "Visningsplacering: Primary Navigation" på siden http://dev.haveoglandskab.dk/wp/wp-admin/nav-menus.php
8. Deaktivér de roller som ikke benyttes: http://dev.haveoglandskab.dk/wp/wp-admin/users.php?page=roles
9. Giv administratoren lov til at ændre udstillere:  http://dev.haveoglandskab.dk/wp/wp-admin/users.php?page=roles&action=edit&role=administrator
