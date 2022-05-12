<div class="modal fade" id="edtModal" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
            <h5>Edit Investor</h5>
            <form action="<?= base_url('dashboard/Investors/Update_investor'); ?>" method="post">
                <div class="form-group">
                    <label>Investor Name</label>
                    <input type="text" name="investor_name" id="investor_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile" id="mobile" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" id="ids">
                    <button class="btn_new btn_new_block">Save</button>
                </div>
            </form>
        </div>
      </div>
    </div>
 </div>