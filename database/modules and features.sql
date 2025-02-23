
    INSERT INTO public.modules (name, icon, description, link, active, created_at)
    VALUES 
        ('Home', 'fa-caret-right', 'Parent menu for home dashboards', 'index.php', 1, CURRENT_TIMESTAMP),
        ('Asset Dashboard', 'fa-caret-right', 'Asset management dashboard', 'index.php?r=assets/index', 1, CURRENT_TIMESTAMP),
        ('AMP Dashboard', 'fa-caret-right', 'AMP dashboard', 'index.php?r=amp/index', 1, CURRENT_TIMESTAMP),
        ('Contract Dashboard', 'fa-caret-right', 'Dashboard for contracts', 'index.php?r=contract/index', 1, CURRENT_TIMESTAMP),
        ('Condition Dashboard', 'fa-caret-right', 'Dashboard for condition monitoring', 'index.php?r=condition/index', 1, CURRENT_TIMESTAMP),
        ('Asset Management', 'fa-caret-right', 'Manage assets', 'index.php?r=assets/index', 1, CURRENT_TIMESTAMP),
        ('Contract Management', 'fa-caret-right', 'Manage contracts', 'index.php?r=contract/index', 1, CURRENT_TIMESTAMP),
        ('Revenue Management', 'fa-caret-right', 'Manage revenues', 'index.php?r=revenue/index', 1, CURRENT_TIMESTAMP),
        ('Traffic Management', 'fa-caret-right', 'Traffic management system', 'index.php?r=traffic/index', 1, CURRENT_TIMESTAMP),
        ('Badgeting Management', 'fa-caret-right', 'Manage budgets', 'index.php?r=badgeting/index', 1, CURRENT_TIMESTAMP),
        ('Events Management', 'fa-caret-right', 'Manage events', 'index.php?r=events/index', 1, CURRENT_TIMESTAMP),
        ('Reporting', 'fa-caret-right', 'Generate reports', 'ndex.php?r=reporting/index', 1, CURRENT_TIMESTAMP),
        ('Maintenance Unit', 'fa-caret-right', 'Manage maintenance units', 'index.php?r=maintenance/index', 1, CURRENT_TIMESTAMP),
        ('User & Permissions', 'fa-caret-right', 'Manage users and permissions', 'index.php?r=permissions/index', 1, CURRENT_TIMESTAMP);


INSERT INTO public.modules_features (module_id, icon, name, description, link, order_by, created_at)
VALUES
(18, 'fas fa-road', 'Asset Dashboard', 'Manage and view Asset Dashboard', '#', 1, NOW()),
(18, 'fas fa-dice-d20', 'AMP Dashboard', 'Manage and view AMP Dashboard', '#', 2, NOW()),
(18, 'far fa-circle', 'Contract Dashboard', 'Manage and view Contract Dashboard', '#', 3, NOW()),
(18, 'fab fa-buromobelexperte', 'Condition Dashboard', 'Manage and view Condition Dashboard', '#', 4, NOW())


