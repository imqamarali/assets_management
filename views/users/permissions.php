<div class="page-content">
    <div class="row">
        <div class="col-xs-16">
            <div class="row">
                <div class="col-sm-12">
                    <div class="widget-box widget-color-green2">
                        <div class="widget-header">
                            <h4 class="widget-title lighter smaller">
                                Update <?php echo htmlspecialchars($permissions['role_name']); ?> Roles
                                <span class="smaller-80">(Manage permissions)</span>
                            </h4>
                            <div class="widget-toolbar" style="width: 35%;">
                                <div style="margin-right:10px;margin-top:2px">
                                    <select id="module-filter" onchange="filterTableByModule()" name="id"
                                        class="chosen-select form-control" required style="width: 100%;">
                                        <option value="">-- Select Module --</option>
                                        <?php foreach ($permissions['modules'] as $module): ?>
                                            <option value="<?= $module['module_id'] ?>">
                                                <?= htmlspecialchars($module['title']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main padding-2">
                                <div class="widget-body">
                                    <table id="permissions-table" class="table table-striped table-sm fs--1 mb-0"
                                        style="border: 1px solid #a9a9a954;">
                                        <thead>
                                            <tr>
                                                <th>Module</th>
                                                <th>Module Feature</th>
                                                <th>Permissions <span class="smaller-80">(Add, View, Update,
                                                        Delete)</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($permissions['modules'] as $module): ?>
                                                <?php foreach ($module['submenus'] as $index => $feature): ?>
                                                    <tr data-module="<?= htmlspecialchars($module['module_id']); ?>">
                                                        <?php if ($index === 0): ?>
                                                            <td rowspan="<?= count($module['submenus']); ?>">
                                                                <?= htmlspecialchars($module['title']); ?>
                                                            </td>
                                                        <?php endif; ?>
                                                        <td><?= htmlspecialchars($feature['title']); ?></td>
                                                        <td>
                                                            <?php foreach (['can_add' => 'Add', 'can_view' => 'View', 'can_edit' => 'Update', 'can_delete' => 'Delete'] as $type => $label): ?>
                                                                <label class="<?= $feature[$type] ? 'active' : ''; ?>">
                                                                    <input type="checkbox" class="permission-checkbox"
                                                                        data-module="<?= htmlspecialchars($module['module_id']); ?>"
                                                                        data-feature="<?= htmlspecialchars($feature['feature_id']); ?>"
                                                                        name="permissions[<?= $module['module_id']; ?>][<?= $feature['feature_id']; ?>][<?= $type; ?>]"
                                                                        <?= $feature[$type] ? 'checked' : ''; ?>
                                                                        onchange="handleCheckboxChange('<?= $type; ?>', this, '<?= htmlspecialchars($module['module_id']); ?>', '<?= htmlspecialchars($feature['permission_id']); ?>', 2);" />
                                                                    <i
                                                                        class="icon-only ace-icon fa fa-<?= $type === 'can_add' ? 'plus' : ($type === 'can_view' ? 'eye' : ($type === 'can_edit' ? 'refresh' : 'trash')); ?> bigger-110"></i>
                                                                </label>
                                                            <?php endforeach; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.chosen-select').chosen().change(function() {
            filterTableByModule();
        });

        filterTableByModule();
    });

    function filterTableByModule() {
        var selectedModule = document.getElementById("module-filter").value;
        var rows = document.querySelectorAll("#permissions-table tbody tr");
        rows.forEach(row => {
            row.style.display = selectedModule === "" || row.getAttribute("data-module") === selectedModule ? "" :
                "none";
        });
    }

    function handleCheckboxChange(name, checkbox, moduleId, featureId, status) {
        var isChecked = checkbox.checked;
        var data = {
            name: name,
            status: isChecked ? 1 : 0,
            id: featureId ? featureId : moduleId,
            type: status,
            role: <?php echo $_REQUEST['id'] ?>,
            _csrf: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: 'index.php?r=users/update',
            type: 'POST',
            data: data,
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>