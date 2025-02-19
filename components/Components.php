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

    //$fields = ['zone', 'region', 'unit', 'route', 'km_from', 'km_to', 'year', 'scope', 'number', 'name', 'code'];
    // $fields = ['number', 'name', 'code', 'zone', 'region', 'unit', 'route', 'km_from', 'km_to', 'year', 'scope'];
    // $fields = ['name', 'province', 'district', 'tehsil', 'zone', 'unit', 'type', 'route', 'km_from', 'km_to'];

    public function renderSearchForm($array)
    {
        // Fetch all possible data from the database
        $zone_list = Yii::$app->db->createCommand('SELECT * FROM public."a_zone"')->queryAll();
        $region_list = Yii::$app->db->createCommand('SELECT * FROM public."a_region"')->queryAll();
        $unit_list = Yii::$app->db->createCommand('SELECT * FROM public."u_unit"')->queryAll();
        $route_list = Yii::$app->db->createCommand('SELECT * FROM public."a_route" ORDER BY id ASC')->queryAll();
        $scope_list = Yii::$app->db->createCommand('SELECT * FROM public."m_scope"')->queryAll();
        $province_list = Yii::$app->db->createCommand('SELECT * FROM public."a_province"')->queryAll();
        // [{"ID":3,"name":"Punjab","details":"Province Punjab (PB)","status":1,"code":"PB"},{"ID":4,"name":"Route1","details":"Routes Details here","status":1,"code":"R1"}]
        // echo json_encode($province_list);
        // exit;

        $district_list = Yii::$app->db->createCommand(
            'SELECT ad.id, ad.province_id, ad.name, ad.code, ad.status, ap.name AS province_name
         FROM public."a_district" AS ad
         LEFT JOIN public."a_province" AS ap ON ad.province_id = ap."ID"
         ORDER BY ad.id ASC;'
        )->queryAll();
        $tehsil_list = Yii::$app->db->createCommand(
            'SELECT at.*, ad.name AS district_name
         FROM public."a_tehsil" AS at
         LEFT JOIN public."a_district" AS ad ON ad.id = at."district_id";'
        )->queryAll();
        $type_list = Yii::$app->db->createCommand('SELECT * FROM public."m_type"')->queryAll();
        $treatment_list = Yii::$app->db->createCommand('SELECT * FROM public."m_treatment" ORDER BY id ASC')->queryAll();

        // Map field names to their respective data
        $data = [
            'zone' => array_column($zone_list, 'Name', 'id'),
            'region' => array_column($region_list, 'name', 'id'),
            'unit' => array_column($unit_list, 'name', 'id'),
            'route' => array_column($route_list, 'name', 'id'),
            'scope' => array_column($scope_list, 'Name', 'id'),
            'district' => array_column($district_list, 'name', 'id'),
            'tehsil' => array_column($tehsil_list, 'name', 'id'),
            'type' => array_column($type_list, 'name', 'id'),
            'province' => array_column($province_list, 'name', 'id'),
            'treatment' => array_column($treatment_list, 'Name', 'id'),
        ];

        // Check if the form is submitted
        $isFormSubmitted = Yii::$app->request->isPost;

        // Start building the form
        $form = '<form method="POST" action="' . Yii::$app->request->url . '">';
        $form .= '<input type="hidden" name="_csrf" value="' . Yii::$app->request->getCsrfToken() . '">';
        $form .= '<div class="accordion" id="accordionExample">';
        $form .= '<div class="">';
        $form .= '<h2 class="accordion-header" id="headingOne">';
        $form .= '<button class="accordion-button collapsed" style="height: 0px !important;padding: 19px;margin-top: 15px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="' . ($isFormSubmitted ? 'true' : 'false') . '" aria-controls="collapseOne"></button>';
        $form .= '</h2>';
        $form .= '<div class="accordion-collapse collapse ' . ($isFormSubmitted ? 'show' : '') . '" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample">';
        $form .= '<div class="accordion-body pt-0">';
        $form .= '<div class="row g-3 mb-3" style="margin-top: -40px;">';

        // Loop through the fields and render only those present in $array
        foreach ($array as $field) {
            if (array_key_exists($field, $data)) {
                $form .= $this->renderField($field, $data[$field]);
            } elseif (strpos($field, 'date') !== false) {
                // Check if the field name contains "date"
                $form .= $this->renderDateField($field);
            } elseif ($field === 'km_from' || $field === 'km_to') {
                $form .= $this->renderTextField($field);
            } elseif ($field === 'year') {
                $form .= $this->renderYearField();
            } else {
                $form .= $this->renderTextInputField($field);
            }
        }

        // Add the submit button
        $form .= '<div class="col-12 col-md-2">';
        $form .= '<input type="submit" name="apply_search" class="btn btn-outline-primary" style="margin-top: 24px;" value="Search">';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '<hr class="bg-200">';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '</form>';

        return $form;
    }
    private function renderDateField($field)
    {
        $label = ucfirst($field);
        return '
                <div class="col-12 col-md-2">
                    <label for="organizerSingle2">' . $label . '</label>
                    <div class="flatpickr-input-container">
                        <div class="form-floating">
                            <input class="form-control datetimepicker flatpickr-input" id="modal' . ucfirst($field) . '"
                                name="' . $field . '" type="text" placeholder="' . ucfirst(str_replace('_', ' ', $field)) . '"
                                data-options="{&quot;disableMobile&quot;:true}" readonly="readonly">
                            <label class="ps-6" for="modal' . ucfirst($field) . '">' . ucfirst(str_replace('_', ' ', $field)) . '</label>
                            <span class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                        </div>
                    </div>
                </div>';
    }

    private function renderField($field, $options)
    {
        $label = ucfirst($field);
        $fieldHtml = '<div class="col-12 col-md-2">';
        $fieldHtml .= '<label for="organizerSingle2">' . $label . '</label>';
        $fieldHtml .= '<select class="form-select form-select-sm" aria-label=".form-select-sm example" name="' . $field . '">';
        $fieldHtml .= '<option selected value="">Please Select</option>';

        // Check if the field has a submitted value
        $submittedValue = Yii::$app->request->post($field, '');

        foreach ($options as $value => $text) {
            $selected = ($value == $submittedValue) ? 'selected' : '';
            $fieldHtml .= '<option value="' . $value . '" ' . $selected . '>' . $text . '</option>';
        }

        $fieldHtml .= '</select>';
        $fieldHtml .= '</div>';

        return $fieldHtml;
    }

    private function renderTextField($field)
    {
        $label = ucfirst(str_replace('_', ' ', $field)); // Convert snake_case to Title Case
        $fieldHtml = '<div class="col-12 col-md-2">';
        $fieldHtml .= '<label for="organizerSingle2">' . $label . '</label>';

        // Check if the field has a submitted value
        $submittedValue = Yii::$app->request->post($field, '');
        $fieldHtml .= '<input class="form-control" type="text" name="' . $field . '" placeholder="KM" value="' . $submittedValue . '">';

        $fieldHtml .= '</div>';

        return $fieldHtml;
    }

    private function renderTextInputField($field)
    {
        $label = ucfirst($field); // Convert field name to Title Case
        $placeholder = ucfirst($field); // Placeholder text
        $fieldHtml = '<div class="col-12 col-md-2">';
        $fieldHtml .= '<label for="organizerSingle2">' . $label . '</label>';

        // Check if the field has a submitted value
        $submittedValue = Yii::$app->request->post($field, '');
        $fieldHtml .= '<input class="form-control" type="text" name="' . $field . '" placeholder="' . $placeholder . '" value="' . $submittedValue . '">';

        $fieldHtml .= '</div>';

        return $fieldHtml;
    }

    private function renderYearField()
    {
        $fieldHtml = '<div class="col-12 col-md-2">';
        $fieldHtml .= '<label for="organizerSingle2">Year</label>';
        $fieldHtml .= '<select class="form-select form-select-sm" aria-label=".form-select-sm example" name="year">';
        $fieldHtml .= '<option selected value="">Please Select</option>';

        // Check if the field has a submitted value
        $submittedValue = Yii::$app->request->post('year', '');

        for ($year = 2018; $year <= 2024; $year++) {
            $selected = ($year == $submittedValue) ? 'selected' : '';
            $fieldHtml .= '<option value="' . $year . '" ' . $selected . '>' . $year . '-' . ($year + 1) . '</option>';
        }

        $fieldHtml .= '</select>';
        $fieldHtml .= '</div>';

        return $fieldHtml;
    }
}
