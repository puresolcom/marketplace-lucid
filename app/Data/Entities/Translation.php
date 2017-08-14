<?php

namespace App\Data\Entities;

class Translation
{
    protected $locale;

    protected $value;

    public function __construct($value, $locale = null)
    {
        $this->setLocale($locale ?? config('app.base_locale'));
        $this->setValue($value);
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}