INSERT INTO public.permissions(
    module_id, feature_id, role_id, is_active, can_view, can_add, can_edit, can_delete, created_at
)
VALUES
    (18, 58, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
    (18, 59, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
    (18, 60, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
    (18, 61, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),


INSERT INTO public.modules_features (module_id, icon, name, description, link, order_by, created_at)
VALUES
(23, 'fas fa-road', 'Assets', 'Manage and view all assets', '#', 1, NOW()),
(23, 'fas fa-dice-d20', 'Amenities', 'Manage and view all amenities', '#', 2, NOW()),
(23, 'far fa-circle', 'Zone', 'Manage and view all zones', '#', 3, NOW()),
(23, 'fab fa-buromobelexperte', 'Region', 'Manage and view all regions', '#', 4, NOW()),
(23, 'fab fa-delicious', 'Province', 'Manage and view all provinces', '#', 5, NOW()),
(23, 'fab fa-flipboard', 'District', 'Manage and view all districts', '#', 6, NOW()),
(23, 'fas fa-road', 'Route', 'Manage and view all routes', '#', 7, NOW()),
(23, 'fas fa-chart-area-d20', 'Section', 'Manage and view all sections', '#', 8, NOW()),
(23, 'fas fa-layer-group', 'Layers', 'Manage and view all layers', '#', 9, NOW()),
(23, 'fab fa-unity', 'Units', 'Manage and view all units', '#', 10, NOW()),
(23, 'fas fa-dice-d20', 'Media', 'Manage and view all media', '#', 11, NOW()),
(23, 'fas fa-dice-d20', 'Amenities', 'Manage and view additional amenities', '#', 12, NOW());


INSERT INTO public.permissions(
    module_id, feature_id, role_id, is_active, can_view, can_add, can_edit, can_delete, created_at
)
VALUES
    (23, 25, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
    (23, 26, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
    (23, 27, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
    (23, 28, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
    (23, 29, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
    (23, 30, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
    (23, 31, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
    (23, 32, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
    (23, 33, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
    (23, 34, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
    (23, 35, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
    (23, 36, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW());


INSERT INTO public.modules_features (module_id, icon, name, description, link, order_by, created_at)
VALUES
(24, 'fas fa-user-tie', 'Contractor', 'Contractor Module', '#', 1, NOW()),
(24, 'fas fa-file-contract', 'Contract', 'Contract Module', 'contractlist.php', 2, NOW()),
(24, 'fas fa-user-astronaut', 'Engineer', 'Engineer Module', '#', 3, NOW()),
(24, 'fas fab fa-buromobelexperte', 'Scope of Work', 'Scope of Work Module', '#', 4, NOW()),
(24, 'fab fa-delicious', 'Type of Maintenance', 'Type of Maintenance Module', '#', 5, NOW()),
(24, 'fab fa-flipboard', 'Payment (Finance)', 'Payment (Finance) Module', '#', 6, NOW()),
(24, 'fas fa-road', 'Expenditure', 'Expenditure Module', '#', 7, NOW());

INSERT INTO public.permissions (module_id, feature_id, role_id, is_active, can_view, can_add, can_edit, can_delete, created_at)
VALUES
(24, 37, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(24, 38, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(24, 39, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(24, 40, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(24, 41, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(24, 42, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(24, 43, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW());

INSERT INTO public.modules_features (module_id, icon, name, description, link, order_by, created_at)
VALUES
(27, 'fas fa-file-signature', 'Budget (AMP)', 'Awaiting processing', 'mainlist.php', 1, NOW()),
(27, 'fas fa-file-contract', 'Items (CSR)', 'Awaiting processing', '#', 2, NOW()),
(27, 'fas fa-user-astronaut', 'Estimate', 'Engineers estimate', '#', 3, NOW()),
(27, 'fab fa-buromobelexperte', 'Scope of Work', '', '#', 4, NOW()),
(27, 'fab fa-delicious', 'Type of Maintenance', '', '#', 5, NOW()),
(27, 'fab fa-flipboard', 'Financial Year', '', '#', 6, NOW()),
(27, 'fas fa-road', 'Expenditure', '', '#', 7, NOW());


INSERT INTO public.permissions (module_id, feature_id, role_id, is_active, can_view, can_add, can_edit, can_delete, created_at)
VALUES
(27, 44, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(27, 45, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(27, 46, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(27, 47, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(27, 48, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(27, 49, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(27, 50, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW());


INSERT INTO public.modules_features (module_id, icon, name, description, link, order_by, created_at)
VALUES
(31, 'far fa-user-circle', 'HO Users', 'Awaiting processing', '#', 1, NOW()),
(31, 'fab fa-uniregistry', 'Maintenance Unit', 'Awaiting processing', '#', 2, NOW()),
(31, 'far fa-circle', 'Roles', '', '#', 3, NOW()),
(31, 'fas fab fa-buromobelexperte', 'Permissions', '', '#', 4, NOW()),
(31, 'fab fa-delicious', 'Report', '', '#', 5, NOW()),
(31, 'fab fa-flipboard', 'Approval', '', '#', 6, NOW()),
(31, 'fas fa-road', 'Widget', '', '#', 7, NOW());



INSERT INTO public.permissions (module_id, feature_id, role_id, is_active, can_view, can_add, can_edit, can_delete, created_at)
VALUES
(31, 51, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(31, 52, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(31, 53, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(31, 54, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(31, 55, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(31, 56, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW()),
(31, 57, 1, 1, TRUE, TRUE, TRUE, TRUE, NOW());


-- Permission for new role.
SELECT clone_permissions(1); -- For ROLE 1
SELECT clone_permissions(2); -- For ROLE 2

CREATE OR REPLACE FUNCTION clone_permissions(new_role_id INT)
RETURNS VOID AS
$$
BEGIN
    INSERT INTO public.permissions (module_id, feature_id, role_id, is_active, can_view, can_add, can_edit, can_delete, created_at)
    SELECT 
        module_id, 
        feature_id, 
        new_role_id, -- Assign new role_id
        is_active, 
        FALSE AS can_view,  -- Set can_view to FALSE
        TRUE AS can_add,    -- Set can_add to TRUE
        TRUE AS can_edit,   -- Set can_edit to TRUE
        TRUE AS can_delete, -- Set can_delete to TRUE
        NOW() AS created_at
    FROM public.permissions
    WHERE role_id = 1;
END;
$$
LANGUAGE plpgsql;
