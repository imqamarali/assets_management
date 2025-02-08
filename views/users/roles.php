<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<div class="widget-box" id="widget-box-1">

    <div class="d-flex" id="scrollspyEcommerce">
        <span class="fa-stack me-2 ms-n1">
            <svg class="svg-inline--fa fa-circle fa-stack-2x text-primary" aria-hidden="true" focusable="false"
                data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512">
                <path fill="currentColor"
                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z">
                </path>
            </svg>
            <svg class="svg-inline--fa fa-cart-plus fa-inverse fa-stack-1x text-primary-soft"
                data-fa-transform="shrink-4" aria-hidden="true" focusable="false" data-prefix="fas"
                data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                style="transform-origin: 0.5625em 0.5em;">
                <g transform="translate(288 256)">
                    <path fill="currentColor"
                        d="M96 0C107.5 0 117.4 8.19 119.6 19.51L121.1 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H170.7L179.9 336H488C501.3 336 512 346.7 512 360C512 373.3 501.3 384 488 384H159.1C148.5 384 138.6 375.8 136.4 364.5L76.14 48H24C10.75 48 0 37.25 0 24C0 10.75 10.75 0 24 0H96zM272 180H316V224C316 235 324.1 244 336 244C347 244 356 235 356 224V180H400C411 180 420 171 420 160C420 148.1 411 140 400 140H356V96C356 84.95 347 76 336 76C324.1 76 316 84.95 316 96V140H272C260.1 140 252 148.1 252 160C252 171 260.1 180 272 180zM128 464C128 437.5 149.5 416 176 416C202.5 416 224 437.5 224 464C224 490.5 202.5 512 176 512C149.5 512 128 490.5 128 464zM512 464C512 490.5 490.5 512 464 512C437.5 512 416 490.5 416 464C416 437.5 437.5 416 464 416C490.5 416 512 437.5 512 464z">
                    </path>
                </g>
            </svg>
        </span>
        <div class="col">
            <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">User Roles</span>
                <span
                    class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
            </h3>
            <p class="mb-0">Managing User Roles</p>
        </div>
    </div>
    <hr class="bg-200">
    <div class="widget-body">
        <div class="widget-main">

            <?php if (count($roles) == 0) { ?>
            <p class="alert alert-warning">
                No Roles found.
            </p>
            <?php } else { ?>

            <table class="table table-striped table-hover table-bordered table-sm fs--1 mb-0">
                <thead>
                    <tr>
                        <th class="center">Sr #</th>
                        <th>Roles</th>
                        <th>Permissions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $key => $item): ?>
                    <tr class="menu-item" data-id="<?php echo $key; ?>">
                        <td class="center"><?php echo $key + 1; ?></td>
                        <td>
                            <a style="cursor: pointer">
                                <?php echo htmlspecialchars($item['role_name']); ?>
                            </a>
                        </td>
                        <td>
                            <!-- Modules Permissions -->
                            <div class="btn-group btn-overlap btn-corner">
                                <label class=" active" data-toggle="tooltip" title="Modules Permissions">
                                    <a href="index.php?r=users/permissions&id=<?php echo $item['role_id'] ?>">
                                        <i class="fa fa-cogs bigger-110"></i>
                                    </a>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php } ?>

        </div>
    </div>
</div>
<div id="roles-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title" id="title">New Role</h4>
                        <span class="widget-toolbar">
                            <a href="#" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                            </a>
                        </span>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main">
                            <form method="post" action="index.php?r=config/role">
                                <?= yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                                <input hidden data-rel="tooltip" type="text" placeholder="Role Id" title="Role Id"
                                    id="role_id" name="role_id" data-placement="bottom" />
                                <input data-rel="tooltip" type="text" placeholder="Role Name" title="Role Name"
                                    id="role_name" name="role_name" data-placement="bottom" required />

                                <div style="margin-top: 5px;">

                                    <textarea data-rel="tooltip" placeholder="Description" title="Description"
                                        id="role_description" name="role_description" required class="form-control"
                                        id="form-field-9" maxlength="256"></textarea>
                                </div>

                                <hr />

                                <label class="btn btn-sm btn-white btn-info">
                                    <input type="checkbox" name="role_view1" value="role_view" />
                                    <i class="icon-only ace-icon fa fa-check bigger-110"></i>
                                    <!-- Delete -->
                                </label>
                                <span class="widget-toolbar">
                                    <button style="background: none; border: none; padding: 0; margin: 0;">
                                        <i class=" ace-icon fa fa-check"></i>
                                    </button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
function setModalValues(item) {
    console.log(item);
    document.getElementById('role_id').value = item.id || '';
    document.getElementById('role_name').value = item.name || '';
    document.getElementById('role_description').value = item.description || '';
    document.querySelector('input[name="role_view1"]').checked = item.active === '1';
    document.getElementById('title').innerHTML = 'Update Role';

}
</script>
<!-- Tooltip Initialization Script -->
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>