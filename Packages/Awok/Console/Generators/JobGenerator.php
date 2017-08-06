<?php

namespace Awok\Console\Generators;

use Exception;
use Illuminate\Support\Str;

class JobGenerator extends Generator
{
    public function generate($name, $domain)
    {
        $name   = Str::studly($name).'Job';
        $domain = Str::studly($domain);
        $path   = $this->findJobPath($name, $domain);
        if ($this->exists($path)) {
            throw new Exception('Job already exists!');
        }

        $namespace       = $this->findJobNamespace($domain);
        $vendorNamespace = $this->findVendorRootNameSpace();
        $content         = file_get_contents($this->getStub());
        $content         = str_replace(
            ['{{job}}', '{{namespace}}', '{{vendor_namespace}}'],
            [$name, $namespace, $vendorNamespace],
            $content
        );
        $this->createFile($path, $content);

        return $this->relativeFromReal($path);
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/job.stub';
    }
}