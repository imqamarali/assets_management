<?php $index = 1;
$where = ''; // Start with a true condition to simplify appending filters
$where1 = '';
$yearr = "";
$yearrc = "";
$whereoo = '';
if (Yii::$app->request->isPost) {
  $data = Yii::$app->request->post();
  $tag = '';
  if (isset($data['apply_search']) && $data['apply_search'] == 'Search') {

    if (isset($data['year']) && !empty($data['year'])) {

      $years = implode(', ', $data['year']); //exit;
      $whereoo .= " AND amp_year.id in (" . $years . ")";
      $yearr .= " AND amp_main.year in (" . $years . ")";
      $yearrc .= " AND m_contract.amp_year in (" . $years . ")";
      $tyear = Yii::$app->db->createCommand('SELECT * FROM public."amp_year" where	1=1 ' . $whereoo . ' ')->queryAll();
      foreach ($tyear as $ro) {
        $tag .= '<span class="badge badge-phoenix fs--2 badge-phoenix-success d-inline-flex align-items-center ms-2"><span class="badge-label d-inline-block lh-base">' . $ro['year'] . '</span></span>';
      }
    }

    if (isset($data['region']) && !empty($data['region'])) {
      $where1 .= " AND amp_sub.region_id = '" . $data['region'] . "'";
      $where .= " AND m_contract.region_id = '" . $data['region'] . "'";
      $tregion = Yii::$app->db->createCommand('SELECT * FROM public."a_region" where	"ID"=' . $data['region'] . ' ')->queryOne();
      $tag .= '<span class="badge badge-phoenix fs--2 badge-phoenix-success d-inline-flex align-items-center ms-2"><span class="badge-label d-inline-block lh-base">' . $tregion['name'] . '</span></span>';
    }
    if (isset($data['zone']) && !empty($data['zone'])) {
      $where1 .= " AND zone_id = '" . $data['zone'] . "'";
      $where .= " AND z.id = '" . $data['zone'] . "'";
      $tzone = Yii::$app->db->createCommand('SELECT * FROM public."a_zone" where id=' . $data['zone'] . ' ')->queryOne();
      $tag .= '<span class="badge badge-phoenix fs--2 badge-phoenix-success d-inline-flex align-items-center ms-2">
					<span class="badge-label d-inline-block lh-base">' . ($tzone['Name'] ?? "na") . '</span></span>';
    }
    if (isset($data['unit']) && !empty($data['unit'])) {
      $where1 .= " AND unit_id = '" . $data['unit'] . "'";
      $where .= " AND unit = '" . $data['unit'] . "'";
      $tunit = Yii::$app->db->createCommand('SELECT * FROM public."u_unit" where "ID"=' . $data['unit'] . ' ')->queryOne();
      $tag .= '<span class="badge badge-phoenix fs--2 badge-phoenix-success d-inline-flex align-items-center ms-2">
					<span class="badge-label d-inline-block lh-base">' . ($tunit['name'] ?? "na") . '</span></span>';
    }
    if (isset($data['route']) && !empty($data['route'])) {
      $where1 .= " AND amp_sub.route_id = '" . $data['route'] . "'";
      $where .= " AND route_id = '" . $data['route'] . "'";
      $troute = Yii::$app->db->createCommand('SELECT * FROM public."a_route" where id=' . $data['route'] . ' ')->queryOne();
      $tag .= '<span class="badge badge-phoenix fs--2 badge-phoenix-success d-inline-flex align-items-center ms-2">
					<span class="badge-label d-inline-block lh-base">' . ($troute['name'] ?? "na") . '</span></span>';
    }
  }
}
$req = 0;
$up = 0;
$ua = 0;
$inpro = 0;
$compl = 0;
$planned = Yii::$app->db->createCommand('SELECT sum(cost) as cost,count(*) as total FROM public."amp_sub"
								left join amp_main on (amp_sub."AMP_id"=amp_main.id)	where 1=1 ' . $yearr . $where1 . ' ')->queryOne();
$coninpro = Yii::$app->db->createCommand('SELECT sum(bid_cost) as bid_cost,count(*) as total FROM public."m_contract" 
		LEFT JOIN public."u_unit" AS u ON m_contract.unit = u."ID"
								LEFT JOIN public."a_region" AS r ON u."region_id" = r."ID"
								LEFT JOIN public."a_zone" z ON r."zone_id" = z.id
		where m_contract.status=1 ' . $yearrc . $where . ' ')->queryOne();
$conco = Yii::$app->db->createCommand('SELECT sum(bid_cost) as bid_cost,count(*) as total FROM public."m_contract" 
		LEFT JOIN public."u_unit" AS u ON m_contract.unit = u."ID"
		LEFT JOIN public."a_region" AS r ON u."region_id" = r."ID"
		LEFT JOIN public."a_zone" z ON r."zone_id" = z.id
		where m_contract.status=2 ' . $yearrc . $where . ' ')->queryOne();
//print_r($data['year']);exit;		
?>
<div class="row">
  <div class="col-12 col-md-4">
    <h4 class="text-1100 text-nowrap">Annual Maintenance Plan Summary</h4>
    <hr class="bg-200">
    <div class="d-flex align-items-center justify-content-between">
      <p class="mb-0 fw-bold">Status </p>
      <p class="mb-0 fs--1"> Number Of Contracts(Rs.) <span class="fw-bold"></span></p>
    </div>
    <hr class="bg-200 mb-2 mt-2">
    <div class="d-flex align-items-center mb-1"><span class="d-inline-block bg-info-300 bullet-item me-2"></span>
      <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">Planned Schemes</p>
      <h5 class="mb-0 text-900"><?php echo  $planned['total'] . '&nbsp;&nbsp;' ?> </h5>
      <h6 class="mb-0 text-900">(<?php echo number_format($planned['cost'] * 100000) ?>)</h6>
    </div>
    <div class="d-flex align-items-center mb-1"><span class="d-inline-block bg-warning-300 bullet-item me-2"></span>
      <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">Proposed</p>
      <h5 class="mb-0 text-900">0</h5>
      <h6 class="mb-0 text-900">(0)</h6>
    </div>
    <div class="d-flex align-items-center"><span class="d-inline-block bg-primary bullet-item me-2"></span>
      <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">Under Approval</p>
      <h5 class="mb-0 text-900">0</h5>
      <h6 class="mb-0 text-900">(0)</h6>
    </div>
    <div class="d-flex align-items-center mb-1"><span class="d-inline-block bg-warning-300 bullet-item me-2"></span>
      <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">Under Procurement</p>
      <h5 class="mb-0 text-900">0</h5>
      <h6 class="mb-0 text-900">(0)</h6>
    </div>
    <div class="d-flex align-items-center mb-1"><span class="d-inline-block bg-danger-300 bullet-item me-2"></span>
      <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">In-Progress</p>
      <h5 class="mb-0 text-900"><?php echo $coninpro['total'] . '&nbsp;&nbsp;' ?> </h5>
      <h6 class="mb-0 text-900">(<?php echo number_format($coninpro['bid_cost']) ?>)</h6>
    </div>
    <div class="d-flex align-items-center mb-1"><span class="d-inline-block bg-success-300 bullet-item me-2"></span>
      <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">Completed </p>
      <h5 class="mb-0 text-900"><?php echo $conco['total'] . '&nbsp;&nbsp;' ?> </h5>
      <h6 class="mb-0 text-900">(<?php echo number_format($conco['bid_cost']) ?>)</h6>
    </div>

    <a href="?r=site/amp" class="btn btn-outline-primary mt-5">See Details</a>
  </div>
  <div class="col-sm-5 col-md-8 col-xxl-4 my-3 my-sm-0">
    <h4 class="text-1100 text-nowrap" style="text-align:center;">AMP Schemes Status</h4>
    <?php echo $tag; ?>
    <hr class="bg-200">
    <div class="echart-pie-label-align-chart-example" style="min-height:320px"></div>

  </div>
</div>
<div class="row">
  <div class="col-12 col-xl-5 col-xxl-4">
    <h4 class="text-1100 text-nowrap">Funds Status</h4>
    <hr class="bg-200">
    <div class="echart-pie-label-align-chart-examplenew" style="min-height:320px"></div>
  </div>
  <div class="col-12 col-xl-7 col-xxl-8">
    <h4 class="text-1100 text-nowrap">Zone wise AMP Summary</h4>
    <hr class="bg-200">
    <div id="" data-list="">
      <div class="table-responsive">
        <table id="" class="table table-striped table-hover table-sm fs--1 mb-0 simlee">
          <thead>
            <tr style="background-color:#a7a7a7;">

              <th class="sort border-top">Zone</th>
              <th class="sort border-top">Planned Schemes</th>
              <th class="sort border-top">Inprogress</th>
              <th class="sort border-top">Completed</th>
              <th class="sort border-top">Paid</th>
              <th class="sort border-top">Liability</th>
            </tr>
          </thead>
          <tbody class="list">
            <?php $asset_Q = 'SELECT * FROM public."a_zone" ';

            $zone = Yii::$app->db->createCommand($asset_Q)->queryAll();

            // Fetch data for dropdowns
            $provinces = Yii::$app->db->createCommand('SELECT "ID", "name" FROM public."a_province"')->queryAll();

            $utilizedin = 0;
            $utilizedco = 0;
            $ampt = 0;
            $paida = 0;
            $remaining = 0;
            foreach ($zone as $item):
              //$status = ($item['status'] == 1) ? "Active" : (($item['status'] == 0) ? "Disabled" : "N/A");
              //echo 'SELECT * FROM public."n_asset" where "Route_id"='.$item['id'].' order by id ASC';exit;
              //echo 'SELECT sum(cost) as cost FROM public."amp_sub" left join amp_main on (amp_sub."AMP_id"=amp_main.id)	where year='.$item['id'].$where1.' ';exit;
              $amp = Yii::$app->db->createCommand('SELECT sum(cost) as cost FROM public."amp_sub"
								left join amp_main on (amp_sub."AMP_id"=amp_main.id)
							
								where zone_id=' . $item['id'] . $where1 . $where1 . ' ')->queryOne();
              $conin = Yii::$app->db->createCommand('SELECT sum(bid_cost) as bid_cost FROM public."m_contract" 
								LEFT JOIN public."u_unit" AS u ON m_contract.unit = u."ID"
								LEFT JOIN public."a_region" AS r ON u."region_id" = r."ID"
								LEFT JOIN public."a_zone" z ON r."zone_id" = z.id
								where m_contract.status=1 and z.id=' . $item['id'] . $yearrc . $where . ' ')->queryOne();
              $concoo = Yii::$app->db->createCommand('SELECT sum(bid_cost) as bid_cost FROM public."m_contract" 
								LEFT JOIN public."u_unit" AS u ON m_contract.unit = u."ID"
								LEFT JOIN public."a_region" AS r ON u."region_id" = r."ID"
								LEFT JOIN public."a_zone" z ON r."zone_id" = z.id
								where m_contract.status=2 and z.id=' . $item['id'] . $yearrc . $where . ' ')->queryOne();
              $paid = Yii::$app->db->createCommand('SELECT sum(amount) as paid FROM public."m_contract_payments" 
								left join m_contract on (m_contract.id=m_contract_payments.contract_id)
								LEFT JOIN public."u_unit" AS u ON m_contract.unit = u."ID"
								LEFT JOIN public."a_region" AS r ON u."region_id" = r."ID"
								LEFT JOIN public."a_zone" z ON r."zone_id" = z.id
								where z.id=' . $item['id'] . $yearrc . $where . ' ')->queryOne();
              //$link=Yii::$app->db->createCommand('SELECT id  FROM public."amp_main"
              //where year='.$item['id'].' ')->queryOne();

              $ampt = $ampt + (int)$amp['cost'] * 1000000;
              $utilizedin = $utilizedin + (int)$conin['bid_cost'];
              $utilizedco = $utilizedco + (int)$concoo['bid_cost'];
              $paida = $paida + (int)$paid['paid'];
              $remaining = $remaining + (int)(($concoo['bid_cost'] + $conin['bid_cost']) - $paid['paid']);
            ?>
              <tr>

                <td><b><a
                      href="index.php?r=budgeting/amp_details&referance=<?php echo $link['id'] ?? "0" ?>"><?= $item['Name'] ?></a></b>
                </td>
                <td style="color:green"><?= number_format(($amp['cost'] * 1000000) ?? "0"); ?></td>
                <td style="color:black"><?= number_format($conin['bid_cost'] ?? "0"); ?></td>
                <td style="color:black"><?= number_format($concoo['bid_cost'] ?? "0"); ?></td>
                <td style="color:green"><?= number_format($paid['paid'] ?? "0"); ?></td>
                <td style="color:red">
                  <?= number_format((($conin['bid_cost'] + $concoo['bid_cost']) - $paid['paid']) ?? "0"); ?>
                </td>
              </tr>
            <?php endforeach; ?>
            <tr>
              <td class="center">Total</td>
              <td><b><?= number_format($ampt) ?></b></td>
              <td><b><?= number_format($utilizedin)   ?></b></td>
              <td><b><?= number_format($utilizedco)   ?></b></td>

              <td><b><?= number_format($paida) ?></b></td>
              <td><b><?= number_format($remaining) ?></b></td>

            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>


</div>

<div class="row">
  <div class="col-12 col-xl-5 col-xxl-4">
    <h4 class="text-1100 text-nowrap">Revenue/Laibility Status</h4>
    <hr class="bg-200">
    <div class="echart-pie-label-align-chart-examplerev" style="min-height:320px"></div>
  </div>
  <div class="col-12 col-xl-7 col-xxl-8">
    <h4 class="text-1100 text-nowrap">Zone wise Revenue/Laibility</h4>
    <hr class="bg-200">
    <div id="" data-list="">
      <div class="table-responsive">
        <table id="" class="table table-striped table-hover table-sm fs--1 mb-0 simlee">
          <thead>
            <tr style="background-color:#a7a7a7;">

              <th class="sort border-top">Zone</th>
              <th class="sort border-top">Revenue</th>
              <th class="sort border-top">Liability</th>
            </tr>
          </thead>
          <tbody class="list">
            <?php $asset_Q = 'SELECT * FROM public."a_zone" ';

            $zone = Yii::$app->db->createCommand($asset_Q)->queryAll();

            // Fetch data for dropdowns
            $provinces = Yii::$app->db->createCommand('SELECT "ID", "name" FROM public."a_province"')->queryAll();

            $utilizedin = 0;
            $utilizedco = 0;
            $ampt = 0;
            $paida = 0;
            $remaining = 0;
            foreach ($zone as $item):
              //$status = ($item['status'] == 1) ? "Active" : (($item['status'] == 0) ? "Disabled" : "N/A");
              //echo 'SELECT * FROM public."n_asset" where "Route_id"='.$item['id'].' order by id ASC';exit;
              //echo 'SELECT sum(cost) as cost FROM public."amp_sub" left join amp_main on (amp_sub."AMP_id"=amp_main.id)	where year='.$item['id'].$where1.' ';exit;
              $amp = Yii::$app->db->createCommand('SELECT sum(cost) as cost FROM public."amp_sub"
								left join amp_main on (amp_sub."AMP_id"=amp_main.id)
							
								where zone_id=' . $item['id'] . $where1 . ' ')->queryOne();
              $conin = Yii::$app->db->createCommand('SELECT sum(bid_cost) as bid_cost FROM public."m_contract" 
								LEFT JOIN public."u_unit" AS u ON m_contract.unit = u."ID"
								LEFT JOIN public."a_region" AS r ON u."region_id" = r."ID"
								LEFT JOIN public."a_zone" z ON r."zone_id" = z.id
								where m_contract.status=1 and z.id=' . $item['id'] . $yearrc . $where . ' ')->queryOne();
              $concoo = Yii::$app->db->createCommand('SELECT sum(bid_cost) as bid_cost FROM public."m_contract" 
								LEFT JOIN public."u_unit" AS u ON m_contract.unit = u."ID"
								LEFT JOIN public."a_region" AS r ON u."region_id" = r."ID"
								LEFT JOIN public."a_zone" z ON r."zone_id" = z.id
								where m_contract.status=2 and z.id=' . $item['id'] . $yearrc . $where . ' ')->queryOne();
              $paid = Yii::$app->db->createCommand('SELECT sum(amount) as paid FROM public."m_contract_payments" 
								left join m_contract on (m_contract.id=m_contract_payments.contract_id)
								LEFT JOIN public."u_unit" AS u ON m_contract.unit = u."ID"
								LEFT JOIN public."a_region" AS r ON u."region_id" = r."ID"
								LEFT JOIN public."a_zone" z ON r."zone_id" = z.id
								where z.id=' . $item['id'] . $yearrc . $where . ' ')->queryOne();
              $link = Yii::$app->db->createCommand('SELECT id  FROM public."amp_main"
								where year=' . $item['id'] . ' ')->queryOne();

              $ampt = $ampt + (int)$amp['cost'] * 1000000;
              $utilizedin = $utilizedin + (int)$conin['bid_cost'];
              $utilizedco = $utilizedco + (int)$concoo['bid_cost'];
              $paida = $paida + (int)$paid['paid'];
              $remaining = $remaining + (int)(($concoo['bid_cost'] + $conin['bid_cost']) - $paid['paid']);
            ?>
              <tr>

                <td><b><a
                      href="index.php?r=budgeting/amp_details&referance=<?php echo $link['id'] ?? "0" ?>"><?= $item['Name'] ?></a></b>
                </td>
                <td style="color:green"><?= number_format('00'); ?></td>
                <td style="color:red">
                  <?= number_format((($conin['bid_cost'] + $concoo['bid_cost']) - $paid['paid']) ?? "0"); ?>
                </td>
              </tr>
            <?php endforeach; ?>
            <tr>
              <td class="center">Total</td>


              <td><b><?= number_format(00) ?></b></td>
              <td><b><?= number_format($remaining) ?></b></td>

            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>


</div>
<div class="row">
  <div class="col-12 col-md-4">
    <h4 class="text-1100 text-nowrap">Data Reconcilation Status </h4>
    <hr class="bg-200">
    <div class="d-flex align-items-center justify-content-between">
      <p class="mb-0 fw-bold">Status </p>
      <p class="mb-0 fs--1"> Number Of Contracts <span class="fw-bold"></span></p>
    </div>
    <hr class="bg-200 mb-2 mt-2">

    <div class="d-flex align-items-center mb-1"><span class="d-inline-block bg-success-300 bullet-item me-2"></span>
      <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">Total Schemes</p>
      <h5 class="mb-0 text-900">5864 </h5>
      <h6 class="mb-0 text-900"></h6>
    </div>

    <div class="d-flex align-items-center mb-1"><span class="d-inline-block bg-success-300 bullet-item me-2"></span>
      <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">Reconciled with finance </p>
      <h5 class="mb-0 text-900">4845</h5>
      <h6 class="mb-0 text-900"></h6>
    </div>
    <div class="d-flex align-items-center mb-1"><span class="d-inline-block bg-danger-300 bullet-item me-2"></span>
      <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">Under Review </p>
      <h5 class="mb-0 text-900">1019</h5>
      <h6 class="mb-0 text-900"></h6>
    </div>


  </div>
  <div class="col-sm-5 col-md-8 col-xxl-4 my-3 my-sm-0">
    <h4 class="text-1100 text-nowrap" style="text-align:center;">5 Years (2018-2019 to 2023-2024)</h4>
    <?php echo $tag; ?>
    <hr class="bg-200">
    <div class="echart-pie-label-align-chart-exampledata" style="min-height:320px"></div>

  </div>
</div>
<script src="assets/js/echarts-example.js"></script>
<script>
  (function(factory) {
    typeof define === 'function' && define.amd ? define(factory) :
      factory();
  })((function() {
    'use strict';

    // import * as echarts from 'echarts';
    const {
      merge
    } = window._;

    // form config.js
    const echartSetOption = (
      chart,
      userOptions,
      getDefaultOptions,
      responsiveOptions
    ) => {
      const {
        breakpoints,
        resize
      } = window.phoenix.utils;
      const handleResize = options => {
        Object.keys(options).forEach(item => {
          if (window.innerWidth > breakpoints[item]) {
            chart.setOption(options[item]);
          }
        });
      };

      const themeController = document.body;
      // Merge user options with lodash
      chart.setOption(merge(getDefaultOptions(), userOptions));

      const navbarVerticalToggle = document.querySelector(
        '.navbar-vertical-toggle'
      );
      if (navbarVerticalToggle) {
        navbarVerticalToggle.addEventListener('navbar.vertical.toggle', () => {
          chart.resize();
          if (responsiveOptions) {
            handleResize(responsiveOptions);
          }
        });
      }

      resize(() => {
        chart.resize();
        if (responsiveOptions) {
          handleResize(responsiveOptions);
        }
      });
      if (responsiveOptions) {
        handleResize(responsiveOptions);
      }

      themeController.addEventListener(
        'clickControl',
        ({
          detail: {
            control
          }
        }) => {
          if (control === 'phoenixTheme') {
            chart.setOption(window._.merge(getDefaultOptions(), userOptions));
          }
        }
      );
    };
    // -------------------end config.js--------------------

    const echartTabs = document.querySelectorAll('[data-tab-has-echarts]');
    if (echartTabs) {
      echartTabs.forEach(tab => {
        tab.addEventListener('shown.bs.tab', e => {
          const el = e.target;
          const {
            hash
          } = el;
          const id = hash || el.dataset.bsTarget;
          const content = document.getElementById(id.substring(1));
          const chart = content?.querySelector('[data-echart-tab]');
          if (chart) {
            window.echarts.init(chart).resize();
          }
        });
      });
    }
    const pieLabelAlignChartInitrev = () => {
      const {
        getColor,
        getData,
        rgbaColor
      } = window.phoenix.utils;
      const $chartEl = document.querySelector(
        '.echart-pie-label-align-chart-examplerev'
      );

      const data = [

        {
          value: 25874569,
          name: 'Revenue',
          itemStyle: {
            color: rgbaColor(getColor('danger'), 0.5)
          }
        },
        {
          value: 654987888,
          name: 'Laibility',
          itemStyle: {
            color: rgbaColor(getColor('success'), 0.5)
          }
        },
        {
          value: <?php echo $remaining ?>,
          name: '',
          itemStyle: {
            color: rgbaColor(getColor('success'), 0.5)
          }
        },

      ];

      if ($chartEl) {
        const userOptions = getData($chartEl, 'echarts');
        const chart = window.echarts.init($chartEl);
        const getDefaultOptions = () => ({
          title: [{
              text: '',
              left: 'center',
              textStyle: {
                color: getColor('gray-600')
              }
            },
            {
              subtext: 'Quantity',
              left: '50%',
              top: '85%',
              textAlign: 'center',
              subtextStyle: {
                color: getColor('gray-700')
              }
            }
          ],

          tooltip: {
            trigger: 'item',
            padding: [7, 10],
            backgroundColor: getColor('gray-100'),
            borderColor: getColor('gray-300'),
            textStyle: {
              color: getColor('dark')
            },
            borderWidth: 1,
            transitionDuration: 0,
            axisPointer: {
              type: 'none'
            },
            position(pos, ...size) {
              if (window.innerWidth <= 540) {
                const tooltipHeight = size[1].offsetHeight;
                const obj = {
                  top: pos[1] - tooltipHeight - 20
                };
                obj[pos[0] < size[3].viewSize[0] / 2 ? 'left' : 'right'] = 5;
                return obj;
              }
              return null;
            }
          },

          series: [{
            type: 'pie',
            radius: window.innerWidth < 530 ? '45%' : '60%',
            center: ['50%', '50%'],
            data,
            label: {
              position: 'outer',
              alignTo: 'labelLine',
              bleedMargin: 5,
              color: getColor('gray-700')
            },
            left: '5%',
            right: '5%',
            top: 0,
            bottom: 0
          }]
        });

        const responsiveOptions = {
          xs: {
            series: [{
              radius: '45%'
            }]
          },
          sm: {
            series: [{
              radius: '60%'
            }]
          }
        };

        echartSetOption(chart, userOptions, getDefaultOptions, responsiveOptions);
      }
    };

    const pieLabelAlignChartInitnew = () => {
      const {
        getColor,
        getData,
        rgbaColor
      } = window.phoenix.utils;
      const $chartEl = document.querySelector(
        '.echart-pie-label-align-chart-examplenew'
      );

      const data = [{
          value: <?php echo $ampt; ?>,
          name: 'Planned Schemes',
          itemStyle: {
            color: rgbaColor(getColor('info'), 0.5)
          }
        },


        {
          value: <?php echo $utilizedin ?>,
          name: 'Inprogress',
          itemStyle: {
            color: rgbaColor(getColor('danger'), 0.5)
          }
        },
        {
          value: <?php echo $utilizedco ?>,
          name: 'Completed',
          itemStyle: {
            color: rgbaColor(getColor('danger'), 0.5)
          }
        },
        {
          value: <?php echo $paida ?>,
          name: 'Paid',
          itemStyle: {
            color: rgbaColor(getColor('success'), 0.5)
          }
        },
        {
          value: <?php echo $remaining ?>,
          name: 'Remaining',
          itemStyle: {
            color: rgbaColor(getColor('success'), 0.5)
          }
        },

      ];

      if ($chartEl) {
        const userOptions = getData($chartEl, 'echarts');
        const chart = window.echarts.init($chartEl);
        const getDefaultOptions = () => ({
          title: [{
              text: '',
              left: 'center',
              textStyle: {
                color: getColor('gray-600')
              }
            },
            {
              subtext: 'Amount of Contracts',
              left: '50%',
              top: '85%',
              textAlign: 'center',
              subtextStyle: {
                color: getColor('gray-700')
              }
            }
          ],

          tooltip: {
            trigger: 'item',
            padding: [7, 10],
            backgroundColor: getColor('gray-100'),
            borderColor: getColor('gray-300'),
            textStyle: {
              color: getColor('dark')
            },
            borderWidth: 1,
            transitionDuration: 0,
            axisPointer: {
              type: 'none'
            },
            position(pos, ...size) {
              if (window.innerWidth <= 540) {
                const tooltipHeight = size[1].offsetHeight;
                const obj = {
                  top: pos[1] - tooltipHeight - 20
                };
                obj[pos[0] < size[3].viewSize[0] / 2 ? 'left' : 'right'] = 5;
                return obj;
              }
              return null;
            }
          },

          series: [{
            type: 'pie',
            radius: window.innerWidth < 530 ? '45%' : '60%',
            center: ['50%', '50%'],
            data,
            label: {
              position: 'outer',
              alignTo: 'labelLine',
              bleedMargin: 5,
              color: getColor('gray-700')
            },
            left: '5%',
            right: '5%',
            top: 0,
            bottom: 0
          }]
        });

        const responsiveOptions = {
          xs: {
            series: [{
              radius: '45%'
            }]
          },
          sm: {
            series: [{
              radius: '60%'
            }]
          }
        };

        echartSetOption(chart, userOptions, getDefaultOptions, responsiveOptions);
      }
    };
    const pieLabelAlignChartInit = () => {
      const {
        getColor,
        getData,
        rgbaColor
      } = window.phoenix.utils;
      const $chartEl = document.querySelector(
        '.echart-pie-label-align-chart-example'
      );

      const data = [{
          value: <?php echo $planned['total']; ?>,
          name: 'Planned Schemes',
          itemStyle: {
            color: rgbaColor(getColor('info'), 0.5)
          }
        },
        {
          value: 0,
          name: 'Requisition',
          itemStyle: {
            color: rgbaColor(getColor('warning'), 0.5)
          }
        },
        {
          value: 0,
          name: 'Under Approval',
          itemStyle: {
            color: rgbaColor(getColor('primary'), 0.5)
          }
        },
        {
          value: 0,
          name: 'Under Procurement',
          itemStyle: {
            color: rgbaColor(getColor('warning'), 0.5)
          }
        },
        {
          value: <?php echo $coninpro['total'] ?>,
          name: 'Inprogress',
          itemStyle: {
            color: rgbaColor(getColor('danger'), 0.5)
          }
        },
        {
          value: <?php echo $conco['total'] ?>,
          name: 'Completed',
          itemStyle: {
            color: rgbaColor(getColor('success'), 0.5)
          }
        },

      ];

      if ($chartEl) {
        const userOptions = getData($chartEl, 'echarts');
        const chart = window.echarts.init($chartEl);
        const getDefaultOptions = () => ({
          title: [{
              text: '',
              left: 'center',
              textStyle: {
                color: getColor('gray-600')
              }
            },
            {
              subtext: 'Quantity',
              left: '50%',
              top: '85%',
              textAlign: 'center',
              subtextStyle: {
                color: getColor('gray-700')
              }
            }
          ],

          tooltip: {
            trigger: 'item',
            padding: [7, 10],
            backgroundColor: getColor('gray-100'),
            borderColor: getColor('gray-300'),
            textStyle: {
              color: getColor('dark')
            },
            borderWidth: 1,
            transitionDuration: 0,
            axisPointer: {
              type: 'none'
            },
            position(pos, ...size) {
              if (window.innerWidth <= 540) {
                const tooltipHeight = size[1].offsetHeight;
                const obj = {
                  top: pos[1] - tooltipHeight - 20
                };
                obj[pos[0] < size[3].viewSize[0] / 2 ? 'left' : 'right'] = 5;
                return obj;
              }
              return null;
            }
          },

          series: [{
            type: 'pie',
            radius: window.innerWidth < 530 ? '45%' : '60%',
            center: ['50%', '50%'],
            data,
            label: {
              position: 'outer',
              alignTo: 'labelLine',
              bleedMargin: 5,
              color: getColor('gray-700')
            },
            left: '5%',
            right: '5%',
            top: 0,
            bottom: 0
          }]
        });

        const responsiveOptions = {
          xs: {
            series: [{
              radius: '45%'
            }]
          },
          sm: {
            series: [{
              radius: '60%'
            }]
          }
        };

        echartSetOption(chart, userOptions, getDefaultOptions, responsiveOptions);
      }
    };

    const pieLabelAlignChartInitdata = () => {
      const {
        getColor,
        getData,
        rgbaColor
      } = window.phoenix.utils;
      const $chartEl = document.querySelector(
        '.echart-pie-label-align-chart-exampledata'
      );

      const data = [{
          value: 5864,
          name: 'Total Schemes',
          itemStyle: {
            color: rgbaColor(getColor('info'), 0.5)
          }
        },
        {
          value: 4845,
          name: 'Reconciled ',
          itemStyle: {
            color: rgbaColor(getColor('info'), 0.5)
          }
        },
        {
          value: 1019,
          name: 'Under Review',
          itemStyle: {
            color: rgbaColor(getColor('warning'), 0.5)
          }
        },


      ];

      if ($chartEl) {
        const userOptions = getData($chartEl, 'echarts');
        const chart = window.echarts.init($chartEl);
        const getDefaultOptions = () => ({
          title: [{
              text: '',
              left: 'center',
              textStyle: {
                color: getColor('gray-600')
              }
            },
            {
              subtext: 'Quantity',
              left: '50%',
              top: '85%',
              textAlign: 'center',
              subtextStyle: {
                color: getColor('gray-700')
              }
            }
          ],

          tooltip: {
            trigger: 'item',
            padding: [7, 10],
            backgroundColor: getColor('gray-100'),
            borderColor: getColor('gray-300'),
            textStyle: {
              color: getColor('dark')
            },
            borderWidth: 1,
            transitionDuration: 0,
            axisPointer: {
              type: 'none'
            },
            position(pos, ...size) {
              if (window.innerWidth <= 540) {
                const tooltipHeight = size[1].offsetHeight;
                const obj = {
                  top: pos[1] - tooltipHeight - 20
                };
                obj[pos[0] < size[3].viewSize[0] / 2 ? 'left' : 'right'] = 5;
                return obj;
              }
              return null;
            }
          },

          series: [{
            type: 'pie',
            radius: window.innerWidth < 530 ? '45%' : '60%',
            center: ['50%', '50%'],
            data,
            label: {
              position: 'outer',
              alignTo: 'labelLine',
              bleedMargin: 5,
              color: getColor('gray-700')
            },
            left: '5%',
            right: '5%',
            top: 0,
            bottom: 0
          }]
        });

        const responsiveOptions = {
          xs: {
            series: [{
              radius: '45%'
            }]
          },
          sm: {
            series: [{
              radius: '60%'
            }]
          }
        };

        echartSetOption(chart, userOptions, getDefaultOptions, responsiveOptions);
      }
    };


    const {
      docReady
    } = window.phoenix.utils;

    docReady(pieLabelAlignChartInitdata);
    docReady(pieLabelAlignChartInit);
    docReady(pieLabelAlignChartInitnew);
    docReady(pieLabelAlignChartInitrev);


  }));
  //# sourceMappingURL=echarts-example.js.map
</Script>
<!-- Script to handle update functionality -->