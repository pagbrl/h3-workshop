<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NotionService
{

  /**
   * @var HttpClientInterface
   */
  private $httpClient;

  /**
   * @var ParameterBagInterface
   */
  private $parameterBag;

  public function __construct(ParameterBagInterface $parameterBag, HttpClientInterface $httpClient)
  {
    $this->httpClient = $httpClient;
    $this->parameterBag = $parameterBag;
  }

  public function getPagesList(): array
  {
    $notionBaseUrl = $this->parameterBag->get('notion_base_url');
    $notionToken = $this->parameterBag->get('notion_token');

    $listPagesUrl = sprintf('%s/%s',
      $notionBaseUrl,
      'v1/search'
    );

    try {
      $results = $this->httpClient->request('POST', $listPagesUrl, [
        'headers' => [
          'Notion-Version' => '2021-08-16'
        ],
        'auth_bearer' => $notionToken,
      ])->getContent();
      return json_decode($results, true);
    } catch(ClientExceptionInterface $e) {
      return [$e->getCode(), $e->getMessage()];
    }
  }
}
