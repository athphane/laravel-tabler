<?php


namespace App\Support\AdminModel;


interface AdminModel
{
    /**
     * Get the admin url
     * @return string
     */
    public function getAdminUrlAttribute(): string;

    /**
     * Get the admin link
     * @return string
     */
    public function getAdminLinkAttribute(): string;

    /**
     * Get the name to be displayed on the admin link
     */
    public function getAdminLinkNameAttribute();

    /**
     * Get can view admin link
     *
     * @return boolean
     */
    public function canViewAdminLink(): bool;

    /**
     * Get the name for log
     * @return string
     */
    public function getLoggingNameAttribute(): string;

    /**
     * Get the log url
     * @return string
     */
    public function getLogUrlAttribute(): string;

    /**
     * Get the causer log url
     * @return string
     */
    public function getCauserLogUrlAttribute(): string;
}
