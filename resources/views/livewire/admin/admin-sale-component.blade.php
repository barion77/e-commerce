<div>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Sale Setting
                </div>
                <div class="panel-body">
                    @if (Session::has('message_success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message_success') }}
                        </div>
                    @endif
                    <form class="form-horizontal" wire:submit.prevent="update_sale()">
                        <div class="form-group">
                            <label class="col-md-4">Status</label>
                            <div class="col-md-4">
                                <select class="from-control" wire:model="status">
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4">Sale Date</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="YYYY/MM/DD H:M:S" class="form-control input-md" id="sale-date" wire:model="sale_date">
                            </div> 
                        </div>
                        <div class="form-group">
                            <label class="col-md-4"></label>
                            <div class="col-md-4">
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function() {
            $("#sale-date").datetimepicker({
                locale: 'ru',
                format: 'Y-MM-DD h:m:s'
            }).on('dp.change', function(ev) {
                var data = $('#sale-date').val();
                @this.set('sale_date', data);
            });
        });
    </script>
@endpush