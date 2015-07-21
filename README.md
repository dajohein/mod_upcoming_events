# Simple Joomla Upcoming Events module with Google Calendar integration #

## Description ##
By installing this module you can add a very basic Upcoming Events with Google Calendar integration and Structured Event Data to your Joomla site, like this one:

http://www.vineyardgroningen.com/agenda/

## Requirements ##
* [Google API PHP client] (https://github.com/google/google-api-php-client)

## Installation ##

Create a project at https://console.developers.google.com/project and create a new "key for server applications".

Clone the package

`git clone https://github.com/dajohein/mod_upcoming_events.git`

and 

`git submodule update --init`

Or download the zip package and manually add the https://github.com/google/google-api-php-client library to the modules/mod_upcoming_events/ folder.

## Module Configuration ##

### Display Otions ###

Option                             | Description
---------------------------------- | -------------------------------------------
Number Of Events To Display        | Max number of events to display
Number Of Days To Display          | Max number of days to display (combines with the number of events)
Show add to Google Calendar button | Show a link under the event calendar that allows users to add it to their Google Calendar

### Google Calendar Integration ###


Option                     | Description
-------------------------- | -------------------------------------------
Google Calendar ID         |  Your public Google Calendar Address, this should have the format of xxxxxxxx@group.calendar.google.com
Google Calendar API Key    | key for server applications
Default Location Name      | Default name of your venue location for the Structured Data.
Default Location Address   | Default address of your venue location for Structured Data.





