<?php

defined('_JEXEC') or die;

// Get module params
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
//$google_api_key = JComponentHelper::getParams('com_upcomingevents')->get('google_api_key', '');
$google_api_key = htmlspecialchars( $params->get('google_api_key') );
$google_calendar_id = htmlspecialchars( $params->get('google_calendar_id') );
$max_events = htmlspecialchars( $params->get('max_events') );
$max_days = htmlspecialchars( $params->get('max_days') );
$header_tag = htmlspecialchars( $params->get('header_tag') );
$header_class = htmlspecialchars( $params->get('header_class') );
$show_google_button = htmlspecialchars( $params->get('show_google_button') );
$default_location_name = htmlspecialchars( $params->get('default_location_name') );
$default_location_address = htmlspecialchars( $params->get('default_location_address') );

// Load Google API PHP Client
require_once( __DIR__ . '/google-api-php-client/src/Google/autoload.php' );

// New Google Client object
$client = new Google_Client();
$client->setApplicationName( 'Joomla! Upcoming Events Module v0.0.1' );
$client->setDeveloperKey( $google_api_key );

// Get Google Calendar object
$cal = new Google_Service_Calendar($client);
$calendarId = $google_calendar_id;
$apiparams = array(
	'singleEvents' => true,
	'orderBy' => 'startTime',
	'timeMin' => date(DateTime::ATOM),
	'maxResults' => $max_events
);

// Get events array
$events = $cal->events->listEvents($calendarId, $apiparams);
$calTimeZone = $events->timeZone;
date_default_timezone_set($calTimeZone);

// Display module!
require JModuleHelper::getLayoutPath('mod_upcoming_events', $params->get('layout', 'default'));
