<div class="modal fade" id="showDocs" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <div id="doccs"></div>
        </div>
      </div>
    </div>
 </div>

 <div class="modal fade" id="congr_modal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <h4 id="mdlTxt"></h4>
        </div>
      </div>
    </div>
 </div>
 <div class="modal fade" id="edtCatys" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <form action="<?= base_url('dashboard/Loan_Category/edit_categories'); ?>" method="post">
                <div class="form-group">
                  <label>Category Name</label>
                  <input id="LnType" type="text" name="type_name" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Select Type</label>
                  <select id="LnCat" class="form-control" name="loan_cat" required>
                    <option value="">Select</option>
                    <option value="product_mobile">Product/Mobile</option>
                    <option value="business">Business</option>
                    <option value="personal">Personal</option>
                    <option value="vehical">Vehical</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Down Payment</label>
                  <select id="dnPay" name="down_payment" class="form-control" required>
                    <option value="enable">Enable</option>
                    <option value="disabled">Disable</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="hidden" name="id" id="loanCatId">
                  <button class="btn_new">Save</button>
                </div>
              </form>
        </div>
      </div>
    </div>
 </div>

 