<?php


namespace Modules\Recruitment\Repositories;

use App\Repositories\BaseRepository;
use Modules\Recruitment\Entities\Area;

class AreaService extends BaseRepository implements AreaServiceInterface
{
    public function getChildrenArea($parentId, $level = 1): array
    {
        if (empty($area)) {
            $parentId = 0;
        }

        $area = [];
        $area['children'] = Area::with('children.children.children')->whereParentId($parentId)->get();
        return $this->getChildren($area, $level);
    }

    private function getChildren($area, $level, $total = 'total')
    {
        $newChildren = [];
        if (count(explode('.', $total)) > $level) {
            return false;
        }

        /** @var Area $child */
        foreach ($area['children'] as $child) {
            $subChildren = $this->getChildren($child, $level, $total . '.children');

            $areaChildren = [];
            $areaChildren['id'] = $child->id;
            $areaChildren['name'] = $child->name;
            if ($subChildren !== false) {
                $areaChildren['children'] = $subChildren;
            }
            $newChildren[] = $areaChildren;
        }

        return $newChildren;
    }
}
