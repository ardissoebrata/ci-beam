<?php
use Symfony\Component\Console\Helper\HelperSet,
		Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper,
		Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper,
		Doctrine\ORM\Tools\Setup,
		Doctrine\ORM\EntityManager;

define('BASEPATH', __DIR__ . '/../../../../system/');
define('APPPATH', __DIR__ . '/../../../');

require_once APPPATH . 'libraries/Doctrine.php';

$doctrine = new Doctrine;

//$config = Setup::createAnnotationMetadataConfiguration(array(APPPATH.'models/entities'));
//$em = EntityManager::create($doctrine->connectionOptions, $config);
$em = $doctrine->em;

$helperSet = new HelperSet(array(
    'db' => new ConnectionHelper($em->getConnection()),
    'em' => new EntityManagerHelper($em)
));
