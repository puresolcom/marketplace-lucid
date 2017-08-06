<?php

namespace Awok\Console\Generators;

use Exception;

class ControllerGenerator extends Generator
{
    public function generate($name)
    {
        $name = $this->controllerName($name);
        $path = $this->findControllerPath($name);
        if ($this->exists($path)) {
            throw new Exception('Controller already exists!');
        }

        $namespace       = $this->findControllerNamespace();
        $vendorNamespace = $this->findVendorRootNameSpace();
        $content         = file_get_contents($this->getStub());
        $content         = str_replace(
            ['{{controller}}', '{{namespace}}', '{{vendor_namespace}}'],
            [$name, $namespace, $vendorNamespace],
            $content
        );
        $this->createFile($path, $content);

        return $this->relativeFromReal($path);
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/controller.stub';
    }
}