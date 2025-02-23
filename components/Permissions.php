<?php

/**
 * @author Prakash S
 * @copyright 2017
 */

namespace app\components;

use Yii;


use yii\base\Component;
use yii\base\InvalidConfigException;

class Permissions extends Component
{

    public function getSidebar()
    {
        if (!isset(Yii::$app->session->get('user_array')['user_level']))
            return [];
        $role_id = Yii::$app->session->get('user_array')['user_level'];
        $query = "SELECT * FROM public.modules";

        $modules = Yii::$app->db->createCommand($query)->queryAll();

        $moduleList = [];
        foreach ($modules as $module) {
            $submenus = [];

            $moduleFeatures = Yii::$app->db->createCommand("SELECT * FROM public.modules_features WHERE module_id = :module_id")
                ->bindValue(':module_id', $module['id'])
                ->queryAll();

            foreach ($moduleFeatures as $feature) {
                $permissions = Yii::$app->db->createCommand("
                SELECT * FROM public.permissions
                WHERE module_id = :module_id
                AND feature_id = :feature_id
                AND role_id = :role_id")
                    ->bindValue(':module_id', $module['id'])
                    ->bindValue(':feature_id', $feature['id'])
                    ->bindValue(':role_id', $role_id)
                    ->queryOne();
                if ($permissions && $permissions['can_view']) {
                    $submenus[] = [
                        'id' => $feature['id'],
                        'link' => $feature['link'],
                        'icon' => $module['icon'],
                        'active' => false,
                        'title' => $feature['name'],
                        'can_view' => $permissions['can_view'],
                        'can_add' => $permissions['can_add'],
                        'can_edit' => $permissions['can_edit'],
                        'can_delete' => $permissions['can_delete'],
                    ];
                }
            }


            // if (!empty($submenus)) {
            if ($module['name'] === "Home") {
                $moduleList[] = [
                    'module_id' => $module['id'],
                    'title' => $module['name'],
                    'is_active' => $module['active'],
                    'link' => $module['link'],
                    'icon' => $module['icon'],
                    'active' => $module['active'],
                    'submenu' => $submenus
                ];
            } elseif ($module['name'] === "Contract Progress") {
                if (count($submenus) > 0) {
                    $moduleList[] = [
                        'module_id' => $module['id'],
                        'title' => $module['name'],
                        'is_active' => $module['active'],
                        'link' => $module['link'],
                        'icon' => $module['icon'],
                        'active' => $module['active'],
                        'submenu' => $submenus
                    ];
                }
            } else {
                $moduleList[] = [
                    'module_id' => $module['id'],
                    'title' => $module['name'],
                    'is_active' => $module['active'],
                    'link' => $module['link'],
                    'icon' => $module['icon'],
                    'active' => $module['active'],
                ];
            }
        }
        // echo json_encode($moduleList);
        // exit;

        return $moduleList;
    }
    public function getModuleFeatures($module_id = null)
    {
        $role_id = Yii::$app->session->get('user_array')['user_level'];
        $query = "SELECT * FROM modules WHERE 1=1";
        if ($module_id) {
            $query .= " AND id = $module_id";
        } else {
            return [];
        }
        $modules = Yii::$app->db->createCommand($query)->queryAll();

        $moduleList = [];
        foreach ($modules as $module) {
            $submenus = [];

            $moduleFeatures = Yii::$app->db->createCommand("SELECT * FROM public.modules_features WHERE module_id = :module_id")
                ->bindValue(':module_id', $module['id'])
                ->queryAll();
            foreach ($moduleFeatures as $feature) {
                $permissions = Yii::$app->db->createCommand("
                SELECT * FROM public.permissions
                WHERE module_id = :module_id
                AND feature_id = :feature_id
                AND role_id = :role_id")
                    ->bindValue(':module_id', $module['id'])
                    ->bindValue(':feature_id', $feature['id'])
                    ->bindValue(':role_id', $role_id)
                    ->queryOne();
                if ($permissions) {
                    $submenus[] = [
                        'id' => $feature['id'],
                        'link' => $feature['link'],
                        'icon' => $module['icon'],
                        'active' => false,
                        'title' => $feature['name'],
                        'can_view' => $permissions['can_view'],
                        'can_add' => $permissions['can_add'],
                        'can_edit' => $permissions['can_edit'],
                        'can_delete' => $permissions['can_delete'],
                    ];
                }
            }
            if (!empty($submenus)) {
                $moduleList[] = [
                    'module_id' => $module['id'],
                    'title' => $module['name'],
                    'is_active' => $module['active'],
                    'link' => $module['link'],
                    'icon' => $module['icon'],
                    'active' => false,
                    'submenus' => $submenus,
                ];
            }
        }

        return $moduleList;
    }

    public function checkMethod($action)
    {
        $actions = [

            'assets/index',
            'assets/list',
            'assets/zone',
            'assets/region',
            'assets/province',
            'assets/district',
            'assets/route',
            'assets/section',
            'assets/layers',
            'assets/unit',
            'assets/media',
            'assets/amenities',
            'assets/save',

            'contract/index',
            'contract/contractor',
            'contract/contractor_details',
            'contract/contract',
            'contract/contract_revised',
            'contract/contract_sub',
            'contract/contract_payment',
            'contract/contractdetails',
            'contract/progress',
            'contract/new_progress',

            'users/index',
            'users/roles',
            'users/permissions',
            'users/update',
            'users/userslist',

            'budgeting/index',
            'budgeting/amp_sub',
            'budgeting/amp_sub_details',
            'budgeting/amp_details',
            'budgeting/amp_list',
            'budgeting/scope',
            'budgeting/type',
            'budgeting/year',


            'notification/contractnotifications',
            'notification/contractdetails',


        ];
        return in_array($action, $actions);
    }
}
