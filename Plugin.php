<?php namespace SRuiz\CustomFields;

use System\Classes\PluginBase;
use System\Classes\PluginManager;
use System\Classes\SettingsManager;
use Cms\Classes\Theme;
use App;
use Backend;
use Event;
use File;
use Yaml;

class Plugin extends PluginBase  {
    public function pluginDetails() {
        return [
            'name'        => 'sruiz.customfields::lang.plugin.name',
            'description' => 'sruiz.customfields::lang.plugin.description',
            'author'      => 'Sebastian Ruiz',
            'icon'        => 'icon-file-image-o'
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'SRuiz\CustomFields\FormWidgets\FieldsWidget' => [
                'label' => 'sruiz.customfields::lang.widget.label',
                'alias' => 'fieldswidget'
            ]
        ];
    }

    public function boot()
    {
        //register the form widget on backend pages
        Event::listen('backend.form.extendFields', function($widget){
            if (!$widget->model instanceof \Cms\Classes\Page) return;

            if (!($theme = Theme::getEditTheme()))
                throw new ApplicationException(Lang::get('cms::lang.theme.edit.not_found'));

            $widget->addFields(
                [
                    'markup[widget]' => [
                        'type' => 'SRuiz\CustomFields\FormWidgets\Fields',
                        'widget' => 'SRuiz\CustomFields\FormWidgets\Fields',
                        'tab' => 'cms::lang.editor.markup',
                        'span' => 'full'
                    ],
                ],
                'secondary'
            );

        });
    }
}
