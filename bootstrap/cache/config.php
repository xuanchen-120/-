<?php return array (
  'app' => 
  array (
    'name' => '五百万部《大乘离文字普光明藏经》多群共修，诚邀您融入诵经抄经功德海',
    'env' => 'production',
    'debug' => false,
    'url' => 'http://www.xdeepu.cn',
    'asset_url' => NULL,
    'timezone' => 'PRC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:d3drEu2RKc6WFb4CW/+3OYmBiiBhDX1sP1lILZ9BBnA=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\EventServiceProvider',
      25 => 'App\\Providers\\RouteServiceProvider',
      26 => 'Overtrue\\LaravelWeChat\\ServiceProvider',
      27 => 'App\\Facades\\Sms\\SmsServiceProvider',
      28 => 'Xethron\\MigrationsGenerator\\MigrationsGeneratorServiceProvider',
      29 => 'Spatie\\Backup\\BackupServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'EasyWeChat' => 'Overtrue\\LaravelWeChat\\Facade',
      'Sms' => 'App\\Facades\\Sms\\SmsFacade',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
      ),
      'rulong' => 
      array (
        'driver' => 'session',
        'provider' => 'rulong',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
      'rulong' => 
      array (
        'driver' => 'eloquent',
        'model' => 'RuLong\\Panel\\Models\\Admin',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'backup' => 
  array (
    'backup' => 
    array (
      'name' => 'guangmingBak',
      'source' => 
      array (
        'files' => 
        array (
          'include' => 
          array (
            0 => '/home/wwwroot/www.xdeepu.cn',
          ),
          'exclude' => 
          array (
            0 => '/home/wwwroot/www.xdeepu.cn/vendor',
            1 => '/home/wwwroot/www.xdeepu.cn/node_modules',
          ),
          'followLinks' => false,
        ),
        'databases' => 
        array (
          0 => 'mysql',
        ),
      ),
      'database_dump_compressor' => NULL,
      'destination' => 
      array (
        'filename_prefix' => 'all_',
        'disks' => 
        array (
          0 => 'local',
        ),
      ),
      'temporary_directory' => '/home/wwwroot/www.xdeepu.cn/storage/app/backup-temp',
    ),
    'notifications' => 
    array (
      'notifications' => 
      array (
        'Spatie\\Backup\\Notifications\\Notifications\\BackupHasFailed' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\UnhealthyBackupWasFound' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\CleanupHasFailed' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\BackupWasSuccessful' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\HealthyBackupWasFound' => 
        array (
          0 => 'mail',
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\CleanupWasSuccessful' => 
        array (
          0 => 'mail',
        ),
      ),
      'notifiable' => 'Spatie\\Backup\\Notifications\\Notifiable',
      'mail' => 
      array (
        'to' => 'your@example.com',
      ),
      'slack' => 
      array (
        'webhook_url' => '',
        'channel' => NULL,
        'username' => NULL,
        'icon' => NULL,
      ),
    ),
    'monitorBackups' => 
    array (
      0 => 
      array (
        'name' => 'guangmingBak',
        'disks' => 
        array (
          0 => 'local',
        ),
        'newestBackupsShouldNotBeOlderThanDays' => 1,
        'storageUsedMayNotBeHigherThanMegabytes' => 5000,
      ),
    ),
    'cleanup' => 
    array (
      'strategy' => 'Spatie\\Backup\\Tasks\\Cleanup\\Strategies\\DefaultStrategy',
      'defaultStrategy' => 
      array (
        'keepAllBackupsForDays' => 7,
        'keepDailyBackupsForDays' => 16,
        'keepWeeklyBackupsForWeeks' => 8,
        'keepMonthlyBackupsForMonths' => 4,
        'keepYearlyBackupsForYears' => 2,
        'deleteOldestBackupsWhenUsingMoreMegabytesThan' => 5000,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'encrypted' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/home/wwwroot/www.xdeepu.cn/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
    ),
    'prefix' => '_cache',
  ),
  'captcha' => 
  array (
    'characters' => '2346789abcdefghjmnpqrtuxyzABCDEFGHJMNPQRTUXYZ',
    'default' => 
    array (
      'length' => 4,
      'width' => 115,
      'height' => 34,
      'quality' => 90,
      'fontColors' => 
      array (
        0 => '#2c3e50',
        1 => '#c0392b',
        2 => '#16a085',
        3 => '#c0392b',
        4 => '#8e44ad',
        5 => '#303f9f',
        6 => '#f57c00',
        7 => '#795548',
      ),
    ),
    'flat' => 
    array (
      'length' => 6,
      'width' => 160,
      'height' => 46,
      'quality' => 90,
      'lines' => 6,
      'bgImage' => false,
      'bgColor' => '#ecf2f4',
      'fontColors' => 
      array (
        0 => '#2c3e50',
        1 => '#c0392b',
        2 => '#16a085',
        3 => '#c0392b',
        4 => '#8e44ad',
        5 => '#303f9f',
        6 => '#f57c00',
        7 => '#795548',
      ),
      'contrast' => -5,
    ),
    'mini' => 
    array (
      'length' => 3,
      'width' => 60,
      'height' => 32,
    ),
    'inverse' => 
    array (
      'length' => 5,
      'width' => 120,
      'height' => 36,
      'quality' => 90,
      'sensitive' => true,
      'angle' => 12,
      'sharpen' => 10,
      'blur' => 2,
      'invert' => true,
      'contrast' => -5,
    ),
    'math' => 
    array (
      'length' => 9,
      'width' => 120,
      'height' => 36,
      'quality' => 90,
      'math' => true,
    ),
  ),
  'catetype' => 
  array (
    'article' => '文章模型',
    'industry' => '行业模型',
    'demand' => '需求模型',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'guangming',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'guangming',
        'username' => 'guangming',
        'password' => '9gxEUhELRfUSc8p2',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'guangming',
        'username' => 'guangming',
        'password' => '9gxEUhELRfUSc8p2',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'guangming',
        'username' => 'guangming',
        'password' => '9gxEUhELRfUSc8p2',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
      'cache' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 1,
      ),
    ),
  ),
  'easysms' => 
  array (
    'timeout' => 5.0,
    'default' => 
    array (
      'strategy' => 'Overtrue\\EasySms\\Strategies\\OrderStrategy',
      'gateways' => 
      array (
        0 => 'aliyun',
      ),
    ),
    'gateways' => 
    array (
      'aliyun' => 
      array (
        'access_key_id' => 'LTAISvjjFhlYvAz6',
        'access_key_secret' => 'lS3MWrbzxcz45OCGqZSEhxhElwN6eV',
        'sign_name' => '特会卖路演俱乐部',
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/home/wwwroot/www.xdeepu.cn/storage/app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/home/wwwroot/www.xdeepu.cn/storage/app/public',
        'url' => 'http://www.xdeepu.cn/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
        'url' => NULL,
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'logging' => 
  array (
    'default' => 'daily',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'daily',
        ),
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/home/wwwroot/www.xdeepu.cn/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/home/wwwroot/www.xdeepu.cn/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.mailtrap.io',
    'port' => '2525',
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Example',
    ),
    'encryption' => NULL,
    'username' => NULL,
    'password' => NULL,
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/home/wwwroot/www.xdeepu.cn/resources/views/vendor/mail',
      ),
    ),
    'log_channel' => NULL,
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'rulong' => 
  array (
    'title' => 'R.Admin',
    'directory' => '/home/wwwroot/www.xdeepu.cn/app/Admin',
    'route' => 
    array (
      'prefix' => 'admin',
      'middleware' => 
      array (
        0 => 'web',
        1 => 'rulong',
      ),
      'namespace' => 'App\\Admin\\Controllers',
    ),
    'auth' => 
    array (
      'guards' => 
      array (
        'rulong' => 
        array (
          'driver' => 'session',
          'provider' => 'rulong',
        ),
      ),
      'providers' => 
      array (
        'rulong' => 
        array (
          'driver' => 'eloquent',
          'model' => 'RuLong\\Panel\\Models\\Admin',
        ),
      ),
    ),
    'logs' => 
    array (
      'enable' => true,
      'except' => 
      array (
        0 => '/',
        1 => 'dashboard',
        2 => 'password',
        3 => 'logs*',
      ),
    ),
    'permission' => 
    array (
      'except' => 
      array (
        0 => '/',
        1 => 'auth*',
        2 => 'dashboard',
        3 => 'password',
        4 => 'ajaxs*',
      ),
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
      'webhook' => 
      array (
        'secret' => NULL,
        'tolerance' => 300,
      ),
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '43200',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/home/wwwroot/www.xdeepu.cn/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => '_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'ueditor' => 
  array (
    'imageActionName' => 'uploadImage',
    'imageFieldName' => 'upfile',
    'imageMaxSize' => 2048000,
    'imageAllowFiles' => 
    array (
      0 => '.png',
      1 => '.jpg',
      2 => '.jpeg',
      3 => '.gif',
      4 => '.bmp',
    ),
    'imageCompressEnable' => true,
    'imageCompressBorder' => 1600,
    'imageInsertAlign' => 'none',
    'imageUrlPrefix' => '',
    'imagePathFormat' => '/uploads/images/{yyyy}/{mm}/{dd}/{hash}',
    'scrawlActionName' => 'uploadScrawl',
    'scrawlFieldName' => 'upfile',
    'scrawlPathFormat' => '/uploads/images/{yyyy}/{mm}/{dd}/{hash}',
    'scrawlMaxSize' => 2048000,
    'scrawlUrlPrefix' => '',
    'scrawlInsertAlign' => 'none',
    'snapscreenActionName' => 'uploadImage',
    'snapscreenPathFormat' => '/uploads/images/{yyyy}/{mm}/{dd}/{hash}',
    'snapscreenUrlPrefix' => '',
    'snapscreenInsertAlign' => 'none',
    'catcherActionName' => 'catchImage',
    'catcherLocalDomain' => 
    array (
    ),
    'catcherFieldName' => 'source',
    'catcherPathFormat' => '/uploads/images/{yyyy}/{mm}/{dd}/{hash}',
    'catcherUrlPrefix' => '',
    'catcherMaxSize' => 2048000,
    'catcherAllowFiles' => 
    array (
      0 => '.png',
      1 => '.jpg',
      2 => '.jpeg',
      3 => '.gif',
      4 => '.bmp',
    ),
    'videoActionName' => 'uploadVideo',
    'videoFieldName' => 'upfile',
    'videoPathFormat' => '/uploads/videos/{yyyy}/{mm}/{dd}/{hash}',
    'videoUrlPrefix' => '',
    'videoMaxSize' => 102400000,
    'videoAllowFiles' => 
    array (
      0 => '.flv',
      1 => '.swf',
      2 => '.mkv',
      3 => '.avi',
      4 => '.rm',
      5 => '.rmvb',
      6 => '.mpeg',
      7 => '.mpg',
      8 => '.ogg',
      9 => '.ogv',
      10 => '.mov',
      11 => '.wmv',
      12 => '.mp4',
      13 => '.webm',
      14 => '.mp3',
      15 => '.wav',
      16 => '.mid',
    ),
    'fileActionName' => 'uploadFile',
    'fileFieldName' => 'upfile',
    'filePathFormat' => '/uploads/files/{yyyy}/{mm}/{dd}/{hash}',
    'fileUrlPrefix' => '',
    'fileMaxSize' => 51200000,
    'fileAllowFiles' => 
    array (
      0 => '.png',
      1 => '.jpg',
      2 => '.jpeg',
      3 => '.gif',
      4 => '.bmp',
      5 => '.flv',
      6 => '.swf',
      7 => '.mkv',
      8 => '.avi',
      9 => '.rm',
      10 => '.rmvb',
      11 => '.mpeg',
      12 => '.mpg',
      13 => '.ogg',
      14 => '.ogv',
      15 => '.mov',
      16 => '.wmv',
      17 => '.mp4',
      18 => '.webm',
      19 => '.mp3',
      20 => '.wav',
      21 => '.mid',
      22 => '.rar',
      23 => '.zip',
      24 => '.tar',
      25 => '.gz',
      26 => '.7z',
      27 => '.bz2',
      28 => '.cab',
      29 => '.iso',
      30 => '.doc',
      31 => '.docx',
      32 => '.xls',
      33 => '.xlsx',
      34 => '.ppt',
      35 => '.pptx',
      36 => '.pdf',
      37 => '.txt',
      38 => '.md',
      39 => '.xml',
    ),
    'imageManagerActionName' => 'listImage',
    'imageManagerListPath' => '/uploads/images/',
    'imageManagerListSize' => 20,
    'imageManagerUrlPrefix' => '',
    'imageManagerInsertAlign' => 'none',
    'imageManagerAllowFiles' => 
    array (
      0 => '.png',
      1 => '.jpg',
      2 => '.jpeg',
      3 => '.gif',
      4 => '.bmp',
    ),
    'fileManagerActionName' => 'listFile',
    'fileManagerListPath' => '/uploads/files/',
    'fileManagerUrlPrefix' => '',
    'fileManagerListSize' => 20,
    'fileManagerAllowFiles' => 
    array (
      0 => '.png',
      1 => '.jpg',
      2 => '.jpeg',
      3 => '.gif',
      4 => '.bmp',
      5 => '.flv',
      6 => '.swf',
      7 => '.mkv',
      8 => '.avi',
      9 => '.rm',
      10 => '.rmvb',
      11 => '.mpeg',
      12 => '.mpg',
      13 => '.ogg',
      14 => '.ogv',
      15 => '.mov',
      16 => '.wmv',
      17 => '.mp4',
      18 => '.webm',
      19 => '.mp3',
      20 => '.wav',
      21 => '.mid',
      22 => '.rar',
      23 => '.zip',
      24 => '.tar',
      25 => '.gz',
      26 => '.7z',
      27 => '.bz2',
      28 => '.cab',
      29 => '.iso',
      30 => '.doc',
      31 => '.docx',
      32 => '.xls',
      33 => '.xlsx',
      34 => '.ppt',
      35 => '.pptx',
      36 => '.pdf',
      37 => '.txt',
      38 => '.md',
      39 => '.xml',
    ),
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/home/wwwroot/www.xdeepu.cn/resources/views',
    ),
    'compiled' => '/home/wwwroot/www.xdeepu.cn/storage/framework/views',
  ),
  'wechat' => 
  array (
    'defaults' => 
    array (
      'response_type' => 'array',
      'use_laravel_cache' => true,
      'log' => 
      array (
        'level' => 'debug',
        'file' => '/home/wwwroot/www.xdeepu.cn/storage/logs/wechat.log',
      ),
    ),
    'route' => 
    array (
    ),
    'official_account' => 
    array (
      'default' => 
      array (
        'app_id' => 'wx49b94bce6e34c582',
        'secret' => 'cbd8be4220d421fc1b2d20aa56be0e09',
        'token' => 'MhqcFEh3ZqrQ2OlzwAT9HeYawsNQ6vHR',
        'aes_key' => '17mGzxuGJIhpOjV0RJp1clfNAQV7gr9m2IrPZwT6f8o',
        'oauth' => 
        array (
          'scopes' => 
          array (
            0 => 'snsapi_userinfo',
          ),
          'callback' => '/wechatauth/oauth_callback',
        ),
      ),
    ),
    'payment' => 
    array (
      'default' => 
      array (
        'sandbox' => false,
        'app_id' => 'wx49b94bce6e34c582',
        'mch_id' => '1520062001',
        'key' => 'zXbHeOOw1WXamutTYC9m3cpWekJPHaF2',
        'cert_path' => 'path/to/cert/apiclient_cert.pem',
        'key_path' => 'path/to/cert/apiclient_key.pem',
        'notify_url' => 'http://example.com/payments/wechat-notify',
      ),
    ),
  ),
  'debug-server' => 
  array (
    'host' => 'tcp://127.0.0.1:9912',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'generators' => 
  array (
    'config' => 
    array (
      'model_template_path' => '/home/wwwroot/www.xdeepu.cn/vendor/xethron/laravel-4-generators/src/Way/Generators/templates/model.txt',
      'scaffold_model_template_path' => '/home/wwwroot/www.xdeepu.cn/vendor/xethron/laravel-4-generators/src/Way/Generators/templates/scaffolding/model.txt',
      'controller_template_path' => '/home/wwwroot/www.xdeepu.cn/vendor/xethron/laravel-4-generators/src/Way/Generators/templates/controller.txt',
      'scaffold_controller_template_path' => '/home/wwwroot/www.xdeepu.cn/vendor/xethron/laravel-4-generators/src/Way/Generators/templates/scaffolding/controller.txt',
      'migration_template_path' => '/home/wwwroot/www.xdeepu.cn/vendor/xethron/laravel-4-generators/src/Way/Generators/templates/migration.txt',
      'seed_template_path' => '/home/wwwroot/www.xdeepu.cn/vendor/xethron/laravel-4-generators/src/Way/Generators/templates/seed.txt',
      'view_template_path' => '/home/wwwroot/www.xdeepu.cn/vendor/xethron/laravel-4-generators/src/Way/Generators/templates/view.txt',
      'model_target_path' => '/home/wwwroot/www.xdeepu.cn/app',
      'controller_target_path' => '/home/wwwroot/www.xdeepu.cn/app/Http/Controllers',
      'migration_target_path' => '/home/wwwroot/www.xdeepu.cn/database/migrations',
      'seed_target_path' => '/home/wwwroot/www.xdeepu.cn/database/seeds',
      'view_target_path' => '/home/wwwroot/www.xdeepu.cn/resources/views',
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
