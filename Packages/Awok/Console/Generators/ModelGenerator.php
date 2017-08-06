<?php

namespace Awok\Console\Generators;

use Exception;
use Illuminate\Support\Str;

class ModelGenerator extends Generator
{
    public function generate($name)
    {
        $name = Str::studly($name);
        $path = $this->findModelPath($name);
        if ($this->exists($path)) {
            throw new Exception('Model already exists!');
        }

        $namespace       = $this->findModelNamespace();
        $vendorNamespace = $this->findVendorRootNameSpace();
        $content         = file_get_contents($this->getStub());
        $content         = str_replace(
            ['{{model}}', '{{namespace}}', '{{vendor_namespace}}'],
            [$name, $namespace, $vendorNamespace],
            $content
        );
        $this->createFile($path, $content);

        return $this->relativeFromReal($path);
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/model.stub';
    }
}