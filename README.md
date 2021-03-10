# Quickstart Challenge - Site information

> This is my submission for the Drupal code challenge for Quickstart

## Description
This repository contains the code for a custom Drupal module that provides a configurable status message displayed to authenticated users. This message includes a link to a page that can be accessed by authenticated users that provides the following site information:

* Site name
* Default site timezone
* Number of user accounts

## How to use

Once installed you can go to `/admin/config/site-info-message-config` to configure the message that users see. Only administrators have access to this configuration file. When users login to the site they will be presented with the message that has been configured and a link to the site information page. Authenticated users can also access this site information page by going to `/site-information`.

