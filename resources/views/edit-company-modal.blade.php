<div class="modal fade editCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <form action="<?= route('update.company.details') ?>" method="post" id="update-company-form">
                    @csrf
                     <input type="hidden" name="cid">
                     <div class="form-group">
                        <label for="">Trading Name</label>
                        <input type="text" class="form-control" name="trading_name" placeholder="Enter Trading name">
                        <span class="text-danger error-text trading_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Company Name</label>
                        <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name">
                        <span class="text-danger error-text company_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">ABN</label>
                        <input type="text" class="form-control" name="abn" placeholder="Enter ABN">
                        <span class="text-danger error-text abn_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea class="form-control" name="address" placeholder="Enter address"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email">
                        <span class="text-danger error-text email_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="phone" class="form-control" name="phone" placeholder="Enter Phone #">
                        <span class="text-danger error-text phone_error"></span>
                    </div>
                     <div class="form-group">
                         <button type="submit" class="btn btn-block btn-success">Save Changes</button>
                     </div>
                 </form>
                

            </div>
        </div>
    </div>
</div>