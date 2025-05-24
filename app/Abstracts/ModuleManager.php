<?php namespace App\Abstracts;

use Barryvdh\TranslationManager\Manager;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Barryvdh\TranslationManager\Models\Translation;
use Barryvdh\TranslationManager\Events\TranslationsExportedEvent;


class ModuleManager extends Manager{

	public function importTranslations($replace = false, $base = null, $import_group = false,$moduleName=null)
    {
        $counter = 0;
        //allows for vendor lang files to be properly recorded through recursion.
        $vendor = true;
        if ($base == null) {
            $base = $this->app['path.lang'];
            $vendor = false;
        }

        foreach ($this->files->directories($base) as $langPath) {
            $locale = basename($langPath);

            //import langfiles for each vendor
            if ($locale == 'vendor') {
                foreach ($this->files->directories($langPath) as $vendor) {
                    $counter += $this->importTranslations($replace, $vendor);
                }

                continue;
            }

            $vendorName = $this->files->name($this->files->dirname($langPath));

            foreach ($this->files->allfiles($langPath) as $file) {
                $info = pathinfo($file);
                $group = $info['filename'];
                if ($import_group) {
                    if ($import_group !== $group) {
                        continue;
                    }
                }

                if (in_array($group, $this->config['exclude_groups'])) {
                    continue;
                }
                $subLangPath = str_replace($langPath.DIRECTORY_SEPARATOR, '', $info['dirname']);
                $subLangPath = str_replace(DIRECTORY_SEPARATOR, '/', $subLangPath);
                $langPath = str_replace(DIRECTORY_SEPARATOR, '/', $langPath);

                if ($subLangPath != $langPath) {
                    $group = $subLangPath.'/'.$group;
                }

                if (! $vendor) {
                    $translations = \Lang::getLoader()->load($locale, $group);
                } else {
                    $translations = include $file;
                    $group = 'vendor/'.$vendorName;
            		$group = $moduleName != null ? str_replace('vendor',$moduleName,$group) : $group;
                }

                if ($translations && is_array($translations)) {
                    foreach (Arr::dot($translations) as $key => $value) {
                        $importedTranslation = $this->importTranslation($key, $value, $locale, $group, $replace);
                        $counter += $importedTranslation ? 1 : 0;
                    }
                }
            }
        }

        foreach ($this->files->files($this->app['path.lang']) as $jsonTranslationFile) {
            if (strpos($jsonTranslationFile, '.json') === false) {
                continue;
            }
            $locale = basename($jsonTranslationFile, '.json');
            $group = self::JSON_GROUP;
            $translations =
                \Lang::getLoader()->load($locale, '*', '*'); // Retrieves JSON entries of the given locale only
            if ($translations && is_array($translations)) {
                foreach ($translations as $key => $value) {
                    $importedTranslation = $this->importTranslation($key, $value, $locale, $group, $replace);
                    $counter += $importedTranslation ? 1 : 0;
                }
            }
        }

        return $counter;
    }

    public function exportTranslations($group = null, $json = false,$isModule=false)
    {
        $basePath = $isModule ?  app_path("Modules/{$group}/Resources/Lang") : $this->app['path.lang'];
        $moduleName = $isModule ? $group : '';
        if (! is_null($group) && ! $json) {
            if (! in_array($group, $this->config['exclude_groups'])) {
                $vendor = false;
                if ($group == '*') {
                    return $this->exportAllTranslations();
                } else {
                    if (Str::startsWith($group, 'vendor')) {
                        $vendor = true;
                    }
                }

                $tree = $this->makeTree(Translation::ofTranslatedGroup( ($isModule ? $group.'/Lang' : $group) )
                                                    ->orderByGroupKeys(Arr::get($this->config, 'sort_keys', false))
                                                    ->get());
                foreach ($tree as $locale => $groups) {
                    $group = $isModule ? $group.'/Lang' : $group;
                    if (isset($groups[$group])) {
                        $translations = $groups[$group];

                        $path = $isModule ?  app_path("Modules/{$moduleName}/Resources/Lang") : $this->app['path.lang'];

                        $locale_path = $isModule ? $group.DIRECTORY_SEPARATOR.$locale : ($locale.DIRECTORY_SEPARATOR.$group);
                        if ($vendor) {
                            $path = $basePath.'/'.$group.'/'.$locale;
                            $locale_path = Str::after($group, '/');
                        }
                        $subfolders = explode(DIRECTORY_SEPARATOR, $locale_path);
                        array_pop($subfolders);
                        if($isModule){
                            array_pop($subfolders);
                            array_pop($subfolders);
                        }
                        $subfolder_level = '';
                        foreach ($subfolders as $subfolder) {
                            $subfolder_level = $subfolder_level.$subfolder.DIRECTORY_SEPARATOR;
                            $temp_path = rtrim($path.DIRECTORY_SEPARATOR.$subfolder_level, DIRECTORY_SEPARATOR);
                            if (! is_dir($temp_path)) {
                                mkdir($temp_path, 0777, true);
                            }
                        }

                        $path = $path.DIRECTORY_SEPARATOR.$locale.DIRECTORY_SEPARATOR.($isModule ? lcfirst($moduleName) : $group).'.php';
                        $output = "<?php\n\nreturn ".var_export($translations, true).';'.\PHP_EOL;
                        $this->files->put($path, $output);
                    }
                }
                Translation::ofTranslatedGroup($group)->update(['status' => Translation::STATUS_SAVED]);
            }
        }

        if ($json) {
            $tree = $this->makeTree(Translation::ofTranslatedGroup(self::JSON_GROUP)
                                                ->orderByGroupKeys(Arr::get($this->config, 'sort_keys', false))
                                                ->get(), true);

            foreach ($tree as $locale => $groups) {
                if (isset($groups[self::JSON_GROUP])) {
                    $translations = $groups[self::JSON_GROUP];
                    $path = $this->app['path.lang'].'/'.$locale.'.json';
                    $output = json_encode($translations, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_UNICODE);
                    $this->files->put($path, $output);
                }
            }

            Translation::ofTranslatedGroup(self::JSON_GROUP)->update(['status' => Translation::STATUS_SAVED]);
        }

        $this->events->dispatch(new TranslationsExportedEvent());
    }
}