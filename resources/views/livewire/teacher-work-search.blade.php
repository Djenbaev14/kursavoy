
<div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-striped">
        <tr>
          <th class="text-center">
            <div class="custom-checkbox custom-checkbox-table custom-control">
              <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                class="custom-control-input" id="checkbox-all">
              <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
            </div>
          </th>
          <th>Name</th>
          <th>Group</th>
          <th>File</th>
          <th>Score</th>
        </tr>
        @foreach ($students as $v)
            <tr>
              <td class="p-0 text-center">
                <div class="custom-checkbox custom-control">
                  <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                    id="checkbox-1">
                  <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                </div>
              </td>
              <td>{{$v->name}}</td>
              <td>{{$v->group_name}}</td>
              <td><a href="../../../works/{{$v->file}}" target="_blank">{{$v->file}}</a></td>
              <td>
                @if ($v->score == NULL)
                  <form action="{{route('teacher.check')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$v->id}}">
                    <div class="row">
                      <div class="col-9">
                        <input type="number" name="score" class="form-control">
                        @error('score')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="col-3">
                        <input type="submit" value="ok" class="btn btn-primary">
                      </div>
                    </div>
                  </form>
                  @else
                  {{$v->score}}
                @endif
              </td>
            </tr>
        @endforeach
      </table>
    </div>
  </div>