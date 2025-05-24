<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;

class GenerateModule extends Command {
    protected $signature = 'module:generate  {--namespace=App\Modules}';
    protected $description = 'Generate a module with repository pattern';

    public function __construct(Composer $composer)
    {
        parent::__construct();

        $this->composer = $composer;
    }

    public function handle() {
        // Get the arguments and options
        $moduleName = $this->ask('What is Module Name ?');
        $modelName = $this->ask('What is Model Name ?');
        $tableName = $this->ask('What is Database Table Name ?');
        $attributes = [];
        $basePrefix = $this->choice('Select Dashboard Base Prefix ',['dashboard','admin','backend'],0);
        $authorizedRoutes = $this->confirm('Do You Want To Authorize Module Routes ?');
        $authMiddleware = 'web';
        if($authorizedRoutes){
            $authMiddleware = $this->ask('Enter Name of your authentication middleware ?  ex(auth,web,user,admin)');
        }

        $typesArr = ['string','boolean','text','longText','integer','double','bigInteger','bigIncrements','dateTime','timestamp',];
        $constsArr = ['index','unique','nullable','default','required'];

        $attributesCount = (int)$this->ask('enter count of model properties (do not count id,status,timestamp,softDeletes)');
        while(!$attributesCount){
            $attributesCount = $this->ask('enter count of model properties (do not count id,status,timestamp,softDeletes)');
        }
        for ($i=0; $i < $attributesCount; $i++) { 
            $defaultValue = '';
            $name = $this->ask('Enter Property Name '.($i+1));
            $type = $this->choice('Select Property Type '.($i+1),$typesArr,0);
            $const = $this->choice('Select Property Constraint '.($i+1),$constsArr,4);
            if($const == 'default'){
                $defaultValue = $this->ask('Enter Default Value For Property '.($i+1));
            }
            $attributes[$i] = [
                'type' => $type,
                'name' => $name,
                'consts' => $const, 
                'default' => $defaultValue,
            ];
        }

        $hasCrud = true;//$this->confirm('Do You Want To implement Crud Operations Design ?');
        $namespace = $this->option('namespace');
        

        // Generate the module directories and files
        $modulePath = base_path("app/Modules/{$moduleName}");
        $moduleNamespace = "{$namespace}\\{$moduleName}";
        $modelPlural = \Str::plural($modelName);
        $migrationClassName = date('Y_m_d_His') . "_create_" . (\Str::snake($modelPlural)) . "_table.php";
        $createTableName = 'Create'.ucwords(\Str::snake($modelPlural)).'Table';
        $stubsPath = public_path("stubs");

        // Create the module directories
        mkdir($modulePath);
        $dirs = [
            "Config","Entities","Database","Database/Migrations","Http","Http/Controllers","Http/Requests",
            "Resources","Resources/Views","Resources/Views/Partials","Resources/Views/Partials/tabs","Resources/Lang","Resources/Lang/ar","Resources/Lang/en","Repositories",
            "Database/Seeders","Database/Factories","Transformers",
            "Providers","Tests","Services","ViewComposers",'Enums'
        ];
        foreach($dirs as $dir){
            $fullPath = $modulePath."/".$dir;
            if(!file_exists($fullPath)){
                mkdir($fullPath);
            }
        }

        // Generate the stub files
        $configStub = file_get_contents("{$stubsPath}/config.stub");
        $langStub = file_get_contents("{$stubsPath}/lang.stub");
        $repoInterfaceStub = file_get_contents("{$stubsPath}/repository-interface.stub");
        $eloquentRepoStub = file_get_contents("{$stubsPath}/eloquent-repository.stub");
        $controllerStub = file_get_contents("{$stubsPath}/controller.stub");
        $modelStub = file_get_contents("{$stubsPath}/model.stub");
        $migrationStub = file_get_contents("{$stubsPath}/migrations.stub");
        $requestStub = file_get_contents("{$stubsPath}/request.stub");
        $routesStub = file_get_contents("{$stubsPath}/routes.stub");
        $seederStub = file_get_contents("{$stubsPath}/seeder.stub");
        $factoryStub = file_get_contents("{$stubsPath}/factory.stub");
        $transformerStub = file_get_contents("{$stubsPath}/transformer.stub");

        // Replace the placeholders in the stub files with the actual values
        $transformerStub = str_replace(
            ['{{modelName}}','{{namespace}}','{{columns}}'],
            [$modelName,'App\\Transformers',$this->generateTransformColumns($attributes)],
            $transformerStub
        );

        $factoryStub = str_replace(
            ['{{modelName}}'],
            [$modelName],
            $factoryStub
        );

        $seederStub = str_replace(
            ['{{modelName}}','{{moduleName}}'],
            [$modelName,$moduleName],
            $seederStub
        );

        $configStub = str_replace(
            ['{{configs}}',],
            [$this->generateConfig($modelName,$modelName,$modelPlural)],
            $configStub
        );

        $langStub = str_replace(
            ['{{translations}}',],
            [$this->generateTranslation($modelName)],
            $langStub
        );

        $eloquentRepoStub = str_replace(
            ['{{namespace}}', '{{modelName}}'],
            ['App\\Repositories', $modelName],
            $eloquentRepoStub
        );

        $modelStub = str_replace(
            ['{{namespace}}', '{{modelName}}', '{{tableName}}','{{fillable}}'],
            ['App\\Entities', $modelName, $tableName,$this->generateFillable($attributes)],
            $modelStub
        );

        $migrationStub = str_replace(
            ['{{migrationClassName}}', '{{tableName}}','{{columns}}'],
            [$createTableName, $tableName,$this->generateColumns($attributes)],
            $migrationStub
        );

        $requestStub = str_replace(
            ['{{namespace}}', '{{modelName}}' , '{{rules}}' , '{{messages}}'],
            ['App\\Http\\Requests', $modelName ,$this->generateValidationRules($attributes,$tableName), $this->generateValidationMessages($attributes) ],
            $requestStub
        );

        $controllerStub = str_replace(
            ['{{namespace}}', '{{moduleName}}', '{{modelName}}','{{modelNameLower}}', '{{modelNamePlural}}' , '{{modelPlural}}' , '{{requestPath}}'],
            [
                'App\\Http\\Controllers', $moduleName, $modelName , lcfirst($modelName), $modelPlural,$modelPlural , 
                'App\\Http\\Requests\\'.$modelName.'Validator'
            ],
            $controllerStub
        );

        // Save the stub files in the module directories
        file_put_contents("{$modulePath}/Database/Migrations/{$migrationClassName}", $migrationStub);
        file_put_contents("{$modulePath}/Database/Seeders/{$modelName}Seeder.php", $seederStub);
        file_put_contents("{$modulePath}/Database/Factories/{$modelName}Factory.php", $factoryStub);
        file_put_contents("{$modulePath}/Repositories/Eloquent{$modelName}Repository.php", $eloquentRepoStub);
        file_put_contents("{$modulePath}/Http/Controllers/{$modelName}Controller.php", $controllerStub);
        file_put_contents("{$modulePath}/Entities/{$modelName}.php", $modelStub);
        file_put_contents("{$modulePath}/Http/Requests/{$modelName}Validator.php", $requestStub);
        file_put_contents("{$modulePath}/Transformers/{$modelName}Resource.php", $transformerStub);
        file_put_contents("{$modulePath}/Config/{$modelName}.php", $configStub);
        file_put_contents("{$modulePath}/Resources/Lang/en/".lcfirst($moduleName).".php", $langStub);
        file_put_contents("{$modulePath}/Resources/Lang/ar/".lcfirst($moduleName).".php", $langStub);
        

        if($hasCrud){
            $crudRepoStub = file_get_contents("{$stubsPath}/crud-repository.stub");
            $crudRepoStub = str_replace(
                ['{{prefix}}','{{prefixOne}}','{{modelName}}','{{modelNameSmall}}', '{{moduleName}}' , '{{basePrefix}}'],
                [lcfirst($modelPlural) ,lcfirst($modelName), $modelName ,lcfirst($modelName), $moduleName , $basePrefix.'/'],
                $crudRepoStub
            );
            file_put_contents("{$modulePath}/Repositories/{$modelName}CrudRepository.php", $crudRepoStub);

            $designComposerStub = file_get_contents("{$stubsPath}/design-composer.stub");
            $designComposerStub = str_replace(
                ['{{modelName}}'],
                [$modelName ],
                $designComposerStub
            );
            file_put_contents("{$modulePath}/ViewComposers/{$modelName}DesignComposer.php", $designComposerStub);

            $indexStub = file_get_contents("{$stubsPath}/index.stub");
            file_put_contents("{$modulePath}/Resources/Views/index.blade.php", $indexStub);

            $createStub = file_get_contents("{$stubsPath}/create.stub");
            $createStub = str_replace(
                ['{{modelNamePlural}}',"{{modelName}}"],
                [lcfirst($modelPlural) , $modelName],
                $createStub
            );
            file_put_contents("{$modulePath}/Resources/Views/create.blade.php", $createStub);

            $editStub = file_get_contents("{$stubsPath}/edit.stub");
            $editStub = str_replace(
                ['{{modelNamePlural}}',"{{modelName}}"],
                [lcfirst($modelPlural) , $modelName],
                $editStub
            );
            file_put_contents("{$modulePath}/Resources/Views/edit.blade.php", $editStub);
            file_put_contents("public/assets/dashboard/components/".lcfirst($modelPlural).".js", '');

            $tabsStub = file_get_contents("{$stubsPath}/tabs.stub");
            file_put_contents("{$modulePath}/Resources/Views/Partials/tabs/tabs.blade.php", $tabsStub);

            $generalDataStub = file_get_contents("{$stubsPath}/general-data.stub");
            file_put_contents("{$modulePath}/Resources/Views/Partials/tabs/general-data.blade.php", $generalDataStub);


            
            $routesStub = str_replace(
                ['{{prefix}}','{{controller}}','{{authEngine}}'],
                ["'/".$basePrefix."/".lcfirst($modelPlural)."'" , 'App\\Http\\Controllers\\'.$modelName.'Controller::class',"'".$authMiddleware."'"],
                $routesStub
            );
            file_put_contents("{$modulePath}/Http/routes.php", $routesStub);

            if($authorizedRoutes){
                // $permissionsStub = file_get_contents("{$stubsPath}/permissions.stub");
                // $permissionsStub = str_replace(
                //     ['{{permissions}}',],
                //     [$this->generatePermissions($modelName.'Controller', $modelName , $modelPlural)],
                //     $permissionsStub
                // );
                // file_put_contents("{$modulePath}/Config/permissions.php", $permissionsStub);
            }
        }

        $this->composer->dumpAutoloads();
        $oldModules = config('modules.modules');
        $oldModules[] = $moduleName;

        \Helper::updateConfigFile('modules','modules',$oldModules);
        \Artisan::call('migrate', [
            '--path' => "/app/Modules/{$moduleName}/Database/Migrations/{$migrationClassName}",
        ]);

        $this->info("Module '{$moduleName}' generated successfully.");
    }

