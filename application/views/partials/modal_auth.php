<!-- ==================== MODAL LOGIN ==================== -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Login</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('auth/login'); ?>" method="post">
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your email">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter your password">
          </div>
          <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Login as User</button>
            <button type="submit" class="btn btn-primary">Login as Agent</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ==================== MODAL REGISTER USER ==================== -->
<div class="modal fade" id="registerUserModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Register as User</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('auth/registerUser'); ?>" method="post">
          <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="fullname" class="form-control">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name="phone" class="form-control">
          </div>
          <div class="form-group">
            <label>Address</label>
            <textarea name="address" class="form-control"></textarea>
          </div>
          <button type="submit" class="btn btn-success btn-block">Create User Account</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ==================== MODAL REGISTER AGENT ==================== -->
<div class="modal fade" id="registerAgentModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Register as Agent</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('auth/registerAgent'); ?>" method="post">
          <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="fullname" class="form-control">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name="phone" class="form-control">
          </div>
          <div class="form-group">
            <label>Agent Type</label>
            <select name="agent_type" class="form-control">
              <option value="Plastic">Plastic</option>
              <option value="Organic">Organic</option>
              <option value="Mixed">Mixed</option>
            </select>
          </div>
          <div class="form-group">
            <label>Service Area</label>
            <input type="text" name="service_area" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Create Agent Account</button>
        </form>
      </div>
    </div>
  </div>
</div>
