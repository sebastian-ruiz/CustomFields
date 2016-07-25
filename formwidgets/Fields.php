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

    public function getValue($field, $valueName)
    {
        if(array_key_exists($valueName, $field))
            return $field[$valueName];
        return '';
    }

    public function fieldRepeater($field)
    {
        return '';
    }

    public function fieldText($field)
    {
        echo '<label>' . $this->getValue($field, "label") . '</label>
                <input type="text" name="" value="" class="form-control" />
                <p class="help-block">'. $this->getValue($field, "comment") .'</p>';
    }

    public function fieldImage($field)
    {
        echo '<label>' . $this->getValue($field, "label") . '</label>
        <div class="field-mediafinder style-image-single is-image " data-control="mediafinder" data-disposable="">
                    
                    <!-- Find Button -->
                    <a href="javascript:;" class="find-button">
                        <span class="find-button-icon oc-icon-image"></span>
                    </a>
    
                    <!-- Existing value -->
                    <div class="find-object">
                        <div class="icon-container">
                            <img data-find-image="" src="" alt="">
                        </div>
                        <div class="info">
                            <h4 class="filename">
                                <span data-find-file-name=""></span>
                                <a href="javascript:;" class="find-remove-button">
                                    <i class="icon-times"></i>
                                </a>
                            </h4>
                        </div>
                    </div>
    
                    <!-- Data locker -->
                    <input type="hidden" name="settings[image]" id="Form-formPageb60415bb486b3eb849523d114f98317f5796371f301ec-field-settings-image" value="" data-find-value="">
                </div><p class="help-block">'. $this->getValue($field, "comment") .'</p>';
    }

    public function fieldCheckboxlist($field)
    {
        echo '<label>'. $this->getValue($field, "label") .'</label>
                    <p class="help-block before-field">'. $this->getValue($field, "comment") .'</p>

                    <div class="checkbox custom-checkbox">
                        <input id="checkbox-example1" name="checkbox" value="1" type="checkbox">
                        <label class="choice" for="checkbox-example1"> Dodge Viper</label>
                        <p class="help-block">Do not send new comment notifications.</p>
                    </div>
                    <div class="checkbox custom-checkbox">
                        <input checked="checked" id="checkbox-example2" name="checkbox" value="2" type="checkbox">
                        <label class="choice" for="checkbox-example2"> GM Corvette</label>
                        <p class="help-block">Send new comment notifications only to post author.</p>
                    </div>
                    <div class="checkbox custom-checkbox">
                        <input id="checkbox-example3" name="checkbox" value="3" type="checkbox">
                        <label class="choice" for="checkbox-example3"> Porsche Boxter</label>
                        <p class="help-block">Notify all users who have permissions to receive blog notifications.</p>
                    </div>';
    }
    public function fieldRadio($field)
    {
        echo '<label>'. $this->getValue($field, "label") .'</label>
                    <p class="help-block before-field">'. $this->getValue($field, "comment") .'</p>

                    <div class="radio custom-radio">
                        <input name="radio" value="1" type="radio" id="radio_1">
                        <label for="radio_1">Paris</label>
                        <p class="help-block">Do not send new comment notifications.</p>
                    </div>
                    <div class="radio custom-radio">
                        <input checked="checked" name="radio" value="2" type="radio" id="radio_2">
                        <label for="radio_2">Dubai</label>
                        <p class="help-block">Send new comment notifications only to post author.</p>
                    </div>
                    <div class="radio custom-radio">
                        <input name="radio" value="3" type="radio" id="radio_3">
                        <label for="radio_3">New Zealand</label>
                        <p class="help-block">Notify all users who have permissions to receive blog notifications.</p>
                    </div>';
    }
    public function fieldSwitch($field)
    {
        echo '<div class="field-switch">
            <label>'. $this->getValue($field, "label") .'</label>
            <p class="help-block">'. $this->getValue($field, "comment") .'</p>
            </div>
        <label class="custom-switch">
                    <input type="checkbox" />
                    <span><span>On</span><span>Off</span></span>
                    <a class="slide-button"></a>
                </label>';
    }
    public function fieldCheckbox($field)
    {
        echo '<div class="checkbox custom-checkbox">
            <input name="checkbox" value="1" type="checkbox" id="checkbox_1">
            <label for="checkbox_1">'. $this->getValue($field, "label") .'</label>
            <p class="help-block">'. $this->getValue($field, "comment") .'</p>
        </div>';
    }
    public function fieldDropdown($field)
    {
        echo '<div class="form-group dropdown-field span-left">
                    <label>'. $this->getValue($field, "label") .'</label>
                    <select class="form-control custom-select">
                        <option selected="selected" value="2">Approved</option>
                        <option value="3">Deleted</option>
                        <option value="1">New</option>
                    </select>
                </div>';
    }
}