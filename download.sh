#!/bin/bash

IFS=$'\n'

for LINK in $(cat download_links);
do
	wget $LINK
done
