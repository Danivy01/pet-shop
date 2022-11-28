<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Product&nbsp;<a href="#" data-toggle="modal" data-target="#productModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="productTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">Product Code</th>
                        <th class="text-center">Product Name</th>
                        <th class="text-center">Product Description</th>
                        <th class="text-center">Quantity On Stock</th>
                        <th class="text-center">Quantity On Hand</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Supplier Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $productTable; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>