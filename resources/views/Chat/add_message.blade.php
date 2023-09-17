<div class="modal fade" id="addNewMessageModal" tabindex="-1" aria-labelledby="addNewMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="addChatForm">
            @csrf
        <div class="modal-body">
          <div class="form-group mb-3">
                <label for="message" class="col-3">To</label>
                <select name="msg_to">
                    @foreach ($users as $user )
                        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                    @endforeach
                </select>
          </div>
          <div class="form-group mb-3">
                <label for="message">Message</label>
                <input type="text" class="form-control" name="message" id="message" placeholder="Enter message">
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
