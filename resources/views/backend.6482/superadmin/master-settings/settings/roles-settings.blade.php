<!------------------- SITE NAME ------------------------------------------->
<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4">
        
                <div class="table-responsive">
                    <table class="table table-bordered tableDark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @php($i = 1 )
                            @foreach($roles as $rolwlist)
                            <tr>
                                <td>
                                    {{$i}}
                                </td>
                                <td>{{$rolwlist->name}}</td>
                                <td>
                                    @if($rolwlist->status == '1')
                                        <span class="badge bg-success rounded-pill">Enabled</span>
                                    @else
                                        <span class="badge bg-danger rounded-pill">Disabled</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-button">
                                        @can('role-edit')
                                            @php($id = encrypt($rolwlist->id))
                                            <a href="{{ route('roles.edit',$id)}}"><i class="glyphicon glyphicon-edit text-primary"></i></a>
                                        @endcan
                                        @can('role-delete')
                                            @php($id = encrypt($rolwlist->id))
                                            <a onclick="if(confirm('Are you sure you want to permenent delete?')){ event.preventDefault();
                                            document.getElementById('role-delete-{{$id}}').submit(); }else{}" href="#"><i class="glyphicon glyphicon-trash text-danger"></i></a>
                                            <form id="role-delete-{{$id}}" action="{{ route('roles.destroy',$id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @php($i++)
                            @endforeach
                        </tbody>
                    </table>
                </div>
            
    </div>

    <div class="col-xl-8 col-lg-8 col-md-8">
        
       
        <div class="darkBox p-4 pb-2">

                    <form action="{{ route('admin.addUserRole') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-xl-6 col-md-6">
                                <div class="form-group pb-3">
                                    <div class="d-flex justify-content-between mb-2" >
                                        <label for="forl-label">Roll Name <span class="text-danger">(*)</span></label>               
                                    </div>
                                    
                                        <input required="required" id="name" name="name" type="text"
                                            class="form-control round-input " placeholder="Enter a rolename.."  />
    
                                            <div class="invalid-feedback">
                                                Please Enter a rolename.
                                            </div>
                                </div>
                            </div>
    
                            <div class="col-lg-6 col-xl-6 col-md-6">
                                <div class="form-group pb-3">
                                    <div class="d-flex justify-content-between mb-2" >
                                        <label for="forl-label">Status <span class="text-danger">(*)</span></label>               
                                    </div>
                                    
                                    <select class="form-control round-input" name="role_status"  required>
                                        <option value="">-Select status -</option>
                                        <option value="1">Enabled</option>
                                        <option value="0">Disabled</option>
                                    </select>
    
                                    <div class="invalid-feedback">
                                        Please choose status
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="col-lg-12 col-xl-12 col-md-12">
                            <div class="form-group pb-3">
                                <div class="d-flex justify-content-between mb-2" >
                                    <label for="forl-label">Set Permission <span class="text-danger">(*)</span></label>               
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered tableDark">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Module Name</th>
                                                <th>View</th>
                                                <th>List</th>
                                                <th>Create</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($i=1)
                                            @foreach($permission as $value)
                                            @php($check_view = DB::table('permissions')->where('name','=',strtolower($value->module_name).'-view')->where('module_name','=',$value->module_name)->get())
                                            @php($check_list = DB::table('permissions')->where('name','=',strtolower($value->module_name).'-list')->where('module_name','=',$value->module_name)->get())
                                            @php($check_create = DB::table('permissions')->where('name','=',strtolower($value->module_name).'-create')->where('module_name','=',$value->module_name)->get())
                                            @php($check_edit = DB::table('permissions')->where('name','=',strtolower($value->module_name).'-edit')->where('module_name','=',$value->module_name)->get())
                                            @php($check_delete = DB::table('permissions')->where('name','=',strtolower($value->module_name).'-delete')->where('module_name','=',$value->module_name)->get())
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$value->module_name}}</td>
                                                <td>
                                                    @if(isset($check_view[0]))
                                                        <div class="form-check custom-checkbox mb-3">
                                                            <input type="checkbox" name="permission[]" class="form-check-input" id="customCheckBox1" value="{{$check_view[0]->id}}">
                                                            <label class="form-check-label" for="customCheckBox1">{{ucwords(str_replace('-',' ',$check_view[0]->name)) }}</label>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($check_list[0]))
                                                        <div class="form-check custom-checkbox mb-3">
                                                            <input type="checkbox" name="permission[]" class="form-check-input" id="customCheckBox1" value="{{$check_list[0]->id}}">
                                                            <label class="form-check-label" for="customCheckBox1">{{ucwords(str_replace('-',' ',$check_list[0]->name)) }}</label>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($check_create[0]))
                                                        <div class="form-check custom-checkbox mb-3">
                                                            <input type="checkbox" name="permission[]" class="form-check-input" id="customCheckBox1" value="{{$check_create[0]->id}}">
                                                            <label class="form-check-label" for="customCheckBox1">{{ucwords(str_replace('-',' ',$check_create[0]->name)) }}</label>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($check_edit[0]))
                                                        <div class="form-check custom-checkbox mb-3">
                                                            <input type="checkbox" name="permission[]" class="form-check-input" id="customCheckBox1" value="{{$check_edit[0]->id}}">
                                                            <label class="form-check-label" for="customCheckBox1">{{ucwords(str_replace('-',' ',$check_edit[0]->name)) }}</label>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($check_delete[0]))
                                                        <div class="form-check custom-checkbox mb-3">
                                                            <input type="checkbox" name="permission[]" class="form-check-input" id="customCheckBox1" value="{{$check_delete[0]->id}}">
                                                            <label class="form-check-label" for="customCheckBox1">{{ucwords(str_replace('-',' ',$check_delete[0]->name)) }}</label>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php($i++)
                                            @endforeach
                                        </tbody>
                                    </table>

                                
                            </div>
                        </div>

                     
                        
                        
                        <button type="submit" class="btn me-2 btn-primary" style="float:right;">Submit</button>
                        <button type="reset" class="btn btn-danger light" style="float:left;">Cancel</button>
                    </form>
                
            
        </div>

    </div>

    
</div>

</div>
<!---------------------------- SITE NAME ------------------------------------------->




