<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <title>Add Group</title>
</head>
<body>
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand mr-auto mt-2" href="index.php">admin panel</a>
      <ul class="navbar-nav mr-5">
              <li class="nav-item">
                <a class="nav-link" href="{{route('createGroupPage')}}">Add Group</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('createSubjectPage')}}">Add Subject</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('createTeacherToSubPage')}}">Add Teacher to Subject</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('createTeacherPage')}}">Add Teacher</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('createStudentPage')}}">Add Student</a>
              </li>
      </ul>
      <div>
        <a href="{{route('logout')}}" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>     
          Logout
      </a>
      </div>
    </div>
  </nav>
  <div class="container mt-5">
    <div class="row mt-5">
      <div class="col-4"></div>
      <div class="col-4">
        <form class='card Regular shadow p-4' method='POST' action="{{route('createGroup')}}">
          @csrf
          <div class="form-group mb-1">
            <label for="exampleInputPassword1">Jańa gruppa qosıw:</label>
            <input type="text" name='name'  class="form-control mt-2" id="exampleInputPassword1" placeholder="jan'a gruppa kiritiń">
            @error('name')
                <span class="text-danger p-1">{{ $message }}</span>
            @enderror
          </div>
          <input type='submit' class='btn btn-outline-primary mt-3' value='Add Group'>
        </form>
      </div>
      <div class="col-4"></div>
    </div>
  </div>
</body>
</html>