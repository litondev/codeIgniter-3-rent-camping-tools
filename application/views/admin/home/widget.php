<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
          	Total Invoice
          </div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">
            <?php 
              echo $widget["total_invoice"]["total"];
            ?>        
          </div>
        </div>
        <div class="col-auto">
          <i class="fa fa-bill fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
          	Total Product
          </div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">
            <?php 
              echo $widget["total_product"]["total"];
            ?>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-list fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
          	Total Pembayaran
          </div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">
            <?php 
              echo $widget["total_manual_payment"]["total"];
            ?>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-calendar fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
          	Total Nilai Invoice Selesai
          </div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">
            <?php 
              echo money($widget["total_value_invoice"]["total"]);
            ?>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-calendar fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>