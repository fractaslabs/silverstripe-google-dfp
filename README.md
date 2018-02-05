# SilverStripe Google DFP
[![Build Status](https://travis-ci.org/fractaslabs/silverstripe-google-dfp.svg?branch=master)](https://travis-ci.org/fractaslabs/silverstripe-google-dfp)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/fractaslabs/silverstripe-google-dfp/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/fractaslabs/silverstripe-google-dfp/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/fractaslabs/silverstripe-googleanalytics/v/stable)](https://packagist.org/packages/fractaslabs/silverstripe-googleanalytics)
[![Latest Unstable Version](https://poser.pugx.org/fractaslabs/silverstripe-googleanalytics/v/unstable)](https://packagist.org/packages/fractaslabs/silverstripe-googleanalytics)
[![Total Downloads](https://poser.pugx.org/fractaslabs/silverstripe-googleanalytics/downloads)](https://packagist.org/packages/fractaslabs/silverstripe-googleanalytics)
[![License](https://poser.pugx.org/fractaslabs/silverstripe-googleanalytics/license)](https://packagist.org/packages/fractaslabs/silverstripe-googleanalytics)

## Overview
An customizable SilverStripe module for Google DoubleClick for Publishers (DFP).


## Maintainer Contacts
- Milan Jelicanin [at] Fractas.com
- Petar Simic [at] Fractas.com


## Requirements
 * SilverStripe Framework 4+


## Version info
The master branch of this module is currently aiming for SilverStripe 4.x compatibility

- [SilverStripe 3.0+ compatible version](https://github.com/fractaslabs/silverstripe-google-dfp/tree/1.0.1)


## Installation
  * Recommended way to install this module is via Composer
 ```
 composer require "fractas/google-dfp" "2.x-dev"
 ```
  * Add to your configuration YML file:
 ```yaml
 ---
 name: mygoogledfp
 ---
 Fractas\GoogleDfp\GoogleDfpSlotHelper:
  enable_in_dev: false # if you wanna test banners in "dev" environment change to true
  publisher_id: 12345678 # change to your Google DFP network code
    layouts:
      PageController: # change to your Controller ClassName or leave it PageController if you wanna apply banners on SiteTree
        div-gpt-ad-123456789012-0: # An exact banner ID from Google DFP system
          alias: billboard # human readable banner type, used in template for banner init
          adUnitPath: /12345678/ad_unit_code # Full path of the ad unit with the network code and ad unit code.
          size: '[[1], [300, 250]]' # An exact size of banner creative
          outOfPage: false # if banner is "floater" or "wallpaper" type, change to "true"
 ```
  * Run ?flush=all to update manifests
  * Call your banner like this $GoogleDfpSlotByAlias('billboard') in your
  template (eg. Page.ss) to render selected banner HTML


 ## Additional documentation
 * More comprehensive documentation can be [found here](https://github.com/fractaslabs/silverstripe-google-dfp/blob/master/docs/en/index.md)


 ## Bugtracker
 * Bugs are tracked on [github.com](https://github.com/fractaslabs/silverstripe-google-dfp/issues)


 ## Licence
 * See [Licence](https://github.com/fractaslabs/fractaslabs/silverstripe-google-dfp/blob/master/LICENSE)
