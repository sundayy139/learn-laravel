<h1>Create user</h1>

<form action="{{route('users.store')}}" method="POST">
    @csrf
    First Name
    <input type="text" name="firstName">
    <br>
    Middle Name
    <input type="text" name="middleName">
    <br>
    Last Name
    <input type="text" name="lastName">
    <br>
    Email
    <input type="email" name="email">
    <br>
    Mobile
    <input type="phone" name="mobile">
    <br>
    Password    
    <input type="password" name="password">
    <br>
    Intro
    <textarea type="text" name="intro">
    </textarea>
    <br>
    Profile
    <textarea type="text" name="profile">
    </textarea>
    <br>
    <button>Create</button>
</form>
