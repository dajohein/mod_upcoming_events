<?php
/**
 * @package     
 * @subpackage  
 *
 * @copyright   
 * @license     
 */

defined('_JEXEC') or die;

$doc = JFactory::getDocument();

// Add module stylesheet
JHtml::_('stylesheet', 'mod_upcoming_events/upcoming_events.css', array(), true);
?>
<?php
	//if ($module->showtitle) 
		//echo '<'.$header_tag.' class="'.$header_class.'">'.$module->title.'</'.$header_tag.'>';	
?>
<div class="upcoming-event-calendar<?php echo $moduleclass_sfx ?>">
	<?php
	    $groupDate = "";
		$dayCount = 0;
		foreach ($events->getItems() as $event) {
			$allDay = false;
		
			$eventStart = $event->start->dateTime;
			if( empty($eventStart) ) {
				$allDay = true;
				$eventStart = $event->start->date;
			}
			$eventStart = new DateTime( $eventStart );
			
			$eventEnd = $event->end->dateTime;
			if( empty($eventEnd) ) {
				$allDay = true;
				$eventEnd = $event->end->date;
			}
			$eventEnd = new DateTime( $eventEnd );
			
			// Final extracted variables from event
			$dateDesc = $eventStart->format("l, F j");
            $timeDesc = $eventStart->format("H:i");
			$highlighted = strpos($event->summary, "*") !== false;

			if ($groupDate !== $eventStart->format("dmY")) {
				  $dayCount++;
				  if ($dayCount > $max_days) break;

				  if ($groupDate != '') echo '</div><hr class="clearfix"/>';
				  echo '<div class="upcoming-event" itemscope itemtype="http://schema.org/Event">';
				  echo '<meta itemprop="startDate" content="'.$eventStart->format('c').'">';
				  echo '<span itemprop="location" itemscope itemtype="http://schema.org/Place">';
				  echo '<meta itemprop="name" content="'.$default_location_name.'">';
				  echo '<meta itemprop="address" content="'.$default_location_address.'">';
				  echo '</span>';

				  echo '<time datetime="'.$eventStart->format('Y-m-d').'" class="icon">';
				  echo '  <em>'.$eventStart->format('l').'</em>';
				  echo '  <strong>'.$eventStart->format('F').'</strong>';
				  echo '  <span>'.$eventStart->format('j').'</span>';
				  echo '</time>';
				  $groupDate = $eventStart->format("dmY");
            }
			
			$eventClass = $highlighted ? 'highlighted' : '';
			echo '<h5 class="upcoming-event-title '.$eventClass.'"><a href="' . $event->htmlLink . '">' . $timeDesc;
			echo ' <span itemprop="name">' . str_replace('*','',$event->summary) . '</span></a>';
			if ($highlighted) 
				echo '<span class="highlight">highlight</span>';
			if ($event->location != '')
				echo '<a href="https://maps.google.nl/maps?q='.urlencode($event->location).'&hl=en" target="_blank" title="Open location in Google Maps"><img src="'.JURI::root().'media/mod_upcoming_events/images/location.png" width="25" height="25" style="width: 25px; height: 25px;" alt="location"/></a>';
			echo '</h5>';
			if ($event->description != "")
				echo '<p class="upcoming-event-desc" itemprop="description">' . $event->description . '</p> ';

		}
		echo( '</div>' );
	?>
</div>
<?php
	if ($show_google_button === '1') {
?>
<div style="padding: 20px 0 20px 0; clear: both"><a href="https://www.google.com/calendar/embed?src=<?php echo urlencode($calendarId) ?>&amp;ctz=Europe/Amsterdam">Add to Google Calendar</a></div>
<?php
	}
?>