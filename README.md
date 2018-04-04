# ActiveCollab File Downloader

We had a large number of files in ActiveCollab we wanted to pull down for our own backups just in case. This is hacky 
solution we used to get those files and it can be reused if your interested or it can be used a demonstration of how to
pull your files from other services like AC.

## Requirements
- This script is quickly thrown together, you'll want some tech background or a can do attitude
- php
- bash
- wget

![screen shot 2018-04-04 at 10 10 41 am](https://user-images.githubusercontent.com/3363867/38313452-1008fe34-37f2-11e8-9a4d-fbc83352e79d.png)
This was the list of files we wanted.

Scrolling down the page you could see it was an infinite scroll system and it used ajax to pull in the files.
![screen shot 2018-04-04 at 10 11 39 am](https://user-images.githubusercontent.com/3363867/38313457-12c796a8-37f2-11e8-8414-1119c0a38bf4.png)

Pop open the chrome developer tools, run down the page until you hit the infinite scroll and you should see a network 
request go out. Right click on it, and copy as CURL.
![screen shot 2018-04-04 at 10 11 13 am](https://user-images.githubusercontent.com/3363867/38313454-1163d66e-37f2-11e8-8065-01d3888f62cf.png)

With that long URL, edit `grab-json.sh`, which looks like

```bash
#!/bin/bash

for i in `seq 1 100`;
do
	curl "https://app.activecollab.com/140528/api/v1/projects/17/files?page=${i}" > json_page_${i}.json
done
```

Delete the `curl` line and paste in your own that should be in your clipboard now. Then just adjust yours so it's 
setup similarly to the above link, you'll still have `-H 'PHPSSID: 1092381923819023'` for example, and those you want to keep.

You also will want to remove `--compressed` and ` -H 'accept-encoding: gzip, deflate, br'` because otherwise the content will
come back gziped.

Once you finished removing those lines, save the file and run it; Don't forget to increase the 100 if you have more than 100 pages.

```
sh grab-json.sh
```

That will then fill a `json_responses` folder, which `organize_download_links.php` will parse, so run it next.

```bash
php organize_download_links.php
```

Then that will generate a `download_files.sh`, run that 
```
sh download_files.sh
```

All your files are now kept safe in the `Downloads/` folder 🙏.
