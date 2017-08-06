<?php

namespace Awok\Console\Generators;

use Exception;
use Illuminate\Support\Str;

class FeatureGenerator extends Generator
{
    public function generate($name)
    {
        $name = Str::studly($name).'Feature';
        $path = $this->findFeaturePath($name);
        if ($this->exists($path)) {
            throw new Exception('Feature already exists!');
        }

        $namespace       = $this->findFeatureNamespace();
        $vendorNamespace = $this->findVendorRootNameSpace();
        $content         = file_get_contents($this->getStub());
        $content         = str_replace(
            ['{{feature}}', '{{namespace}}', '{{vendor_namespace}}'],
            [$name, $namespace, $vendorNamespace],
            $content
        );
        $this->createFile($path, $content);

        return $this->relativeFromReal($path);
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/feature.stub';
    }
}