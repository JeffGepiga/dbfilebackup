<?php
namespace JeffGepiga\BackupManager\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Returns instance of logged in user.
 *
 * @return \JeffGepiga\BackupManager\BackupManager
 */
class BackupManager extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'BackupManager';
    }

} 