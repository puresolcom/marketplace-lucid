<?php

namespace App\Domains\Option;

use App\Data\Models\Option;
use Laravel\Lumen\Application;

/**
 * Class OptionManager
 *
 * @package App\Domains\Option
 */
class OptionManager
{
    protected $app;

    protected $optionModel;

    public function __construct(Application $app)
    {
        $this->app         = $app;
        $this->optionModel = $this->app->make(Option::class);
    }

    /**
     * @param null $type
     * @param      $key
     * @param null $default
     *
     * @return null
     */
    public function get($type = null, $key, $default = null)
    {
        if ($type) {
            $this->optionModel->where('type', '=', $type);
        }
        $result = $this->optionModel->where('key', '=', $key)->first();
        if (! $result) {
            return $default;
        }

        return $result->value;
    }

    /**
     * @param $type
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    public function set($type, $key, $value)
    {
        return $this->optionModel->updateOrCreate(
            ['type' => $type, 'key' => $key],
            ['value' => $value]
        );
    }
}