<?php
use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ArrayCache,
	Doctrine\Common\Annotations\AnnotationReader,
	Doctrine\ORM\Mapping\Driver\AnnotationDriver,
	Doctrine\DBAL\Logging\EchoSqlLogger,
	Doctrine\DBAL\Event\Listeners\MysqlSessionInit,
	Doctrine\ORM\Tools\SchemaTool,
	Doctrine\Common\EventManager,
	Doctrine\ORM\Tools\Setup;

/**
 * Doctrine2 bridge to CodeIgniter
 */
class Doctrine 
{
	/**
	 * Doctrine Entity Manager
	 * @var Doctrine\ORM\EntityManager 
	 */
	public $em = null;
	
	public $config = null;
	
	public $connectionOptions = null;

	public function __construct()
	{
		// Set up class loading. You could use different autoloaders, provided by your favorite framework,
		// if you want to.
		$directory = APPPATH . "third_party/doctrine2-orm";
		if (!class_exists('Doctrine\ORM\Tools\Setup', false)) 
		{
			require $directory . '/Doctrine/ORM/Tools/Setup.php';
		}
		Doctrine\ORM\Tools\Setup::registerAutoloadDirectory($directory);

		$doctrineClassLoader = new ClassLoader('Doctrine',  APPPATH.'libraries');
		$doctrineClassLoader->register();
		
		// Set up models loading
		$entitiesClassLoader = new ClassLoader('models', rtrim(APPPATH, "/" ));
		$entitiesClassLoader->register();
		foreach (glob(APPPATH.'modules/*', GLOB_ONLYDIR) as $m) 
		{
			$module = str_replace(APPPATH.'modules/', '', $m);
			$loader = new ClassLoader($module, APPPATH.'modules');
			$loader->register();
		}
		
		$proxiesClassLoader = new ClassLoader('Proxies', APPPATH.'models/proxies');
		$proxiesClassLoader->register();

		// Set up caches
		$this->config = new Configuration;
		$cache = new ArrayCache;
//		$cache = new \Doctrine\Common\Cache\ApcCache;
		$this->config->setMetadataCacheImpl($cache);
		$this->config->setQueryCacheImpl($cache);

		// Set up models
		$models = array(APPPATH.'models');
		foreach (glob(APPPATH.'modules/*/models', GLOB_ONLYDIR) as $m)
			array_push($models, $m);
		$driverImpl = $this->config->newDefaultAnnotationDriver($models);
		$this->config->setMetadataDriverImpl($driverImpl);

		// Proxy configuration
		$this->config->setProxyDir(APPPATH.'/models/proxies');
		$this->config->setProxyNamespace('Proxies');

		// Set up logger
//		$logger = new EchoSQLLogger;
//		$this->config->setSQLLogger($logger);

		$this->config->setAutoGenerateProxyClasses( TRUE );

		// Database connection information
		// load database configuration from CodeIgniter
		// Is the config file in the environment folder?
		if ( ! defined('ENVIRONMENT') OR ! file_exists($file_path = APPPATH.'config/'.ENVIRONMENT.'/database.php'))
		{
			if ( ! file_exists($file_path = APPPATH.'config/database.php'))
			{
				show_error('The configuration file database.php does not exist.');
			}
		}

		include($file_path);

		if ( ! isset($db) OR count($db) == 0)
		{
			show_error('No database connection settings were found in the database config file.');
		}
			
		$this->connectionOptions = array(
			'driver'	=> 'pdo_mysql',
			'user'		=> $db['default']['username'],
			'password'	=> $db['default']['password'],
			'host'		=> $db['default']['hostname'],
			'dbname'	=> $db['default']['database']
		);

		// Create EntityManager
		$this->em = EntityManager::create($this->connectionOptions, $this->config);
	}
}