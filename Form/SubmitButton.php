<?php

namespace Astcode\Core\Form;

use Astcode\Core\Model;
use Astcode\Core\Form\BaseField;

class SubmitButton extends BaseField
{
    public array $options = [];
    private string $text;

    public function __construct(Model $model, $text)
    {
        $this->text = $text;
        parent::__construct($model, $text);
    }

    public function addOption(string $option): self
    {
        $this->options[] = $option;
        return $this;
    }

    public function addOptions(array $options): self
    {
        foreach ($options as $option) {
            $this->addOption($option);
        }
        return $this;
    }

    public function renderInput(): string
    {
        $class = '';

        if (!empty($this->options)) {
            $class = ' ' . implode(' ', $this->options);
        }

        return sprintf('<button type="submit" class="btn btn-primary%s">%s</button>', $class, $this->text);
    }

    public function getOverRideLabel(): string
    {
        // Customize the label for the submit button here.
        // Return an empty string if you don't want a label.
        return '';
    }
}
