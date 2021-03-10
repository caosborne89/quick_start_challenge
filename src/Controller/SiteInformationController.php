<?php

namespace Drupal\qs_challenge\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserListBuilder;
use Drupal\Core\Entity\EntityTypeManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

Class SiteInformationController extends ControllerBase {
  protected $entityManager;

  public function __construct(EntityTypeManager $entity_manager) {
    $this->entityManager = $entity_manager;
  }
  public static function create(ContainerInterface $container) {
    return new static (
      $container->get('entity_type.manager')
    );
  }

  public function siteInformation() {
    $time_zone = $this->config('system.date')
         ->get('timezone.default');
    $site_name = $this->config('system.site')->get('name');
    $query = $this->entityManager->getStorage('user')->getQuery();
    $user_count = $query
      ->condition('status', '1')
      ->count()
      ->execute();
    return [
      '#theme' => 'site-information',
      '#cache' => [
        'max-age' => 0
      ],
      '#default_time_zone' => $time_zone,
      '#site_name' => $site_name,
      '#number_of_accounts' => $user_count,
    ];
  }
}
