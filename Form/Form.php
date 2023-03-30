<?php

namespace App\Core\Form;

use App\Core\Form\Field;
use App\Core\Form\BaseField;
use App\Core\Form\SubmitButton;
use App\Core\Form\InputField;
use App\Core\Form\TextAreaField;


class Form
{
    public array $options = [];

    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field($model, $attribute)
    {
        return new InputField($model, $attribute);
    }

    public function label($model, $attribute)
    {
        // return new InputField($model, $attribute);
    }

    public function textAreaField($model, $attribute)
    {
        return new TextAreaField($model, $attribute);
    }

    public function submitButton($model, $text)
    {
        return new SubmitButton($model, $text);
    }

    // public function addOption(string $option): self
    // {
    //     $this->options[] = $option;
    //     return $this;
    // }

    // public function addOptions(array $options): self
    // {
    //     foreach ($options as $option) {
    //         $this->addOption($option);
    //     }
    //     return $this;
    // }
}
