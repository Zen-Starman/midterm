<?php

/**
 * Validate the form
 *
 * @return boolean
 */
function validForm()
{
    global $f3;
    $isValid = true;

    if (!validName($f3->get('name'))) {

        $isValid = false;
        $f3->set("errors['name']", "Please enter a valid name");
    }

    if (!validOptions($f3->get('options'))) {

        $isValid = false;
        $f3->set("errors['options']", "Please select valid options");
    }

    return $isValid;
}

/**
 * Validate name
 *
 * @param $name
 * @return bool
 */
function validName($name){
    return (!empty($name) && ctype_alpha($name));
}

/**
 * Validate options
 *
 * @param String options
 * @return boolean
 */
function validOptions($options)
{
    global $f3;

    //Questions are mandatory
    if (empty($options)) {
        return false;
    }
    //If there are options chosen, we need to validate
    foreach ($options as $option) {
        if (!in_array($option, $f3->get('options'))) {
            return false;
        }
    }
    //If we're still here, then we have valid options
    return true;
}