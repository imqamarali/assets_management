<style>
    .dropdown-toggle {
        border: 0;
        background: #fff;
    }

    h4 {
        float: left;
    }
</style>


<div class="row">
    <div class="col_12">
        <div class="d-flex" id="scrollspyEcommerce"><span class="fa-stack me-2 ms-n1"><svg
                    class="svg-inline--fa fa-circle fa-stack-2x text-primary" aria-hidden="true" focusable="false"
                    data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512" data-fa-i2svg="">
                    <path fill="currentColor"
                        d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z">
                    </path>
                </svg><!-- <i class="fas fa-circle fa-stack-2x text-primary"></i> Font Awesome fontawesome.com --><svg
                    class="svg-inline--fa fa-cart-plus fa-inverse fa-stack-1x text-primary-soft"
                    data-fa-transform="shrink-4" aria-hidden="true" focusable="false" data-prefix="fas"
                    data-icon="cart-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                    data-fa-i2svg="" style="transform-origin: 0.5625em 0.5em;">
                    <g transform="translate(288 256)">
                        <g transform="translate(0, 0)  scale(0.75, 0.75)  rotate(0 0 0)">
                            <path fill="currentColor"
                                d="M96 0C107.5 0 117.4 8.19 119.6 19.51L121.1 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H170.7L179.9 336H488C501.3 336 512 346.7 512 360C512 373.3 501.3 384 488 384H159.1C148.5 384 138.6 375.8 136.4 364.5L76.14 48H24C10.75 48 0 37.25 0 24C0 10.75 10.75 0 24 0H96zM272 180H316V224C316 235 324.1 244 336 244C347 244 356 235 356 224V180H400C411 180 420 171 420 160C420 148.1 411 140 400 140H356V96C356 84.95 347 76 336 76C324.1 76 316 84.95 316 96V140H272C260.1 140 252 148.1 252 160C252 171 260.1 180 272 180zM128 464C128 437.5 149.5 416 176 416C202.5 416 224 437.5 224 464C224 490.5 202.5 512 176 512C149.5 512 128 490.5 128 464zM512 464C512 490.5 490.5 512 464 512C437.5 512 416 490.5 416 464C416 437.5 437.5 416 464 416C490.5 416 512 437.5 512 464z"
                                transform="translate(-288 -256)"></path>
                        </g>
                    </g>
                </svg>
                <!-- <i class="fa-inverse fa-stack-1x text-primary-soft fas fa-cart-plus" data-fa-transform="shrink-4"></i> Font Awesome fontawesome.com --></span>
            <div class="col">
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Details</span><span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
            </div>

            <div
                style="float: right;font-size: 15px !important;font-weight: bold;padding: 4px;border-bottom: 1px solid green;margin-top: -29px;height: 26px;">
                Import Batch:
                <a href="#">
                    <i class="ace-icon fa fa-circle light-green"></i> &nbsp;
                    <span class="red">
                        <b><?= $condition_data['batch_name'] ?></b></span>
                </a>
            </div>
            <div
                style="float: right;font-size: 15px !important;font-weight: bold;padding: 4px;border-bottom: 1px solid green;margin-top: -29px;height: 26px;">
                &nbsp;|&nbsp;&nbsp;Date
                <a href="#">
                    <i class="ace-icon fa fa-circle light-green"></i> &nbsp;
                    <span class="red">
                        <b><?= $condition_data['date'] ?></b></span>
                </a>
            </div>
        </div>

        <hr class="bg-200">
        <div class="row" style="margin: 0px -40px;">
            <div class="table-responsive">
                <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 8px;">
                    <thead style="border: 1px solid #a9a9a954;">
                        <tr style="text-align: center; background-color: #f2f2f2;">
                            <th colspan="33" style="border: 1px solid #a9a9a954; padding: 5px; font-size: medium;">
                                <span id="toggleArrow" style="cursor: pointer; margin-right: 10px;"
                                    onclick="toggleTable()">
                                    <i class="fa fa-eye"></i> PAVEMENT CONDITION SURVEY
                                </span>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="table-responsive" id="table1">
                <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 8px;">
                    <thead style="border: 1px solid #a9a9a954;">
                        <tr style="text-align: center; background-color: #f2f2f2;">
                            <th rowspan="2" style="border: 1px solid #a9a9a954; padding: 5px;">Route</th>
                            <th rowspan="2" style="border: 1px solid #a9a9a954; padding: 5px;">Direction</th>
                            <th rowspan="2" style="border: 1px solid #a9a9a954; padding: 5px;">Km.</th>
                            <th rowspan="2" style="border: 1px solid #a9a9a954; padding: 5px;">Surface</th>
                            <th rowspan="2" style="border: 1px solid #a9a9a954; padding: 5px;">Road Width (m)</th>
                            <th colspan="2" style="border: 1px solid #a9a9a954; padding: 5px;">Shoulder Width(m)</th>
                            <th colspan="3" style="border: 1px solid #a9a9a954; padding: 5px;">Rutting</th>
                            <th colspan="3" style="border: 1px solid #a9a9a954; padding: 5px;">Cracking (Structural)
                            </th>
                            <th colspan="3" style="border: 1px solid #a9a9a954; padding: 5px;">Cracking (Thermal)</th>
                            <th colspan="3" style="border: 1px solid #a9a9a954; padding: 5px;">Potholes</th>
                            <th colspan="3" style="border: 1px solid #a9a9a954; padding: 5px;">Patching</th>
                            <th colspan="3" style="border: 1px solid #a9a9a954; padding: 5px;">Ravelling</th>
                            <th colspan="3" style="border: 1px solid #a9a9a954; padding: 5px;">Edge Erosion</th>
                            <th colspan="3" style="border: 1px solid #a9a9a954; padding: 5px;">Drainage</th>
                            <th rowspan="2" style="border: 1px solid #a9a9a954; padding: 5px;">Remarks</th>
                            <th rowspan="2" style="border: 1px solid #a9a9a954; padding: 5px;">Date</th>
                        </tr>
                        <tr style="text-align: center; background-color: #f2f2f2;">
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">LEFT</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">RIGHT</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Severity</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Extent</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Index</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Severity</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Extent</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Index</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Severity</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Extent</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Index</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Severity</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Extent</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Index</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Severity</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Extent</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Index</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Severity</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Extent</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Index</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Severity</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Extent</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Index</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Severity</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Extent</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Index</th>
                        </tr>
                        <tr style="text-align: center; font-size: 8px; background-color: #f2f2f2;">
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">route</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">dir</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">km.</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">stype</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">rd-w</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">sh-lw</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">sh-rw</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">rut-s</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">rut-e</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">ri</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">crack-s</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">crack-e</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">ci</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">crack-ts</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">crack-te</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">ci</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">pot-s</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">pot-e</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">pi</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Patch-s</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Patch-e</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">pti</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">rv-s</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">rv-e</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">rvi</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">ee-s</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">ee-e</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">eei</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">d-s</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">d-e</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">di</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">rem</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($condition_data['pavement_condition_survey'] as $survey): ?>
                            <tr style="text-align: center; font-size: 8px;">
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['route']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['direction']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['km']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['surface']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['road_width']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['shoulder_width_left']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['shoulder_width_right']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['rutting_severity']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['rutting_extent']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['rutting_index']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['cracking_structural_severity']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['cracking_structural_extent']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['cracking_structural_index']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['cracking_thermal_severity']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['cracking_thermal_extent']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['cracking_thermal_index']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['potholes_severity']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['potholes_extent']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['potholes_index']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['patching_severity']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['patching_extent']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['patching_index']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['ravelling_severity']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['ravelling_extent']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['ravelling_index']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['edge_erosion_severity']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['edge_erosion_extent']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['edge_erosion_index']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['drainage_severity']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['drainage_extent']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['drainage_index']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['remarks']); ?></td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['date']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
        <div class="row" style="margin: 0px -40px; margin-top:5px;">
            <div class="table-responsive">
                <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 8px;">
                    <thead style="border: 1px solid #a9a9a954;">
                        <tr style="text-align: center; background-color: #f2f2f2;">
                            <th colspan="33" style="border: 1px solid #a9a9a954; padding: 5px; font-size: medium;">
                                <span id="toggleArrow" style="cursor: pointer; margin-right: 10px;"
                                    onclick="toggleTable1()">
                                    <i class="fa fa-eye"></i> ROAD ROUGHNESS SURVEY
                                </span>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="table-responsive" id="table2">
                <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 8px;">
                    <thead style="border: 1px solid #a9a9a954;">
                        <tr style="text-align: center; background-color: #f2f2f2;">
                            <th rowspan="2" style="border: 1px solid #a9a9a954; padding: 5px;">Route</th>
                            <th rowspan="2" style="border: 1px solid #a9a9a954; padding: 5px;">Direction</th>
                            <th rowspan="2" style="border: 1px solid #a9a9a954; padding: 5px;">Km.</th>
                            <th rowspan="2" style="border: 1px solid #a9a9a954; padding: 5px;">Remarks</th>
                            <th rowspan="2" style="border: 1px solid #a9a9a954; padding: 5px;">Date</th>
                            <th colspan="2" style="border: 1px solid #a9a9a954; padding: 5px;">Roughness</th>
                        </tr>
                        <tr style="text-align: center; background-color: #f2f2f2;">
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">m/km </th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Index</th>
                        </tr>
                        <tr style="text-align: center; font-size: 8px; background-color: #f2f2f2;">
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Route</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">dir</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">km.</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">rem</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Date</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">rufmkm </th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">gi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($condition_data['road_roughness_survey'] as $survey): ?>
                            <tr style="text-align: center; font-size: 8px;">
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['route']); ?>
                                </td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['direction']); ?>
                                </td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['km']); ?>
                                </td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['remarks']); ?>
                                </td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['date']); ?>
                                </td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['roughness_m_per_km']); ?>
                                </td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['roughness_index']); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="row" style="margin: 0px -40px; margin-top:5px;">
            <div class="table-responsive">
                <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 8px;">
                    <thead style="border: 1px solid #a9a9a954;">
                        <tr style="text-align: center; background-color: #f2f2f2;">
                            <th colspan="33" style="border: 1px solid #a9a9a954; padding: 5px; font-size: medium;">
                                <span id="toggleArrow" style="cursor: pointer; margin-right: 10px;"
                                    onclick="toggleTable2()">
                                    <i class="fa fa-eye"></i> REMAINING SERVICE LIFE
                                </span>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="table-responsive" id="table3">
                <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 8px;">
                    <thead style="border: 1px solid #a9a9a954;">
                        <tr style="text-align: center; background-color: #f2f2f2;">
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Route</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Direction</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Km.</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Rutting</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Cracking(Structural)</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Cracking (Thermal)</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Ravelling</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Roughness</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">Pavement</th>
                        </tr>
                        <tr style="text-align: center; background-color: #f2f2f2;">
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">route </th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">dir</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">km</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">rslrd</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">rslcds</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">rslcdt</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">rslrv</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">rslgd</th>
                            <th style="border: 1px solid #a9a9a954; padding: 5px;">rslpd</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($condition_data['remaining_service_life'] as $survey): ?>
                            <tr style="text-align: center; font-size: 8px;">
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['route']); ?>
                                </td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['direction']); ?>
                                </td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['km']); ?>
                                </td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['rutting']); ?>
                                </td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['cracking_structural']); ?>
                                </td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['cracking_thermal']); ?></td>
                                </td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['ravelling']); ?>
                                </td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['roughness']); ?>
                                </td>
                                <td style="border: 1px solid #a9a9a954; padding: 5px;">
                                    <?php echo htmlspecialchars($survey['pavement']); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>

