[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

# Laravel BackupManager

Simple laravel package to backup/restore files and database.

## Screenshot

![Main Window](https://github.com/jeff-gepiga/dbfilebackup/blob/master/screen.gif?raw=true)

## Requirements

 - PHP >= 7.4
 - Laravel 8-10
 - `mysql` (to restore database)
 - `mysqldump` (to backup database)
 - `tar` (to backup/restore files)
 - `zcat` (to extract database archive)
 
 Please make sure above binaries are added to `PATH` environment variable or you can specify full path to them in config file.

## Installation

Via Composer

``` bash
$ composer require jeff-gepiga/dbfilebackup
```
---

Publish package's files by running below command:

```bash
$ php artisan vendor:publish --provider="JeffGepiga\BackupManager\ServiceProvider"
```
It should publish `config/backupmanager.php.php` config file and migration file.

Run `php artisan migrate` to create backup verifier (`verifybackup`)) table.

---

Finally setup options in `config/backupmanager.php` file and open the backup manager at url you have specified in `route` option eg `http//yourapp.com/backupmanager`, you should now see interface of BackupManager.

See `config/backupmanager.php` file for more information about backup settings.

## Setting Up Automatic Backups

To setup automatic backups, place following in `app/Console/Kernel.php` file:

```php
$schedule->command('backupmanager:create')->daily();
```

Although packages provides GUI interface to manage backups, following commands are also available:

```bash
  backupmanager:create                  Creates backup of files and/or database.
  backupmanager:list                    Shows list of backups taken.
  backupmanager:restore                 Restores a backup already taken.
```

## Saving Backups to Other Disks

By default this package saves backups to `local` disk but you can use built-in feature of laravel filesystem to save backups to other disks too. Let's say you want to upload to different server for which you have ftp credentials, you need to update those ftp credentials into laravel's `config/filesystems.php` file under `ftp` disk setting. Once you have done that, in backup manager config file (`config/backupmanager.php`) specify your disk to be `ftp` instead of `local` eg:

    // define disk options
    'disk' => 'ftp',

instead of 

     'disk' => 'local',

Now backup files will be saved on your ftp location instead of locally.

## How Restore is verified

Even though there is no 100% way to verify restores, yet for **files** we create and verify restore feature by putting some contents into `backup-verify` file before and after restore. Similarly, we verify **database** restore by putting some contents into `verifybackup` table before and after restore. In both cases, contents of that file and database table are different at the time of backup and restore.

## Disclaimer

This package was created for our needs and works for us however no guarantee is provided in terms of its functionality especially restore feature which can not be 100% verified because of the way restore feature works. So use this package at your own risk.

## Credits

- [Sarfraz Ahmed][link-author]
- [All Contributors][link-contributors]

## License

Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/jeff-gepiga/dbfilebackup.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/jeff-gepiga/dbfilebackup.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/jeff-gepiga/dbfilebackup
[link-downloads]: https://packagist.org/packages/jeff-gepiga/dbfilebackup
[link-author]: https://github.com/JeffGepiga
[link-contributors]: https://github.com/jeff-gepiga/dbfilebackup/graphs/contributors
