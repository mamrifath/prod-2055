<div class="modal fade editCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <form action="<?= route('update.item.details') ?>" method="post" id="update-company-form">
                    @csrf
                     <input type="hidden" name="id">
                     <div class="form-group ">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Item name">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="text" class="form-control" name="qty" placeholder="Enter Quantity">
                        <span class="text-danger error-text qty_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Brand</label>
                        <input type="text" class="form-control" name="brand" placeholder="Enter Brand">
                        <span class="text-danger error-text brand_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Buying Price</label>
                        <input type="text" class="form-control" name="buying_price" placeholder="Enter Buying Price">
                        <span class="text-danger error-text buying_price_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Profit Price</label>
                        <input type="text" class="form-control" name="profit_margin" placeholder="Enter Profit Margin">
                        <span class="text-danger error-text profit_margin_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Selling Price</label>
                        <input type="text" class="form-control" name="selling_price" placeholder="Enter Selling Price">
                        <span class="text-danger error-text selling_price_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Warranty</label>
                        <input type="text" class="form-control" name="warranty" placeholder="Enter Warranty">
                        <span class="text-danger error-text warranty_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Expiry Date</label>
                        <input type="text" class="form-control" name="expiry_date" placeholder="Enter Expiry Date">
                        <span class="text-danger error-text expiry_date_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">In Active</option>
                        </select>
                    </div>
                     <div class="form-group">
                         <button type="submit" class="btn btn-block btn-success">Save Changes</button>
                     </div>
                 </form>
                

            </div>
        </div>
    </div>
</div>