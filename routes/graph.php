<?php

Route::get('_/get/{type}/{suid}', 'GraphController@getNode')
	->where(['type' => '(visitor|person|company|tag|qualifier|address|note)']);

Route::get('_/get/{type}/{suid}/with/{node1}/{node2?}/{node3?}', 'GraphController@getNode')
	->where(['type' => '(visitor|person|company|tag|qualifier|address|note)']);

Route::get('_/get/{type}/{suid}/with/{node2}/via/{node1}', 'GraphController@getNodeVia')
	->where(['type' => '(visitor|person|company|tag|qualifier|address|note)']);

Route::get('_/get/{type}/{suid}/with/all', 'GraphController@getNodeAll')
	->where(['type' => '(visitor|person|company|tag|qualifier|address|note)']);

Route::get('_/get/{type}/by/{property_name}/{property_value}', 'GraphController@getNodeBy')
	->where(['type' => '(visitor|person|company|tag|qualifier|address|note)']);

Route::get('_/get/{type}/by/{property_name}/{property_value}/with/{node}', 'GraphController@getNodeBy')
	->where(['type' => '(visitor|person|company|tag|qualifier|address|note)']);

Route::get('_/find/{type}/by/{property}/{search}', 'GraphController@findNode')
	->where(['type' => '(visitor|person|company|tag|qualifier|address|note)']);

Route::get('_/find/{type}/like/{property}/{search}', 'GraphController@findNodeLike')
	->where(['type' => '(visitor|person|company|tag|qualifier|address|note)']);

Route::get('_/find/{type}/by/{property}/{search}/with/{node1}/{node2?}/{node3?}', 'GraphController@findNode')
	->where(['type' => '(visitor|person|company|tag|qualifier|address|note)']);

Route::get('_/find/{type}/like/{property}/{search}/with/{node1}/{node2?}/{node3?}', 'GraphController@findNodeLike')
	->where(['type' => '(visitor|person|company|tag|qualifier|address|note)']);

Route::post('_/set/token/{token}', 'GraphController@setNode');

Route::post('_/set', 'GraphController@setNode');

Route::get('_/set/{token}/{data}', 'GraphController@setNodeToken');

