# SilverStripe Google DFP developer guide

## Installation
  * Recommended way to install this module is via Composer
 ```
 composer require fractaslabs/silverstripe-google-dfp
 ```

## Configuration
  * Add to your .yml file configuration:
 ```yaml
 ---
 name: mygoogledfp
 ---
GoogleDfpSlotHelper:
  enable_in_dev: false # if you wanna test banners in "dev" environment change to true
  publisher_id: 12345678 # change to your Google DFP network code
    layouts:
      Page: # change to your Controller ClassName or leave it Page if you wanna apply banners on SiteTree
        div-gpt-ad-123456789012-0: # An exact banner ID from Google DFP system
          alias: billboard # human readable banner type, used in template for banner init
          adUnitPath: /12345678/ad_unit_code # Full path of the ad unit with the network code and ad unit code.
          size: '[[1], [300, 250]]' # An exact size of banner creative
          outOfPage: false # if type of banner is "floater" or "wallpaper", change to "true"
 ```
  * Visit [mygoogledfp.yml.example](https://github.com/fractaslabs/silverstripe-google-dfp/blob/master/_config/mygoogledfp.yml.example)
  for more examples of banner usage
  * Run ?flush=all to update manifests


## Template usage
* Add a variable $GoogleDfpSlotByAlias('billboard') or $GoogleDfpSlotByID('1')
in desired spot to your template (like Page.ss) to render banners HTML.

If you wanna add a margin between banner and rest of content, following CSS can be
helpful:
```css
.banner-slot { margin-top: 15px; margin-bottom: 15px; }
```
Of course, you can adjust this according to your needs.


## Common issues
* If you have problems with show of banners it could be that is "behind" some HTML
element. In that case, in your CSS file add a following:
```css
.banner-slot { position: relative; z-index: 2; }
```
Adjust a z-index value according to your needs (be careful not to hide other elements).
