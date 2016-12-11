<?php

class ParserFunctionsHooks {

	/**
	 * @param $parser Parser
	 * @return bool
	 */
	public static function onParserFirstCallInit( $parser ) {
    global $sfgFormPrinter;

    $sfgFormPrinter->setInputTypeHook('hw-location', 'hw_location_input_html', array());

    function hw_location_input_html($cur_value, $input_name, $is_mandatory, $is_disabled, $field_args) {
      echo "<br>";
      echo "HW LOCATION:<br>";
      echo "cur_value:" . $cur_value;
      echo "<br>";
      echo "input_name:" . $input_name;
      echo "<br>";
      echo "is_mandatory:" . $is_mandatory;
      echo "<br>";
      echo "is_disabled:" . $is_disabled;
      echo "<br>";
      echo "field_args:" . print_r($field_args, true);
      echo "<br>";
    }

		return true;
	}

}
