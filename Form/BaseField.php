<?php

namespace App\Core\Form;

use App\Core\Model;

abstract class BaseField
{

    public Model $model;
    public string $attribute;

    abstract public function renderInput(): string;

        /**
     * Field constructor.
     *
     * @param App\Core\Model $model
     * @param String $attribute
     */
    public function __construct($model, $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        $label = method_exists($this, 'getOverRideLabel') 
            ? $this->getOverRideLabel() 
            : $this->model->getLabel($this->attribute);

        return sprintf(
            '
            <div class="form-group">
                %s
                %s
                <div class="invalid-feedback"> 
                    %s 
                </div>
            </div>
        ',
            $label, // label
            $this->renderInput(), // input
            $this->model->getFirstError($this->attribute)
        ); // error message
    }


    
}
