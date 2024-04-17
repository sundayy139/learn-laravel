<h1>Danh sách Users</h1>

<a href="{{route('users.create')}}">
    Add user
</a>
<table border="1" width="100%">
  <tr>
    <th>#</th>
    <th>Name</th>
    <th>Email</th>
    <th>Mobile</th>
    <th>Intro</th>
    <th>Profile</th>
    <th>Registed At</th>
  </tr>

  @foreach($users as $user)
  <tr>
    <td>{{ $user -> id }}</td>
    <td>{{ $user -> fullName }} </td>
    <td>{{ $user -> email }}</td>
    <td>{{ $user -> mobile }}</td>
    <td>{{ $user -> intro }}</td>
    <td>{{ $user -> profile }}</td>
    <td>{{ $user -> registedAt }}</td>
  </tr>
  @endforeach
</table>

