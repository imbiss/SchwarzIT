<?php
namespace App\Service;

use App\Repository\PageRepository;
use App\Entity\Page;

final class PageService
{
    private PageRepository $pageRepo;

    // inject repository
    public function __construct(PageRepository $pageRepo)
    {
        $this->pageRepo = $pageRepo;
    }

    public function getAllPages(): array
    {
        return $this->pageRepo->findAll();
    }


    public function addPage(Page $p): void
    {
        $this->pageRepo->save($p);
    }

    public function updatePage(Page $p): void
    {
        $this->pageRepo->save($p);
    }

    public function removePage(int $id): void
    {
        $this->pageRepo->remove($id);
    }
}
