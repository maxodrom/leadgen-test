<?php

require_once '../vendor/autoload.php';

use LeadGenerator\Generator;

$generator = new Generator();
$generator->generateLeads(10000, '\maxodrom\leadgentest\Handler::processLead');
