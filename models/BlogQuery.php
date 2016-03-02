<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Blog]].
 *
 * @see Blog
 */
class BlogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/
    
    /**
     * With user_id condition
     * @param int $user_id
     * @return \app\models\BlogQuery
     */
    public function withUserId($user_id) 
    {
        $this->andWhere(
                'blg_blog.user_id = :user_id', 
                ['user_id' => $user_id]);
        return $this;
    }

    /**
     * @inheritdoc
     * @return Blog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Blog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}