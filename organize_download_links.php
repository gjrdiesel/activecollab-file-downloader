<?php

$files = glob('json_responses/**');

$download_links = ['#!/bin/bash'];

foreach($files as $file){
	$json = json_decode(file_get_contents($file));
	foreach($json->files as $file){
		$download_links[] = "wget -O \"Downloads/{$file->name}\" " . $file->download_url;
	}
}

file_put_contents('download_files.sh',implode($download_links,"\n"));
