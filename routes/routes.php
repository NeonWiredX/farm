<?php

//no middleware yet
return [
    '/'=>"PointController@index",//list
    '/create'=>"PointController@create",
    '/view'=>"PointController@view",
    '/update'=>"PointController@update",
    '/delete'=>"PointController@delete",
];