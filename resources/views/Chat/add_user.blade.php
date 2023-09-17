<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="addUserForm">
            @csrf
        <div class="modal-body">
          <div class="form-group mb-3">
                <label for="message">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
          </div>
          <div class="form-group mb-3">
                <label for="message">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
          </div>
          <div class="form-group mb-3">
                <label for="message">Password</label>
                <input type="text" class="form-control" name="password" id="password" placeholder="Enter password">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>
