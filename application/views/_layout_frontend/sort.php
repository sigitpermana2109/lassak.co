<div class="row" style="background-color: #f6f6f6;">  
    <div class="col col-md-8">
      <div class="dropdown">      
        <!--Trigger-->
        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Urutkan</button>
      
        <!--Menu-->
        <div class="dropdown-menu dropdown-success">
          <a class="dropdown-item" href="<?= base_url('Frontend/Shop/hargaASC'); ?>">Harga Terendah - Harga Tertinggi</a>
          <a class="dropdown-item" href="<?= base_url('Frontend/Shop/hargaDESC'); ?>">Harga Tertinggi - Harga Terendah</a>
        </div>
      </div>
    </div>
    <div class="col col-md-4 my-auto d-flex">
      <div class="float-right">
        <form class="form-inline" action="<?= base_url('Frontend/Shop/search');?>" method="GET">
          <input class="form-control form-control-sm mr-3 w-75" type="text" name="keyword" placeholder="Cari Disini"
          aria-label="Search">
          <i class="fa fa-search" aria-hidden="true"></i>
        </form>
      </div>
    </div> 
</div>