<div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-white">
    <div class="row">
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
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Assets Executive Summary</span>
                    <span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
                <p class="mb-0">Asset Status</p><hr class="bg-200">
				
            </div>

           
        </div>
		<style>
		
	.settings-panel {
  max-width: 14.62rem;
  width: 100% !important;
}
		</style>
  <form method="POST" id="ajaxform">
 <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>">
 <div class="offcanvas offcanvas-end settings-panel border-0" id="settings-offcanvas" tabindex="-1" aria-labelledby="settings-offcanvas">
      <div class="offcanvas-header align-items-start border-bottom flex-column">
        <div class="">
          <div>
            <h5 class="mb-2 me-2 lh-sm"><span class="fas fa-palette me-2 fs-0"></span>Search</h5>
          </div>
        </div>
      </div>
      <div class="offcanvas-body scrollbar px-card" id="themeController">
	   <div class="col-12 col-md-12" id="custom">
       <label for="organizerSingle2">AMP Year</label>
		<select class="form-select" id="organizerMultiple" data-choices="data-choices" multiple="multiple"  name="year[]">
<option >Please Select</option>
<?php 
$amp_year = Yii::$app->db->createCommand('SELECT * FROM public."amp_year"')->queryAll();
        foreach ($amp_year as $value) {
            //$selected = ($value == $submittedValue) ? 'selected' : '';
            echo '<option value="' . $value['id'] . '">' . $value['year'] . '</option>';
        }
?>
</select>
</div>
<div class="col-12 col-md-12" >
       <label for="organizerSingle2">Zone</label>
		<select class="form-select form-select-sm" aria-label=".form-select-sm example" onclick="select_region(this.id)" id="zone"  name="zone">
<option value="">Please Zone</option>
<?php 
$amp_year = Yii::$app->db->createCommand('SELECT * FROM public."a_zone"')->queryAll();
        foreach ($amp_year as $value) {
            //$selected = ($value == $submittedValue) ? 'selected' : '';
            echo '<option value="' . $value['id'] . '">' . $value['Name'] . '</option>';
        }
?>
</select>
</div>
<div class="col-12 col-md-12" >
       <label for="organizerSingle2">Region</label>
		<select id="region" class="form-select form-select-sm" aria-label=".form-select-sm example" onclick="select_unit(this.id)" name="region">
<option value="">Please Region</option>

</select>
</div>
<div class="col-12 col-md-12" >
       <label for="organizerSingle2">Unit</label>
		<select id="unit" class="form-select form-select-sm" aria-label=".form-select-sm example"  name="unit">
<option value="">Please Unit</option>

</select>
</div>
<div class="col-12 col-md-12" id="custom">
       <label for="organizerSingle2">Route</label>
		<select class="form-select form-select-sm" aria-label=".form-select-sm example"  name="route">
<option value="">Please Select</option>
<?php 
$amp_year = Yii::$app->db->createCommand('SELECT * FROM public."a_route"')->queryAll();
        foreach ($amp_year as $value) {
            //$selected = ($value == $submittedValue) ? 'selected' : '';
            echo '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
        }