    protected function generateFillable($attributes)
    {
        $fillable = '';
        foreach ($attributes as $key => $value) {
            $fillable.= "'".$value['name']."',";
        }

        $fillable .= "'status','created_at','updated_at','deleted_at',";

        return "protected \$fillable = [$fillable];";
    }

    protected function generateColumns($attributes)
    {
        $columns = '';
        foreach ($attributes as $attribute) {
            $columns .= "\$table->".$attribute['type']."('".$attribute["name"]."')->".$attribute['consts']."(".$attribute['default'].");\n          ";
        }
        return $columns;
    }

    protected function generateConfig($attributes,$modelName,$modelPlural)
    {
        $fillable = "'title'=>'".$attributes."', \n         ";
        $perms = $this->generatePermissions($modelName.'Controller', $modelName , $modelPlural);
        $fillable.= "'permissions'=>  [\n       ".$perms."], \n         ";
        return "[\n         $fillable];";
    }

    protected function generateTranslation($modelName)
    {
        $fillable = "'title'=>'".\Str::plural($modelName)."', \n        ";
        $fillable.= "'newOne'=>'Add New {$modelName}', \n       ";
        return "[\n         $fillable];";
    }

    protected function generateValidationRules($attributes,$moduleNamePlural)
    {
        $rules = '';
        foreach ($attributes as $attribute) {
            if($attribute['consts'] != 'nullable'){
                $rules .= "'" . $attribute['name'] . "' => 'required".($attribute['consts'] == 'unique' ? '|unique:'.$moduleNamePlural.','.$attribute['name'] : '' )."' , \n      ";
            }
        }
        $rules.= "'status' => 'nullable' , \n      ";
        return "[\n         $rules];";
    }

