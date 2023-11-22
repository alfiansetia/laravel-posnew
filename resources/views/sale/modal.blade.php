<div class="modal fade" id="modal_product" tabindex="-1" aria-labelledby="modal_productLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_productLabel">
                    Product Active
                    <button id="btn_modal_refresh" class="btn btn-sm btn-info ml-1"><i class="fas fa-sync"></i></button>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <select class="form-control form-control-lg mb-2" name="category_product" id="category_product"
                            style="width: 100%">
                            <option value="">Select Category</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-block btn-primary" id="btn_reset_filter">
                            <i class="fas fa-sync mr-1"></i>Reset Filter
                        </button>
                    </div>
                </div>
                <table id="table_product" class="table table-sm table-hover mt-2" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 30px;">#</th>
                            <th>Code [SKU]</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Disc</th>
                            <th>Stock</th>
                            <th>Desc</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
