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
	Doctrine\Common\EventManager;

/**
 * Doctrine2 bridge to CodeIgniter
 * 
 * @todo Add ENVIRONMENT aware configuration & database.
 */
class Doctrine 
{
	public $em = null;

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
		$config = new Configuration;
		$cache = new ArrayCache;
		$config->setMetadataCacheImpl($cache);
		$driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH.'models/Entities'));
		$config->setMetadataDriverImpl($driverImpl);
		$config->setQueryCacheImpl($cache);

		$config->setQueryCacheImpl($cache);

		// Proxy configuration
		$config->setProxyDir(APPPATH.'/models/proxies');
		$config->setProxyNamespace('Proxies');

		// Set up logger
		$logger = new EchoSQLLogger;
		$config->setSQLLogger($logger);

		$config->setAutoGenerateProxyClasses( TRUE );

		// Database connection information
		// load database configuration from CodeIgniter
		require APPPATH.'config/database.php';
			
		$connectionOptions = array(
			'driver'	=> 'pdo_mysql',
			'user'		=> $db['default']['username'],
			'password'	=> $db['default']['password'],
			'host'		=> $db['default']['hostname'],
			'dbname'	=> $db['default']['database']
		);

		// Create EntityManager
		$this->em = EntityManager::create($connectionOptions, $config);
	}
}