<?php

namespace Framework\Helpers\Form\Fields;

class Select extends FormField
{
	public $options = array();
	
	public function html() {
		$html = '';
		$html .= "<select class=\"{$this->classes}\" id=\"{$this->id}\" name=\"{$this->name}\" />";
		foreach ($this->options as $value => $text) {
			
			if ($this->value == $value) {
				$html .= "<option value=\"{$value}\" selected=\"selected\">{$text}</option>";
			} 
			else {
				$html .= "<option value=\"{$value}\">{$text}</option>";
			}
		}
		$html .= "</select>";
		
		return $html;
	}
}