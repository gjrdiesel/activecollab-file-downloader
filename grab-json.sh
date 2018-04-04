#!/bin/bash

for i in `seq 1 100`;
do
	curl "https://app.activecollab.com/140528/api/v1/projects/17/files?page=${i}" > json_page_${i}.json
done