<script>
    function toggleTable() {
        var table = document.getElementById("table1");
        var icon = document.getElementById("toggleArrow").getElementsByTagName("i")[0];

        // Toggle table visibility
        if (table.style.display === "none") {
            table.style.display = "block";
            icon.classList.remove("fa-arrow-up");
            icon.classList.add("fa-arrow-down");
        } else {
            table.style.display = "none";
            icon.classList.remove("fa-arrow-down");
            icon.classList.add("fa-arrow-up");
        }
    }

    function toggleTable1() {
        var table = document.getElementById("table2");
        var icon = document.getElementById("toggleArrow").getElementsByTagName("i")[0];

        // Toggle table visibility
        if (table.style.display === "none") {
            table.style.display = "block";
            icon.classList.remove("fa-arrow-up");
            icon.classList.add("fa-arrow-down");
        } else {
            table.style.display = "none";
            icon.classList.remove("fa-arrow-down");
            icon.classList.add("fa-arrow-up");
        }
    }

    function toggleTable2() {
        var table = document.getElementById("table3");
        var icon = document.getElementById("toggleArrow").getElementsByTagName("i")[0];

        // Toggle table visibility
        if (table.style.display === "none") {
            table.style.display = "block";
            icon.classList.remove("fa-arrow-up");
            icon.classList.add("fa-arrow-down");
        } else {
            table.style.display = "none";
            icon.classList.remove("fa-arrow-down");
            icon.classList.add("fa-arrow-up");
        }
    }
</script>