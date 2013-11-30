<?php

$controllers = new Pimple();

$controllers['LoginController2'] = function($c) use ($services) {
	return new \Controllers\LoginController2($services['AccountManager'], $services['Input'], $services['Redirect']);
}

?>