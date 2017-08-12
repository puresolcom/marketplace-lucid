<?php

namespace App\Operations;

use App\Data\Entities\Translation;
use Awok\Foundation\Operation;

class ExtractTranslatableFieldsOperation extends Operation
{
    protected $input;

    protected $keys;

    public function __construct($input, $keys)
    {
        $this->input = $input;
        $this->keys  = $keys;
    }

    public function handle()
    {
        if (empty($this->keys)) {
            throw new \Exception(trans('Invalid translatable keys'));
        }

        $translations = [];

        foreach ($this->keys as $key) {
            $translationField = array_get($this->input, $key);
            if (is_string($translationField)) {
                $translations[$key][] = new Translation($translationField);
            } elseif (is_array($translationField)) {
                foreach ($translationField as $locale => $value) {
                    $translations[$key][] = new Translation($value, $locale);
                }
            }
        }

        return $translations;
    }
}