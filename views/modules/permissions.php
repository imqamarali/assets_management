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
                                    <select id="form-field-select-3" name="id" class="chosen-select form-control"
                                        required style="width: 100%;" onchange="filterTableByModule()">
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
                                    <table class="table table-striped table-hover table-bordered table-sm fs--1 mb-0">
                                        <thead class="thin-border-bottom">
                                            <tr>
                                                <th> Module</th>
                                                <th>Module Feature</th>
                                                <th class="hidden-480">Permissions
                                                    <span class="smaller-80">(Add, View, Update,Delete)</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($permissions['modules'] as $module): ?>
                                                <?php $features = $module['submenus']; ?>
                                                <?php foreach ($features as $index => $feature): ?>
                                                    <tr id="<?= htmlspecialchars($module['module_id']); ?>">
                                                        <?php if ($index === 0): ?>
                                                            <td rowspan="<?php echo count($features); ?>" style="padding: 10px;">
                                                                <?php echo htmlspecialchars($module['title']); ?>
                                                            </td>
                                                        <?php endif; ?>

                                                        <td style="padding: 4px !important;">
                                                            <?php //echo json_encode($feature) 
                                                            ?>
                                                            <?php echo htmlspecialchars($feature['title']);
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php foreach (['can_add' => 'Add', 'can_view' => 'View', 'can_edit' => 'Update', 'can_delete' => 'Delete'] as $type => $label): ?>
                                                                <label
                                                                    class=" <?php echo ($feature[$type] === 1) ? 'active' : ''; ?>">
                                                                    <input type="checkbox" class="permission-checkbox"
                                                                        data-module="<?php echo htmlspecialchars($module['module_id']); ?>"
                                                                        data-feature="<?php echo htmlspecialchars($feature['feature_id']); ?>"
                                                                        name="permissions[<?php echo $module['module_id']; ?>][<?php echo $feature['feature_id']; ?>][<?php echo $type; ?>]"
                                                                        <?php echo ($feature[$type] === 1) ? 'checked' : ''; ?>
                                                                        onchange="handleCheckboxChange('<?php echo $type; ?>', this, '<?php echo htmlspecialchars($module['module_id']); ?>', '<?php echo htmlspecialchars($feature['permission_id']); ?>', 2);" />
                                                                    <i
                                                                        class="icon-only ace-icon fa fa-<?php echo ($type === 'is_active') ? 'check-square-o' : ($type === 'can_add' ? 'plus' : ($type === 'can_view' ? 'eye' : ($type === 'can_edit' ? 'refresh' : 'trash'))); ?> bigger-110"></i>
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
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->

<script type="text/javascript">
    if ("ontouchstart" in document.documentElement)
        document.write(
            "<script src='assets/js/jquery.mobile.custom.min.js'>" +
            "<" +
            "/script>"
        );
</script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/tree.min.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>
<script>
    function filterTableByModule() {
        var selectedModuleId = document.getElementById('form-field-select-3').value;
        var rows = document.querySelectorAll('#permissions-table tbody tr');

        rows.forEach(function(row) {
            var moduleId = row.getAttribute('id');
            if (selectedModuleId === '' || moduleId === selectedModuleId) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function handleCheckboxChange(name, checkbox, moduleId, featureId, status) {
        var isChecked = checkbox.checked;
        var idToPost = featureId ? featureId : moduleId; // Use featureId if available
        var data = {
            name: name,
            status: isChecked ? 1 : 0, // Send 1 if checked, otherwise 0
            id: idToPost,
            type: status,
            role: <?php echo $_REQUEST['id'] ?>,
            _csrf: $('meta[name="csrf-token"]').attr('content') // Ensure the CSRF token is sent
        };

        console.log(data);

        $.ajax({
            url: 'index.php?r=users/update',
            type: 'POST',
            data: data,
            success: function(response) {
                console.log(response);
                // Optionally show a success message
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Optionally show an error message
            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.permission-checkbox').on('change', function() {
            $(this).closest('form').submit();
        });

        $('.input-mask-product').on('input', function() {
            var searchValue = $(this).val().toLowerCase();

            $('table tbody tr').each(function() {
                var moduleCell = $(this).find('td:first').text().toLowerCase();
                $(this).toggle(moduleCell.includes(searchValue));
            });
        });
    });
</script>

<script src="assets/js/tree.min.js"></script>

<script type="text/javascript">
    function extractTreeData(ulElement) {
        const data = {};
        $(ulElement).children('li').each(function() {
            const $this = $(this);
            const folderText = $this.children('span.folder').text();
            const icon = $this.children('i.icon').text();

            if (folderText) {
                const itemClass = 'tree-branch tree-selected';
                data[folderText] = {
                    text: folderText,
                    type: 'folder',
                    'icon-class': icon || 'fa fa-refresh',
                    class: itemClass,
                    additionalParameters: {
                        children: extractTreeData($this.children('ul'))
                    }
                };
            } else {
                const itemText = $this.text().trim();
                if (itemText) {
                    data[itemText] = {
                        text: itemText,
                        type: 'item',
                        'icon-class': 'item',
                    };
                }
            }
        });
        return data;
    }

    jQuery(function($) {
        const treeData = extractTreeData($('#tree2'));
        const sampleData = {
            dataSource2: function(options, callback) {
                let $data = null;
                if (!("text" in options) && !("type" in options)) {
                    $data = treeData;
                    callback({
                        data: $data
                    });
                    return;
                } else if ("type" in options && options.type == "folder") {
                    $data = options.additionalParameters?.children || {};
                }

                if ($data != null) {
                    setTimeout(function() {
                        callback({
                            data: $data
                        });
                    }, parseInt(Math.random() * 500) + 200);
                }
            }
        };

        $("#tree2").ace_tree({
            dataSource: sampleData["dataSource2"],
            loadingHTML: '<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>',
            "open-icon": "ace-icon fa fa-folder-open",
            "close-icon": "ace-icon fa fa-folder",
            itemSelect: true,
            folderSelect: true,
            multiSelect: true,
            "selected-icon": null,
            "unselected-icon": null,
            "folder-open-icon": "ace-icon tree-plus",
            "folder-close-icon": "ace-icon tree-minus",
        });
    });
</script>

<script>
    // Function to hide messages after 6 seconds
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        var errorMessage = document.getElementById('error-message');

        if (successMessage) {
            successMessage.style.transition = "opacity 0.5s ease";
            successMessage.style.opacity = 0; // Fade out effect
            setTimeout(function() {
                successMessage.style.display = 'none'; // Remove it from the layout
            }, 500); // Wait for fade out to complete
        }

        // Check if the error message exists and fade it out
        if (errorMessage) {
            errorMessage.style.transition = "opacity 0.5s ease";
            errorMessage.style.opacity = 0; // Fade out effect
            setTimeout(function() {
                errorMessage.style.display = 'none'; // Remove it from the layout
            }, 500); // Wait for fade out to complete
        }
    }, 6000); // 6 seconds
</script>