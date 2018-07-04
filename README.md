Phabricator Gantt Diagrams
==========================

This project is cloned from phabricatorGantt (https://github.com/kennyeni/phabricatorGantt).

This is a quick prototype that displays all Phabricator Tasks (Maniphest) as a Gantt Diagram. For this purpose some things have to be configured.

Configure Phabricator
---------------------

Gantt Diagrams need a start date and task duration, two fields Phabricator does not offer by default, however, it provides a very good and extensible framework; to add this fields edit: http://EXAMPLE.org/config/edit/maniphest.custom-field-definitions/ adding this JSON fields:

```json
{
  "estimated-days" : {
    "name"     : "Days Duration",
    "type"     : "int",
    "caption"  : "Estimated number of days this will take.",
    "required" : true
  },
  "start-day"      : {
    "name"     : "Start Date",
    "type"     : "date",
    "required" : true
  }
}
```

Then you will need to create a bot user to access tasks externally (http://EXAMPLE.org/people/create/)

Configure this project
----------------------

I used two external libraries, which you simple have to download and unzip in the same root folder this contents are.

* https://github.com/phacility/libphutil
* http://dhtmlx.com/docs/products/dhtmlxGantt/

Then you will need to edit "functions.php" file, adding Phabricator's api_token and server_url.

Test run this project
----------------------

```
git clone git@github.com:xzhub/phabricatorGantt2018.git
cd phabricatorGantt2018
git clone git@github.com:phacility/libphutil.git
wget https://dhtmlx.com/x/download/regular/dhtmlxGantt.zip
unzip dhtmlxGantt.zip 
vi functions.php # fill in $api_token and $server_url

#copy the folder to your web root then visit http:/<your-server-ip>/phabricatorGantt2018
#Or, you can use docker to run a php server, then visit http://localhost/
sudo docker run -d -p 80:80 -v /path/to/phabricatorGantt2018:/app tutum/apache-php
```

