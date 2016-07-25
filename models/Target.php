<?php namespace SRuiz\CustomFields\Models;

use Db;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Cms\Classes\Theme;
use Model;
use Event;
use File;
use Yaml;
use stdClass;

/**
 * Model
 */

class Target extends Model
{
    public $allCustomFields;

    public function getYamlCustomFields() {

        if (!isset($this->allCustomFields))
            $this->allCustomFields = new stdClass();

        $themeDir = Theme::getActiveTheme()->getDirName();
        $files = File::allFiles(themes_path($themeDir));

        foreach ($files as $file) {
            if ($file->getExtension() == "yaml") {
                $openFile = $file->openFile();
                // Make sure the first line of file contains the words 'Custom Fields'.
                if (strpos($openFile->getCurrentLine(), 'Custom Fields') !== false) {
                    $filePath = "themes" . str_replace(themes_path(), '', $file->getRealPath());
                    $filename = str_replace(' ', '_', $file->getBasename('.'.$file->getExtension()));;
                    $this->allCustomFields->$filename = Yaml::parseFile($filePath);
                }
            }
        }
    }
}