<?php		$index = 1;
							 $where = ''; // Start with a true condition to simplify appending filters
$where1 = '';$yearr = "";$yearrc="";$whereoo='';
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
$tag='';
            if (isset($data['apply_search']) && $data['apply_search'] == 'Search') {
				
                if (isset($data['year']) && !empty($data['year'])) {

                    $years= implode(', ',$data['year']);//exit;
					$whereoo .= " AND amp_year.id in (".$years.")";
					$yearr .= " AND amp_main.year in (".$years.")";
					$yearrc .= " AND m_contract.amp_year in (".$years.")";
   					$tyear=Yii::$app->db->createCommand('SELECT * FROM public."amp_year" where	1=1 '.$whereoo.' ')->queryAll();
					foreach($tyear as $ro){ 
					$tag .='<span class="badge badge-phoenix fs--2 badge-phoenix-success d-inline-flex align-items-center ms-2"><span class="badge-label d-inline-block lh-base">'.$ro['year'].'</span></span>';
					} 
				}
				
                if (isset($data['region']) && !empty($data['region'])) {
                    $where1 .= " AND amp_sub.region_id = '" . $data['region'] . "'";
					$where .= " AND m_contract.region_id = '" . $data['region'] . "'";
					$tregion=Yii::$app->db->createCommand('SELECT * FROM public."a_region" where	"ID"='.$data['region'].' ')->queryOne();
					$tag .='<span class="badge badge-phoenix fs--2 badge-phoenix-success d-inline-flex align-items-center ms-2"><span class="badge-label d-inline-block lh-base">'.$tregion['name'].'</span></span>';
				}
				if (isset($data['zone']) && !empty($data['zone'])) {
                    $where1 .= " AND zone_id = '" . $data['zone'] . "'";
					$where .= " AND z.id = '" . $data['zone'] . "'";
					$tzone=Yii::$app->db->createCommand('SELECT * FROM public."a_zone" where id='.$data['zone'].' ')->queryOne();
					$tag .='<span class="badge badge-phoenix fs--2 badge-phoenix-success d-inline-flex align-items-center ms-2">
					<span class="badge-label d-inline-block lh-base">'.($tzone['Name']??"na").'</span></span>';
                }
                if (isset($data['unit']) && !empty($data['unit'])) {
                    $where1 .= " AND unit_id = '" . $data['unit'] . "'";
					$where .= " AND unit = '" . $data['unit'] . "'";
					$tunit=Yii::$app->db->createCommand('SELECT * FROM public."u_unit" where "ID"='.$data['unit'].' ')->queryOne();
					$tag .='<span class="badge badge-phoenix fs--2 badge-phoenix-success d-inline-flex align-items-center ms-2">
					<span class="badge-label d-inline-block lh-base">'.($tunit['name']??"na").'</span></span>';
					
                }
				if (isset($data['route']) && !empty($data['route'])) {
                    $where1 .= " AND amp_sub.route_id = '" . $data['route'] . "'";
					$where .= " AND route_id = '" . $data['route'] . "'";
					$troute=Yii::$app->db->createCommand('SELECT * FROM public."a_route" where id='.$data['route'].' ')->queryOne();
					$tag .='<span class="badge badge-phoenix fs--2 badge-phoenix-success d-inline-flex align-items-center ms-2">
					<span class="badge-label d-inline-block lh-base">'.($troute['name']??"na").'</span></span>';
					
                }
                
               
            }
        }
		$req=0;
		$up=0;
		$ua=0;
		$inpro=0;
		$compl=0;
		
						//print_r($data['year']);exit;		
        ?>
		
			   <div class="row">
			   <div class="col-12 col-xl-5 col-xxl-4">
		<h4 class="text-1100 text-nowrap">Overall Asset Status</h4>
		<hr class="bg-200">
                   <div class="echart-pie-label-align-chart-example" style="min-height:320px"></div>   
                  </div>
        <div class="col-12 col-xl-7 col-xxl-8">
		<h4 class="text-1100 text-nowrap">Province wise Asset status</h4><hr class="bg-200">
            <div id=""
                data-list="">
                <div class="table-responsive">
                    <table id="" class="table table-striped table-hover table-sm fs--1 mb-0 simlee">
                        <thead>
                            <tr style="background-color:#a7a7a7;">
                                
                                <th class="sort border-top">Province</th>
                                <th class="sort border-top">Total KM</th>
                                <th class="sort border-top">Operational</th>
								<th class="sort border-top">Under Maintenance</th>
								<th class="sort border-top">Under Construction</th>
								<th class="sort border-top">Planned</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php $asset_Q = 'SELECT * FROM public."a_zone" ';

        $zone = Yii::$app->db->createCommand($asset_Q)->queryAll();

        // Fetch data for dropdowns
        $provinces = Yii::$app->db->createCommand('SELECT * FROM public."a_province"')->queryAll();
        
							$total=0;
							$ope=0;
							$um=0;
							$uc=0;
							$pl=0;
                            foreach ($provinces as $item):
                                //$status = ($item['status'] == 1) ? "Active" : (($item['status'] == 0) ? "Disabled" : "N/A");