?>
</select>
</div>
		<input  name="apply_search" class="btn btn-outline-primary" style="margin-top: 24px;" value="Search" onclick="searchform()" >
	   </div>
    </div><a class="card setting-toggle" href="#settings-offcanvas" data-bs-toggle="offcanvas">
      <div class="card-body d-flex align-items-center px-2 py-1">
        <div class="position-relative rounded-start" style="height:34px;width:28px">
          <div class="settings-popover"><span class="ripple"><span class="fa-spin position-absolute all-0 d-flex flex-center"><span class="icon-spin position-absolute all-0 d-flex flex-center">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="#ffffff" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.7369 12.3941L19.1989 12.1065C18.4459 11.7041 18.0843 10.8487 18.0843 9.99495C18.0843 9.14118 18.4459 8.28582 19.1989 7.88336L19.7369 7.59581C19.9474 7.47484 20.0316 7.23291 19.9474 7.03131C19.4842 5.57973 18.6843 4.28943 17.6738 3.20075C17.5053 3.03946 17.2527 2.99914 17.0422 3.12011L16.393 3.46714C15.6883 3.84379 14.8377 3.74529 14.1476 3.3427C14.0988 3.31422 14.0496 3.28621 14.0002 3.25868C13.2568 2.84453 12.7055 2.10629 12.7055 1.25525V0.70081C12.7055 0.499202 12.5371 0.297594 12.2845 0.257272C10.7266 -0.105622 9.16879 -0.0653007 7.69516 0.257272C7.44254 0.297594 7.31623 0.499202 7.31623 0.70081V1.23474C7.31623 2.09575 6.74999 2.8362 5.99824 3.25599C5.95774 3.27861 5.91747 3.30159 5.87744 3.32493C5.15643 3.74527 4.26453 3.85902 3.53534 3.45302L2.93743 3.12011C2.72691 2.99914 2.47429 3.03946 2.30587 3.20075C1.29538 4.28943 0.495411 5.57973 0.0322686 7.03131C-0.051939 7.23291 0.0322686 7.47484 0.242788 7.59581L0.784376 7.8853C1.54166 8.29007 1.92694 9.13627 1.92694 9.99495C1.92694 10.8536 1.54166 11.6998 0.784375 12.1046L0.242788 12.3941C0.0322686 12.515 -0.051939 12.757 0.0322686 12.9586C0.495411 14.4102 1.29538 15.7005 2.30587 16.7891C2.47429 16.9504 2.72691 16.9907 2.93743 16.8698L3.58669 16.5227C4.29133 16.1461 5.14131 16.2457 5.8331 16.6455C5.88713 16.6767 5.94159 16.7074 5.99648 16.7375C6.75162 17.1511 7.31623 17.8941 7.31623 18.7552V19.2891C7.31623 19.4425 7.41373 19.5959 7.55309 19.696C7.64066 19.7589 7.74815 19.7843 7.85406 19.8046C9.35884 20.0925 10.8609 20.0456 12.2845 19.7729C12.5371 19.6923 12.7055 19.4907 12.7055 19.2891V18.7346C12.7055 17.8836 13.2568 17.1454 14.0002 16.7312C14.0496 16.7037 14.0988 16.6757 14.1476 16.6472C14.8377 16.2446 15.6883 16.1461 16.393 16.5227L17.0422 16.8698C17.2527 16.9907 17.5053 16.9504 17.6738 16.7891C18.7264 15.7005 19.4842 14.4102 19.9895 12.9586C20.0316 12.757 19.9474 12.515 19.7369 12.3941ZM10.0109 13.2005C8.1162 13.2005 6.64257 11.7893 6.64257 9.97478C6.64257 8.20063 8.1162 6.74905 10.0109 6.74905C11.8634 6.74905 13.3792 8.20063 13.3792 9.97478C13.3792 11.7893 11.8634 13.2005 10.0109 13.2005Z" fill="#2A7BE4"></path>
                  </svg></span></span></span></div>
        </div><small class="text-uppercase text-700 fw-bold py-2 pe-2 ps-1 rounded-end">Search</small>
      </div>
    </a>
        </form>
	<div id="error-div"></div>	
</div>

 
            </div>
 
	<script>
	 <?php $address = $_SERVER['HTTP_HOST'] . Yii::$app->request->baseUrl;?>
	
function searchform(){    
    $.ajax({
            type: "POST",
            url: "http://<?php echo $address; ?>/index.php?r=site/assetpart",
            contenetType: "json",
            data: $("#ajaxform").serialize(),
            success: function(response) {

                $('#error-div').html(response);
            }
        });
} 
	function select_region(id){
        $.ajax({
            type: "POST",
            url: "http://<?php echo $address; ?>/index.php?r=site/region&id=" + document.getElementById("zone").value,
            contenetType: "json",
            
             contenetType: "json",
            success: function(jsonList) {
                var json = $.parseJSON(jsonList);
                var listItems = '<option value="">Select Region</option>';
                $(json).each(function(i, val) {
                    listItems += "<option value='" + val.ID + "'>" + val.name + "</option>";
                });
                listItems += "";
                $("#region").html(listItems);
            }
        });
    }
	function select_unit(id){
        $.ajax({
            type: "POST",
            url: "http://<?php echo $address; ?>/index.php?r=site/unit&id=" + document.getElementById("region").value,
            contenetType: "json",
            
             contenetType: "json",
            success: function(jsonList) {
                var json = $.parseJSON(jsonList);
                var listItems = '<option value="">Select unit</option>';
                $(json).each(function(i, val) {
                    listItems += "<option value='" + val.ID + "'>" + val.name + "</option>";
                });
                listItems += "";
                $("#unit").html(listItems);
            }
        });
    }
	
	window.onload = function() {
  searchform();
};

	</script>



