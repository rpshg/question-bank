    <!-- modal to restore entity -->
        
    <div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Restore</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure want to <span id="restore-confirm"></span>?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                
                    <form id="restore-entity-form" method="POST">
                        @csrf
                        <button class="btn btn-success" type="submit">Restore</button>
                    </form>
                    
                </div>
            </div>
        </div>
        
    </div>
        