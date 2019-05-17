<?php

class environment
{

    private $tenantdirectory = "repo/";
    public $scriptpath = "oc/";

    public function __construct($admin=false)
    {
        $this->admin = $admin;
    }

    public function getAppDirectory()
    {
        return DIR_APPLICATION;
    }

    public function getDomain()
    {
        return $_SERVER['HTTP_HOST'];
    }

    public function getSystemDirectory()
    {
        return DIR_SYSTEM;
    }

    public function getLangDirectory()
    {
        return DIR_LANGUAGE;
    }

    public function getTemplateDirectory()
    {
        return DIR_TEMPLATE;
    }

    public function getConfigDirectory()
    {
        return DIR_CONFIG;
    }

    public function getModificationDirectory()
    {
        return DIR_MODIFICATION;
    }

    public function getHttpServer()
    {
        return HTTP_SERVER;
    }

    public function getHttpsServer()
    {
        return HTTPS_SERVER;
    }

    public function getCacheDirectory()
    {
        return $this->getTenantDirectory() . 'cache/';
    }

    public function getImageDirectory()
    {
        return $this->getTenantDirectory() . 'image/';
    }

    public function getImgRelDirectory()
    {
        return $this->getTenantDirectory() . 'image/';
    }

    public function getLogsDirectory()
    {
        return $this->getTenantDirectory() . 'logs/';
    }

    public function getDownloadDirectory()
    {
        return $this->getTenantDirectory() . 'download/';
    }

    public function getSessionDirectory()
    {
        return $this->getTenantDirectory() . 'session/';
    }


    public function getUploadDirectory()
    {
        return $this->getTenantDirectory() . 'upload/';
    }

    public function getMainPath()
    {
        return $_SERVER['DOCUMENT_ROOT'] . "/" . $this->scriptpath;
    }

    public function getTenantDirectory()
    {
        return ($this->admin ? '../' : '') . $this->tenantdirectory . $this->getDomain() . '/';
    }
}