//echo 'SELECT * FROM public."n_asset" where "Route_id"='.$item['id'].' order by id ASC';exit;
//echo 'SELECT sum(cost) as cost FROM public."amp_sub" left join amp_main on (amp_sub."AMP_id"=amp_main.id)	where year='.$item['id'].$where1.' ';exit;
								$amp=Yii::$app->db->createCommand('SELECT count(*) as count FROM public."n_asset"
								
								where province_id='.$item['ID'])->queryOne();
								
								$total=$total+$amp['count'];
							$ope=$ope+$amp['count'];
							$um=$um;
							$uc=$uc;
							$pl=$pl;
								?>
                                <tr>
                                   
                                    <td><b><a href="index.php?r=budgeting/amp_details&referance=<?php echo $link['id']??"0"?>"><?= $item['name'] ?></a></b></td>
                                    <td style="color:green"><?= number_format(($amp['count'])??"0"); ?></td>
									<td style="color:black"><?= number_format($amp['count']??"0"); ?></td>
									<td style="color:black"><?= number_format(0) ?></td>
									<td style="color:green"><?= number_format(0); ?></td>
									<td style="color:red"><?= number_format(0); ?></td>
                                </tr>
                            <?php endforeach; ?>
							<tr>
                                    <td  class="center">Total</td>
                                    <td><b><?= number_format($total) ?></b></td>
									<td><b><?= number_format($ope)	 ?></b></td>
									<td><b><?= number_format($um)	 ?></b></td>
									
									<td><b><?= number_format($uc) ?></b></td>
									<td><b><?= number_format($pl) ?></b></td>
                                    
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
		
				  
	</div>
		
<script src="assets/js/echarts-example.js"></script> 
<script>(function (factory) {
  typeof define === 'function' && define.amd ? define(factory) :
  factory();
})((function () { 'use strict';

  // import * as echarts from 'echarts';
  const { merge } = window._;

  // form config.js
  const echartSetOption = (
    chart,
    userOptions,
    getDefaultOptions,
    responsiveOptions
  ) => {
    const { breakpoints, resize } = window.phoenix.utils;
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
      ({ detail: { control } }) => {
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
        const { hash } = el;
        const id = hash || el.dataset.bsTarget;
        const content = document.getElementById(id.substring(1));
        const chart = content?.querySelector('[data-echart-tab]');
        if (chart) {
          window.echarts.init(chart).resize();
        }
      });
    });
  }

    const pieLabelAlignChartInit = () => {
    const { getColor, getData, rgbaColor } = window.phoenix.utils;
    const $chartEl = document.querySelector(
      '.echart-pie-label-align-chart-example'
    );

    const data = [
      {
        value: <?php echo $ope;?>,
        name: 'Operational',
        itemStyle: {
          color: rgbaColor(getColor('info'), 0.5)
        }
      },
	  
	  
	  {
        value: <?php echo $um?>,
        name: 'Under Maintenance',
        itemStyle: {
          color: rgbaColor(getColor('danger'), 0.5)
        }
      },
	  {
        value: <?php echo $uc?>,
        name: 'Under Construction',
        itemStyle: {
          color: rgbaColor(getColor('danger'), 0.5)
        }
      },
	  {
        value: <?php echo $pl?>,
        name: 'Planned',
        itemStyle: {
          color: rgbaColor(getColor('success'), 0.5)
        }
      },
	  

     ];

    if ($chartEl) {
      const userOptions = getData($chartEl, 'echarts');
      const chart = window.echarts.init($chartEl);
      const getDefaultOptions = () => ({
        title: [
          {
            text: 'Asset Status',
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
          textStyle: { color: getColor('dark') },
          borderWidth: 1,
          transitionDuration: 0,
          axisPointer: {
            type: 'none'
          },
          position(pos, ...size) {
            if (window.innerWidth <= 540) {
              const tooltipHeight = size[1].offsetHeight;
              const obj = { top: pos[1] - tooltipHeight - 20 };
              obj[pos[0] < size[3].viewSize[0] / 2 ? 'left' : 'right'] = 5;
              return obj;
            }
            return null;
          }
        },

        series: [
          {
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
          }
        ]
      });

      const responsiveOptions = {
        xs: {
          series: [
            {
              radius: '45%'
            }
          ]
        },
        sm: {
          series: [
            {
              radius: '60%'
            }
          ]
        }
      };

      echartSetOption(chart, userOptions, getDefaultOptions, responsiveOptions);
    }
  };


  const { docReady } = window.phoenix.utils;

 
  docReady(pieLabelAlignChartInit);
 

}));
//# sourceMappingURL=echarts-example.js.map
</Script>