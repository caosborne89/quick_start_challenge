<?php

namespace Drupal\qs_challenge\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserListBuilder;
use Drupal\Core\Entity\EntityTypeManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for site information page
 */
Class SiteInformationController extends ControllerBase {
  /**
   * EntityTypeManager service
   *
   * @var \Drupal\Core\Entity\EntityTypeManager
   */
  protected $entityManager;

  /**
   * SiteInformationController constructor
   *
   * @param \Drupal\Core\Entity\EntityTypeManager $entity_manager
   * The EntityTypeManager service
   */
  public function __construct(EntityTypeManager $entity_manager) {
    $this->entityManager = $entity_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static (
      $container->get('entity_type.manager')
    );
  }

  /**
   * Site information
   *
   * @return array
   *  Returns the site-information theme with the site data variabes
   *  that should be displayed to authenticated users
   */
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
