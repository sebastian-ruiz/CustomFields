<?php namespace SRuiz\CustomFields\Models;

use Db;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Cms\Classes\Theme;
use Model;
use Event;
use File;
use Yaml;


/**
 * Model
 */

class Target extends Model
{
    public $allCustomFields = [];

    public function getYamlCustomFields() {

        $themeDir = Theme::getActiveTheme()->getDirName();
        $files = File::allFiles(themes_path($themeDir));

        foreach ($files as $file) {
            if ($file->getExtension() == "yaml") {
                $openFile = $file->openFile();
                // Make sure the first line of file contains the words 'Custom Fields'.
                if (strpos($openFile->getCurrentLine(), 'Custom Fields') !== false) {
                    $filePath = "themes" . str_replace(themes_path(), '', $file->getRealPath());
                    $this->allCustomFields[] = Yaml::parseFile($filePath);
                }
            }
        }
    }
}