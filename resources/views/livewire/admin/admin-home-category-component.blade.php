<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-heading">
                    <div class="panel-heading">
                        Manage Home Categories
                    </div>
                </div>
                <div class="panel-body">
                    @if (Session::has('message_success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message_success') }}
                        </div>
                    @endif
                    <form class="form-horizontal" wire:submit.prevent="update_home_category()">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Choose Category</label>
                            <div class="col-md-4" wire:ignore>
                                <select class="sel_categories form-control" name="categories[]" multiple="multiple" wire:model="selected_categories">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Number Of Products</label>
                            <div class="col-md-4">
                                <input type="text" class="from-control input-md" wire:model="number_product">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <input type="submit" class="btn btn-success" value="Save">
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
        $(document).ready(function() {
            $('.sel_categories').select2();
            $('.sel_categories').on('change', function(e) {
                var data = $('.sel_categories').select2("val");
                @this.set('selected_categories', data);
            });
        });
    </script>
@endpush