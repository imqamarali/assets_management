<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Components extends Component
{
    public function Roles()
    {
        $items = Yii::$app->db->createCommand('SELECT * FROM public.role_types')->queryAll();
        return $items;
    }
    public function CheckPermissions($module_id, $submodule = null)
    {
        $role_id = Yii::$app->session->get('user_array')['user_level'];
        $query = "SELECT permissions.*,modules_features.name FROM public.permissions
                    LEFT JOIN public.modules_features on permissions.feature_id=modules_features.id
                    WHERE permissions.module_id=$module_id and permissions.role_id=$role_id;";
        if ($submodule) {
            $query = "SELECT permissions.*,modules_features.name FROM public.permissions
                    LEFT JOIN public.modules_features on permissions.feature_id=modules_features.id
                    WHERE permissions.module_id=$module_id and permissions.feature_id=$submodule and permissions.role_id=$role_id;";
        }
        $info = Yii::$app->db->createCommand($query)->queryAll();
        return $info;
    }
    public function SessionId()
    {
        return Yii::$app->session->get('user_array')['user_level'];
    }
    public function CheckRole()
    {
        $session_id = Yii::$app->session->get('user_array')['user_level'];

        $items = Yii::$app->db->createCommand("SELECT * FROM public.role_types where role_id= $session_id")->queryOne();
        if ($items)
            return $items['role_id'];
        return -1;
    }
    public function SaveingPath($user, $type)
    {
        $students_profile = '/images/students/profiles/';
        $students_documents = 'images/students/documents/';

        if ($user == 'student') {
            if ($type == 'profile')
                return $students_profile;
            else if ($type == 'document')
                return $students_documents;
        }


        return null;
    }
}
