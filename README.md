# Hitchwiki Page-Forms Location input

Adds new location input ("hw-location") to handle Hitchwiki locations (for cities, areas, countries and spots) at [Page Forms](https://www.mediawiki.org/wiki/Extension:Page_Forms) extension.

Internal project extension to use at our wikis ([Hitchwiki](http://hitchwiki.org), [Nomadwiki](http://hitchwiki.org), [Trashwiki](http://trashwiki.org)).

Part of [Hitchwiki.org](https://github.com/Hitchwiki/hitchwiki) MediaWiki setup.

[Contact us](http://hitchwiki.org/contact).

## Install manually

Note that normal Hitchwiki takes care of installing this extension.

Clone under `extensions`:
```bash
git clone https://github.com/Hitchwiki/HWPageFormsLocationInput-extension.git extensions/HWPageFormsLocationInput
```
Add to LocalSettings.php
```php
wfLoadExtension('HWPageFormsLocationInput');
```

# License
MIT
