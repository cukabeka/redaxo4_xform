<?php

class rex_xform_text extends rex_xform_abstract
{

	function enterObject()
	{

		if ($this->getValue() == "" && !$this->params["send"]) {
			$this->setValue($this->getElement(3));
		}

		$classes = "";
		$classes .= " ".$this->getElement(5);
		
		$wc = "";
		if (isset($this->params["warning"][$this->getId()])) {
			$wc = " ".$this->params["warning"][$this->getId()];
		}

		$this->params["form_output"][$this->getId()] = '
			<p class="formtext formlabel-'.$this->getName().'" id="'.$this->getHTMLId().'">
				<label class="text' . $wc . '" for="' . $this->getFieldId() . '" >' . rex_translate($this->getElement(2)) . '</label>
				<input type="text" class="text'.$classes.$wc.'" name="'.$this->getFieldName().'" id="'.$this->getFieldId().'" value="'.htmlspecialchars(stripslashes($this->getValue())).'" />
			</p>';

		$this->params["value_pool"]["email"][$this->getElement(1)] = stripslashes($this->getValue());
		if ($this->getElement(4) != "no_db")
		{
			$this->params["value_pool"]["sql"][$this->getElement(1)] = $this->getValue();
		}

	}

	function getDescription()
	{
		return "text -> Beispiel: text|label|Bezeichnung|defaultwert|[no_db]";
	}

	function getDefinitions()
	{
		return array(
						'type' => 'value',
						'name' => 'text',
						'values' => array(
									array( 'type' => 'name',   'label' => 'Feld' ),
									array( 'type' => 'text',    'label' => 'Bezeichnung'),
									array( 'type' => 'text',    'label' => 'Defaultwert'),
									array( 'type' => 'no_db',   'label' => 'Datenbank',  'default' => 1),
									array( 'type' => 'text',    'label' => 'classes'),
								),
						'description' => 'Ein einfaches Textfeld als Eingabe',
						'dbtype' => 'text',
						'famous' => TRUE
						);

	}
}

?>