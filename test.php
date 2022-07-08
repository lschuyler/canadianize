<?php

namespace lschuyler\Canadianize;
require __DIR__ . '/src/class-canadianize.php';
require __DIR__ . '/src/class-person.php';

//include_once('../../../wp-includes/option.php');
/** Sets up WordPress vars and included files. */
require_once('ABSPATH' . '/wp-settings.php');

$includedStuff = get_included_files();
print_r($includedStuff);

$canadian_person = new Person();
echo "<br/>" . $canadian_person->name;

