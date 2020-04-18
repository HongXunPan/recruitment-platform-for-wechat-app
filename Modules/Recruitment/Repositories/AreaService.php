<?php


namespace Modules\Recruitment\Repositories;

use App\Repositories\BaseRepository;
use Modules\Recruitment\Entities\Area;

class AreaService extends BaseRepository implements AreaServiceInterface
{
    public function getChildrenAreaTree($parentId, $level = 1): array
    {
        if (empty($area)) {
            $parentId = 0;
        }

        $area = [];
        $area['children'] = Area::with('children.children.children')->whereParentId($parentId)->get();
        return $this->getChildrenTree($area, $level);
    }

    private function getChildrenTree($area, $level, $total = 'total')
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

    public function getChildrenAreaId($areaId, $includeSelf = true): array
    {
        if (!is_array($areaId)) {
            $areaId = [$areaId];
        }
        $ids = $this->getChildrenId($areaId);
        if ($includeSelf) {
            $ids = array_merge($areaId, $ids);
        }
        return $ids;
    }

    private function getChildrenId(array $areaIds)
    {
        $ids = Area::whereIn('parent_id', $areaIds)->get()->pluck('id')->toArray();
        if (!empty($ids)) {
            $subIds = $this->getChildrenId($ids);
            if (!empty($subIds)) {
                $ids = array_merge($ids, $subIds);
            }
        }
        return $ids;
    }
}
