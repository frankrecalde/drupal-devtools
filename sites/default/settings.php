<?php

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';

/**
 * The default list of directories that will be ignored by Drupal's file API.
 *
 * By default ignore node_modules and bower_components folders to avoid issues
 * with common frontend tools and recursive scanning of directories looking for
 * extensions.
 *
 * @see \Drupal\Core\File\FileSystemInterface::scanDirectory()
 * @see \Drupal\Core\Extension\ExtensionDiscovery::scanDirectory()
 */
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];

/**
 * The default number of entities to update in a batch process.
 *
 * This is used by update and post-update functions that need to go through and
 * change all the entities on a site, so it is useful to increase this number
 * if your hosting configuration (i.e. RAM allocation, CPU speed) allows for a
 * larger number of entities to be processed in a single batch run.
 */
$settings['entity_update_batch_size'] = 50;

/**
 * Entity update backup.
 *
 * This is used to inform the entity storage handler that the backup tables as
 * well as the original entity type and field storage definitions should be
 * retained after a successful entity update process.
 */
$settings['entity_update_backup'] = TRUE;

/**
 * Node migration type.
 *
 * This is used to force the migration system to use the classic node migrations
 * instead of the default complete node migrations. The migration system will
 * use the classic node migration only if there are existing migrate_map tables
 * for the classic node migrations and they contain data. These tables may not
 * exist if you are developing custom migrations and do not want to use the
 * complete node migrations. Set this to TRUE to force the use of the classic
 * node migrations.
 */
$settings['migrate_node_migrate_type_classic'] = FALSE;

/**
 * Load local development override configuration, if available.
 *
 * Create a settings.local.php file to override variables on secondary (staging,
 * development, etc.) installations of this site.
 *
 * Typical uses of settings.local.php include:
 * - Disabling caching.
 * - Disabling JavaScript/CSS compression.
 * - Rerouting outgoing emails.
 *
 * Keep this code block at the end of this file to take full effect.
 */
#
if (file_exists($app_root . '/' . $site_path . '/settings.development.php')) {
  include $app_root . '/' . $site_path . '/settings.development.php';
}

$settings['rebuild_access'] = FALSE;

$settings['trusted_host_patterns'] = [
  '^drupal-dev\.lndo\.site$',
  '^drupal-dev\.ddev\.site$',
];

// Enable all reverse proxies.
$settings['reverse_proxy'] = TRUE;

// Disable error display.
$config['system.logging']['error_level'] = 'hide';

// Page performance. 10 min page cache.
$config['system.performance']['css']['preprocess'] = TRUE;
$config['system.performance']['js']['preprocess'] = TRUE;
$config['system.performance']['cache']['page']['max_age'] = 600;

// Enable shield via config.
$config['shield.settings']['shield_enable'] = getenv('SHIELD_USERNAME') && getenv('SHIELD_PASSWORD');
$config['shield.settings']['credentials']['shield']['user'] = getenv('SHIELD_USERNAME');
$config['shield.settings']['credentials']['shield']['pass'] = getenv('SHIELD_PASSWORD');
$config['shield.settings']['print'] = 'Login';

// Force email to use envars.
$config['symfony_mailer.mailer_transport.smtp']['configuration']['user'] = getenv('SMTP_USERNAME');
$config['symfony_mailer.mailer_transport.smtp']['configuration']['pass'] = getenv('SMTP_PASSWORD');
$config['symfony_mailer.mailer_transport.smtp']['configuration']['host'] = getenv('SMTP_HOST');
$config['symfony_mailer.mailer_transport.smtp']['configuration']['port'] = getenv('SMTP_PORT');
$config['symfony_mailer.mailer_transport.smtp']['configuration']['query']['verify_peer'] = TRUE;

// Prefer not to use Symfony's APCu. Native is faster.
if (extension_loaded('apcu') && ini_get('apc.enabled')) {
  $settings['class_loader_auto_detect'] = FALSE;
}