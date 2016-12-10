<?php

namespace CodeEmailMKT\Infrastructure\Service;

use CodeEmailMKT\Domain\Entity\Campaign;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Mailgun\Mailgun;
use Zend\Expressive\Template\TemplateRendererInterface;
use CodeEmailMKT\Domain\Service\CampaignReportInterface;

class CampaignReport implements CampaignReportInterface
{
    private $campaign;
    private $templateRenderer;
    private $mailGunConfig;
    private $mailgun;
    private $repository;

    public function __construct(TemplateRendererInterface $templateRenderer,
                                Mailgun $mailgun, array $mailGunConfig, CustomerRepositoryInterface $repository)
    {

        $this->templateRenderer = $templateRenderer;
        $this->mailGunConfig = $mailGunConfig;
        $this->mailgun = $mailgun;
        $this->repository = $repository;
    }


    public function setCampaign(Campaign $campaign)
    {
        $this->campaign = $campaign;
        return $this;
    }


    public function render()
    {
        //qtd de cliques
        //qtd de aberturas
        //calcular quantos destinatários não abriram os emails
        //contagem de pessoas ou destinatários que não assinam mais a lista de envio
        $this->getCampaignData();
    }

    protected function getCampaignData()
    {
        $domain = $this->mailGunConfig['domain'];
        var_dump($this->mailgun->get("$domain/campaigns/campaign_{$this->campaign->getId()}"));
        die;
    }

}