<?php

require_once __DIR__. '/../vendor/autoload.php';

use LeadGenerator\Generator;

$generator = new Generator();
$generator->generateLeads(10000, '\maxodrom\leadgentest\Handler::processLead');
