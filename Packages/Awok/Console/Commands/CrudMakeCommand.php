<?php

namespace Awok\Console\Commands;

use Awok\Console\Generators\ControllerGenerator;
use Awok\Console\Generators\FeatureGenerator;
use Awok\Console\Generators\JobGenerator;
use Awok\Console\Generators\ModelGenerator;
use Awok\Console\Generators\ValidatorGenerator;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class CrudMakeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:crud {singular_entity_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a CRUD for an entity';

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        $name       = $this->argument('singular_entity_name');
        $pluralName = Str::plural($name);

        $controllerGenerator = new ControllerGenerator();
        $modelGenerator      = new ModelGenerator();
        $featureGenerator    = new FeatureGenerator();
        $jobGenerator        = new JobGenerator();
        $validatorGenerator  = new ValidatorGenerator();

        $generatedFilesPaths = [];

        try {
            $this->info('Beginning creating CRUD.'."\n");
            /*****************************
             * Generate Model
             ****************************/
            $generatedFilesPaths[] = $modelGenerator->generate($name);
            /*****************************
             * Generate Features
             ****************************/
            $featureGenerator->setStubName('feature.stub');

            // List Feature
            $featureGenerator->setStubVar('namespace_below',
                "use {$featureGenerator->findVendorRootNameSpace()}\\Domains\\Data\\Jobs\\BuildEloquentQueryFromRequestJob;\n".
                "use {$featureGenerator->findVendorRootNameSpace()}\\Domains\\Http\\Jobs\\JsonResponseJob;\n".
                "use {$modelGenerator->getGeneratedClassFQN()};"
            );
            $featureGenerator->setStubVar('handler_body',
                "\$results = \$this->run(BuildEloquentQueryFromRequestJob::class, ['model' => {$modelGenerator->getGeneratedClassName()}::class]);".
                "\n\n".
                "\t\t".
                "return \$this->run(new JsonResponseJob(\$results));"
            );
            $generatedFilesPaths[] = $featureGenerator->generate("list_{$name}");
            $controllerGenerator->setStubVar('list_feature_namespace', $featureGenerator->getGeneratedClassFQN());
            $controllerGenerator->setStubVar('list_feature_class', $featureGenerator->getGeneratedClassName());

            // Get Feature
            $featureGenerator->setStubVar('namespace_below',
                "use {$featureGenerator->findVendorRootNameSpace()}\\Domains\\Data\\Jobs\\FindEloquentObjectFromRequestJob;\n".
                "use {$featureGenerator->findVendorRootNameSpace()}\\Domains\\Http\\Jobs\\JsonResponseJob;\n".
                "use {$modelGenerator->getGeneratedClassFQN()};"
            );
            $featureGenerator->setStubVar('handler_body',
                "\$user = \$this->run(FindEloquentObjectFromRequestJob::class, ['model' => {$modelGenerator->getGeneratedClassName()}::class]);".
                "\n\n".
                "\t\t".
                "return \$this->run(new JsonResponseJob(\$user));"
            );
            $generatedFilesPaths[] = $featureGenerator->generate("get_{$name}");
            $controllerGenerator->setStubVar('get_feature_namespace', $featureGenerator->getGeneratedClassFQN());
            $controllerGenerator->setStubVar('get_feature_class', $featureGenerator->getGeneratedClassName());

            // Create Feature
            $generatedFilesPaths[] = $featureGenerator->generate("create_{$name}");
            $controllerGenerator->setStubVar('create_feature_namespace', $featureGenerator->getGeneratedClassFQN());
            $controllerGenerator->setStubVar('create_feature_class', $featureGenerator->getGeneratedClassName());

            $generatedFilesPaths[] = $featureGenerator->generate("update_{$name}");
            $controllerGenerator->setStubVar('update_feature_namespace', $featureGenerator->getGeneratedClassFQN());
            $controllerGenerator->setStubVar('update_feature_class', $featureGenerator->getGeneratedClassName());

            $generatedFilesPaths[] = $featureGenerator->generate("delete_{$name}");
            $controllerGenerator->setStubVar('delete_feature_namespace', $featureGenerator->getGeneratedClassFQN());
            $controllerGenerator->setStubVar('delete_feature_class', $featureGenerator->getGeneratedClassName());
            /*****************************
             * Generate Controllers
             ****************************/
            $controllerGenerator->setStubName('controller.stub');
            $generatedFilesPaths[] = $controllerGenerator->generate($pluralName);
            /*****************************
             * Generate Jobs
             ****************************/
            $generatedFilesPaths[] = $jobGenerator->generate("create_{$name}", $name);
            $generatedFilesPaths[] = $jobGenerator->generate("create_{$name}_input_validate", $name);
            $generatedFilesPaths[] = $jobGenerator->generate("create_{$name}_input_filter", $name);
            $generatedFilesPaths[] = $jobGenerator->generate("update_{$name}", $name);
            $generatedFilesPaths[] = $jobGenerator->generate("update_{$name}_input_validate", $name);
            $generatedFilesPaths[] = $jobGenerator->generate("update_{$name}_input_filter", $name);

            /*****************************
             * Generate Validators
             ****************************/
            $generatedFilesPaths[] = $validatorGenerator->generate("create_{$name}", $name);
            $generatedFilesPaths[] = $validatorGenerator->generate("update_{$name}", $name);

            $this->info('CRUD Generation done'."\n");
        } catch (Exception $e) {
            $this->error($e->getMessage());
            $this->deleteFiles($generatedFilesPaths);
        }
    }

    protected function deleteFiles($paths)
    {
        $this->warn('Deleting newly generated files because of an error');
        $fileSystem = new Filesystem();

        foreach ($paths as $path) {
            if (! $fileSystem->delete($path)) {
                $this->error('Unable to delete file'.' '.$path);
            } else {
                $this->error($path.' deleted');
            }
        }

        $this->warn('All files were deleted successfully');
    }
}