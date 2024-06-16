<div class="d-flex justify-content-between align-items-center mb-4">
    
    <div class="d-flex align-items-center">
        
        <a href="#" class="btn btn-primary menu menu-big" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-backdrop="static" data-bs-keyboard="false">Add MOU Content</a>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New MOU Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('store-mou-settings')}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                            @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group pb-3">
                                    <div class="d-flex justify-content-between mb-2" >
                                        <label for="forl-label">Content Key</label>
                                        <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                                    </div>
                                <input type="text" name="mou_content_key" class="form-control" required="required" placeholder="Enter content key">
                                <div class="invalid-feedback">
                                    Please enter content key
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12" id="add_description">
                                <div class="form-group pb-3">
                                    <div class="d-flex justify-content-between mb-2" >
                                        <label for="forl-label">Content Description(<a href="#" onclick="add_new_description()">Add New</a>)</label>
                                        <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                                    </div>
                                    <textarea name="mou_content_description[]" class="form-control" required="required" placeholder="Enter content description" rows="3"></textarea>
                                    <div class="invalid-feedback">
                                        Please enter content description
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary menu"  style="float:left;">Submit</button>
                    </div>

                </form>
                </div>
                </div>
            </div>
    </div>
</div>
<style>
    .buttonIn { 
        width: 100%; 
        position: relative; 
    } 
      
    
      
    .clearnew { 
        position: absolute; 
        right: 1%; 
        z-index: 2; 
        top: 12%; 
        height: 20%; 
        cursor: pointer; 
        
    } 
</style>


<!---------------------------- SITE Email ------------------------------------------->


<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
        <table class="tabe table-bordered table-hover" id="data_table" style="width:100%">
            <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Key</th>
                    <th>Value</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($mou_settings) && !empty($mou_settings))
                @php($sl=1)
                @foreach($mou_settings as $MouList)
                @php($id = encrypt($MouList->id))
                <tr>
                    <td>{{$sl}}</td>
                    <td>{{$MouList->key}}</td>
                    <td>
                        @php($vv = json_decode($MouList->value))
                        {{$vv[0]}}.....
                    
                    </td>
                    <td>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$sl}}" data-bs-backdrop="static" data-bs-keyboard="false"><i class="glyphicon glyphicon-edit text-primary"></i></a>

                            <div class="modal fade" id="exampleModal_{{$sl}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit MOU Content</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('update-mou-modules')}}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                                            @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group pb-3">
                                                    <div class="d-flex justify-content-between mb-2" >
                                                        <label for="forl-label">Content Key</label>
                                                        <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                                                    </div>
                                                    <input type="hidden" name="key_id" value="{{$id}}" >
                                                  <input type="text" name="mou_content_key" class="form-control" required="required" value="{{$MouList->key}}" placeholder="Enter content key">
                                                <div class="invalid-feedback">
                                                    Please enter content key
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12" id="add_description">
                                                <div class="form-group pb-3">
                                                    <div class="d-flex justify-content-between mb-2" >
                                                        <label for="forl-label">Content Description(<a href="#" onclick="add_new_description()">Add New</a>)</label>
                                                        <div class="text-danger asterik text-end mb-0 pb-0">*</div>
                                                    </div>
                                                    @if(isset($vv) &&!empty($vv))
                                                    @foreach($vv as $pll)
                                                    <textarea name="mou_content_description[]" class="form-control" required="required" placeholder="Enter content description" rows="3">{{$pll}}</textarea>
                                                    <div class="invalid-feedback">
                                                        Please enter content description
                                                    </div>
                                                    <br>
                                                    @endforeach
                                                    @endif

                                                    <textarea name="mou_content_description[]" class="form-control" required="required" placeholder="Enter content description" rows="3"></textarea>
                                                    <div class="invalid-feedback">
                                                        Please enter content description
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary menu"  style="float:left;">Submit</button>
                                    </div>

                                </form>
                                </div>
                                </div>
                            </div>

                            &nbsp;&nbsp;
                            @php($id = encrypt($MouList->id))
                        <a onclick="if(confirm('Are you sure you want to permenent delete?')){ event.preventDefault();
                        document.getElementById('role-delete-{{$id}}').submit(); }else{}" href="#"><i class="glyphicon glyphicon-trash text-danger"></i></a>
                        <form id="role-delete-{{$id}}" action="{{ route('mou.destroy',$id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        </form>
                    </td>
                </tr>


                @php($sl++)
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    </div>
    
</div>



<!---------------------------- SITE Mobile ------------------------------------------->



<!---------------------------- SITE Favicon & Logo ------------------------------------------->




</form>

<script>
    

   

    function add_new_description(){

        

            var emp = '';
                emp += '<div class="form-group pb-3">';
                emp += '<div class="d-flex justify-content-between mb-2" >';
                    emp += '<label for="forl-label"></label>';
                    emp += '<div class="text-danger asterik text-end mb-0 pb-0" style="float:right;">*</div>';
                    emp += '</div>';
                    emp += '<textarea name="mou_content_description[]" class="form-control" required="required" placeholder="Enter content description" rows="3"></textarea>';
                    emp += '<div class="invalid-feedback">Please enter content description</div></div>';
                                        
                      
            

            $("#add_description").append(emp);

    }

    
   

    
</script>