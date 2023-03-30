<?php

namespace App\Core\Form;

use App\Core\Model;
use App\Core\Form\BaseField;

class InputField extends BaseField
{
    /**
<input type="button">
<input type="checkbox">
<input type="color">
<input type="date">
<input type="datetime-local">
<input type="email">
<input type="file">
<input type="hidden">
<input type="image">
<input type="month">
<input type="number">
<input type="password">
<input type="radio">
<input type="range">
<input type="reset">
<input type="search">
<input type="submit">
<input type="tel">
<input type="text">
<input type="time">
<input type="url">
<input type="week">
     */
    public const TYPE_BUTTON = 'button';
    public const TYPE_CHECKBOX = 'checkbox';
    public const TYPE_COLOR = 'color';
    public const TYPE_DATE = 'date';
    public const TYPE_DATETIME_LOCAL = 'datetime-local';
    public const TYPE_EMAIL = 'email';
    public const TYPE_FILE = 'file';
    public const TYPE_HIDDEN = 'hidden';
    public const TYPE_IMAGE = 'image';
    public const TYPE_MONTH = 'month';
    public const TYPE_NUMBER = 'number';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_RADIO = 'radio';
    public const TYPE_RANGE = 'range';
    public const TYPE_RESET = 'reset';
    public const TYPE_SEARCH = 'search';
    public const TYPE_SUBMIT = 'submit';
    public const TYPE_TEL = 'tel';
    public const TYPE_TEXT = 'text';
    public const TYPE_TIME = 'time';
    public const TYPE_URL = 'url';
    public const TYPE_WEEK = 'week';



    public string $type;
    public string $placeholder = '';
    public array $options = [];



    /**
     * Field constructor.
     *
     * @param App\Core\Model $model
     * @param String $attribute
     */
    public function __construct(Model $model, $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    public function fieldType($type)
    {
        // switch on $type
        switch ($type) {
            case 'button':
                $this->type = self::TYPE_BUTTON;
                break;
            case 'checkbox':
                $this->type = self::TYPE_CHECKBOX;
                break;
            case 'color':
                $this->type = self::TYPE_COLOR;
                break;
            case 'date':
                $this->type = self::TYPE_DATE;
                break;
            case 'datetime-local':
                $this->type = self::TYPE_DATETIME_LOCAL;
                break;
            case 'email':
                $this->type = self::TYPE_EMAIL;
                break;
            case 'file':
                $this->type = self::TYPE_FILE;
                break;
            case 'hidden':
                $this->type = self::TYPE_HIDDEN;
                break;
            case 'image':
                $this->type = self::TYPE_IMAGE;
                break;
            case 'month':
                $this->type = self::TYPE_MONTH;
                break;
            case 'number':
                $this->type = self::TYPE_NUMBER;
                break;
            case 'password':
                $this->type = self::TYPE_PASSWORD;
                break;
            case 'radio':
                $this->type = self::TYPE_RADIO;
                break;
            case 'range':
                $this->type = self::TYPE_RANGE;
                break;
            case 'reset':
                $this->type = self::TYPE_RESET;
                break;
            case 'search':
                $this->type = self::TYPE_SEARCH;
                break;
            case 'submit':
                $this->type = self::TYPE_SUBMIT;
                break;
            case 'tel':
                $this->type = self::TYPE_TEL;
                break;
            case 'text':
                $this->type = self::TYPE_TEXT;
                break;
            case 'time':
                $this->type = self::TYPE_TIME;
                break;
            case 'url':
                $this->type = self::TYPE_URL;
                break;
            case 'week':
                $this->type = self::TYPE_WEEK;
                break;
            default:
                $this->type = self::TYPE_TEXT;
                break;
        }
        return $this;
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function placeholder($value)
    {
        $this->placeholder = $value;
        return $this;
    }

    public function addOption(string $option): self
    {
        $this->options[] = $option;
        return $this;
    }

    public function numberField()
    {
        $this->type = self::TYPE_NUMBER;
        return $this;
    }

    public function label()
    {
        return sprintf('
            <label>%s</label>
        ', $this->model->getLabel($this->attribute));
    }

    public function renderInput(): string
    {
        $class = '';

        if (!empty($this->options)) {
            $class = ' ' . implode(' ', $this->options);
        }

        return sprintf(
            '
            <input type="%s" name="%s" value="%s" class="form-control%s%s" placeholder="%s">',
            $this->type, // type
            $this->attribute,  // name
            $this->model->{$this->attribute}, // value
            $this->model->hasError($this->attribute) ? ' is-invalid' : '', // class
            $class ? ' ' . $class : '', // class
            $this->placeholder, // placeholder
        );
    }



}
