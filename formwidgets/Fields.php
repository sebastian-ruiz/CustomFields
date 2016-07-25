<?php namespace SRuiz\CustomFields\FormWidgets;

use Backend\Classes\FormWidgetBase;
use \SRuiz\CustomFields\Models\Target;
use App;
use File;


class Fields extends FormWidgetBase
{
    public function widgetDetails()
    {
        return [
            'name' => 'sruiz.customfields::lang.widget.name',
            'description' => 'sruiz.customfields::lang.widget.description'
        ];
    }

    public function render()
    {
        $this->prepareVars();
//        $editor = Settings::instance()->editor;

        return $this->makePartial("fields");
    }

    public function prepareVars()
    {
        $t = new Target();

        $t->getYamlCustomFields();
        $this->vars['allCustomFields'] = $t->allCustomFields;
    }

    public function loadAssets()
    {
        $this->addJs('/plugins/sruiz/customfields/formwidgets/assets/dist/app.min.js');
        $this->addCss('/plugins/sruiz/customfields/formwidgets/assets/dist/app.css');
    }

}