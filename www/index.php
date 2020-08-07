<?php

require_once '../vendor/autoload.php';

use LeadGenerator\Generator;

$generator = new Generator();
$generator->generateLeads(100, '\maxodrom\leadgentest\Handler::processLead');
