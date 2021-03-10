<?php

namespace Drupal\qs_challenge\Controller;

use Drupal\Core\Controller\ControllerBase;

Class SiteInformationController extends ControllerBase {

  public function siteInformation() {
    $time_zone = $this->config('system.date')
         ->get('timezone.default');
    $site_name = $this->config('system.site')->get('name');

    return [
      '#theme' => 'site-information',
      '#default_time_zone' => $time_zone,
      '#site_name' => $site_name,
    ];
  }

}