    protected function generateValidationMessages($attributes)
    {
        $messages = '';
        foreach ($attributes as $attribute) {
            if($attribute['consts'] != 'nullable'){
                $name = ucwords(str_replace('_',' ',$attribute['name']));
                $messages .= "'" . $attribute['name'] . ".required' => '".$name." is required!' , \n        ";
            }
        }

        return "[\n      $messages];";
    }

    protected function generateTransformColumns($attributes)
    {
        $columns = '';
        foreach ($attributes as $attribute) {
            $columns .= "'".$attribute["name"]."'   => \$this->".$attribute['name'].",\n        ";
        }
        return $columns;
    }

    public function generatePermissions($controller,$moduleName,$moduleNamePlural){
        $permissions = "'".$controller."@index' => 'list-".lcfirst($moduleNamePlural)."', \n        ";
        $permissions.= "'".$controller."@create' => 'add-".lcfirst($moduleName)."', \n        ";
        $permissions.= "'".$controller."@store' => 'add-".lcfirst($moduleName)."', \n        ";
        $permissions.= "'".$controller."@edit' => 'edit-".lcfirst($moduleName)."', \n        ";
        $permissions.= "'".$controller."@update' => 'edit-".lcfirst($moduleName)."', \n        ";
        $permissions.= "'".$controller."@fastEdit' => 'edit-".lcfirst($moduleName)."', \n        ";
        $permissions.= "'".$controller."@restore' => 'restore-".lcfirst($moduleName)."', \n        ";
        $permissions.= "'".$controller."@delete' => 'delete-".lcfirst($moduleName)."', \n        ";
        $permissions.= "'".$controller."@destroy' => 'delete-".lcfirst($moduleName)."', \n        ";
        return $permissions;
    }
}
