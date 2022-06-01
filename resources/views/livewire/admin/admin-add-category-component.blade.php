<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add New Category
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.categories') }}" class="btn btn-success pull-right">All Category</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message_success'))
                            <div class="alert alert-success">
                                {{ Session::get('message_success') }}
                            </div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent="store_category()">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="">Category Name</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Categor Name" class="form-control input-md" wire:model="name" wire:keyup="generate_slug()">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="">Category Slug</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Categor Slug" class="form-control input-md" wire:model="slug">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for=""></label>
                                <div class="col-md-4">
                                    <input type="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
