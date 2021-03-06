<?php

class rex_xform_checkbox extends rex_xform_abstract
{

  function enterObject()
  {
    if ($this->getElement(3) == "") $this->setElement(3,1);

    $checked = "";

    if($this->params["send"] != 1 && $this->getValue() === "" && $this->getElement(4) == $this->getElement(3))
    {
      $checked = ' checked="checked"';
      $v = $this->getElement(3);

    }elseif($this->getValue() == $this->getElement(3)) {
      $checked = ' checked="checked"';
      $v = $this->getElement(3);

    }elseif($this->getValue() == 1) {
      $checked = ' checked="checked"';
      $v = 1;

    }else {
      $this->setValue("0");
      $v = 1;
    }

    $wc = "";
    if (isset($this->params["warning"][$this->getId()])) {
      $wc = $this->params["warning"][$this->getId()];
    }

    $this->params["form_output"][$this->getId()] = '
      <p class="formcheckbox formlabel-'.$this->getName().'" id="'.$this->getHTMLId().'">
        <input type="checkbox" class="checkbox '.$wc.'" name="'.$this->getFieldName().'" id="'.$this->getFieldId().'" value="'.$v.'" '.$checked.' />
        <label class="checkbox '.$wc.'" for="'.$this->getFieldId().'" >'.rex_translate($this->getElement(2)).'</label>
      </p>';

    $this->params["value_pool"]["email"][$this->getElement(1)] = stripslashes($this->getValue());
    if ($this->getElement(5) != "no_db") { $this->params["value_pool"]["sql"][$this->getElement(1)] = $this->getValue(); }

  }

  function getDescription()
  {
    return "checkbox -> Beispiel: checkbox|check_design|Bezeichnung|Value|1/0|[no_db]";
  }

  function getDefinitions()
  {

    return array(
            'type' => 'value',
            'name' => 'checkbox',
            'values' => array(
    array( 'type' => 'name',   'label' => 'Name' ),
    array( 'type' => 'text',    'label' => 'Bezeichnung'),
    array( 'type' => 'text',    'label' => 'Wert wenn angeklickt', 'default' => 1),
    array( 'type' => 'boolean', 'label' => 'Defaultstatus',         'default' => 1),
    array( 'type' => 'no_db',   'label' => 'Datenbank',  'default' => 1),
    ),
            'description' => 'Ein Selectfeld mit festen Definitionen.',
            'dbtype' => 'varchar(255)',
            'famous' => TRUE
    );

  }



}

?>