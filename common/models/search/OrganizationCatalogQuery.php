<?php

namespace common\models\search;

/**
 * This is the ActiveQuery class for [[\common\models\OrganizationCatalog]].
 *
 * @see \common\models\OrganizationCatalog
 */
class OrganizationCatalogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\OrganizationCatalog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\OrganizationCatalog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
