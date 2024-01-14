# Barotrauma Legacy Master Server
A master server remake for Barotrauma Legacy

## Requirements

 - PHP
 - MySQL Server

## Set up
### Server

 1. Copy these files info a folder that accessible from the network.
 2. Create a MySQL database and import DATABASE.sql
 3. Enable MySQL Event Scheduler
 4. Edit database.php with your MySQL server credential

### Client

 1. Edit config.xml inside your game files and replace the content of masterserverurl with the url where you put the server files in.
 2. Just run the game / dedicated server and you're good to go.

## Caveats

 - Updated game files (Where you can update the game from the launcher) not included, but you can manually put the files and add the content to filelist.xml
 - versioninfo.xml doesn't contain all of the version history of the game
