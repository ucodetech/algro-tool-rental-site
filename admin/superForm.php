<div class="card">
      <div class="card-header card-header-tabs card-header-warning">
        <div class="nav-tabs-navigation">
          <div class="nav-tabs-wrapper">
            <span class="nav-tabs-title">Form:</span>
            <ul class="nav nav-tabs" data-tabs="tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#profile" data-toggle="tab">
                  <i class="material-icons fa fa-user-plus fa-lg"></i> Add Tool
                  <div class="ripple-container"></div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active">
            <hr>
            <form class="form" action="#" method="post" enctype="multipart/form-data" id="addToolform">
              <div class="form-group">
                <label for="tool_name">Tool name: <sup class="text-danger
                  ">*</sup></label>
                  <input type="text" name="tool_name" id="tool_name" class="form-control">
              </div>
              <div class="form-group">
                <label for="tool_price">Tool Price <sup class="text-danger
                  ">*</sup></label>
                  <input type="number" name="tool_price" id="tool_price" class="form-control">
              </div>
              <div class="form-group">
                <label for="tool_type">Tool Type: <sup class="text-danger
                  ">*</sup></label>
                  <select name="tool_type" id="tool_type" class="form-control">
                    <option value="">Select Tool Type</option>
                    <option value="heavy duty">Heavy Duty</option>
                    <option value="light duty">Light Duty</option>
                  </select>
              </div>
             <div class="form-group">
                 <label for="tool_img" class="bmd-label-floating" style="cursor: pointer;"><i class="fa fa-upload fa-lg text-success"></i> Select File</label>
                <input type="file" class="form-control" id="tool_img" name="tool_img" style="display:none;">
             </div>

             
              <div class="form-group">
                <button type="submit" name="save" id="saveBtn" class="btn btn-info btn-block">Upload</button>
                <div class="clear-fix"></div>
                <div id="showError"></div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>